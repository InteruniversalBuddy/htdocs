<?php
namespace Tag2;
include("cars.php");
include("cars2.php");
$car = new cars\car("BMW x", "blue");   
$car->display();
echo $car->drive();
echo '<br>';
echo '<br>';
$car2 = new cars2\car("Toyota y3", "black");
$car2->display();