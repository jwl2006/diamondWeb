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
        require 'Credentials.php';
        $username = mysql_real_escape_string($usrName);
        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        
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
        }
        
        mysql_close();
        return $buyer;
    }
    
    function checkInDb($usrName) {
         require 'Credentials.php';
        
         $username = mysql_real_escape_string($usrName);
        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        
        $query = "SELECT email FROM buyer WHERE email LIKE '$username'";
        $result = mysql_query($query) or die(mysql_error());
        
        if(mysql_num_rows($result) > 0) {
            mysql_close();
            return true;
        } 
        mysql_close();
        return false;
    }
    
    function saveBuyerInDB($user, $password, $firstname, $lastname, $address, $homephone, $cellphone) {
        require 'Credentials.php';
        
        $email = mysql_real_escape_string($user);
        $password = mysql_real_escape_string($password);
        $firstname = mysql_real_escape_string($firstname);
        $lastname = mysql_real_escape_string($lastname);
        $address = mysql_real_escape_string($address);
        $homephone = mysql_real_escape_string($homephone);
        $cellphone = mysql_real_escape_string($cellphone);
        
        //open connection and select databases
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        
        $query = 'INSERT INTO buyer '.
                    '(firstname, lastname, email, address, home_phone, cell_phone, password) '.
                    'VALUES ( "$firstname", "$lastname", "$email", "$address", "$homephone","$cellphone", $password)';
        
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
