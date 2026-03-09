const express = require('express');
const cors = require('cors');
const mysql = require('mysql2/promise');
require('dotenv').config();

const app = express();
const PORT = process.env.PORT || 3001;

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

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
    console.log('Connected to MySQL database');
  } catch (error) {
    console.error('Database connection failed:', error);
    process.exit(1);
  }
}

// API Routes
app.get('/api/stats', async (req, res) => {
  try {
    const [beneficiaries] = await db.execute('SELECT COUNT(*) as count FROM beneficiaries');
    const [projects] = await db.execute('SELECT COUNT(*) as count FROM projects WHERE status = ?', ['Completed']);
    const [partners] = await db.execute('SELECT COUNT(*) as count FROM partners');
    const [donations] = await db.execute('SELECT COUNT(*) as count FROM donation WHERE payment_status = ?', ['success']);

    res.json({
      beneficiaries: beneficiaries[0].count,
      projects: projects[0].count,
      partners: partners[0].count,
      donations: donations[0].count
    });
  } catch (error) {
    console.error('Error fetching stats:', error);
    res.status(500).json({ error: 'Failed to fetch statistics' });
  }
});

app.get('/api/projects', async (req, res) => {
  try {
    const [projects] = await db.execute('SELECT * FROM projects ORDER BY created_at DESC');
    res.json(projects);
  } catch (error) {
    console.error('Error fetching projects:', error);
    res.status(500).json({ error: 'Failed to fetch projects' });
  }
});

app.get('/api/beneficiaries', async (req, res) => {
  try {
    const [beneficiaries] = await db.execute('SELECT * FROM beneficiaries ORDER BY created_at DESC');
    res.json(beneficiaries);
  } catch (error) {
    console.error('Error fetching beneficiaries:', error);
    res.status(500).json({ error: 'Failed to fetch beneficiaries' });
  }
});

app.get('/api/partners', async (req, res) => {
  try {
    const [partners] = await db.execute('SELECT * FROM partners ORDER BY created_at DESC');
    res.json(partners);
  } catch (error) {
    console.error('Error fetching partners:', error);
    res.status(500).json({ error: 'Failed to fetch partners' });
  }
});

app.post('/api/donation', async (req, res) => {
  try {
    const { name, email, amount, phone } = req.body;
    const [result] = await db.execute(
      'INSERT INTO donation (name, email, amount, phone, payment_status) VALUES (?, ?, ?, ?, ?)',
      [name, email, amount, phone, 'pending']
    );
    res.json({ success: true, id: result.insertId });
  } catch (error) {
    console.error('Error processing donation:', error);
    res.status(500).json({ error: 'Failed to process donation' });
  }
});

// Start server
initDB().then(() => {
  app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
  });
});
