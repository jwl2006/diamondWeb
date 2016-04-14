<?php
require 'CoffeeController.php';
require_once 'Model/BuyerModel.php';

class loginControl {
   private $message = array(),
           $_isLoggedIn = False,
           $_userName,
           $_password;
       
    function validate($username, $password) {
           $this->checkRequired($username,'UserName');
           $this->checkRequired($password,'Password');
          
           $this->checkLength($username,'UserName');
           $this->checkLength($password,'Password'); 
        
           
           $this->isValidEmail($username, 'UserName');
      
           $this->checkFile($username, $password,"./DataSource/userlogin.csv");
           
           $error_msg = $this->getError();
           if(empty($error_msg)) {
                $this->_isLoggedIn = true;
                $this->_userName = $username;
                $this->_password = $password;
            } else {
                foreach($this->message as $e) {
                    return"<p>Errors:{$e}</p>";
                } 
            }
    }
    
    function signUpValidate($user, $password, $confirmpasswd, 
                            $firstname, $lastname, $address, 
                            $homephone, $cellphone) {
        
            $this->checkLength($user, $UserName);
            $this->checkLength($password,'Password');
            $this->checkLength($confirmpasswd,'Password');
            
            $this->isValidEmail($username, 'UserName');
            $this->matchPassword($password, $confirmpasswd);
            
            $this->isNotInDb($username);
            
            $error_msg = $this->getError();
            
            if(empty($error_msg)) {
               //put the data in the data base
                $buyerModel = new BuyerModel();
                $saveStatus = $buyerModel->saveBuyerInDB($user, 
                        $password, $firstname, $lastname, 
                        $address, $homephone, $cellphone);
                if($saveStatus) {
                    return "<p> Congratulations, register success! Please Login.";
                }
            } else {
                foreach($this->message as $e) {
                    return "<p>Errors:{$e}</p>";
                }
            }
    }
    
    function isNotInDb ($username) {
        $buyerModel = new BuyerModel();
        if (!$buyerModel->checkInDb($username)) {
            return true;
        } else {
            $this->addError("Try another email.");
            return false;
        }
    }
    
    
    function redirectTo($location = null) {
        exit(header('Location:' . $location));	
    }
    
    function isLoggedin() {
        return $this->_isLoggedIn;
    }
    
  
    
    
    function searchUserInfo($user,$filename) {
        $result = array();
        $coffee = new CoffeeController();
        $data = $coffee->readCSV($filename);
        for($i=0;$i<count($data);$i++) {
            if(trim($data[$i][1]) == trim($user)) {
                    $result = $data[$i];
                }
        }
        return $result;
    }
    
    public function getUserTable($dataInfo,$filename) {
         $coffee = new CoffeeController();
         $data = $coffee->readCSV($filename);
         $title = $data[0];
         $result = '';
//            $username = $data[$i][0];
//            $email = $data[$i][1];   
//            $phone = $data[$i][2];
//            $address = $data[$i][3];
//            $purchase_item = $data[$i][4];
//            $unit = $data[$i][5];
//            $date_bought = $data[$i][6];
            
          $result .= "<table class = 'pure-table' "; 
             
              for($i=0;$i<count($title);$i++) {
                  $label = $title[$i];
                  $value = $dataInfo[$i];
                  $result .= "<tr>
                                  <th>$label</th> 
                                  <td>$value</td>
                              </tr>";
               }
         $result .= '</table>'; 
         return $result;
     }
    
    function checkLength($value, $msg) {
    
         if(strlen(trim($value)) < 6) {
             $this->addError("$msg must be at least 6 characters.");  
        } 
    }
    
    function matchPassword($firstpwd, $secondowd) {
         if ($firstpwd != $secondowd) {
             $this->addError("Please make sure password match.");
         }    
    }
    
    function getError() {
       return $this->message;
    }
    
    function addError($error) {
        array_push($this->message, $error);
    //    $this->$errors[] = $error;
    }
   
    function checkRequired($value, $msg) {
        $value_trim = trim($value);
        if(empty($value_trim)) {
           $this->addError("$msg is required!");
        }
    }

    function isValidEmail($email, $msg){ 
        if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            return true;
        } else {
            $this->addError("$msg must be email");
            return false;
        }
    }
   


    function checkFile($user, $password,$filename) {
        if($this->isInthefile($user, $password, $filename)) {
            return true;
        } else {
            $this->addError("User Not registered!");
            return false;
        } 
    }
    function isInthefile($user, $password,$filename) {
        $coffee = new CoffeeController();
        $data = $coffee->readCSV($filename);
        for($i=1; $i < count($data); ++$i) {
            if(($user == $data[$i][0]) && ($password == $data[$i][1])) {
                return true;
            }
        }
        return false;
    }
    
    function getUser() {
        return $this-> _userName;
    }
    
    function getPassword() {
        return $this->_password;
    }
}



    



