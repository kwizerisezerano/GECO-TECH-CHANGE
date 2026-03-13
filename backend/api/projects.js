const express = require('express');
const router = express.Router();
const mysql = require('mysql2/promise');

// Database connection
const dbConfig = {
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'gecorwanda'
};

// Get all projects or filter by status
router.get('/', async (req, res) => {
  try {
    const { status } = req.query;
    const connection = await mysql.createConnection(dbConfig);
    
    let query = 'SELECT * FROM projects';
    let params = [];
    
    if (status) {
      query += ' WHERE status = ?';
      params.push(status);
    }
    
    query += ' ORDER BY created_at DESC';
    
    const [rows] = await connection.execute(query, params);
    await connection.end();
    
    res.json(rows);
  } catch (error) {
    console.error('Error fetching projects:', error);
    res.status(500).json({ error: 'Failed to fetch projects' });
  }
});

// Get single project by ID
router.get('/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const connection = await mysql.createConnection(dbConfig);
    
    const [rows] = await connection.execute(
      'SELECT * FROM projects WHERE id = ?',
      [id]
    );
    
    await connection.end();
    
    if (rows.length === 0) {
      return res.status(404).json({ error: 'Project not found' });
    }
    
    res.json(rows[0]);
  } catch (error) {
    console.error('Error fetching project:', error);
    res.status(500).json({ error: 'Failed to fetch project' });
  }
});

// Create new project
router.post('/', async (req, res) => {
  try {
    const { project_name, status, description, start_date, end_date, budget } = req.body;
    
    if (!project_name || !status) {
      return res.status(400).json({ error: 'Project name and status are required' });
    }
    
    const connection = await mysql.createConnection(dbConfig);
    
    const [result] = await connection.execute(
      `INSERT INTO projects (project_name, status, description, start_date, end_date, budget) 
       VALUES (?, ?, ?, ?, ?, ?)`,
      [project_name, status, description, start_date, end_date, budget]
    );
    
    await connection.end();
    
    res.status(201).json({ 
      id: result.insertId,
      message: 'Project created successfully' 
    });
  } catch (error) {
    console.error('Error creating project:', error);
    res.status(500).json({ error: 'Failed to create project' });
  }
});

// Update project
router.put('/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const { project_name, status, description, start_date, end_date, budget } = req.body;
    
    if (!project_name || !status) {
      return res.status(400).json({ error: 'Project name and status are required' });
    }
    
    const connection = await mysql.createConnection(dbConfig);
    
    const [result] = await connection.execute(
      `UPDATE projects 
       SET project_name = ?, status = ?, description = ?, start_date = ?, end_date = ?, budget = ?
       WHERE id = ?`,
      [project_name, status, description, start_date, end_date, budget, id]
    );
    
    await connection.end();
    
    if (result.affectedRows === 0) {
      return res.status(404).json({ error: 'Project not found' });
    }
    
    res.json({ message: 'Project updated successfully' });
  } catch (error) {
    console.error('Error updating project:', error);
    res.status(500).json({ error: 'Failed to update project' });
  }
});

// Delete project
router.delete('/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const connection = await mysql.createConnection(dbConfig);
    
    const [result] = await connection.execute(
      'DELETE FROM projects WHERE id = ?',
      [id]
    );
    
    await connection.end();
    
    if (result.affectedRows === 0) {
      return res.status(404).json({ error: 'Project not found' });
    }
    
    res.json({ message: 'Project deleted successfully' });
  } catch (error) {
    console.error('Error deleting project:', error);
    res.status(500).json({ error: 'Failed to delete project' });
  }
});

module.exports = router;
