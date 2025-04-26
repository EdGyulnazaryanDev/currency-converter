<?php
namespace CurrencyService\Config;

abstract class Config
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function get(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }
}