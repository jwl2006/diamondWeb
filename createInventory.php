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
$seller = $_SESSION['user'];

$login = new loginControl();


if(isset($_POST['productname']) || isset($_POST['price'])||
        isset($_POST['weight']) || isset($_POST['category']) ||
               isset($_POST['introduction'])) {
    
    $productname = trim($_POST['productname']);
    $price = trim($_POST['price']);
    $weight = trim($_POST['weight']);
    $category = trim($_POST['category']);
    $introduction = trim($_POST['introduction']);
    $seller = trim($seller);
//    $seller = session['user'];
    $content .= $login->productValidate($productname,$price,$weight,$category,$introduction,$seller);
        if ($login->isProductAdded()) {
             $login->redirectTo('sellerHomepage.php', '0');
        }
    
}




$content .="
         <h3>Upload new products</h3>
         <form action='' method='post'  class='pure-form pure-form-stacked'>
            <fieldset>
              <div class='pure-control-group'>  
		<label  for='productname'>Product Name*</label>
		<input type='text' name='productname'required>
              </div>
              <div class='pure-control-group'> 
                <label for='price'>Price</label>
		<input type='text' name='price' required>
              </div>
              <div class='pure-control-group'> 
                <label for='weight'>Weight</label>
		<input type='text' name='weight' placeholder='' required>
              </div>
    
                 <lable for='category'>Category</lable>
                    <select name='category'>
                       <option value='raw'>Raw diamond</option>
                       <option value='crafted'>Crafted diamond</option>
                       <option value='ring'>Diamond ring</option>     
                </select>


                <label for='introduction'>Introduction: </label>
                <textarea name='introduction' id='introduction'> Less than 50 words please.
                </textarea>
                
                <button type='submit' class='pure-button pure-button-primary'>Sign Up</button>
            </fieldset>
         </form>";
include 'Template.php';
