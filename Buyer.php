<?php

session_start();
require './controller/loginControl.php';

$title = "Buyer Info";
$login = new loginControl();
$coffeeController = new CoffeeController();
$content = '';



if(isset( $_SESSION['user'])) {
    $username = $_SESSION['user'];
    $buyerTable = $coffeeController->CreateBuyerTable($username);
    $content .= $buyerTable;
} else {
    $login->redirectTo('401.php');
}



include 'Template.php';

