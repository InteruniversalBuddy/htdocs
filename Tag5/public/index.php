<?php
declare(strict_types= 1);
require __DIR__ ."/../vendor/autoload.php";
use Steampixel\Route;

Route::add('/', function() {
    phpinfo();
}, ['get', 'post']);

Route::add('/info', function() {
    phpinfo();
}, ['get', 'post']);

Route::add('/user/([0-9]*)/edit', function($class) {
    $libclass = "lib\\$class";
    class_exists($libclass) ? $app = new $libclass() : print "Class $class not found";
  }, ['get', 'post']);

Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)', function($class, $methode) {
    $libclass = "lib\\$class";
    class_exists($libclass) ? $app = new $libclass($methode) : print "Class $class not found";
}, ['get', 'post']);


Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)', function($class, $methode, $parameter) {
    echo "Hello $class!";
    $libclass = "lib\\$class";
    class_exists($libclass) ? $app = new $libclass($methode, $parameter) : print "Class $class not found";
}, ['get', 'post']);