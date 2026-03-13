# Database Setup Instructions

## Quick Setup

### Option 1: Automatic Setup (Recommended)
Run the Windows batch file:
```bash
setup_database.bat
```

### Option 2: Manual Setup with PHP
```bash
php run_migration.php
```

### Option 3: Manual Setup with MySQL
```bash
mysql -u root -p < database_migration.sql
```

## What the Migration Does

1. **Creates Database**: `gecorwanda`
2. **Creates Tables**:
   - `beneficiaries` - Store beneficiary information
   - `members` - Store member information  
   - `projects` - Store project details
   - `partners` - Store partner information
   - `donation` - Store donation records (compatible with both PHP and Node.js)
   - `pdf_files` - Store uploaded PDF files

3. **Inserts Sample Data**:
   - 3 sample projects
   - 3 sample partners

## Database Schema

### Key Features
- **UTF8MB4 Support**: Full Unicode support including emojis
- **Indexes**: Optimized for common queries
- **Timestamps**: Automatic created_at and updated_at fields
- **Compatibility**: Works with both PHP frontend and Node.js backend

### Donation Table Notes
The donation table includes both:
- `first_name`, `last_name` (for PHP compatibility)
- `amount` field (for Node.js compatibility)
- `donation_amount` field (for PHP compatibility)

## After Setup

Once the database is created, you can start your backend server:

```bash
cd backend
npm run dev
```

The server should now connect successfully to the database.

## Troubleshooting

### Error: "Unknown database 'gecorwanda'"
- Run the migration script first
- Ensure MySQL/XAMPP is running

### Error: "Access denied for user 'root'@'localhost'"
- Check your MySQL credentials
- Update the password in the migration script if needed

### Error: "PHP is not recognized"
- Install PHP or use the MySQL command directly
- Add PHP to your system PATH

## Verification

To verify the setup worked:
1. Check that the database exists: `mysql -u root -e "SHOW DATABASES;"`
2. Check tables: `mysql -u root gecorwanda -e "SHOW TABLES;"`
3. Start the backend server and check for connection success

## File Structure

```
├── database_migration.sql    # Main migration file
├── run_migration.php         # PHP migration runner
├── setup_database.bat        # Windows batch file
├── DATABASE_SETUP.md         # This file
└── backend/
    └── server.js            # Updated backend server
```
