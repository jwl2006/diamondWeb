<?php
require './controller/CoffeeController.php';

$coffeeController = new CoffeeController();

$title = "Sellers";
$content = $coffeeController->SellerTable("./DataSource/seller.csv");



include 'Template.php';

