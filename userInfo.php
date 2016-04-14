<?php
session_start();
require './controller/loginControl.php';

$login = new loginControl();
if(isset( $_SESSION['user'])) {
    $user= $_SESSION['user']; 
    
    $userInfo = $login->searchUserInfo($user, "./DataSource/userInfo.csv");
    
    if(!empty($userInfo)) {
        $content = $login->getUserTable($userInfo,"./DataSource/userInfo.csv");
    
    } else {
        $content .="User information is not on file";
    }
   
} else {
    $login->redirectTo('401.php');
}


include 'Template.php';
