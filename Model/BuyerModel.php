<?php
/**
 * Description of DiamondModel
 *
 * @author wanghao
 */
require_once 'Entities/buyerEntity.php';
require_once 'Entities/productEntity.php';
require_once 'Entities/buyerHistory.php';

class BuyerModel {
    //put your code here
    function GetBuyerByName($username) {

        require 'Credentials.php';

        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);

        $username = mysql_real_escape_string($username);     
        $query = "SELECT * FROM buyer WHERE email LIKE '$username'";
        $result = mysql_query($query) or die(mysql_error());
  
        
      
        
        if ($row = mysql_fetch_array($result)) {
            $firstname = $row[1];
            
            $lastname = $row[2];
            $email = $row[3]; 
            $address = $row[4];
            $home_phone = $row[5];
            $cell_phone = $row[6];
            $passwd = $row[7];
            
      
        
            $buyer = new buyerEntity(-1, $firstname, $lastname, $email, $address, $home_phone, $cell_phone, $passwd);
             mysql_close();
            return $buyer;
        }
        mysql_close();
        return NULL;
    }
    
    function getUserByIdentity($identity) {
         require 'Credentials.php';

        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        
        $query = "SELECT * FROM buyer WHERE identity LIKE '$identity'";
        $result = mysql_query($query) or die(mysql_error());
        $buyerList = array();
        while ($row = mysql_fetch_array($result)) {
            $firstname = $row[1];
            $lastname = $row[2];
            $email = $row[3]; 
            $address = $row[4];
            $home_phone = $row[5];
            $cell_phone = $row[6];
            $passwd = $row[7];
           
            $buyer = new buyerEntity(-1, $firstname, $lastname, $email, $address, $home_phone, $cell_phone, $passwd,$identity);
            $buyerList[] = $buyer;   
        }
        return $buyerList;   
    }
    
    function findBuyerHistory($buyer) {
         require 'Credentials.php';
   
        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        
        $buyer = mysql_real_escape_string($buyer);
        
        $query = "SELECT * FROM transaction WHERE buyer LIKE '$buyer'";
                  
        $result = mysql_query($query) or die(mysql_error());
        $transactiontList = array();
        while ($row = mysql_fetch_array($result)) {
            $id = $row[0];
            $productid = $row[1];
            $quantity = $row[2];
            $time = $row[3]; 
            $buyer = $row[4];
            $seller = $row[5];
            $productname = $this->findProductbyId($productid);
          
           
            $transaction = new buyerHistory($productname, $quantity, $time, $buyer, $seller);
            
            $transactiontList[] = $transaction;   
        }
    
        return $transactiontList;   
        mysql_close();
    }
    
    
    function findProductbyId($productid) {
        require 'Credentials.php';
   
        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        
        $productid= mysql_real_escape_string($productid);
        $query = "SELECT * FROM product WHERE id LIKE '$productid'";
          
        $result = mysql_query($query) or die(mysql_error());
         mysql_close();
        if ($row = mysql_fetch_array($result)) {
             $nameFound = $row[1];
             return $nameFound;
        } 
        return null;
    }
    
    
    
    
    
    
        
    function findSellerInventory($seller='') {
        require 'Credentials.php';
   
        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        
        $seller = mysql_real_escape_string($seller);
        if(!empty($seller)) {
            $query = "SELECT * FROM product WHERE seller LIKE '$seller'";
        } else {
            $query = "SELECT * FROM product";
        }
        
        $result = mysql_query($query) or die(mysql_error());
        $productList = array();
        while ($row = mysql_fetch_array($result)) {
            $id = $row[0];
            $name = $row[1];
            $price = $row[2];
            $weight = $row[3]; 
            $category = $row[4];
            $seller = $row[5];
            $introduction = $row[6];
           
            $product = new productEntity($id,$name, $price, $weight, $category, $seller, $introduction);
            
            $productList[] = $product;   
        }
    
        return $productList;   
        mysql_close();
        
    }
    
  
    
    function isauthenticated($username, $password) {
          require 'Credentials.php';

        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);

        $query = "SELECT * FROM buyer WHERE email LIKE '$username' and password LIKE '$password'";
       
        $result = mysql_query($query) or die(mysql_error());
        mysql_close();
        if(mysql_num_rows($result) > 0) {
            return true;
        }
       return false;  
    }

    function readEntryFromDb($query) {
         require 'Credentials.php';

        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
       
        $result = mysql_query($query) or die(mysql_error());
        mysql_close();
        return $result;
    }
    
    function checkInDb($value) {
          require 'Credentials.php';

        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
       
        $value = mysql_real_escape_string($value);
        $query = "SELECT email FROM buyer WHERE email LIKE '$value'";
        $result = mysql_query($query) or die(mysql_error());

        mysql_close();

        if(mysql_num_rows($result) > 0) {       
            return true;
        } 
        return false;
    }
    
    function findIdentityInDB($email) {
        require 'Credentials.php';
   
        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        
        $email = mysql_real_escape_string($email);
        $query = "SELECT identity FROM buyer WHERE email LIKE '$email'";
          
        $result = mysql_query($query) or die(mysql_error());
         mysql_close();
        if ($row = mysql_fetch_array($result)) {
             $identityFound = $row[0];
             return $identityFound;
        } 
        return null;
    }
    
    function saveTransaction($productid, $quantity, $time, $buyer, $seller) {
        require 'Credentials.php';
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
       
        $id = 'NULL';
        $productid = mysql_real_escape_string($productid);
        $quantity = mysql_real_escape_string($quantity);
        $time = mysql_real_escape_string($time);
        $buyer = mysql_real_escape_string($buyer);
        $seller = mysql_real_escape_string($seller);
        
        $query = "INSERT INTO transaction (id, productid, quantity, time, buyer, seller) 
                    VALUES ('$id','$productid', '$quantity', '$time', '$buyer', '$seller')";
        
        $result = mysql_query($query);
     
        mysql_close();
        
        if($result) {
            return true;
        } else {
            die(mysql_error());
            return false;
        }
    }
    
    function saveProductInDB($productname, $price, $weight, $category, $introduction, $seller) {
        require 'Credentials.php';
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
       
        $id = 'NULL';
        $id = mysql_real_escape_string($id);
        $productname = mysql_real_escape_string($productname);
        $price = mysql_real_escape_string($price);
        $weight = mysql_real_escape_string($weight);
        $category = mysql_real_escape_string($category);
        $introduction = mysql_real_escape_string($introduction);
        $seller = mysql_real_escape_string($seller);
        
        $query = "INSERT INTO product (id, name, price, weight, category, introduction, seller) 
                    VALUES ('$id', '$productname', '$price', '$weight', '$category', '$introduction', '$seller')";
        
     
        $result = mysql_query($query);
     
        mysql_close();
        
        if($result) {
            return true;
        } else {
            die(mysql_error());
            return false;
        }   
      
    }
    
    function saveBuyerInDB($email, $secret, $firstname, $lastname, $address, $homephone, $cellphone, $identity) {
        require 'Credentials.php';
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        
        $id = 'NULL';
        $id = mysql_real_escape_string($id);
        $email = mysql_real_escape_string($email);
        $secret = mysql_real_escape_string($secret);
        $firstname = mysql_real_escape_string($firstname);
        $lastname = mysql_real_escape_string($lastname);
        $address = mysql_real_escape_string($address);
        $homephone = mysql_real_escape_string($homephone);
        $cellphone = mysql_real_escape_string($cellphone);
        $identity = mysql_real_escape_string($identity);
        
        //open connection and select databases
        
       
        
        $query = "INSERT INTO buyer (id, firstname, lastname, email, address, home_phone, cell_phone, password, identity) 
                    VALUES ('$id', '$firstname', '$lastname', '$email', '$address', '$homephone', '$cellphone', '$secret','$identity')";
        
        $result = mysql_query($query);
        mysql_close();
        if($result) {
            return true;
        } else {
            die(mysql_error());
            return false;
        }   
    }
    
}
