<?php
namespace CurrencyService\Services;

use CurrencyService\Repositories\CurrencyRepository;

class CurrencyService
{
    private ApiClient $apiClient;
    private CurrencyRepository $currencyRepository;

    public function __construct()
    {
        $this->apiClient = new ApiClient();
        $this->currencyRepository = new CurrencyRepository();
    }

    public function getLatestRates(string $baseCurrency = 'EUR'): array
    {
        try {
            $data = $this->apiClient->get('latest', ['from' => $baseCurrency]);
            return $data['rates'] ?? [];
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}