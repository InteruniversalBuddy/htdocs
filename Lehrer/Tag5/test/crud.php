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


ob_start();
$cars->getData("3");
$ausgabe = ob_get_clean();


echo "$yellow Test JSON bei cars / getData \n";
$decodedJson = json_decode($ausgabe, true);
if ($decodedJson !== null) {
    echo "$green::::::::::::::::::::::::::::>> Die Ausgabe ist ein gültiges JSON.\n$reset";
} else {
    if (is_array($decodedJson) && isset($decodedJson['error'])) {
        echo "$red::::::::::::::::::::::::::::>> Fehler: " . $decodedJson['error'] . " \n$reset";
    } else{
        echo "$green::::::::::::::::::::::::::::>> Kein Fehler aufgetreten.\n$reset";
        echo "JSON-Ausgabe:\n";
        print_r(value: $decodedJson);
        echo "\n";
    }
}






// insert
$_POST = [
    "name" => "AA",
    "price" => 35000,
    "kraftstoff" => "Benzin",
    "farbe" => "#123456",
    "bauart" => "Limousine",
    "tank" => 0,
    "jahrgang" => "2023-01-01"
];

// Ausgabe in den Puffer umleiten
/* ob_start();
$cars->insertData();
$ausgabe = ob_get_clean();
echo $ausgabe; */



// Ausgabe in den Puffer umleiten
/* ob_start();
$cars->getData(6);
$ausgabe = ob_get_clean();
echo $ausgabe; */



echo (string) $reset;