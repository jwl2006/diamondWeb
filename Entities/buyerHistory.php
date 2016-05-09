<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class buyerHistory {
    
    private $productid,
            $quantity,
            $time,
            $buyer,
            $seller;
    
    function __construct($productid, $quantity, $time, $buyer, $seller) {
        $this->productid = $productid;
        $this->quantity = $quantity;
        $this->time = $time;
        $this->buyer = $buyer;
        $this->seller = $seller;
    }
    
    function getProductid() {
        return $this->productid;
    }
    
    function getQuantity() {
        return $this->quantity;
    }
    
    function getTime() {
        return $this->time;
    }
    
    function getBuyer() {
        return $this->buyer;
    }
    
    function getSeller() {
        return $this->seller;
    }
    
    function setProductid($productid) {
        $this->productid = $productid;
    }
    
    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
    
    function setTime($time) {
        $this->time = $time;
    }
    
    function setBuyer($buyer) {
        $this->buyer = $buyer;
    }
    
    function setSeller($seller) {
        $this->seller = $seller;
    }
   
            
    
    
    
    
    
    
    
    
    
    
    
}
