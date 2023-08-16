<?php
namespace models;

use PDO;
use PDOStatement;
use Exception;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_DATABASE'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD')
        );

        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $sql, array $param = []): PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);

        // boucle sur mes params
        foreach ($param as $key => $value) {

            if (gettype($value) == "integer") {
                $stmt->bindParam($key, $value, PDO::PARAM_INT);
            } else if (gettype($value) == "boolean") {
                $stmt->bindParam($key, $value, PDO::PARAM_BOOL);
            } else {
                $stmt->bindValue($key, $value);
            }
        }

        $stmt->execute();
        return $stmt;
    }

    public function exec(string $sql, array $param = []): bool
    {
        $stmt = $this->pdo->prepare($sql);

        foreach ($param as $key => $value) {
            if (gettype($value) == "integer") {
                $stmt->bindParam($key, $value, PDO::PARAM_INT);
            } else if (gettype($value) == "boolean") {
                $stmt->bindParam($key, $value, PDO::PARAM_BOOL);
            } else {
                $stmt->bindValue($key, $value);
            }
        }
        return $stmt->execute();
    }

    public function lastInsertId(): string|int
    {
        return $this->pdo->lastInsertId();
    }

}