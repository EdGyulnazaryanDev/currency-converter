<?php
namespace CurrencyService\Controllers;

use CurrencyService\Services\CurrencyService;
use CurrencyService\Services\VisitorLogger;
use CurrencyService\Core\Request;

class CurrencyController extends BaseController
{
    private CurrencyService $currencyService;
    private VisitorLogger $visitorLogger;

    public function __construct()
    {
        $this->currencyService = new CurrencyService();
        $this->visitorLogger = new VisitorLogger();
    }

    public function index(Request $request)
    {
        $this->visitorLogger->logVisit($request);

        $baseCurrency = $_COOKIE['base_currency'] ?? 'EUR';
        $rates = $this->currencyService->getLatestRates($baseCurrency);
        return $this->renderView('currency_view', [
            'rates' => $rates,
            'baseCurrency' => $baseCurrency
        ]);
    }

    public function changeBaseCurrency(Request $request)
    {
        $currency = $request->getBody()['currency'] ?? 'EUR';
        setcookie('base_currency', $currency, time() + (86400 * 30), "/");
        header('Location: /');
        exit;
    }
}