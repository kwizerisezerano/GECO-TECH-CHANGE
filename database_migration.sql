-- GECO RWANDA Database Migration Script
-- This script creates the database and all required tables
-- Run this script to set up the database from scratch

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS gecorwanda CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gecorwanda;

-- Drop existing tables to recreate them (for clean migration)
DROP TABLE IF EXISTS pdf_files;
DROP TABLE IF EXISTS donation;
DROP TABLE IF EXISTS partners;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS beneficiaries;

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

-- Show database creation status
SELECT 'Database gecorwanda created successfully with all tables' as status;
