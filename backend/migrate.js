const mysql = require('mysql2/promise');
require('dotenv').config();

/**
 * Database Migration Script for GECO RWANDA
 * Run this script to create the database and all required tables
 * Usage: node migrate.js
 */

const dbConfig = {
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  multipleStatements: true // Allow multiple SQL statements
};

const migrationSQL = `
-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS gecorwanda CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gecorwanda;

-- Drop existing tables to recreate them (for clean migration)
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS pdf_files;
DROP TABLE IF EXISTS donation;
DROP TABLE IF EXISTS partners;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS beneficiaries;
SET FOREIGN_KEY_CHECKS = 1;

-- Beneficiaries table
CREATE TABLE beneficiaries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    idno_type VARCHAR(50),
    idno VARCHAR(50) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_idno (idno),
    INDEX idx_phone (phone_number)
);

-- Members table
CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    idno_type VARCHAR(50),
    idno VARCHAR(50) UNIQUE NOT NULL,
    role VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_idno (idno),
    INDEX idx_phone (phone_number)
);

-- Projects table
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL UNIQUE,
    status VARCHAR(50) NOT NULL DEFAULT 'ongoing',
    description TEXT,
    start_date DATE,
    end_date DATE,
    budget DECIMAL(15,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_project_name (project_name)
);

-- Partners table
CREATE TABLE partners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    partner_name VARCHAR(255) NOT NULL UNIQUE,
    contact_person VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    description TEXT,
    partnership_type VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_partner_name (partner_name)
);

-- Donation table - Updated to match both PHP and Node.js requirements
CREATE TABLE donation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    location VARCHAR(255),
    donation_amount DECIMAL(10,2) NOT NULL,
    amount DECIMAL(10,2) NOT NULL, -- For Node.js compatibility
    transaction_ref VARCHAR(100) UNIQUE NOT NULL,
    payment_status VARCHAR(50) DEFAULT 'pending',
    payment_method VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_transaction_ref (transaction_ref),
    INDEX idx_payment_status (payment_status),
    INDEX idx_phone (phone_number),
    INDEX idx_email (email)
);

-- PDF Files table
CREATE TABLE pdf_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    file_data LONGBLOB NOT NULL,
    file_type VARCHAR(100) NOT NULL UNIQUE,
    file_size INT,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_file_type (file_type)
);

-- Insert some default data for testing
INSERT INTO projects (project_name, status, description) VALUES 
('Education Support Program', 'ongoing', 'Providing educational support to underprivileged children'),
('Healthcare Initiative', 'completed', 'Free medical camps in rural areas'),
('Women Empowerment', 'ongoing', 'Skills training and microfinance for women');

INSERT INTO partners (partner_name, contact_person, email, phone, partnership_type) VALUES 
('UNICEF Rwanda', 'John Doe', 'john@unicef.rw', '+250788123456', 'International NGO'),
('Ministry of Education', 'Jane Smith', 'jane@mineduc.rw', '+250788123457', 'Government'),
('Local Community Bank', 'Bob Wilson', 'bob@bank.rw', '+250788123458', 'Financial');

-- Show migration completion
SELECT 'Database migration completed successfully' as status;
`;

async function runMigration() {
  let connection;
  
  try {
    console.log('🔄 Starting database migration...');
    console.log(`📍 Connecting to MySQL at ${dbConfig.host}...`);
    
    // Connect without database first
    connection = await mysql.createConnection(dbConfig);
    console.log('✅ Connected to MySQL server');
    
    // Execute migration
    console.log('🚀 Executing migration script...');
    await connection.query(migrationSQL);
    
    console.log('✅ Migration executed successfully');
    
    // Connect to the new database to verify
    await connection.end();
    
    const dbConfigWithDB = {
      ...dbConfig,
      database: 'gecorwanda'
    };
    
    connection = await mysql.createConnection(dbConfigWithDB);
    console.log('✅ Connected to gecorwanda database');
    
    // Get table list
    const [tables] = await connection.execute('SHOW TABLES');
    console.log(`📊 Created ${tables.length} tables:`);
    
    tables.forEach((table, index) => {
      const tableName = Object.values(table)[0];
      console.log(`   ${index + 1}. ${tableName}`);
    });
    
    // Show sample data counts
    const [projectCount] = await connection.execute('SELECT COUNT(*) as count FROM projects');
    const [partnerCount] = await connection.execute('SELECT COUNT(*) as count FROM partners');
    
    console.log('\n📈 Sample data inserted:');
    console.log(`   • Projects: ${projectCount[0].count}`);
    console.log(`   • Partners: ${partnerCount[0].count}`);
    
    console.log('\n🎉 Database setup completed successfully!');
    console.log('💡 You can now start your server with: npm run dev');
    
  } catch (error) {
    console.error('❌ Migration failed:', error.message);
    console.error('\n🔧 Troubleshooting:');
    console.error('   • Make sure MySQL/XAMPP is running');
    console.error('   • Check your database credentials in .env file');
    console.error('   • Ensure MySQL user has CREATE DATABASE privileges');
    process.exit(1);
  } finally {
    if (connection) {
      await connection.end();
      console.log('🔌 Database connection closed');
    }
  }
}

// Run migration if this file is executed directly
if (require.main === module) {
  runMigration();
}

module.exports = { runMigration };
