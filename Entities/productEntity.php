<?php
class productEntity {
 private   $id,
            $name,
            $price,
            $weight,
            $category,
            $seller,
            $introduction;
 
   function __construct($id='',$name, $price, $weight, $category, $seller, $introduction='') {
       
        $this->name = $name;
        $this->price =  $price;
        $this->weight = $weight;
        $this->category = $category;
        $this->seller = $seller;
        $this->introduction = $introduction;
        $this->id = $id;
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }
    
    function getPrice() {
        return $this->price;
    }
    function getWeight() {
        return $this->weight;
    }
    function getCategory() {
        return $this->category;
    }
    
    function getSeller() {
        return $this->seller;
    }
    
    function getIntroduction() {
        return $this->introduction;
    }
    
    function setID($id) {
         $this->id = $id;
    }
    
    function setName($name) {
        $this->name = $name;
    }
    
    function setPrice($price) {
        $this->price = $price;
    }
    
    function setWeight($weight) {
        $this->weight = $weight;
    }
    
    function setCategory($category) {
        $this->category = $category;
    }
    
    function setSeller($seller) {
        $this->seller = $seller;
    }
    
    function setIntroduction($introduction) {
        $this->introduction = $introduction;
    }
    
}


