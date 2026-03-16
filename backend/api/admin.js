const express = require('express');
const router = express.Router();
const mysql = require('mysql2/promise');
const { hashPassword, comparePassword, decrypt, encrypt } = require('../utils/crypto');

// Database connection
const dbConfig = {
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_NAME || 'gecorwanda'
};

let db;

async function initDB() {
  try {
    db = await mysql.createConnection(dbConfig);
    console.log('Admin API connected to MySQL database');
  } catch (error) {
    console.error('Admin API Database connection failed:', error);
  }
}

initDB();

// Admin login endpoint
router.post('/login', async (req, res) => {
  try {
    const { email, password } = req.body;
    
    if (!email || !password) {
      return res.status(400).json({
        success: false,
        message: 'Email and password are required'
      });
    }
    
    // Find admin user by checking all admin emails (since they're encrypted)
    const [users] = await db.execute('SELECT * FROM admin_users');
    
    // Decrypt emails and find matching user
    let matchingUser = null;
    for (const user of users) {
      const decryptedEmail = decrypt(user.email_encrypted);
      if (decryptedEmail === email) {
        matchingUser = user;
        break;
      }
    }
    
    if (!matchingUser) {
      return res.status(401).json({
        success: false,
        message: 'Invalid email or password'
      });
    }
    
    // Verify password
    const isValidPassword = comparePassword(password, matchingUser.password_hash);
    
    if (!isValidPassword) {
      return res.status(401).json({
        success: false,
        message: 'Invalid email or password'
      });
    }
    
    // Update last login
    await db.execute(
      'UPDATE admin_users SET last_login = NOW() WHERE id = ?',
      [matchingUser.id]
    );
    
    res.json({
      success: true,
      message: 'Login successful',
      user: {
        id: matchingUser.id,
        email: email, // Return the email they logged in with
        name: decrypt(matchingUser.name_encrypted),
        role: matchingUser.role
      }
    });
  } catch (error) {
    console.error('Login error:', error);
    res.status(500).json({
      success: false,
      message: 'Server error'
    });
  }
});

// Get dashboard statistics
router.get('/dashboard-stats', async (req, res) => {
  try {
    // Projects count by status
    const [projectStats] = await db.execute(`
      SELECT status, COUNT(*) as count 
      FROM projects 
      GROUP BY status
    `);
    
    // Total beneficiaries
    const [beneficiaries] = await db.execute('SELECT COUNT(*) as count FROM people WHERE person_type = "beneficiary"');
    
    // Total members
    const [members] = await db.execute('SELECT COUNT(*) as count FROM people WHERE person_type = "member"');
    
    // Total partners
    const [partners] = await db.execute('SELECT COUNT(*) as count FROM partners');
    
    // Successful donations
    const [donations] = await db.execute(`
      SELECT COUNT(*) as count, SUM(amount) as total_amount
      FROM donation 
      WHERE payment_status = 'success'
    `);
    
    // Recent projects
    const [recentProjects] = await db.execute(`
      SELECT * FROM projects 
      ORDER BY created_at DESC 
      LIMIT 5
    `);
    
    // Recent beneficiaries
    const [recentBeneficiaries] = await db.execute(`
      SELECT id, name_encrypted, created_at 
      FROM people 
      WHERE person_type = 'beneficiary'
      ORDER BY created_at DESC 
      LIMIT 5
    `);
    
    // Partner types distribution
    const [partnerTypes] = await db.execute(`
      SELECT partnership_type, COUNT(*) as count 
      FROM partners 
      GROUP BY partnership_type
    `);
    
    // Monthly donation trends (last 6 months)
    const [donationTrends] = await db.execute(`
      SELECT 
        DATE_FORMAT(created_at, '%Y-%m') as month,
        COUNT(*) as count,
        SUM(amount) as total_amount
      FROM donation 
      WHERE payment_status = 'success' 
        AND created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
      GROUP BY DATE_FORMAT(created_at, '%Y-%m')
      ORDER BY month DESC
    `);
    
    // Project budget summary
    const [budgetSummary] = await db.execute(`
      SELECT 
        SUM(budget) as total_budget,
        AVG(budget) as avg_budget,
        MIN(budget) as min_budget,
        MAX(budget) as max_budget
      FROM projects 
      WHERE budget IS NOT NULL
    `);
    
    // Publications count
    const [publications] = await db.execute('SELECT COUNT(*) as count FROM pdf_files');
    
    // Decrypt recent beneficiaries names
    const decryptedBeneficiaries = recentBeneficiaries.map(beneficiary => ({
      id: beneficiary.id,
      name: decrypt(beneficiary.name_encrypted),
      created_at: beneficiary.created_at
    }));
    
    res.json({
      success: true,
      data: {
        projectStats,
        totalBeneficiaries: beneficiaries[0].count,
        totalMembers: members[0].count,
        totalPartners: partners[0].count,
        totalDonations: donations[0].count,
        totalDonationAmount: donations[0].total_amount || 0,
        recentProjects,
        recentBeneficiaries: decryptedBeneficiaries,
        partnerTypes,
        donationTrends,
        budgetSummary: budgetSummary[0],
        totalPublications: publications[0].count
      }
    });
  } catch (error) {
    console.error('Dashboard stats error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch dashboard statistics'
    });
  }
});

// Get all projects for admin
router.get('/projects', async (req, res) => {
  try {
    const [projects] = await db.execute(`
      SELECT * FROM projects 
      ORDER BY created_at DESC
    `);
    
    res.json({
      success: true,
      data: projects
    });
  } catch (error) {
    console.error('Get projects error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch projects'
    });
  }
});

// Add new project
router.post('/projects', async (req, res) => {
  try {
    const { project_name, status, description, start_date, end_date, budget } = req.body;
    
    const [result] = await db.execute(`
      INSERT INTO projects (project_name, status, description, start_date, end_date, budget, created_at) 
      VALUES (?, ?, ?, ?, ?, ?, NOW())
    `, [project_name, status, description, start_date, end_date, budget]);
    
    res.json({
      success: true,
      message: 'Project added successfully',
      projectId: result.insertId
    });
  } catch (error) {
    console.error('Add project error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to add project'
    });
  }
});

// Update project
router.put('/projects/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const { project_name, status, description, start_date, end_date, budget } = req.body;
    
    const [result] = await db.execute(`
      UPDATE projects 
      SET project_name = ?, status = ?, description = ?, start_date = ?, end_date = ?, budget = ?
      WHERE id = ?
    `, [project_name, status, description, start_date, end_date, budget, id]);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'Project updated successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Project not found'
      });
    }
  } catch (error) {
    console.error('Update project error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to update project'
    });
  }
});

// Delete project
router.delete('/projects/:id', async (req, res) => {
  try {
    const { id } = req.params;
    
    const [result] = await db.execute('DELETE FROM projects WHERE id = ?', [id]);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'Project deleted successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Project not found'
      });
    }
  } catch (error) {
    console.error('Delete project error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to delete project'
    });
  }
});

// Get beneficiaries
router.get('/beneficiaries', async (req, res) => {
  try {
    const [beneficiaries] = await db.execute(`
      SELECT id, name_encrypted, phone_number_encrypted, 
             idno_type, idno_encrypted, created_at 
      FROM people 
      WHERE person_type = 'beneficiary'
      ORDER BY created_at DESC
    `);
    
    // Decrypt sensitive data
    const decryptedBeneficiaries = beneficiaries.map(beneficiary => ({
      id: beneficiary.id,
      name: decrypt(beneficiary.name_encrypted),
      phone_number: decrypt(beneficiary.phone_number_encrypted),
      idno_type: beneficiary.idno_type,
      idno: decrypt(beneficiary.idno_encrypted),
      created_at: beneficiary.created_at
    }));
    
    res.json({
      success: true,
      data: decryptedBeneficiaries
    });
  } catch (error) {
    console.error('Get beneficiaries error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch beneficiaries'
    });
  }
});

// Get donations
router.get('/donations', async (req, res) => {
  try {
    const [donations] = await db.execute(`
      SELECT * FROM donation 
      ORDER BY created_at DESC
    `);
    
    res.json({
      success: true,
      data: donations
    });
  } catch (error) {
    console.error('Get donations error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch donations'
    });
  }
});

// Get members
router.get('/members', async (req, res) => {
  try {
    const [members] = await db.execute(`
      SELECT id, name_encrypted, phone_number_encrypted,
             idno_type, idno_encrypted, role, created_at 
      FROM people 
      WHERE person_type = 'member'
      ORDER BY created_at DESC
    `);
    
    // Decrypt sensitive data
    const decryptedMembers = members.map(member => ({
      id: member.id,
      name: decrypt(member.name_encrypted),
      phone_number: decrypt(member.phone_number_encrypted),
      idno_type: member.idno_type,
      idno: decrypt(member.idno_encrypted),
      role: member.role,
      created_at: member.created_at
    }));
    
    res.json({
      success: true,
      data: decryptedMembers
    });
  } catch (error) {
    console.error('Get members error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch members'
    });
  }
});

// Get partners
router.get('/partners', async (req, res) => {
  try {
    const [partners] = await db.execute(`
      SELECT id, partner_name_encrypted, contact_person_encrypted, email_encrypted,
             phone_encrypted, description, partnership_type, created_at 
      FROM partners 
      ORDER BY created_at DESC
    `);
    
    // Decrypt sensitive data
    const decryptedPartners = partners.map(partner => ({
      id: partner.id,
      partner_name: decrypt(partner.partner_name_encrypted),
      contact_person: decrypt(partner.contact_person_encrypted),
      email: decrypt(partner.email_encrypted),
      phone: decrypt(partner.phone_encrypted),
      description: partner.description,
      partnership_type: partner.partnership_type,
      created_at: partner.created_at
    }));
    
    res.json({
      success: true,
      data: decryptedPartners
    });
  } catch (error) {
    console.error('Get partners error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch partners'
    });
  }
});

// Add new partner
router.post('/partners', async (req, res) => {
  try {
    const { partner_name, contact_person, email, phone, description, partnership_type } = req.body;
    
    const [result] = await db.execute(`
      INSERT INTO partners (partner_name_encrypted, contact_person_encrypted, email_encrypted, phone_encrypted, description, partnership_type, created_at) 
      VALUES (?, ?, ?, ?, ?, ?, NOW())
    `, [
      encrypt(partner_name),
      encrypt(contact_person),
      encrypt(email),
      encrypt(phone),
      description,
      partnership_type
    ]);
    
    res.json({
      success: true,
      message: 'Partner added successfully',
      partnerId: result.insertId
    });
  } catch (error) {
    console.error('Add partner error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to add partner'
    });
  }
});

// Update partner
router.put('/partners/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const { partner_name, contact_person, email, phone, description, partnership_type } = req.body;
    
    const [result] = await db.execute(`
      UPDATE partners 
      SET partner_name_encrypted = ?, contact_person_encrypted = ?, email_encrypted = ?, phone_encrypted = ?, description = ?, partnership_type = ?
      WHERE id = ?
    `, [
      encrypt(partner_name),
      encrypt(contact_person),
      encrypt(email),
      encrypt(phone),
      description,
      partnership_type,
      id
    ]);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'Partner updated successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Partner not found'
      });
    }
  } catch (error) {
    console.error('Update partner error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to update partner'
    });
  }
});

// Delete partner
router.delete('/partners/:id', async (req, res) => {
  try {
    const { id } = req.params;
    
    const [result] = await db.execute('DELETE FROM partners WHERE id = ?', [id]);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'Partner deleted successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Partner not found'
      });
    }
  } catch (error) {
    console.error('Delete partner error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to delete partner'
    });
  }
});

// Add new beneficiary
router.post('/beneficiaries', async (req, res) => {
  try {
    const { name, phone_number, idno_type, idno } = req.body;
    
    const [result] = await db.execute(`
      INSERT INTO people (name_encrypted, phone_number_encrypted, idno_type, idno_encrypted, person_type, created_at) 
      VALUES (?, ?, ?, ?, 'beneficiary', NOW())
    `, [encrypt(name), encrypt(phone_number), idno_type, encrypt(idno)]);
    
    res.json({
      success: true,
      message: 'Beneficiary added successfully',
      beneficiaryId: result.insertId
    });
  } catch (error) {
    console.error('Add beneficiary error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to add beneficiary'
    });
  }
});

// Update beneficiary
router.put('/beneficiaries/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const { name, phone_number, idno_type, idno } = req.body;
    
    const [result] = await db.execute(`
      UPDATE people 
      SET name_encrypted = ?, phone_number_encrypted = ?, idno_type = ?, idno_encrypted = ?
      WHERE id = ? AND person_type = 'beneficiary'
    `, [encrypt(name), encrypt(phone_number), idno_type, encrypt(idno), id]);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'Beneficiary updated successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Beneficiary not found'
      });
    }
  } catch (error) {
    console.error('Update beneficiary error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to update beneficiary'
    });
  }
});

// Delete beneficiary
router.delete('/beneficiaries/:id', async (req, res) => {
  try {
    const { id } = req.params;
    
    const [result] = await db.execute('DELETE FROM people WHERE id = ? AND person_type = \'beneficiary\'', [id]);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'Beneficiary deleted successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Beneficiary not found'
      });
    }
  } catch (error) {
    console.error('Delete beneficiary error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to delete beneficiary'
    });
  }
});

// Add new member
router.post('/members', async (req, res) => {
  try {
    const { name, phone_number, idno_type, idno, role } = req.body;
    
    const [result] = await db.execute(`
      INSERT INTO people (name_encrypted, phone_number_encrypted, idno_type, idno_encrypted, person_type, role, created_at) 
      VALUES (?, ?, ?, ?, 'member', ?, NOW())
    `, [encrypt(name), encrypt(phone_number), idno_type, encrypt(idno), role]);
    
    res.json({
      success: true,
      message: 'Member added successfully',
      memberId: result.insertId
    });
  } catch (error) {
    console.error('Add member error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to add member'
    });
  }
});

// Update member
router.put('/members/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const { name, phone_number, idno_type, idno, role } = req.body;
    
    const [result] = await db.execute(`
      UPDATE people 
      SET name_encrypted = ?, phone_number_encrypted = ?, idno_type = ?, idno_encrypted = ?, role = ?
      WHERE id = ? AND person_type = 'member'
    `, [encrypt(name), encrypt(phone_number), idno_type, encrypt(idno), role, id]);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'Member updated successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Member not found'
      });
    }
  } catch (error) {
    console.error('Update member error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to update member'
    });
  }
});

// Delete member
router.delete('/members/:id', async (req, res) => {
  try {
    const { id } = req.params;
    
    const [result] = await db.execute('DELETE FROM people WHERE id = ? AND person_type = \'member\'', [id]);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'Member deleted successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Member not found'
      });
    }
  } catch (error) {
    console.error('Delete member error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to delete member'
    });
  }
});

// Get publications
router.get('/publications', async (req, res) => {
  try {
    const [publications] = await db.execute(`
      SELECT id, file_name, file_type, file_size, uploaded_at 
      FROM pdf_files 
      ORDER BY uploaded_at DESC
    `);
    
    res.json({
      success: true,
      data: publications
    });
  } catch (error) {
    console.error('Get publications error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch publications'
    });
  }
});

module.exports = router;
