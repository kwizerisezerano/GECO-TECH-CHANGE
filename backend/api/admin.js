const express = require('express');
const router = express.Router();
const mysql = require('mysql2/promise');
const multer = require('multer');
const path = require('path');
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

// Configure multer for file uploads
const storage = multer.memoryStorage();
const upload = multer({
  storage: storage,
  limits: {
    fileSize: 10 * 1024 * 1024 // 10MB limit
  },
  fileFilter: (req, file, cb) => {
    // Allow PDF files only
    if (file.mimetype === 'application/pdf') {
      cb(null, true);
    } else {
      cb(new Error('Only PDF files are allowed'), false);
    }
  }
});

// Helper function to create notifications
async function createNotification(title, message, type = 'info', relatedEntityType = null, relatedEntityId = null) {
  try {
    await db.execute(`
      INSERT INTO notifications (title, message, type, related_entity_type, related_entity_id) 
      VALUES (?, ?, ?, ?, ?)
    `, [title, message, type, relatedEntityType, relatedEntityId]);
  } catch (error) {
    console.error('Failed to create notification:', error);
  }
}

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
    
    // Total users (admin users)
    const [users] = await db.execute('SELECT COUNT(*) as count FROM admin_users');
    
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
    
    // Budget summary by currency
    const [projectsByCurrency] = await db.execute(`
      SELECT currency, budget
      FROM projects 
      WHERE budget IS NOT NULL AND currency IS NOT NULL
    `);
    
    // Group budgets by currency
    const budgetByCurrency = {};
    projectsByCurrency.forEach(project => {
      const currency = project.currency || 'RWF';
      if (!budgetByCurrency[currency]) {
        budgetByCurrency[currency] = {
          total: 0,
          count: 0,
          min: project.budget,
          max: project.budget
        };
      }
      
      budgetByCurrency[currency].total += project.budget;
      budgetByCurrency[currency].count++;
      budgetByCurrency[currency].min = Math.min(budgetByCurrency[currency].min, project.budget);
      budgetByCurrency[currency].max = Math.max(budgetByCurrency[currency].max, project.budget);
    });
    
    // Calculate averages for each currency
    Object.keys(budgetByCurrency).forEach(currency => {
      budgetByCurrency[currency].average = budgetByCurrency[currency].total / budgetByCurrency[currency].count;
    });
    
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
        totalUsers: users[0].count,
        totalPartners: partners[0].count,
        totalDonations: donations[0].count,
        totalDonationAmount: donations[0].total_amount || 0,
        recentProjects,
        recentBeneficiaries: decryptedBeneficiaries,
        partnerTypes,
        donationTrends,
        budgetSummary: budgetSummary[0],
        budgetByCurrency,
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
    
    // Handle duplicate entry error
    if (error.code === 'ER_DUP_ENTRY' || error.errno === 1062) {
      res.status(409).json({
        success: false,
        message: 'A project with this name already exists. Please choose a different name.'
      });
    } else {
      res.status(500).json({
        success: false,
        message: 'Failed to add project'
      });
    }
  }
});

// Update project
router.put('/projects/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const { project_name, status, description, start_date, end_date, budget, currency } = req.body;
    
    // Build dynamic update query based on provided fields
    const updateFields = [];
    const updateValues = [];
    
    if (project_name !== undefined) {
      updateFields.push('project_name = ?');
      updateValues.push(project_name);
    }
    if (status !== undefined) {
      updateFields.push('status = ?');
      updateValues.push(status);
    }
    if (description !== undefined) {
      updateFields.push('description = ?');
      updateValues.push(description);
    }
    if (start_date !== undefined) {
      updateFields.push('start_date = ?');
      updateValues.push(start_date);
    }
    if (end_date !== undefined) {
      updateFields.push('end_date = ?');
      updateValues.push(end_date);
    }
    if (budget !== undefined) {
      updateFields.push('budget = ?');
      updateValues.push(budget);
    }
    if (currency !== undefined) {
      updateFields.push('currency = ?');
      updateValues.push(currency);
    }
    
    // If no fields provided, return error
    if (updateFields.length === 0) {
      return res.status(400).json({
        success: false,
        message: 'No fields to update provided'
      });
    }
    
    // Add id to values
    updateValues.push(id);
    
    const updateQuery = `UPDATE projects SET ${updateFields.join(', ')} WHERE id = ?`;
    
    const [result] = await db.execute(updateQuery, updateValues);
    
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

// Get users
router.get('/users', async (req, res) => {
  try {
    const [users] = await db.execute(`
      SELECT id, name_encrypted, email_encrypted, role, last_login, created_at 
      FROM admin_users 
      ORDER BY created_at DESC
    `);
    
    // Decrypt sensitive data
    const decryptedUsers = users.map(user => ({
      id: user.id,
      name: decrypt(user.name_encrypted),
      email: decrypt(user.email_encrypted),
      role: user.role,
      last_login: user.last_login,
      created_at: user.created_at
    }));
    
    res.json({
      success: true,
      data: decryptedUsers
    });
  } catch (error) {
    console.error('Get users error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch users'
    });
  }
});

// Add new user
router.post('/users', async (req, res) => {
  try {
    const { name, email, password, role, status } = req.body;
    
    // Hash password
    const hashedPassword = hashPassword(password);
    
    const [result] = await db.execute(`
      INSERT INTO admin_users (name_encrypted, email_encrypted, password_hash, role, created_at) 
      VALUES (?, ?, ?, ?, NOW())
    `, [encrypt(name), encrypt(email), hashedPassword, role]);
    
    res.json({
      success: true,
      message: 'User added successfully',
      userId: result.insertId
    });
  } catch (error) {
    console.error('Add user error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to add user'
    });
  }
});

// Update user
router.put('/users/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const { name, email, password, role, status } = req.body;
    
    let updateQuery, updateValues;
    
    if (password) {
      // Update with new password
      const hashedPassword = hashPassword(password);
      updateQuery = `
        UPDATE admin_users 
        SET name_encrypted = ?, email_encrypted = ?, password_hash = ?, role = ?
        WHERE id = ?
      `;
      updateValues = [encrypt(name), encrypt(email), hashedPassword, role, id];
    } else {
      // Update without changing password
      updateQuery = `
        UPDATE admin_users 
        SET name_encrypted = ?, email_encrypted = ?, role = ?
        WHERE id = ?
      `;
      updateValues = [encrypt(name), encrypt(email), role, id];
    }
    
    const [result] = await db.execute(updateQuery, updateValues);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'User updated successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'User not found'
      });
    }
  } catch (error) {
    console.error('Update user error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to update user'
    });
  }
});

// Delete user
router.delete('/users/:id', async (req, res) => {
  try {
    const { id } = req.params;
    
    const [result] = await db.execute('DELETE FROM admin_users WHERE id = ?', [id]);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'User deleted successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'User not found'
      });
    }
  } catch (error) {
    console.error('Delete user error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to delete user'
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
    
    // Create notification
    await createNotification(
      'New Partner Added',
      `Partner "${partner_name}" has been successfully added to the system.`,
      'success',
      'partner',
      result.insertId
    );
    
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
      INSERT INTO people (name_encrypted, phone_number_encrypted, idno_type, idno_encrypted, person_type) 
      VALUES (?, ?, ?, ?, 'beneficiary')
    `, [
      encrypt(name),
      encrypt(phone_number),
      idno_type,
      encrypt(idno)
    ]);
    
    // Create notification
    await createNotification(
      'New Beneficiary Added',
      `Beneficiary "${name}" has been successfully added to the system.`,
      'success',
      'beneficiary',
      result.insertId
    );
    
    res.json({
      success: true,
      message: 'Beneficiary added successfully',
      data: {
        id: result.insertId,
        name,
        phone_number,
        idno_type,
        idno
      }
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
    `, [
      encrypt(name),
      encrypt(phone_number),
      idno_type,
      encrypt(idno),
      id
    ]);
    
    if (result.affectedRows > 0) {
      // Create notification
      await createNotification(
        'Beneficiary Updated',
        `Beneficiary "${name}" information has been updated.`,
        'info',
        'beneficiary',
        parseInt(id)
      );
      
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
    
    // Get beneficiary info before deletion for notification
    const [beneficiaryData] = await db.execute(`
      SELECT name_encrypted FROM people WHERE id = ? AND person_type = 'beneficiary'
    `, [id]);
    
    const [result] = await db.execute('DELETE FROM people WHERE id = ? AND person_type = \'beneficiary\'', [id]);
    
    if (result.affectedRows > 0) {
      // Create notification
      let beneficiaryName = 'Unknown';
      if (beneficiaryData.length > 0) {
        beneficiaryName = decrypt(beneficiaryData[0].name_encrypted);
      }
      
      await createNotification(
        'Beneficiary Deleted',
        `Beneficiary "${beneficiaryName}" has been removed from the system.`,
        'warning',
        'beneficiary',
        parseInt(id)
      );
      
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

// Get notifications
router.get('/notifications', async (req, res) => {
  try {
    const [notifications] = await db.execute(`
      SELECT id, title, message, type, related_entity_type, related_entity_id, is_read, created_at 
      FROM notifications 
      ORDER BY created_at DESC
      LIMIT 50
    `);
    
    res.json({
      success: true,
      data: notifications
    });
  } catch (error) {
    console.error('Get notifications error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch notifications'
    });
  }
});

// Add notification
router.post('/notifications', async (req, res) => {
  try {
    const { title, message, type, related_entity_type, related_entity_id } = req.body;
    
    // Convert undefined to null for MySQL compatibility
    const cleanRelatedEntityType = related_entity_type !== undefined ? related_entity_type : null;
    const cleanRelatedEntityId = related_entity_id !== undefined ? related_entity_id : null;
    
    const [result] = await db.execute(`
      INSERT INTO notifications (title, message, type, related_entity_type, related_entity_id) 
      VALUES (?, ?, ?, ?, ?)
    `, [title, message, type || 'info', cleanRelatedEntityType, cleanRelatedEntityId]);
    
    res.json({
      success: true,
      message: 'Notification created successfully',
      data: {
        id: result.insertId,
        title,
        message,
        type: type || 'info',
        related_entity_type: cleanRelatedEntityType,
        related_entity_id: cleanRelatedEntityId
      }
    });
  } catch (error) {
    console.error('Add notification error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to create notification'
    });
  }
});

// Update notification
router.put('/notifications/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const { title, message, type } = req.body;
    
    // Build dynamic update query based on provided fields
    const updateFields = [];
    const updateValues = [];
    
    if (title !== undefined) {
      updateFields.push('title = ?');
      updateValues.push(title);
    }
    if (message !== undefined) {
      updateFields.push('message = ?');
      updateValues.push(message);
    }
    if (type !== undefined) {
      updateFields.push('type = ?');
      updateValues.push(type);
    }
    
    // If no fields provided, return error
    if (updateFields.length === 0) {
      return res.status(400).json({
        success: false,
        message: 'No fields to update provided'
      });
    }
    
    // Add id to values
    updateValues.push(id);
    
    const updateQuery = `UPDATE notifications SET ${updateFields.join(', ')} WHERE id = ?`;
    
    const [result] = await db.execute(updateQuery, updateValues);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'Notification updated successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Notification not found'
      });
    }
  } catch (error) {
    console.error('Update notification error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to update notification'
    });
  }
});

// Mark notification as read
router.put('/notifications/:id/read', async (req, res) => {
  try {
    const { id } = req.params;
    
    const [result] = await db.execute('UPDATE notifications SET is_read = TRUE WHERE id = ?', [id]);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'Notification marked as read'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Notification not found'
      });
    }
  } catch (error) {
    console.error('Mark notification as read error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to mark notification as read'
    });
  }
});

// Delete notification
router.delete('/notifications/:id', async (req, res) => {
  try {
    const { id } = req.params;
    
    const [result] = await db.execute('DELETE FROM notifications WHERE id = ?', [id]);
    
    if (result.affectedRows > 0) {
      res.json({
        success: true,
        message: 'Notification deleted successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Notification not found'
      });
    }
  } catch (error) {
    console.error('Delete notification error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to delete notification'
    });
  }
});

// Get unread notifications count
router.get('/notifications/unread/count', async (req, res) => {
  try {
    const [result] = await db.execute('SELECT COUNT(*) as count FROM notifications WHERE is_read = FALSE');
    
    res.json({
      success: true,
      data: {
        unread_count: result[0].count
      }
    });
  } catch (error) {
    console.error('Get unread notifications count error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to get unread notifications count'
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

// Upload publication
router.post('/publications', upload.single('file'), async (req, res) => {
  try {
    if (!req.file) {
      return res.status(400).json({
        success: false,
        message: 'No file uploaded'
      });
    }

    const { originalname, buffer, size, mimetype } = req.file;
    const file_type = originalname;

    // Insert file into database
    const [result] = await db.execute(`
      INSERT INTO pdf_files (file_name, file_data, file_type, file_size) 
      VALUES (?, ?, ?, ?)
    `, [originalname, buffer, file_type, size]);

    // Create notification
    await createNotification(
      'New Publication Uploaded',
      `Publication "${originalname}" has been successfully uploaded.`,
      'success',
      'publication',
      result.insertId
    );

    res.json({
      success: true,
      message: 'Publication uploaded successfully',
      data: {
        id: result.insertId,
        file_name: originalname,
        file_type: file_type,
        file_size: size
      }
    });
  } catch (error) {
    console.error('Upload publication error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to upload publication'
    });
  }
});

// Download publication
router.get('/publications/:id/download', async (req, res) => {
  try {
    const { id } = req.params;
    
    const [publication] = await db.execute(`
      SELECT file_name, file_data, file_type 
      FROM pdf_files 
      WHERE id = ?
    `, [id]);
    
    if (publication.length === 0) {
      return res.status(404).json({
        success: false,
        message: 'Publication not found'
      });
    }

    const file = publication[0];
    
    res.setHeader('Content-Type', 'application/pdf');
    res.setHeader('Content-Disposition', `attachment; filename="${file.file_name}"`);
    res.send(file.file_data);
  } catch (error) {
    console.error('Download publication error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to download publication'
    });
  }
});

// Delete publication
router.delete('/publications/:id', async (req, res) => {
  try {
    const { id } = req.params;
    
    // Get publication info before deletion for notification
    const [publicationData] = await db.execute(`
      SELECT file_name FROM pdf_files WHERE id = ?
    `, [id]);
    
    const [result] = await db.execute('DELETE FROM pdf_files WHERE id = ?', [id]);
    
    if (result.affectedRows > 0) {
      // Create notification
      let fileName = 'Unknown';
      if (publicationData.length > 0) {
        fileName = publicationData[0].file_name;
      }
      
      await createNotification(
        'Publication Deleted',
        `Publication "${fileName}" has been removed from the system.`,
        'warning',
        'publication',
        parseInt(id)
      );
      
      res.json({
        success: true,
        message: 'Publication deleted successfully'
      });
    } else {
      res.status(404).json({
        success: false,
        message: 'Publication not found'
      });
    }
  } catch (error) {
    console.error('Delete publication error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to delete publication'
    });
  }
});

module.exports = router;
