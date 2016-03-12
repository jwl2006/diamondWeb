<?php
require './controller/CoffeeController.php';

$coffeeController = new CoffeeController();

$title = "Diamond";
$content = $coffeeController->SellerTable("./DataSource/diamond.csv");

include 'Template.php';