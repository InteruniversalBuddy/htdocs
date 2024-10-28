<?php

namespace app;

use lib\test;

/**
 * Die Klasse Cars ruft dynamisch Methoden auf oder initialisiert ein Test-Objekt.
 */
class cars {
    /** @var test Eine Instanz der Test-Klasse */
    private test $test;

    /**
     * Konstruktor der Klasse Cars.
     * 
     * @param string $methode Der Name der Methode, die aufgerufen werden soll.
     * @param string $parameter Ein optionaler Parameter, der an die Methode übergeben wird.
     */
    public function __construct(string $methode = "", string $parameter = "") {
        try {
            method_exists($this, $methode) ? $this->$methode($parameter) : $this->init();
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Initialisiert eine Instanz der Test-Klasse.
     * 
     * @return void
     */
    public function init(): void {
        $this->test = new test();
    }

    /**
     * Beispielmethode a.
     * 
     * @return void
     */
    public function a(string $a="myself"): void {
        echo "I love $a!!! <3";
    }

        /**
     * Initialisert eine Instanz der Test-Klasse mit einer Methode und hard-gecodetem Parameter.
     * 
     * @return void
     * @param string $parameter Der Name der Methode, die aufgerufen werden soll.
     */
    public function MeinTest(string $parameter=""){
        echo "MeinTest method called with parameter $parameter";
        $this->test = new test($parameter, 4);
    }
}
