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
//    $login->redirectTo('Diamond.php','0');
    $content .= "<a href='userlogout.php'><button class='pure-button pure-button-primary'>Log Out</button></a>";

    $orderhistory = $coffeeController->findOrderHistory($username);
    $content .= $orderhistory;
    
} else {
    $login->redirectTo('401.php','0');
}

$content .= "<a href='Diamond.php'><button class='pure-button pure-button-primary'>Order</button></a>";


include 'Template.php';

