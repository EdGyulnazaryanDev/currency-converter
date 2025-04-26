<?php
namespace CurrencyService\Models;

class Visitor
{
    public function __construct(
        private int $id,
        private string $ipAddress,
        private string $userAgent,
        private \DateTimeInterface $visitTime
    ) {}

    // Getters
    public function getId(): int { return $this->id; }
    public function getIpAddress(): string { return $this->ipAddress; }
    public function getUserAgent(): string { return $this->userAgent; }
    public function getVisitTime(): \DateTimeInterface { return $this->visitTime; }
}
