<?php
class CartUserModel {
    public $db;
    function __contrust() {
        $this->db = new Database();
    }
}