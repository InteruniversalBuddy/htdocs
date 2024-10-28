<?php
namespace lib;

use Exception;
use PDO;
use PDOException;

/**
 * Klasse database zur Verwaltung von Datenbankverbindungen und -abfragen.
 */
class database {
    /**
     * @var PDO $pdo Die PDO-Datenbankverbindung.
     */
    private PDO $pdo;

    /**
     * @var \PDOStatement|null $stmt Das vorbereitete PDO-Statement.
     */
    private ?\PDOStatement $stmt = null;

    /**
     * Konstruktor der Klasse database.
     *
     * Stellt eine Verbindung zur Datenbank her.
     *
     * @throws PDOException Wenn die Verbindung fehlschlägt.
     */
    public function __construct() {
        $host = 'localhost';
        $db = 'm295';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        
        try {
            $this->pdo = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

        // Check if the database exists
        $stmt = $this->pdo->query("SHOW DATABASES LIKE '$db'");
        $dbExists = $stmt->fetchColumn();

        // If the database does not exist, execute the SQL file
        if (!$dbExists) {
            $sqlFilePath = __DIR__ . '/../database/database.sql';
            
            if (file_exists($sqlFilePath)) {
                $sqlCommands = file_get_contents($sqlFilePath);
                $this->pdo->exec($sqlCommands);
            } else {
                throw new Exception("SQL file not found at: $sqlFilePath");
            }
        }
    }

    /**
     * Führt eine SQL-Abfrage aus und gibt die Ergebnismenge zurück.
     *
     * @param string $sql  Die SQL-Abfrage, die ausgeführt werden soll.
     * @param array  $data Die Parameter für die SQL-Abfrage.
     * @return array       Die Ergebnismenge als assoziatives Array.
     * @throws Exception   Wenn ein Fehler bei der Abfrage auftritt.
     */
    public function executeQuery(string $sql, array $data): array {
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($data);
            $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error executing query: " . $e->getMessage());
        }
    }

    /**
     * Destruktor der Klasse database.
     *
     * Trennt die Verbindung zur Datenbank.
     */
    public function __destruct() {
        //$this->pdo = null;
    }

    /**
     * Führt eine SQL-Abfrage aus und gibt das Ergebnis zurück.
     *
     * @param string $sql  Die SQL-Abfrage, die ausgeführt werden soll.
     * @param array  $data Die Parameter für die SQL-Abfrage.
     * @return array       Die Ergebnismenge als assoziatives Array.
     * @throws Exception   Wenn ein Fehler bei der Abfrage auftritt.
     */
    public function run(string $sql, array $data): array {
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($data);
            $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error executing query: " . $e->getMessage());
        }
    }
}
