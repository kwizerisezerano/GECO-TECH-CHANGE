const mysql = require('mysql2/promise');
require('dotenv').config();
const { updateRealData } = require('./update_real_data');

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
DROP TABLE IF EXISTS notification_reads;
DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS pdf_files;
DROP TABLE IF EXISTS donation;
DROP TABLE IF EXISTS partners;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS beneficiaries;
DROP TABLE IF EXISTS people;
DROP TABLE IF EXISTS admin_users;
SET FOREIGN_KEY_CHECKS = 1;

-- Beneficiaries and Members combined table (people table)
CREATE TABLE people (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_encrypted TEXT NOT NULL,
    phone_number_encrypted TEXT NOT NULL,
    idno_type VARCHAR(50),
    idno_encrypted TEXT NOT NULL,
    person_type ENUM('beneficiary', 'member') NOT NULL,
    role VARCHAR(100), -- Only for members
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_idno_encrypted (idno_encrypted(255)),
    INDEX idx_phone_encrypted (phone_number_encrypted(255)),
    INDEX idx_person_type (person_type)
);

-- Projects table
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL UNIQUE,
    status VARCHAR(50) NOT NULL DEFAULT 'ongoing',
    description TEXT,
    start_date DATE,
    end_date DATE,
    budget DECIMAL(15,2) COMMENT 'Budget amount in RWF (Rwanda Francs)',
    currency VARCHAR(3) DEFAULT 'RWF' COMMENT 'Currency code (RWF, USD, EUR, etc.)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_project_name (project_name),
    INDEX idx_currency (currency)
);

-- Partners table (with encrypted fields)
CREATE TABLE partners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    partner_name_encrypted TEXT NOT NULL,
    contact_person_encrypted TEXT,
    email_encrypted TEXT,
    phone_encrypted TEXT,
    description TEXT,
    partnership_type VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_partner_name_encrypted (partner_name_encrypted(255))
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

-- Admin users table
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email_encrypted TEXT NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    name_encrypted TEXT NOT NULL,
    role VARCHAR(50) DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    INDEX idx_email_encrypted (email_encrypted(255))
);

-- Notifications table
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    type ENUM('info', 'success', 'warning', 'error') DEFAULT 'info',
    related_entity_type VARCHAR(50),
    related_entity_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_type (type),
    INDEX idx_related_entity (related_entity_type, related_entity_id),
    INDEX idx_created_at (created_at)
);

-- Notification reads table (tracks which IP has read which notification)
CREATE TABLE notification_reads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    notification_id INT NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    read_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_notification_ip (notification_id, ip_address),
    INDEX idx_ip_address (ip_address),
    FOREIGN KEY (notification_id) REFERENCES notifications(id) ON DELETE CASCADE
);

-- Insert some default data for testing
INSERT INTO projects (project_name, status, description) VALUES 
('Education Support Program', 'ongoing', 'Providing educational support to underprivileged children'),
('Healthcare Initiative', 'completed', 'Free medical camps in rural areas'),
('Women Empowerment', 'ongoing', 'Skills training and microfinance for women');

-- Note: Partners data will be added through update_real_data.js with encryption

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
    
    console.log('\n📈 Tables created: ' + tables.length);
    
    console.log('\n🎉 Database setup completed successfully!');
    console.log('💡 Seeding real data...');

    // Auto-seed all real data (admin, projects, partners)
    await updateRealData();

    console.log('\n✅ All done! You can now start your server with: npm run dev');
    
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
