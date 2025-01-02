<?php
namespace app\Database;

use PDO;
use PDOException;

class Database {
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $pdo;

    public function __construct() {
        $this->host = $_ENV['DB_SERVER'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->dbname = $_ENV['DB_NAME'];
    }

    public function connect() {
        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                    $this->username,
                    $this->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
?>
