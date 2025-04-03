<?php
class CategoryUserModel{
    public $db;
        public function __construct()
        {
            $this->db = new Database();
        }
        public function getCategoryDashboard(){
            $sql = "select * from categories";
            return $this->db->pdo->query($sql);
            $result = $query->fetchAll();
            return $result;
        }
}