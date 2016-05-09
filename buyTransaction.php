<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require './controller/loginControl.php';
session_start();

$content = '';

$title = "Tranaction";

if(isset($_POST['productid'])) {
    $productID = $_POST['productid'];
}

if(isset($_POST['seller'])) {
    $seller = $_POST['seller'] ;
}

$quantity = "1";
$time = new DateTime();
$time = $time->setTimezone(new DateTimeZone('America/Los_Angeles'));
$time = date_format($time, 'Y-m-d H:i:s');

$buyer = $_SESSION['user'];



$login = new loginControl();


$productID = trim($productID);
$quantity = trim($quantity);


$buyer = trim($buyer);
$seller = trim($seller);

$content .= $login->transactionValidate($productID, $quantity, $time, $buyer, $seller);

if ($login->isProductAdded()) {
    $login->redirectTo('Buyer.php', '1');
}

include 'Template.php';