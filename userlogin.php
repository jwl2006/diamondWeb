<?php
session_start();
require './controller/loginControl.php';
$title = "User Login";

$login = new loginControl();
$content = '';

if(isset($_POST['user']) || isset($_POST['password'])) {
        $user =$_POST['user'];
        $pwd = $_POST['password'];
        $content .= $login->validate($user,$pwd);
       
        if($login->isLoggedin()) {
            $_SESSION['user'] = $user;  
            $login->redirectTo('userInfo.php');
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
                    <a href='/signUp' class='track-event'>Sign Up</a>
                    </span>
                </div>
         </form>";


include 'Template.php';


