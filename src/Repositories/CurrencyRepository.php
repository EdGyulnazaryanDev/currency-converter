<?php
namespace CurrencyService\Repositories;

use CurrencyService\Core\Database\DatabaseConnection;
use CurrencyService\Config\DatabaseConfig;
use CurrencyService\Models\Currency;
use PDO;

class CurrencyRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $config = new DatabaseConfig();

        $this->pdo = DatabaseConnection::getInstance($config);
    }

    public function saveRates(string $baseCurrency, array $rates, \DateTimeInterface $date): bool
    {
        $this->pdo->beginTransaction();

        try {
            // First clear existing rates for this date
            $stmt = $this->pdo->prepare(
                "DELETE FROM currency_rates WHERE date = :date AND base_currency = :base_currency"
            );
            $stmt->execute([
                ':date' => $date->format('Y-m-d'),
                ':base_currency' => $baseCurrency
            ]);

            // Insert new rates
            $stmt = $this->pdo->prepare(
                "INSERT INTO currency_rates (base_currency, target_currency, rate, date) 
                 VALUES (:base_currency, :target_currency, :rate, :date)"
            );

            foreach ($rates as $currency => $rate) {
                $stmt->execute([
                    ':base_currency' => $baseCurrency,
                    ':target_currency' => $currency,
                    ':rate' => $rate,
                    ':date' => $date->format('Y-m-d')
                ]);
            }

            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function getLatestRates(string $baseCurrency): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT target_currency, rate 
             FROM currency_rates 
             WHERE base_currency = :base_currency 
             AND date = (SELECT MAX(date) FROM currency_rates WHERE base_currency = :base_currency)
             ORDER BY target_currency"
        );
        $stmt->execute([':base_currency' => $baseCurrency]);

        $rates = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rates[$row['target_currency']] = (float)$row['rate'];
        }

        return $rates ?: null;
    }

    public function getHistoricalRates(string $baseCurrency, \DateTimeInterface $date): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT target_currency, rate 
             FROM currency_rates 
             WHERE base_currency = :base_currency AND date = :date"
        );
        $stmt->execute([
            ':base_currency' => $baseCurrency,
            ':date' => $date->format('Y-m-d')
        ]);

        $rates = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rates[$row['target_currency']] = (float)$row['rate'];
        }

        return $rates ?: null;
    }
}