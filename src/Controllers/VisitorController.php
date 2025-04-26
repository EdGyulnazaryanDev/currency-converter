<?php
namespace CurrencyService\Controllers;

use CurrencyService\Services\CurrencyService;
use CurrencyService\Services\VisitorLogger;
use CurrencyService\Core\Request;

class VisitorController extends BaseController
{
    private VisitorLogger $visitorLogger;

    public function __construct()
    {
        $this->visitorLogger = new VisitorLogger();
    }

    public function getVisitors(Request $request)
    {
        $visitors = $this->visitorLogger->findAll();
        return $this->renderView('visitor_view', [
            'visitors' => $visitors
        ]);
    }

}