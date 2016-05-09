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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js">></script>
    </head> 
    <body>
        <div id="wrapper">
            <div id="banner">
                
            </div>
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Diamond.php">Diamond</a></li>
                    <li><a href="showAllUsers.php">Sellers</a></li>
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
    <script>
        $(document).ready(function(){
            $(document).on("click", "#orderButton", function(){
            console.log("clicked");
            var $row = $(this).parents(':eq(1)');
            console.log($row);
            $tds = $row.find("td");
            var data = [];
            $.each($tds, function() {
                data.push($(this).text());
            })
           var $productid = data[6];
           var $seller = data[4];
           var param = '?productid='+$productid+'&seller='+$seller;
           var uri = "/buyTransaction.php"+ param;
           console.log(uri);
           $.ajax({
               type: "POST",
               url: 'buyTransaction.php',
               data:{'productid': $productid, 'seller': $seller},
               success: function(response) {
                  document.open();
                  document.write(response);
                  document.close();
                  window.location.replace("Buyer.php");
               }
               
           });
            
        })
    })
        
    </script>
</html>
