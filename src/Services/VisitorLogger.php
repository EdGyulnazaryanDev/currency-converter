<?php
namespace CurrencyService\Services;

use CurrencyService\Core\Request;
use CurrencyService\Repositories\VisitorRepository;

class VisitorLogger
{
    private VisitorRepository $visitorRepository;

    public function __construct()
    {
        $this->visitorRepository = new VisitorRepository();
    }

    public function logVisit(Request $request): void
    {
        $this->visitorRepository->create([
            'ip_address' => $request->getIpAddress(),
            'user_agent' => $request->getUserAgent()
        ]);
    }


    public function findAll()
    {
        return $this->visitorRepository->findAll();
    }
}