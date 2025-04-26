<?php
namespace CurrencyService\Models;

class Currency
{
    public function __construct(
        private string $code,
        private string $name,
        private float $rate,
        private \DateTimeInterface $date
    ) {}

    // Getters
    public function getCode(): string { return $this->code; }
    public function getName(): string { return $this->name; }
    public function getRate(): float { return $this->rate; }
    public function getDate(): \DateTimeInterface { return $this->date; }
}