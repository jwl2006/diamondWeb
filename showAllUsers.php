<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require './controller/loginControl.php';

$title = "All Users";

$coffeeController = new CoffeeController();
$content = '';

$allUsers = $coffeeController->showAllUsers("seller");

$content .= $allUsers;
include 'Template.php';

?>
<!--<html>
    <head>
       
    </head>
    <body>
        <div>
            <?php echo "All User's in Hao Wang User Database"?>
        </div>
        <div>
            <?php echo "-------------------------------------------------------------------------------------------------------------"?>
        </div>
        <div id="content_area">
                <?php echo $content; ?>
        </div>
          <div>
           
            //<?php echo "-------------------------------------------------------------------------------------------------------------"?>
        </div>
    </body>
</html>-->


