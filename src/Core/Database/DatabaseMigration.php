<?php
namespace CurrencyService\Core\Database;
use PDO;
use CurrencyService\Config\DatabaseConfig;

class DatabaseMigration
{
    private PDO $pdo;

    public function __construct()
    {
        $config = new DatabaseConfig();
        $this->pdo = DatabaseConnection::getInstance($config);
    }

    public function migrate(): void
    {
        $this->pdo->exec("
        CREATE TABLE IF NOT EXISTS visitors (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            ip_address TEXT NOT NULL,
            user_agent TEXT NOT NULL,
            visit_time DATETIME DEFAULT CURRENT_TIMESTAMP
        );
        
        CREATE TABLE IF NOT EXISTS currency_rates (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            base_currency TEXT NOT NULL,
            target_currency TEXT NOT NULL,
            rate REAL NOT NULL,
            date DATE NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            UNIQUE(base_currency, target_currency, date)
        );
        
        CREATE INDEX IF NOT EXISTS idx_currency_rates_base ON currency_rates(base_currency);
        CREATE INDEX IF NOT EXISTS idx_currency_rates_date ON currency_rates(date);
    ");
    }
}