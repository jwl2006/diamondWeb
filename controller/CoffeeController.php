<?php
require 'Model/BuyerModel.php';
class CoffeeController
{       
   function SellerTable($filename)
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
    
    
    function CreateBuyerTable($username)
    {
        $buyerModel = new BuyerModel();
        $buyer= $buyerModel->GetBuyerByName($username);
        $result = "";
        
        //Generate a coffeeTable for each coffeeEntity in array
        $result .= 
              "<table class = 'pure-table'>            
                        <tr>
                            <th>First Name: </th>
                            <td>$buyer->firstname</td>
                        </tr>
                        
                        <tr>
                            <th>Last Name: </th>
                            <td>$buyer->lastname</td>
                        </tr>
                        
                        <tr>
                            <th>Email: </th>
                            <td>$buyer->email</td>
                        </tr>
                        
                        <tr>
                            <th>Address: </th>
                            <td>$buyer->address</td>
                        </tr>
                        
                        <tr>
                            <th>Home Phone: </th>
                            <td>$buyer->home_phone</td>
                        </tr>
                        
                        <tr>
                            <th>Cell Phone: </th>
                            <td>$buyer->cell_phone</td>
                        </tr>        
                </table>"; 
         return $result;
        }        
     
}
?>
