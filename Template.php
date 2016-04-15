<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="styles/stylesheet.css"/>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
        <script src="./javascript/firework.js"></script>
    </head> 
    <body>
        <div id="wrapper">
            <div id="banner">
                
            </div>
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Diamond.php">Diamond</a></li>
                    <li><a href="Seller.php">Sellers</a></li>
                    <li><a href="News.php">News</a></li>
                    <li><a href="userlogin.php">Account</a></li>
                </ul>
            </nav>
            <div>
                <?php if(isset($caption)) echo $caption; ?>
            </div>
            <div id="content_area">
                <?php echo $content; ?>
            </div>
            
            <div id="sidebar">
                <?php if(isset($sidePicture)) echo $sidePicture;?>
            </div>
            
        
            
            
            <footer>
                <p>All rights reserved</p>
            </footer>
        </div>
    </body>
</html>
