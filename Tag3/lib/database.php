<?php

namespace lib;
use PDO;

class database {
    private pdo $pdo;
    private $result;
    public function __construct() {
        // Datenbank verbindung
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=m295', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function executeQuery(string $sql="", array $data=[]) {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        $this->result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $this->result;
    }
}