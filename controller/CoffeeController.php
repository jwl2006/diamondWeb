<?php
require 'Model/BuyerModel.php';


class CoffeeController
{      
   function SellerTable()
    {
        $data = $this->readCSV($filename);
        $result = "";
        
        for($i=1; $i < count($data); ++$i) 
        {
            $image = $data[$i][0];
            $name = $data[$i][1];   
            $product = $data[$i][2];
            $certified = $data[$i][3];
            $contact = $data[$i][4];
            $country = $data[$i][5];
            $review = $data[$i][7];
            $validname = 'N/A';
            $validproduct = 'N/A';
            if($this->checkUserName($name)) {
                $validname = $name;
            } 
            
            if($this->checkProductName($product)) {
                $validproduct = $product;
            }
                $result .= "<table class = 'coffeeTable'";  
                $result .= "   <tr>
                                  <th rowspan='6' width='150px'><img runat='server' src = '$image' /></th>
                                  <th width = '75px'>Name:</th> 

                                  <td> $validname </td>
                              </tr>

                              <tr>
                                  <th>Products: </th> 
                                  <td>$validproduct</td>
                              </tr>

                              <tr>
                                  <th>Certified: </th> 
                                  <td>$certified</td>
                              </tr>

                              <tr>
                                  <th>Contact: </th> 
                                  <td>$contact</td>
                              </tr>

                              <tr>
                                  <th>Country: </th> 
                                  <td>$country</td>
                              </tr>
                              <tr>
                                  <td colspan='2' >$review</td> 
                              </tr>
                              "; 
                 $result .= '</table>';
        }
        return $result;
    }
   
    function findOrderHistory($buyer) {
        $buyermodel = new BuyerModel();
        $historyList = $buyermodel->findBuyerHistory($buyer);
        
        
        $result ="<table class = 'pure-table pure-table-horizontal'  >
                  <caption>Order History</caption>
                        <thead>    
                            <tr>
                                <th>Product Name</td>
                                <th>Quantity </td>
                                <th>Time </td>
                                <th>Seller </td>
                            </tr>
                        <thead>
                        <tbody>";
         foreach($historyList as $history) {
              $result .= $this-> buildHistoryTable($history);
        }
        $result .= "</tbody>";
        $result .= "</table>";
        return $result;      
    }
    
        
    function buildHistoryTable ($history) {
               
                $historyinfo = '';
                if(!empty($history)) {
                     
                    $name = $history->getProductid();
                    $quantity= $history->getQuantity();
                    $time = $history->getTime();
                    $seller = $history->getSeller();
                    
                   
                 
                    $historyinfo  .= "<tr>
                                        <td>$name</td>
                                        <td>$quantity</td>
                                        <td>$time</td>
                                        <td>$seller</td>";
                                      
                    $historyinfo  .= "</tr>";                
            }
        
        return $historyinfo ;
    }
    
    
    function showSellerInventory($seller='') {
        $buyermodel = new BuyerModel();
        $productList = $buyermodel->findSellerInventory($seller); 
    
    
        $result ="
            <table id='sellerInventory' class = 'pure-table pure-table-horizontal'  >
                        <thead>    
                            <tr>
                                <th>Product Name</td>
                                <th>Price </td>
                                <th>Weight </td>
                                <th>Category </td>
                                <th >Seller</td>
                                <th>Introduction </td>";
                                
        if(empty($seller)) {
            $result .= "<th>Buy </td>";
        }
        $result .= "</tr> </thead>";
        $result .= "<tbody>";
        foreach($productList as $product) {
           $result .= $this->buildProductList($product, $seller);
        }
        $result .= "</tbody>";
        $result .= "</table>";
        $result .= "</form>";
       
        return $result;
        
                
    }
    
    function buildProductList ($product, $isSellerFlag) {
               
                $productinfo = '';
                if(!empty($product)) {
                     
                    $name = $product->getName();
                    $price = $product->getPrice();
                    $weight = $product->getWeight();
                    $category = $product->getCategory();
                    $seller = $product->getSeller();
                    $introduction = $product->getIntroduction();
                    $productID = $product->getId();
                 
                    $productinfo .= "<tr>
                                        <td>$name</td>
                                        <td>$price</td>
                                        <td>$weight</td>
                                        <td>$category</td>
                                        <td>$seller</td>
                                        <td>$introduction</td>
                                        <td style='display:none;'>$productID</td>";
                                       
                    if(empty($isSellerFlag)) {   
                            
                             $productinfo .= " <td><button id='orderButton' class='pure-button pure-button-primary'>Order Now</button></td>";
                    }
                    $productinfo .= "</tr>";
                                
            }
        
        return $productinfo;
    }
 
   
     public function checkUserName($userName) {    
        if(preg_match("/^[^0-9][a-z A-Z0-9]{1,15}$/", $userName)) {
                return true;
            }
        return false;
    }
    
    public function checkProductName($productName) {
        if(preg_match("/^[^0-9][^\~\!\@\#\$\%\^\&\*\(\)\`\"]{1,16}$/", $productName)) {
            return true;
        }
        return false;
    }
    
    function regCheckUserName($name) {
        $feedback = '';
        if(isset($name) && trim($name) != '') {
            if($this->checkUserName($name)) {
                 $feedback = "<b>$name</b> is Valid!";
            } else {
                $feedback = " Not valid";
            }
        return $feedback;
        }
    }


    
    function regCheckProductName($name) {
        $feedback = '';
        if(isset($name) && trim($name) != '') {
            if($this->checkProductName($name)) {
                 $feedback = "<b>$name</b> is Valid!";
            } else {
                $feedback = " Not valid";
            }
        return $feedback;
        }
    }
    
    function readCSV($filename)
    {
        $file = fopen($filename,'r');
        while(!feof($file)) 
        {
            $line[] = fgetcsv($file);
        }
        fclose($file);
        return $line;
    }
    
    function showAllUsers($identity) {
       
        $buyerModel = new BuyerModel();
        $buyers = $buyerModel->getUserByIdentity($identity);
        $buyerTable = "";
        $buyerTable .= "<table class = 'pure-table pure-table-horizontal'  >
                        <thead>    
                            <tr>
                                <th>First Name</td>
                                <th>Last Name</td>
                                <th>Email</td>
                                <th>Address</td>
                                <th>Home Phone</td>
                                <th>Cell Phone </td>
                            </tr>    
                        </thead>        ";
        foreach($buyers as $buyer) {
            $buyerTable .= $this->buildBuyerTable($buyer);
        }
         $buyerTable .="</table>";
        return $buyerTable;
    }
    
    function CreateBuyerTable($username) {
        $buyerModel = new BuyerModel();
        $buyer= $buyerModel->GetBuyerByName($username);
        
        $result = "<table class = 'pure-table pure-table-horizontal'  >
                        <thead>    
                            <tr>
                                <th>First Name</td>
                                <th>Last Name</td>
                                <th>Email</td>
                                <th>Address</td>
                                <th>Home Phone</td>
                                <th>Cell Phone </td>
                            </tr>    
                        </thead>        ";
        $result .= $this->buildBuyerTable($buyer);
        $result .= "</table>";
        return $result;
    }
    
    function buildBuyerTable($buyer)
    {
        $result = "";        
        $firstname = $buyer->getFirstname();
        $lastname = $buyer->getLastname();
        $email = $buyer->getEmail();
        $address = $buyer->getAddress();
        $homephone = $buyer->getHome_phone();
        $cellphone = $buyer->getCell_phone();
             
        //Generate a coffeeTable for each coffeeEntity in array
        if ($buyer != NULL) {
        $result .= 
                        "<tr>   
                            <td>$firstname</td>
                            <td>$lastname</td>
                            <td>$email</td>
                            <td>$address</td>
                            <td>$homephone</td>
                            <td>$cellphone</td>
                        </tr>";        
        }
         return $result;
        }        
     
}
?>
