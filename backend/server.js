const express = require('express');
const cors = require('cors');
const mysql = require('mysql2/promise');
const nodemailer = require('nodemailer');
require('dotenv').config();

// Import API routes
const projectsRouter = require('./api/projects');
const adminRouter = require('./api/admin');

const app = express();
const PORT = process.env.PORT || 3001;

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// API Routes
app.use('/api/projects', projectsRouter);
app.use('/api/admin', adminRouter);

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

// Initialize database and create tables
const initDatabase = async () => {
  try {
    const connection = await mysql.createConnection({
      host: process.env.DB_HOST || 'localhost',
      user: process.env.DB_USER || 'root',
      password: process.env.DB_PASSWORD || '',
      database: process.env.DB_NAME || 'geco_rwanda'
    });

    // Create contact_messages table if it doesn't exist
    await connection.execute(`
      CREATE TABLE IF NOT EXISTS contact_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(50),
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_created_at (created_at)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    `);

    await connection.end();
    console.log('Database initialized successfully');
  } catch (error) {
    console.error('Database initialization error:', error);
    process.exit(1);
  }
};

// Call initDatabase function
initDatabase();

// API Routes
app.get('/api/stats', async (req, res) => {
  try {
    const [beneficiaries] = await db.execute('SELECT COUNT(*) as count FROM people WHERE person_type = ?', ['beneficiary']);
    const [projects] = await db.execute('SELECT COUNT(*) as count FROM projects WHERE status = ?', ['ongoing']);
    const [partners] = await db.execute('SELECT COUNT(*) as count FROM partners');
    const [members] = await db.execute('SELECT COUNT(*) as count FROM people WHERE person_type = ?', ['member']);
    const [donations] = await db.execute('SELECT COUNT(*) as count FROM donation WHERE payment_status = ?', ['success']);

    res.json({
      beneficiaries: beneficiaries[0].count,
      projects: projects[0].count,
      partners: partners[0].count,
      members: members[0].count,
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
    const [beneficiaries] = await db.execute('SELECT * FROM people WHERE person_type = ? ORDER BY created_at DESC', ['beneficiary']);
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
    
    // Split name into first_name and last_name for compatibility
    const nameParts = name.split(' ');
    const firstName = nameParts[0] || name;
    const lastName = nameParts.slice(1).join(' ') || '';
    
    const [result] = await db.execute(
      'INSERT INTO donation (first_name, last_name, email, amount, phone_number, payment_status, transaction_ref) VALUES (?, ?, ?, ?, ?, ?, ?)',
      [firstName, lastName, email, amount, phone, 'pending', 'don_' + Date.now()]
    );
    res.json({ success: true, id: result.insertId });
  } catch (error) {
    console.error('Error processing donation:', error);
    res.status(500).json({ error: 'Failed to process donation' });
  }
});

// Email Test Endpoint
app.get('/api/test-email', async (req, res) => {
  try {
    console.log('Testing email configuration...');
    
    // Create email transporter
    const transporter = nodemailer.createTransport({
      host: process.env.SMTP_HOST || 'smtp.gmail.com',
      port: process.env.SMTP_PORT || 587,
      secure: process.env.SMTP_SECURE === 'true',
      auth: {
        user: process.env.EMAIL_USER || 'globalepelepticc@gmail.com',
        pass: process.env.EMAIL_PASS || 'zmqo bmlc xbcy eaic'
      },
      tls: {
        rejectUnauthorized: false
      },
      debug: true,
      logger: true
    });

    // Test connection
    console.log('Verifying SMTP connection...');
    await transporter.verify();
    console.log('SMTP connection verified successfully!');

    // Send test email
    console.log('Sending test email...');
    const mailOptions = {
      from: 'GECO RWANDA Test <globalepelepticc@gmail.com>',
      to: 'globalepelepticc@gmail.com',
      subject: 'Test Email from GECO RWANDA',
      html: `
        <div style="font-family: Arial, sans-serif; padding: 20px;">
          <h2 style="color: #667eea;">Email Test Successful!</h2>
          <p>This is a test email from the GECO RWANDA contact form system.</p>
          <p>Sent at: ${new Date().toLocaleString()}</p>
          <p>If you receive this email, the SMTP configuration is working correctly.</p>
        </div>
      `
    };

    const result = await transporter.sendMail(mailOptions);
    console.log('Test email sent successfully:', result.messageId);

    res.json({
      success: true,
      message: 'Test email sent successfully!',
      messageId: result.messageId
    });

  } catch (error) {
    console.error('Email test failed:', {
      error: error.message,
      code: error.code,
      command: error.command,
      response: error.response,
      stack: error.stack
    });
    
    res.status(500).json({
      success: false,
      error: error.message,
      code: error.code,
      details: 'Check the Gmail app password and security settings'
    });
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

    // Save contact message to database first
    try {
      const [result] = await db.execute(`
        INSERT INTO contact_messages (name, email, phone, subject, message, created_at)
        VALUES (?, ?, ?, ?, ?, NOW())
      `, [name, email, phone, subject, message]);
      console.log('Contact message saved to database with ID:', result.insertId);
    } catch (dbError) {
      console.error('Error saving contact message to database:', dbError);
      // Continue with email attempt even if database save fails
    }

    // Try to send email
    try {
      // Create email transporter using app password for Gmail
      const transporter = nodemailer.createTransport({
        host: process.env.SMTP_HOST || 'smtp.gmail.com',
        port: process.env.SMTP_PORT || 587,
        secure: process.env.SMTP_SECURE === 'true',
        auth: {
          user: process.env.EMAIL_USER || 'globalepelepticc@gmail.com',
          pass: process.env.EMAIL_PASS || 'zmqo bmlc xbcy eaic'
        },
        tls: {
          rejectUnauthorized: false
        },
        debug: true,
        logger: true
      });

      // Test connection first
      await transporter.verify();
      console.log('SMTP connection verified successfully');

      // Email content
      const mailOptions = {
        from: `${appName || 'GECO RWANDA'} <globalepelepticc@gmail.com>`,
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
      const result = await transporter.sendMail(mailOptions);
      console.log('Email sent successfully:', result.messageId);

      res.json({
        success: true,
        message: 'Message sent successfully! We will get back to you soon.'
      });

    } catch (emailError) {
      console.error('Email sending failed but message saved to database:', {
        error: emailError.message,
        code: emailError.code,
        command: emailError.command,
        response: emailError.response
      });
      
      // Still return success since the message was saved to database
      res.json({
        success: true,
        message: 'Message received! We will get back to you soon.',
        note: 'Email delivery failed but message was saved to database'
      });
    }

  } catch (error) {
    console.error('Contact form error:', {
      message: error.message,
      code: error.code,
      command: error.command,
      response: error.response,
      stack: error.stack
    });
    res.status(500).json({
      success: false,
      message: 'Failed to process your message. Please try again.',
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
