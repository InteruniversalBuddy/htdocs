<?php

declare(strict_types= 1);

namespace lib;

class test{
    public $methode;
    public function __construct(string $methode="", string $parameter = ""){
        echo "Hello from test class";
        method_exists($this, $methode) ? $this->$methode($parameter) : "";
    }

    public function a(){
        echo "<br><h1>aaaaaa</h1>";
    }
    
    public function b($parameter){
        echo "<br><h1>I love paramaters: $parameter!!!!!!</h1>";
    }
}