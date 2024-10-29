<?php
namespace app\cars;

use Exception;
use lib\response;
use Valitron\Validator;
use app\cars\model;

/**
 * Klasse cars für die Verwaltung von Autodaten.
 */
class cars
{
    /**
     * Modell - Klasse für DB - Zugriffe.
     * 
     * @var model $model
     */
    private model $model;

    /**
     * Konstruktor der Klasse cars.
     *
     * @param string $methode   Die Methode, die aufgerufen werden soll.
     * @param string $parameter Der Parameter, der der Methode übergeben wird.
     */
    public function __construct(string $methode = "", string $parameter = "")
    {
        $this->model = new model();
        if (!empty($methode) && method_exists(object_or_class: $this, method: $methode)) {
            try {
                $this->$methode($parameter);
            } catch (Exception $e) {
                response::errorJSON(array: ["error" => $e->getMessage()]);
            }
        } else {
            $this->init();
        }
    }

    /**
     * Holt Daten aus der Datenbank basierend auf der ID.
     * 
     * Diese Methode gibt keine Daten direkt zurück, sondern sendet eine JSON-Antwort
     * an den Client über die `response`-Klasse.
     *
     * @param string|null $id Die ID des Autos (optional).
     * @return void
     */
    public function getData(?string $id): void
    {
        if ($id === "") {
            $sql = "SELECT * FROM cars";
            $data = [];
        } else {
            $sql = "SELECT * FROM cars WHERE id = :id";
            $data = ["id" => $id];
        }
        $result = $this->model->getData($sql, $data);
        if ($result) {
            response::successJSON(array: ["data" => $result, "count" => count($result), "success" => "Daten erfolgreich abgerufen."]);

        } else {
            response::errorJSON(array: ["error" => "Keine Daten gefunden."]);
        }
    }

    /**
     * Fügt neue Daten in die Datenbank ein.
     * 
     * Diese Methode gibt keine Daten direkt zurück, sondern sendet eine JSON-Antwort
     * an den Client über die `response`-Klasse.
     * 
     * @return void
     */
    public function insertData(string $parameter = ''): void
    {
        // Überprüfe, ob POST-Daten vorhanden sind :: http://m295.tag4.local/cars/insertData
        if (empty($_POST)) {
            echo "Fehler: Keine POST-Daten vorhanden.\n";
            return;
        } else {
            /* $carData = [
                "name" => "Skoda",
                "price" => 35000,
                "kraftstoff" => "Benzin",
                "farbe" => "#123456",
                "bauart" => "Limousine",
                "tank" => 0,
                "jahrgang" => "2023-01-01"
            ]; */
            $carData = $_POST;
            // check ob Felder alle vorhanden sind:
            if (!isset($carData['name']))
                $carData['name'] = '';
            // -------------------------------------------------------------------------------
            $v = new Validator($carData);
            // wenn name text ist
            $v->rule('required', 'name')->message('darf nicht leer sein');
            $v->rule('regex', 'name', '/^[a-zA-Z0-9]+$/')->message('nur Buchstaben und Zahlen sind erlaubt');
            $v->rule('lengthMin', 'name', 4)->message('muss mindestens 4 Zeichen lang sein');
            $v->rule('lengthMax', 'name', 255)->message('darf maximal 255 Zeichen lang sein');
            // -------------------------------------------------------------------------------
            // wenn validation ok
            if (!$v->validate()) {
                echo "Fehler: <pre>";
                print_r($v->errors());
                echo "</pre>";
            } else {
                $sql = "INSERT INTO cars (name, price, kraftstoff, farbe, bauart, tank, jahrgang) 
                        VALUES (:name, :price, :kraftstoff, :farbe, :bauart, :tank, :jahrgang)";
                try {
                    $this->model->execute($sql, $carData);
                    response::successJSON(array: ["success" => "Eintrag erfolgreich hinzugefügt."]);
                } catch (Exception $e) {
                    response::errorJSON(array: ["error" => "Fehler beim Hinzufügen: " . $e->getMessage()]);
                }
            }
        }
    }

    /**
     * Aktualisiert bestehende Daten in der Datenbank.
     * 
     * Diese Methode gibt keine Daten direkt zurück, sondern sendet eine JSON-Antwort
     * an den Client über die `response`-Klasse.
     * 
     * @return void
     */
    public function updateData(): void
    {
        $carData = [
            "id" => 1,  // Beispiel-ID, anpassen
            "name" => "Skoda Superb",
            "price" => 36000
        ];

        $sql = "UPDATE cars SET name = :name, price = :price WHERE id = :id";

        try {
            $this->model->execute($sql, $carData);
            response::successJSON(array: ["success" => "Eintrag erfolgreich aktualisiert."]);
        } catch (Exception $e) {
            response::errorJSON(array: ["error" => "Fehler beim Aktualisieren: " . $e->getMessage()]);
        }
    }

    /**
     * Löscht Daten aus der Datenbank.
     *
     * Diese Methode gibt keine Daten direkt zurück, sondern sendet eine JSON-Antwort
     * an den Client über die `response`-Klasse.
     * 
     * @return void
     */
    public function deleteData(string $carId): void
    {

        if ($_SESSION['stufe'] == 1) {
            $sql = "DELETE FROM cars WHERE id = :id";

            try {
                $this->model->execute($sql, ["id" => $carId]);
                response::successJSON(array: ["success" => "Eintrag erfolgreich gelöscht."]);
            } catch (Exception $e) {
                response::errorJSON(array: ["error" => "Fehler beim Löschen: " . $e->getMessage()]);
            }
        } else {
            response::errorJSON(array: ["error" => "keine Berechtigung"]);
        }
    }

    /**
     * Destruktor der Klasse cars.
     */
    public function __destruct()
    {
        // Optionaler Destruktor
    }

    /**
     * Zeigt die Daten in einem formatieren Format an.
     *
     * @param mixed $data Die anzuzeigenden Daten.
     * @return void
     */
    public function showData(mixed $data): void
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    /**
     * Initialisierungsmethode.
     *
     * @return void
     */
    public function init(): void
    {

    }
}
