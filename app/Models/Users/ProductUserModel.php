<?php
class ProductUserModel {
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getProductDashboard() {
        $sql = "select * from products order by RAND() limit 8";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();
        return $result;
    }
}
