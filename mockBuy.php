<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require './controller/loginControl.php';
session_start();
$content = '';
$title = "Create Inventory";
$buyer = $_SESSION['user'];

$login = new loginControl();


if(isset($_POST['productname']) || isset($_POST['quantity'])||
        isset($_POST['time']) || isset($_POST['seller'])) {
    
    $productname = trim($_POST['productname']);
    $price = trim($_POST['quantity']);
    $weight = trim($_POST['time']);
    $category = trim($_POST['seller']);

    $buyer = trim($buyer);
//    $seller = session['user'];
    $content .= $login->productValidate($productname,$price,$weight,$category,$introduction,$seller);
        if ($login->isProductAdded()) {
             $login->redirectTo('sellerHomepage.php', '0');
        }
    
}
