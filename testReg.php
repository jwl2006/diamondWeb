<?php
require './controller/CoffeeController.php';

$coffeeController = new CoffeeController();

$title = "Test Reg Exp Function";

$userfeedback = '';
if (isset($_POST['seller'])) {
    $userfeedback =  $coffeeController->regCheckUserName($_POST['seller']);
}

$productfeedback='';
if (isset($_POST['product'])) {
    $productfeedback = $coffeeController->regCheckProductName($_POST['product']);
}


$content = "<h3> Test driver for Regular Expression(HW2)</h3>
           <p> Please type in the Seller Name you want to test: </p>";
$content .="
        <form action='' method='post'>
	<div class='field'>
		<label  for='seller'>Seller Name</label>
		<input type='text' name='seller' id='sellser'  autocomplete='off'>
                <input type='submit' value='Check'>
                <p>$userfeedback</p>
	</div>
     
        <br>

        <p> Please type in the Product Name you want to test: </p>
	<div class='field'>
		<label for='product'>Product Name</label>
		<input type='text' name='product' id='product' autocomplete='off'>
                <input type='submit' value='Check'>
                <p>$productfeedback</p>
	</div>
</form>";



include 'Template.php';