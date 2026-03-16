const crypto = require('crypto');

// Use a fixed encryption key for consistency (32 bytes for AES-256)
const ENCRYPTION_KEY = process.env.ENCRYPTION_KEY || 'gecorwanda-encryption-key-32';
const ALGORITHM = 'aes-256-gcm';

// Ensure key is exactly 32 bytes
const getKey = () => {
  const key = ENCRYPTION_KEY.padEnd(32, '0').substring(0, 32);
  return Buffer.from(key, 'utf8');
};

/**
 * Encrypt sensitive data
 * @param {string} text - Text to encrypt
 * @returns {string} - Encrypted text (IV + encrypted data + auth tag)
 */
function encrypt(text) {
  if (!text) return '';
  
  const iv = crypto.randomBytes(16);
  const cipher = crypto.createCipheriv('aes-256-gcm', getKey(), iv);
  cipher.setAAD(Buffer.from('gecorwanda', 'utf8'));
  
  let encrypted = cipher.update(text, 'utf8', 'hex');
  encrypted += cipher.final('hex');
  
  const authTag = cipher.getAuthTag();
  
  // Combine IV + encrypted data + auth tag
  return iv.toString('hex') + ':' + encrypted + ':' + authTag.toString('hex');
}

/**
 * Decrypt sensitive data
 * @param {string} encryptedData - Encrypted text (IV + encrypted data + auth tag)
 * @returns {string} - Decrypted text
 */
function decrypt(encryptedData) {
  if (!encryptedData) return '';
  
  try {
    const parts = encryptedData.split(':');
    if (parts.length !== 3) return encryptedData; // Return as-is if not properly encrypted
    
    const iv = Buffer.from(parts[0], 'hex');
    const encrypted = parts[1];
    const authTag = Buffer.from(parts[2], 'hex');
    
    const decipher = crypto.createDecipheriv('aes-256-gcm', getKey(), iv);
    decipher.setAAD(Buffer.from('gecorwanda', 'utf8'));
    decipher.setAuthTag(authTag);
    
    let decrypted = decipher.update(encrypted, 'hex', 'utf8');
    decrypted += decipher.final('utf8');
    
    return decrypted;
  } catch (error) {
    console.error('Decryption error:', error.message);
    return encryptedData; // Return as-is if decryption fails
  }
}

/**
 * Hash password using bcrypt
 * @param {string} password - Plain text password
 * @returns {string} - Hashed password
 */
function hashPassword(password) {
  const bcrypt = require('bcrypt');
  const saltRounds = 12;
  return bcrypt.hashSync(password, saltRounds);
}

/**
 * Compare password with hash
 * @param {string} password - Plain text password
 * @param {string} hash - Hashed password
 * @returns {boolean} - True if password matches
 */
function comparePassword(password, hash) {
  const bcrypt = require('bcrypt');
  return bcrypt.compareSync(password, hash);
}

module.exports = {
  encrypt,
  decrypt,
  hashPassword,
  comparePassword,
  ENCRYPTION_KEY
};
