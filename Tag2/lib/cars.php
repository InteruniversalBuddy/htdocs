<?php
namespace lib;
use lib\response;
class cars {
    public function __construct($methode, $parameter) {
        echo "Drive safe";
        if (method_exists($this, $methode)) {
            echo "Methode '$methode' - gefunden worden<br>";
            $this->$methode($parameter);
        }else{
            response::error(404);
        }
    }
    public function yippie($parameter) {
        echo $parameter;
    }
}