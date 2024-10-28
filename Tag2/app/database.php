<?php
namespace app;
use lib\response;
use PDO;
class database {
    private $pdo;
    private $result;
    function __construct($methode, $parameter) {
        $this->pdo = new PDO('mysql:host=localhost;dbname=m295', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(method_exists($this, $methode)) {
            $this->$methode($parameter);
        }else{
            response::error(404);
        }
    }

    private function showData() {
        echo'<pre>';
        print_r($this->result);
        echo '</pre>';
    }

    private function execute($sql, $data = []){
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        $this->result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function showDataFromId($id) {
        if(is_numeric($id)) {
            $sql = "SELECT * FROM cars WHERE id = :id;";
            $data = ['id' =>$id];
        }else{
            $sql = 'SELECT * FROM cars;';
        }
        $this->execute($sql, $data);
        $this->showData();
    }

    function getData() {
        $sql = 'SELECT * FROM cars;';
        $this->execute($sql);
    }
    
    function addData($parameter) {
        $sql = "INSERT INTO cars VALUES ('', '333333', 'Elektro', '#0000ff', 'Limousine', '0', '2024-10-02', timestamp(), 1)";
        $this->execute($sql);
    }
}