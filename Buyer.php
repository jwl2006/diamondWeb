<?php
require 'controller/CoffeeController.php';
$coffeeController = new CoffeeController();
$username = "wanghao313@gmail.com";
$buyerTable = $coffeeController->CreateBuyerTable($username);
$title = "Buyer Info";
$content = '';
$content .= $buyerTable;


include 'Template.php';

