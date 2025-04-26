<?php
require __DIR__ . '/../vendor/autoload.php';

//require_once 'src/Core/Database/DatabaseMigration.php';
//require_once 'config/DatabaseConfig.php';
//require_once 'config/Config.php';

use CurrencyService\Core\Database\DatabaseMigration;

try {
    $migration = new DatabaseMigration();
    $migration->migrate();
    echo "Database migrated successfully!\n";
} catch (Exception $e) {
    echo "Migration failed: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}

echo "Database migrated successfully!\n";