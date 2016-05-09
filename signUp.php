<?php
session_start();
require './controller/loginControl.php';
$title = "User signUp";

$login = new loginControl();
$content = '';

//if(isset($_POST['user']) || isset($_POST['password'])) {
//        $user =$_POST['user'];
//        $pwd = $_POST['password'];
//        $pwd2nd = $_POST['confirmpasswd'];
//        
//        $content .= $login->validate($user,$pwd);
//       
//        if($login->isLoggedin()) {
//            $_SESSION['user'] = $user;  
//            $login->redirectTo('userInfo.php');
//        }
//}


if(isset($_POST['user']) || isset($_POST['password'])||
        isset($_POST['confirmpasswd']) || isset($_POST['firstname']) ||
               isset($_POST['lastname']) ||
               isset($_POST['homephone']) || isset($_POST['identity'])) {
    
    $user = trim($_POST['user']);
    $password = trim($_POST['password']);
    $confirmpasswd = trim($_POST['confirmpasswd']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $address = trim($_POST['address']);
    $homephone = trim($_POST['homephone']);
    $cellphone = trim($_POST['cellphone']);
    $identity = trim($_POST['identity']);
 
    $content .= $login->signUpValidate($user, $password, $confirmpasswd, 
                        $firstname, $lastname, $address, $homephone, $cellphone, $identity);
    if($login->isSignedUp()) {
        $login->redirectTo("userlogin.php", "3");
        unset($_SESSION['user']);
    }
   
}

$content .="
         <form action='' method='post'  class='pure-form pure-form-stacked'>
		<label  for='user'>Create Username*</label>
		<input type='text' name='user' placeholder='yourname@email.com' required>
                <label for='password'>Create Password*</label>
		<input type='password' name='password' placeholder='length > 6 characters' required>
                <label for='confirmpasswd'>Confirm Password*</label>
		<input type='password' name='confirmpasswd' placeholder='' required>
                
                <div class='userInfo'>
                <p> Profile Information</p>
                </div>
                <lable for='identity'>Select your identity</lable>
                    <select name='identity'>
                       <option value=''>--</option>
                       <option value='seller'>Seller</option>
                       <option value='buyer'>Buyer</option>     
                    </select>
                    
                
                <label  for='firstname'>First Name*: </label>
		<input type='text' name='firstname' placeholder='eg: Lilly' required>
                <label for='lastname'>Last Name*: </label>
		<input type='text' name='lastname' placeholder='eg: Lewis' required>
                <label for='address'>Address: </label>
		<input type='text' name='address' placeholder='' >
                <label for='homephone'>Home Phone: </label>
		<input type='text' name='homephone' placeholder='' >
                <label for='cellphone'>Cell Phone*: </label>
		<input type='text' name='cellphone' placeholder='' required >

 
                
                <button type='submit' class='pure-button pure-button-primary'>Sign Up</button>
         </form>";


include 'Template.php';