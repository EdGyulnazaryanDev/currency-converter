<?php
namespace CurrencyService\Config;

use CurrencyService\Config\Config;

class DatabaseConfig extends Config
{
    public function __construct()
    {
        parent::__construct([
            'dsn' => 'sqlite:' . __DIR__ . '/rates.sqlite',
            'username' => null,
            'password' => null,
            'options' => [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]
        ]);
    }
}

