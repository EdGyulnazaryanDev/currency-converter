<?php
namespace CurrencyService\Controllers;

abstract class BaseController
{
    protected function renderView(string $view, array $params = []): void
    {
        extract($params);
        require __DIR__ . "/../../src/Views/{$view}.php";
    }
}