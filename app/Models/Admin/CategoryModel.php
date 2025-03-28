<?php
    class CategoryModel {
        public $db;
        public function __construct()
        {
            $this->db = new Database();
        }

        public function getAllData() {
            $sql = "select * from categories";
            $query = $this->db->pdo->query($sql);
            $result = $query->fetchAll();
            return $result;
        }

       
        public function addCategorytoDB($destPath) {
            $name = $_POST['name'];
            $category_id =  $_POST['category_id'];
            $now = date('Y-m-d H:i:s');


            $sql = "INSERT INTO categories (name, category_id, created_at, updated_at) 
            VALUES (:name, :category_id, :created_at, :updated_at)";

            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':created_at', $now);
            $stmt->bindParam(':updated_at', $now);

            return $stmt->execute();
        }

        public function getCategoryById() {
            $id = $_GET['id'];
            $sql = "SELECT * FROM categories WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
        
            if ($stmt->execute()) {
                return $stmt->fetch();
            }
            return false;
        }
        

       
        public function updateCategorytoDB() {
            // Lấy thông tin sanr phẩm hiện tại từ DB
            $category = $this->getCategoryByID($_GET['id']);
            if (!$category) {
                return false;
            }
            $id = $_GET['id'];
            
            $name = isset($_POST['name']) && $_POST['name'] !== '' ? $_POST['name'] : $category->name;
            $now = date('Y-m-d H:i:s');
           
            // Câu truy vấn cập nhật
            $sql = "
                UPDATE categories SET 
                    name = :name,
                    id = :id,
                    updated_at = :updated_at
                WHERE id = :id
            ";
        
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':updated_at', $now);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }
        
        public function deleteCategoryById($id) {
            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
        
            return $stmt->execute();
        }

        public function getCategories() {
            try {
                $sql = "SELECT id, name FROM categories";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo "<p style='color: red;'>Lỗi SQL: " . $e->getMessage() . "</p>";
                return [];
            }
        }

    }
?>