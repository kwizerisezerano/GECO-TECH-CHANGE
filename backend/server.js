const express = require('express');
const cors = require('cors');
const mysql = require('mysql2/promise');
const nodemailer = require('nodemailer');
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

// Contact Form Endpoint
app.post('/api/contact', async (req, res) => {
  try {
    const { name, email, phone, subject, message, toEmail, appName } = req.body;

    // Validate required fields
    if (!name || !email || !subject || !message) {
      return res.status(400).json({
        success: false,
        message: 'Missing required fields'
      });
    }

    // Create email transporter using app password for Gmail
    const transporter = nodemailer.createTransport({
      host: 'smtp.gmail.com',
      port: 587,
      secure: false,
      auth: {
        user: 'globalepelepticc@gmail.com',
        pass: 'qmoaglalasotogqx' // App password without spaces
      },
      tls: {
        rejectUnauthorized: false
      }
    });

    // Email content
    const mailOptions = {
      from: `${appName || 'GECO RWANDA'} <noreply@gecorwanda.org>`,
      to: toEmail || 'globalepelepticc@gmail.com',
      subject: `${appName || 'GECO RWANDA'} Contact Form: ${subject}`,
      html: `
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
          <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
            <h1 style="margin: 0; font-size: 28px;">${appName || 'GECO RWANDA'}</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">New Contact Form Submission</p>
          </div>
          
          <div style="background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; border: 1px solid #e0e0e0;">
            <h2 style="color: #333; margin-top: 0;">Contact Information</h2>
            
            <div style="margin-bottom: 20px;">
              <strong style="color: #666;">Name:</strong>
              <p style="margin: 5px 0; color: #333;">${name}</p>
            </div>
            
            <div style="margin-bottom: 20px;">
              <strong style="color: #666;">Email:</strong>
              <p style="margin: 5px 0; color: #333;">${email}</p>
            </div>
            
            ${phone ? `
            <div style="margin-bottom: 20px;">
              <strong style="color: #666;">Phone:</strong>
              <p style="margin: 5px 0; color: #333;">${phone}</p>
            </div>
            ` : ''}
            
            <div style="margin-bottom: 20px;">
              <strong style="color: #666;">Subject:</strong>
              <p style="margin: 5px 0; color: #333;">${subject}</p>
            </div>
            
            <div style="margin-bottom: 20px;">
              <strong style="color: #666;">Message:</strong>
              <p style="margin: 5px 0; color: #333; line-height: 1.6;">${message}</p>
            </div>
            
            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0; font-size: 12px; color: #666;">
              <p>This message was sent from the ${appName || 'GECO RWANDA'} contact form.</p>
              <p>Sent on: ${new Date().toLocaleString()}</p>
            </div>
          </div>
        </div>
      `
    };

    // Send email
    await transporter.sendMail(mailOptions);

    res.json({
      success: true,
      message: 'Email sent successfully'
    });

  } catch (error) {
    console.error('Email sending error details:', {
      message: error.message,
      code: error.code,
      command: error.command,
      response: error.response,
      stack: error.stack
    });
    res.status(500).json({
      success: false,
      message: 'Failed to send email',
      error: error.message
    });
  }
});

// Start server
initDB().then(() => {
  app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
  });
});
