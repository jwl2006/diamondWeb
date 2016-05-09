<?php
require 'CoffeeController.php';
require_once 'Model/BuyerModel.php';

class loginControl {
   private $message = array(),
           $_isLoggedIn = False,
           $_userName,
           $_isSignedUp = False,
           $_password,
           $_productAdded = False,
           $_transactionAdded = False;
       
       
    function validate($username, $password) {
         
           $this->checkLength($username,'UserName');
           $this->checkLength($password,'Password'); 
        
           
           $this->isValidEmail($username, 'UserName');
      
           $this->authentication($username, $password);
           
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
    
    function authentication($username, $password) {
        $buyerModel = new BuyerModel();
        if (!$buyerModel->isauthenticated($username, sha1($password))) {
            $this->addError("User Not registered!");
            return false;
        } 
            return true;  
    }
    
    function productValidate($productname, $price, $weight, $category, $introduction, $seller) {
        
        $this->checkRequired($productname,"productname");
        $this->checkRequired($price, "price");
        $this->checkRequired($weight, "weight");
        $this->checkRequired($category, "category");
        
         if(empty($error_msg)) {
           
             $buyerModel = new BuyerModel();
             $saveProduct = $buyerModel->saveProductInDB($productname, $price, $weight, $category, $introduction, $seller);
             
             if($saveProduct) {
               
                 $this->_productAdded = true;
                 return "Congrats, your product is posted!";
             }   
         }  else {
                foreach($this->message as $e) {
                    return "<p>Errors:{$e}</p>";
                }
        }
    }
    function checkRequired($entry, $msg) {
        if(!empty($entry)) {
            return true;
        } else {
            $this->addError($msg + "is required.");
            return false;
        }
    }
    
    function transactionValidate($productid, $quantity, $time, $buyer, $seller) {
         
         $this->checkRequired($productid, "productId");
         $this->checkRequired($quantity, "quantity");
         
         $error_msg = $this->getError();
         
        if(empty($error_msg)) { 
            $buyerModel = new BuyerModel();
            $saveStatus = $buyerModel->saveTransaction($productid, $quantity, $time, $buyer, $seller);
          
            
            if($saveStatus) {
                 $this->_transactionAdded = true;
                 return "Congrats, order completed!"; 
            }
        } else {
                foreach($this->message as $e) {
                    return "<p>Errors:{$e}</p>";
                }
            }
    }
    
   
    function isProductAdded (){
        return $this->_productAdded;
    }
    
    function signUpValidate($userName, $password, $confirmpasswd, 
                            $firstname, $lastname, $address, 
                            $homephone, $cellphone, $identity) {
        
            $this->checkLength($userName, 'UserName');
            $this->checkLength($password,'Password');
            $this->checkLength($confirmpasswd,'Password');
            
            $this->isValidEmail($userName, 'UserName');
        
            $this->matchPassword($password, $confirmpasswd);
            
            $this->isNotInDb($userName);
           
            $this->checkIdentity($identity);
            $error_msg = $this->getError();
            
            if(empty($error_msg)) {
               //put the data in the data base
              
              
                $saveStatus = $this->saveBuyer($userName, sha1($password), $firstname, $lastname, $address, $homephone, $cellphone, $identity);
                
                if($saveStatus) {
                    $this->_isSignedUp = true;
                    return "Register success, Congratulations! Please log in.";
                }
            } else {
                foreach($this->message as $e) {
                    return "<p>Errors:{$e}</p>";
                }
            }
    }
    
    function checkIdentity($identity) {
        if ($identity == 'seller' || $identity == 'buyer') {
            return true;
        }
        $this->addError("Please select your identity");
        return false;
    }
 
    function saveBuyer($userName, $password, $firstname, $lastname, $address, $homephone, $cellphone, $identity) {
       
        $buyerModel = new BuyerModel();
        return $buyerModel->saveBuyerInDB($userName, $password, $firstname, $lastname, $address, $homephone, $cellphone, $identity); 
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
    
    
    function redirectTo($location = null,$time) {
        header("refresh:" . $time . ";url=".$location);	
    }
    
    function isLoggedin() {
        return $this->_isLoggedIn;
    }
    
    function isSignedUp() {
        return $this->_isSignedUp;
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
    
   function getUserTable($dataInfo, $filename) {
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



    



