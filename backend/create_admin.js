const mysql = require('mysql2/promise');
const { hashPassword, encrypt } = require('./utils/crypto');
require('dotenv').config();

/**
 * Create Default Admin User Script
 * Run this script to create a default admin user for the system
 * Usage: node create_admin.js
 */

const dbConfig = {
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_NAME || 'gecorwanda'
};

async function createDefaultAdmin() {
  let connection;
  
  try {
    console.log('🔄 Connecting to database...');
    connection = await mysql.createConnection(dbConfig);
    console.log('✅ Connected to database');

    // Check if specific admin user already exists
    const [existingUsers] = await connection.execute('SELECT COUNT(*) as count FROM admin_users WHERE email_encrypted = ?', [encrypt('admin@gecorwanda.org')]);
    
    if (existingUsers[0].count > 0) {
      console.log('ℹ️  Admin user admin@gecorwanda.org already exists.');
      
      // Show existing users
      const [users] = await connection.execute('SELECT id, role, created_at FROM admin_users');
      console.log('\n📋 Existing Admin Users:');
      users.forEach(user => {
        console.log(`   • ID: ${user.id}, Role: ${user.role}, Created: ${user.created_at}`);
      });
      
      return;
    }

    // Create default admin user
    const defaultAdmin = {
      email: 'admin@gecorwanda.org',
      password: 'admin123',
      name: 'System Administrator',
      role: 'admin'
    };

    console.log('👤 Creating default admin user...');

    // Hash password and encrypt sensitive data
    const hashedPassword = hashPassword(defaultAdmin.password);
    const encryptedEmail = encrypt(defaultAdmin.email);
    const encryptedName = encrypt(defaultAdmin.name);

    // Insert admin user
    const [result] = await connection.execute(`
      INSERT INTO admin_users (email_encrypted, password_hash, name_encrypted, role, created_at) 
      VALUES (?, ?, ?, ?, NOW())
    `, [encryptedEmail, hashedPassword, encryptedName, defaultAdmin.role]);

    console.log('✅ Default admin user created successfully!');
    console.log('\n🔑 Login Credentials:');
    console.log(`   Email: ${defaultAdmin.email}`);
    console.log(`   Password: ${defaultAdmin.password}`);
    console.log(`   Role: ${defaultAdmin.role}`);
    console.log(`   User ID: ${result.insertId}`);
    
    console.log('\n⚠️  IMPORTANT:');
    console.log('   • Please change the default password after first login');
    console.log('   • Keep these credentials secure');
    console.log('   • You can now login to the admin dashboard');

  } catch (error) {
    console.error('❌ Failed to create admin user:', error.message);
    console.error('\n🔧 Troubleshooting:');
    console.error('   • Make sure the database exists (run: node migrate.js)');
    console.error('   • Check your database connection in .env file');
    process.exit(1);
  } finally {
    if (connection) {
      await connection.end();
      console.log('🔌 Database connection closed');
    }
  }
}

// Run script if executed directly
if (require.main === module) {
  createDefaultAdmin();
}

module.exports = { createDefaultAdmin };
