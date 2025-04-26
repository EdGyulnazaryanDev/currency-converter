<?php
namespace CurrencyService\Core\Database;

use PDO;
use PDOException;
use CurrencyService\Config\DatabaseConfig;

class DatabaseConnection
{
    private static ?PDO $instance = null;
    private DatabaseConfig $config;

    private function __construct(DatabaseConfig $config)
    {
        $this->config = $config;
    }

    public static function getInstance(DatabaseConfig $config): PDO
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    $config->get('dsn'),
                    $config->get('username'),
                    $config->get('password'),
                    $config->get('options')
                );
            } catch (PDOException $e) {
                dd("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    private function __clone() {}
    public function __wakeup() {}
}