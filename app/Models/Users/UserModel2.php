<?php

class UserModel2{
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getCurrentUser(){
        if (isset($_SESSION['users'])){
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $_SESSION['users']['id']);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }else {
            return false;
        }
    }

    public function accountUpdate(){

    }

    public function changePassword(){
        if(isset($_SESSION['users'])){
            $user = $this->getCurrentUser();
            if(password_verify($_POST['current-password'], $user->password)){
            $hash =  password_hash(trim($_POST['new-password']), PASSWORD_BCRYPT);
            $sql = "UPDATE `users` SET `password`= :password WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':password', $hash);
            $stmt->bindParam(':id', $_SESSION['users']['id']);
            return $stmt->execute();
            }
        }else{
            return false;
        }
    }

    public function updateCurrentUser($destPath) {
        // Lấy thông tin từ POST
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $image = $destPath; // Sử dụng ảnh mới nếu có
        $now = date('Y-m-d H:i:s');
    
        // Câu truy vấn SQL đúng cú pháp
        $sql = "
            UPDATE users SET 
                name = :name,
                email = :email,
                address = :address,
                phone = :phone,
                image = :image,
                updated_at = :updated_at
            WHERE id = :id
        ";
    
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':updated_at', $now);
        $stmt->bindParam(':id', $_SESSION['users']['id']);
    
        return $stmt->execute();
    }
}