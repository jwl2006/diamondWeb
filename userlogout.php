<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require './controller/loginControl.php';

$login = new loginControl();
unset($_SESSION['user']);
$login->redirectTo('userlogin.php', '0');
include 'Template.php';
