<?php

declare(strict_types= 1);

require __DIR__ ."/../vendor/autoload.php";

// Use this namespace
use Steampixel\Route;

// Add routes
Route::add('/', function() {
    echo "Haiy!!! =D";
}, ['get', 'post']);    

Route::add('/info', function() {
    phpinfo();
}, 'get');

Route::add('/([a-zA-Z0-9]*)', function($class) {
    echo "Hello $class!<br>";
    $appclass = "app\\$class";
    class_exists($appclass) ? $app = new $appclass() : print "Class $class not found";
}, 'get');

Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)', function($class, $methode) {
    echo "Hello $class!<br>";
    $appclass = "app\\$class";
    class_exists($appclass) ? $app = new $appclass($methode) : print "Class $class not found";
}, 'get');

Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)', function($class, $methode, $parameter) {
    echo "Hello $class!<br>";
    $appclass = "app\\$class";
    class_exists($appclass) ? $app = new $appclass($methode, $parameter) : print "Class $class not found";
}, 'get');

Route::pathNotFound(function(){
    echo '<h1>Error 404 D=</h1>';   
});

// Run the router
Route::run('/');