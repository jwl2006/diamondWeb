<?php

require './controller/CoffeeController.php';
$title = "Sellers";
session_start();
$coffeeController = new CoffeeController();

$seller = $_SESSION['user'];

$content = ' ';

$content .= $coffeeController->showSellerInventory($seller);

$content .= "<a href='createInventory.php'><button class='pure-button pure-button-primary'>Post Product</button></a>";
$content .= "<br><br><br><br>";
$content .= "<a href='userlogout.php'><button class='pure-button pure-button-primary'>Log Out</button></a>";

include 'Template.php';