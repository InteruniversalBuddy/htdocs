<?php

spl_autoload_register(function($class) {
    include $class . '.php';
});

$class = $_GET['class'] ?? 'cars';
$methode = $_GET['methode'] ?? '';
$parameter = $_GET['parameter'] ??'';

$app = new $class($methode,$parameter);