const mysql = require('mysql2/promise');
const { decrypt } = require('./utils/crypto');
require('dotenv').config();

async function checkAdminUsers() {
  let connection;
  
  try {
    connection = await mysql.createConnection({
      host: process.env.DB_HOST || 'localhost',
      user: process.env.DB_USER || 'root',
      password: process.env.DB_PASSWORD || '',
      database: process.env.DB_NAME || 'gecorwanda'
    });
    
    const [users] = await connection.execute('SELECT * FROM admin_users');
    console.log('Existing admin users:');
    users.forEach(user => {
      console.log(`ID: ${user.id}, Email: ${decrypt(user.email_encrypted)}, Name: ${decrypt(user.name_encrypted)}, Role: ${user.role}`);
    });
    
  } catch (error) {
    console.error('Error:', error.message);
  } finally {
    if (connection) {
      await connection.end();
    }
  }
}

checkAdminUsers();
