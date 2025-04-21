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
        $this->changePassword(); // xử lý đầy đủ mọi thứ và set $_SESSION['message']
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
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $image = $destPath;
        $now = date('Y-m-d H:i:s');
    
        $sql = "
            UPDATE users SET 
                name = :name,
                address = :address,
                phone = :phone,
                image = :image,
                updated_at = :updated_at
            WHERE id = :id
        ";
    
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':updated_at', $now);
        $stmt->bindParam(':id', $_SESSION['users']['id']);
    
        return $stmt->execute();
    }   
}
