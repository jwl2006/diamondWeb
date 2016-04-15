<?php
/**
 * Description of DiamondModel
 *
 * @author wanghao
 */
require_once 'Entities/buyerEntity.php';
class BuyerModel {
    //put your code here
    function GetBuyerByName($username) {

        $username = mysql_real_escape_string($username);     
        $query = "SELECT * FROM buyer WHERE email LIKE '$username'";
        
        $result = $this->readEntryFromDb($query);
       

        
        if ($row = mysql_fetch_array($result)) {
            $firstname = $row[1];
            
            $lastname = $row[2];
            $email = $row[3]; 
            $address = $row[4];
            $home_phone = $row[5];
            $cell_phone = $row[6];
            $passwd = $row[7];
            
      
        
            $buyer = new buyerEntity(-1, $firstname, $lastname, $email, $address, $home_phone, $cell_phone, $passwd);
            return $buyer;
        }
       
        return NULL;
    }
    function isauthenticated($username, $password) {
        $query = "SELECT * FROM buyer WHERE email LIKE '$username' and password LIKE '$password'";
        $result = $this->readEntryFromDb($query);
     
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
        $value = mysql_real_escape_string($value);
        $query = "SELECT email FROM buyer WHERE email LIKE '$value'";
        $result = $this->readEntryFromDb($query);

        if(mysql_num_rows($result) > 0) { 
            return true;
        } 
        return false;
    }
    
    function saveBuyerInDB($email, $secret, $firstname, $lastname, $address, $homephone, $cellphone) {
        require 'Credentials.php';
        
        $id = 'NULL';
        $id = mysql_real_escape_string($id);
        $email = mysql_real_escape_string($email);
        $secret = mysql_real_escape_string($secret);
        $firstname = mysql_real_escape_string($firstname);
        $lastname = mysql_real_escape_string($lastname);
        $address = mysql_real_escape_string($address);
        $homephone = mysql_real_escape_string($homephone);
        $cellphone = mysql_real_escape_string($cellphone);
        
        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
       
        
        $query = "INSERT INTO buyer (id, firstname, lastname, email, address, home_phone, cell_phone, password) 
                    VALUES ('$id', '$firstname', '$lastname', '$email', '$address', '$homephone', '$cellphone', '$secret')";
        
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
