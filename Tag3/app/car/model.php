<?php

namespace app\car;
use lib\database;
class model extends database{
    private array $result;
    public function __construct(){
        parent::__construct();
    }

    public function getData(string $sql="", array $data=[]){
        $this->result = parent::executeQuery($sql, $data);
        return $this->result;
    }
}