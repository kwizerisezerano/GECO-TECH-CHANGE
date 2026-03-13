<?php
/**
 * Database Migration Runner
 * This script executes the database migration to create all tables
 */

echo "Starting database migration...\n";

// Database configuration for migration (without specifying database initially)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'gecorwanda';

try {
    // First connect without database to create it
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to MySQL server\n";
    
    // Read and execute migration file
    $migrationFile = __DIR__ . '/database_migration.sql';
    if (!file_exists($migrationFile)) {
        throw new Exception("Migration file not found: $migrationFile");
    }
    
    $migrationSQL = file_get_contents($migrationFile);
    
    // Execute migration
    $pdo->exec($migrationSQL);
    
    echo "✅ Database migration completed successfully!\n";
    echo "✅ Database 'gecorwanda' created with all tables\n";
    echo "✅ Sample data inserted\n";
    
    // Test connection to the new database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Show table count
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "\n📊 Created tables (" . count($tables) . "):\n";
    foreach ($tables as $table) {
        echo "  - $table\n";
    }
    
    echo "\n🎉 Migration completed! You can now start your backend server.\n";
    
} catch (PDOException $e) {
    echo "❌ Database Error: " . $e->getMessage() . "\n";
    echo "Please make sure MySQL is running and you have the correct credentials.\n";
    exit(1);
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
