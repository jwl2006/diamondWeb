<?php
require './controller/CoffeeController.php';
session_start();
$coffeeController = new CoffeeController();

$title = "Diamond";
//$content = $coffeeController->SellerTable("./DataSource/diamond.csv");
$content = '';
$content .= $coffeeController->showSellerInventory('');



$content .= "<span class='signup-today'>
                   <a href='signUp.php' class='track-event'>Buy</a>
               </span>";
  

include 'Template.php';
?>
