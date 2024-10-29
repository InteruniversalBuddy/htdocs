<?php
namespace lib;

use Exception;
use PDO;
use PDOException;

/**
 * Klasse database zur Verwaltung von Datenbankverbindungen und -abfragen.
 */
class database
{
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
    public function __construct()
    {
        $host = 'localhost';
        $db = 'm295';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        try {
            $this->pdo = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
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
    public function executeQuery(string $sql, array $data): array
    {
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
    public function __destruct()
    {
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
    public function run(string $sql, array $data): array
    {
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($data);
            $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error executing query: " . $e->getMessage());
        }
    }
    public static function chkDB() {
        $meldungen = false;
        $host = 'localhost';
        $db = 'm295';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;charset=$charset"; 
        $logMessage = function($message) use ($meldungen) {
            if ($meldungen) echo "$message<br>";
        };
        try {
            $logMessage("Prüfe DB-Verbindung...");
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            $query = $pdo->query("SHOW DATABASES LIKE '$db'");
            if ($query->rowCount() == 0) {
                $logMessage("Datenbank '$db' nicht vorhanden. Erstelle Datenbank...");
                $sql = file_get_contents(__DIR__ . '/../database/database.sql');
                if ($sql === false) {
                    throw new Exception("SQL-Datei konnte nicht geladen werden.");
                }
                $pdo->exec("CREATE DATABASE `$db` CHARACTER SET $charset COLLATE utf8mb4_general_ci");
                $pdo->exec("USE `$db`;");
                $pdo->exec($sql);
                $logMessage("Datenbank '$db' wurde erfolgreich erstellt.");
            } else {
                $logMessage("Datenbank '$db' ist bereits vorhanden.");
            }
        } catch (PDOException $e) {
            $logMessage("Fehler bei der Datenbankverbindung: " . $e->getMessage());
        } catch (Exception $e) {
            $logMessage("Fehler: " . $e->getMessage());
        }
    }
    
}
