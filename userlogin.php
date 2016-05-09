<?php
session_start();
require './controller/loginControl.php';
require_once './Model/BuyerModel.php';
$title = "User Login";

$login = new loginControl();
$buyermodel = new BuyerModel();
$content = '';

if(isset($_POST['user']) || isset($_POST['password'])) {
        $user =$_POST['user'];
        $pwd = $_POST['password'];
        $content .= $login->validate($user,$pwd);
        
        if($login->isLoggedin()) {
            $_SESSION['user'] = $user; 
        
            $identity = $buyermodel->findIdentityInDB($user);
            
           
            if($identity == 'buyer') {
                $login->redirectTo('Buyer.php','0');
            } else if($identity == 'seller') {
                $login->redirectTo('sellerHomepage.php', '0');
            }
            } else {
                 $login->redirectTo('userlogout.php', '0');
            }
        }





$content .="
         <form action='' method='post' class='pure-form pure-form-stacked'>
		<label  for='user'>User Name</label>
		<input type='text' name='user' placeholder='yourname@email.com' required>
                <label for='password'>Password</label>
		<input type='password' name='password' placeholder='password' required>
                <button type='submit' class='pure-button pure-button-primary'>Sign in</button>
                <div class = 'footer'>
                 Don’t have an account?
                    <span class='signup-today'>
                    <a href='signUp.php' class='track-event'>Sign Up</a>
                    </span>
                </div>
         </form>";


include 'Template.php';


