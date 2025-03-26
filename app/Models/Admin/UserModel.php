<?php

class UserModel{
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAllData()
    {
        $sql = "select * from users";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();
        return $result;
    }
}