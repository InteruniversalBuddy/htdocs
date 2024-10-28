<?php

include "./../vendor/autoload.php";

$green = "\033[32m";
$red = "\033[31m";
$yellow = "\033[33m";
$reset = "\033[0m";

$cars = new app\cars\cars();

$data =[
    "name" => $_POST["name"],
    "price" => $_POST["price"],
    "kraftstoff" => $_POST["kraftstoff"],
    "farbe" => $_POST["farbe"],
    "bauart" => $_POST["bauart"],
    "tank" => $_POST["tank"],
    "jahrgang" => $_POST["jahrgang"]
];

ob_start();
$cars->insertData();
echo "$yellow";
$ausgabe = ob_get_clean();
echo $ausgabe;
echo (string) $reset;