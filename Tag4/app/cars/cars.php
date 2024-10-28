<?php
namespace app\cars;

use Exception;
use Valitron\Validator;
use lib\response;

/**
 * Klasse cars für die Verwaltung von Autodaten.
 */
class cars {
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
    public function __construct(string $methode = "", string $parameter = "") {
        $this->model = new model();
        if (!empty($methode) && method_exists(object_or_class: $this, method: $methode)) {
            try {
                $this->$methode($parameter);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            $this->init();
        }
    }

    /**
     * Holt Daten aus der Datenbank basierend auf der ID.
     *
     * @param string|null $id Die ID des Autos (optional).
     * @return void
     */
    public function getData(?string $id): void {
        if ($id === "") {
            $sql = "SELECT * FROM cars";
            $data = [];
        } else {
            $sql = "SELECT * FROM cars WHERE id = :id";
            $data = ["id" => $id];
        }
        $result = $this->model->getData($sql, $data);
        $this->showData($result);
    }

    /**
     * Fügt neue Daten in die Datenbank ein.
     *
     * @return void
     */
    public function insertData(): void {
        // Überprüfe, ob POST-Daten vorhanden sind
        if (empty($_POST)) {
            echo "Fehler: Keine POST-Daten vorhanden.\n";
            return;
        }else{
            $carData = [
                "name" => $_POST["name"],
                "price" => $_POST["price"],
                "kraftstoff" => $_POST["kraftstoff"],
                "farbe" => $_POST["farbe"],
                "bauart" => $_POST["bauart"],
                "tank" => $_POST["tank"],
                "jahrgang" => $_POST["jahrgang"]
            ];

            $v = new Validator($carData);

            $v->rule('required', 'name');

            if($v->validate()) {
                $sql = "INSERT INTO cars (name, price, kraftstoff, farbe, bauart, tank, jahrgang) 
                        VALUES (:name, :price, :kraftstoff, :farbe, :bauart, :tank, :jahrgang)";
                
                try {
                    $this->model->execute($sql, $carData);
                    echo "Eintrag erfolgreich hinzugefügt.";
                } catch (Exception $e) {
                    echo "Fehler beim Hinzufügen: " . $e->getMessage();
                }
            }else{
                echo "Fehler: <pre>";
                print_r($v->errors());
                echo "</pre>";
            }
        }
    }

    /**
     * Aktualisiert bestehende Daten in der Datenbank.
     *
     * @return void
     */
    public function updateData(): void {
        $carData = [
            "id" => 1,  // Beispiel-ID, anpassen
            "name" => "Skoda Superb",
            "price" => 36000
        ];

        $sql = "UPDATE cars SET name = :name, price = :price WHERE id = :id";
        
        try {
            $this->model->execute($sql, $carData);
            echo "Eintrag erfolgreich aktualisiert.";
        } catch (Exception $e) {
            echo "Fehler beim Aktualisieren: " . $e->getMessage();
        }
    }

    /**
     * Löscht Daten aus der Datenbank.
     *
     * @return void
     */
    public function deleteData(int $carId=0): void {
        $sql = "DELETE FROM cars WHERE id = :id";
        
        try {
            $this->model->execute($sql, ["id" => $carId]);
            echo "Eintrag erfolgreich gelöscht.";
        } catch (Exception $e) {
            echo "Fehler beim Löschen: " . $e->getMessage();
        }
    }

    /**
     * Destruktor der Klasse cars.
     */
    public function __destruct() {
        // Optionaler Destruktor
    }

    /**
     * Zeigt die Daten in einem formatieren Format an.
     *
     * @param mixed $data Die anzuzeigenden Daten.
     * @return void
     */
    public function showData(mixed $data): void {
        /* echo "<pre>";
        print_r($data);
        echo "</pre>"; */
        response::successJSON($data);
    }

    /**
     * Initialisierungsmethode.
     *
     * @return void
     */
    public function init(): void {

    }
}
