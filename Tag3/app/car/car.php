<?php

namespace app\car;

use app\car\model;

class car {
    private model $model;
    private string $sql;
    private array $data = [];
    private array $result = [];

    public function __construct(string $methode = "", string $parameter = "") {
        try {
            method_exists($this, $methode) ? $this->$methode($parameter) : $this->init();
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function init(): void {
        $this->model = new model();
    }

    public function getData(string $id=""){
        $this->init();
        $id="" ? $this->sql="SELECT * FROM cars" : $this->sql="SELECT * FROM cars WHERE id = :id";
        $id="" ? $this->data=[] : $this->data=[":id" => $id];
        $this->result = $this->model->getData($this->sql, $this->data);
        $this->showData();
    }

    public function showData(){
        echo'<pre>';
        print_r($this->result);
        echo '</pre>';
    }
}
