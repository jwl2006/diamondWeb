<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require './controller/CoffeeController.php';

$coffeeController = new CoffeeController();


echo "<br>";
echo '<b>Testing User Name: </b>'."<br>";

echo "<br>";

if($coffeeController->checkUserName("Miley Stanford")) { 
    echo "Miley Stanford is valid " . "<br>";
} else {
    echo "Miley Stanford is NOT valid " . "<br>";
}

echo "<br>";

if($coffeeController->checkUserName("Miley Stanford Harward")) {
    echo "Miley Stanford Harward is valid "."<br>";
} else {
    echo "Miley Stanford Harwardis NOT valid " . "<br>";
}

echo "<br>";

if($coffeeController->checkUserName("Miley# Stanford")) {
    echo "Miley# Stanford is valid "."<br>";
} else {
    echo "Miley# Stanford is not valid " . "<br>";
}

echo "<br>";

if($coffeeController->checkUserName("1Miley Stanford")) {
    echo "1Miley Stanford is valid "."<br>";
} else {
    echo "1Miley Stanford is not valid " . "<br>";
}
echo "<br>";
echo "<br>";

echo "<b>Testing Product Name: </b>"."<br>";

echo "<br>";
if($coffeeController->checkProductName("Lilly Diamond")) {
    echo "Lilly Diamond is valid "."<br>";
} else {
    echo "Lilly Diamond is NOT valid " . "<br>";
}

echo "<br>";

$longproduct = "Lilly Diamond what ever I put here is too long for a test purpose but I just want to see if its longer than 200 what happened? I do not know about that let's go further length to see what happended";
if($coffeeController->checkProductName($longproduct)) {
    echo  $longproduct . " is valid "."<br>";
} else {
    echo $longproduct . " is NOT valid " . "<br>";
}

echo "<br>";

if($coffeeController->checkProductName("Li@%lly Diamond")) {
    echo "Li@%lly Diamond is valid "."<br>";
} else {
    echo "Li@%lly Diamond is NOT valid " . "<br>";
}

echo "<br>";

if($coffeeController->checkProductName("1Lilly Diamond")) {
    echo "1Lilly Diamond is valid "."<br>";
} else {
    echo "1Lilly Diamond is NOT valid " . "<br>";
}



