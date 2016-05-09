<?php
class buyerEntity{
    //put your code here
    private $id,
            $firstname,
            $lastname,
            $email,
            $address,
            $home_phone,
            $cell_phone,
            $password,
            $identity;

    
    function __construct($id='', $firstname, $lastname, $email, $address='', $home_phone='', $cell_phone, $password,$identity='') {
        $this->id =$id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->address = $address;
        $this->home_phone = $home_phone;
        $this->cell_phone = $cell_phone;
        $this->password = $password;
    }
    
    function getIdentity() {
        return $this->identity;
    }

    function setIdentity($identity) {
        $this->identity = $identity;
    }
    
    function getId() {
        return $this->id;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getEmail() {
        return $this->email;
    }

    function getAddress() {
        return $this->address;
    }

    function getHome_phone() {
        return $this->home_phone;
    }

    function getCell_phone() {
        return $this->cell_phone;
    }

    function getPassword() {
        return $this->password;
    }
    function setId($id) {
        $this->id = $id;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setHome_phone($home_phone) {
        $this->home_phone = $home_phone;
    }

    function setCell_phone($cell_phone) {
        $this->cell_phone = $cell_phone;
    }

    function setPassword($password) {
        $this->password = $password;
    }
}
