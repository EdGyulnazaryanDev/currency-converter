<?php
namespace CurrencyService\Repositories;

use CurrencyService\Core\Database\DatabaseConnection;
use CurrencyService\Config\DatabaseConfig;
use CurrencyService\Models\Visitor;
use PDO;

class VisitorRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $config = new DatabaseConfig();
        $this->pdo = DatabaseConnection::getInstance($config);
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO visitors (ip_address, user_agent) VALUES (:ip_address, :user_agent)"
        );

        return $stmt->execute([
            ':ip_address' => $data['ip_address'],
            ':user_agent' => $data['user_agent']
        ]);
    }

    public function findById(int $id): ?Visitor
    {
        $stmt = $this->pdo->prepare("SELECT * FROM visitors WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new Visitor(
            $data['id'],
            $data['ip_address'],
            $data['user_agent'],
            new \DateTime($data['visit_time'])
        ) : null;
    }

    public function findAll(int $limit = 100): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM visitors ORDER BY visit_time DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $visitors = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $visitors[] = new Visitor(
                $data['id'],
                $data['ip_address'],
                $data['user_agent'],
                new \DateTime($data['visit_time'])
            );
        }
        return $visitors;
    }
}