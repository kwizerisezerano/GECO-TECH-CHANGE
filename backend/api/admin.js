const express = require('express');
const router = express.Router();
const mysql = require('mysql2/promise');

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
    const { username, password } = req.body;
    
    // Simple authentication (you should enhance this with proper password hashing)
    if (username === 'admin' && password === 'geco2024') {
      // In a real application, you would generate a JWT token here
      res.json({
        success: true,
        message: 'Login successful',
        user: {
          username: username,
          role: 'admin'
        }
      });
    } else {
      res.status(401).json({
        success: false,
        message: 'Invalid username or password'
      });
    }
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
    const [beneficiaries] = await db.execute('SELECT COUNT(*) as count FROM beneficiaries');
    
    // Total partners
    const [partners] = await db.execute('SELECT COUNT(*) as count FROM partners');
    
    // Successful donations
    const [donations] = await db.execute(`
      SELECT COUNT(*) as count 
      FROM donation 
      WHERE payment_status = 'success'
    `);
    
    // Recent projects
    const [recentProjects] = await db.execute(`
      SELECT * FROM projects 
      ORDER BY created_at DESC 
      LIMIT 5
    `);
    
    res.json({
      success: true,
      data: {
        projectStats,
        totalBeneficiaries: beneficiaries[0].count,
        totalPartners: partners[0].count,
        totalDonations: donations[0].count,
        recentProjects
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
      SELECT * FROM beneficiaries 
      ORDER BY created_at DESC
    `);
    
    res.json({
      success: true,
      data: beneficiaries
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
      SELECT * FROM members 
      ORDER BY created_at DESC
    `);
    
    res.json({
      success: true,
      data: members
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
      SELECT * FROM partners 
      ORDER BY created_at DESC
    `);
    
    res.json({
      success: true,
      data: partners
    });
  } catch (error) {
    console.error('Get partners error:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch partners'
    });
  }
});

module.exports = router;
