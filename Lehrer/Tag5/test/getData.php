<?php

//include "./../lib/database.php";
//include "./../app/cars/model.php";
//include "./../app/cars/cars.php";
//include "./../vendor/vlucas/valitron/src/Valitron/Validator.php";
include "./../vendor/autoload.php";


$green = "\033[32m";
$red = "\033[31m";
$yellow = "\033[33m"; 
$reset = "\033[0m"; 

// instanz von cars erstellen
$cars = new app\cars\cars();

// Test JSON bei cars / getData / 3
ob_start();
$cars->getData("3");
$ausgabe = ob_get_clean();
// Ausgabe 
echo "$yellow Test JSON bei cars / getData \n";
isJSON($ausgabe);




echo (string) $reset;

function isJSON($string) {
    global $green, $red, $yellow, $reset;
    $decodedJson = json_decode($string, true);
    if ($decodedJson !== null) {
        echo "$green::::::::::::::::::::::::::::>> Die Ausgabe ist ein gültiges JSON.\n$reset";
    } else {
        echo "$red::::::::::::::::::::::::::::>> Ausgabe kein JSON! \n$reset";
    }
    isError($decodedJson);
}
function isError($array) {
    global $green, $red, $yellow, $reset;
    if(isset($array['error'])) {
        echo "$red::::::::::::::::::::::::::::>> Fehler: " . $array['error'] . " \n$reset";
    } 
    elseif (isset($array['success'])) {
        echo "$green::::::::::::::::::::::::::::>> Success:" . $array['success'] . "\n$reset";
    }
    else{
        echo "$yellow::::::::::::::::::::::::::::>> Keine Status Meldungen.\n$reset";
    }
}