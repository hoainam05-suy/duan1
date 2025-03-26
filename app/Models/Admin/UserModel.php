<?php
    class UserModel {
        public $db;
        public function __construct()
        {
            $this->db = new Database();
        }

        public function getAllData() {
            $sql = "select * from users";
            $query = $this->db->pdo->query($sql);
            $result = $query->fetchAll();
            return $result;
        }

       
        public function addUsertoDB($destPath) {
            $name = $_POST ['name'];
            $email = $_POST['email'];
            $password = $_POST['password'] !== "" ?  password_hash($_POST['password'], PASSWORD_BCRYPT) : password_hash($_POST['email'], PASSWORD_BCRYPT);
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $role = $_POST['role'];
            $image = "$destPath";
            $now = date('Y-m-d H:i:s');


            $sql = "INSERT INTO users (name, email, password, address, phone, image, created_at, updated_at, role) 
            VALUES (:name, :email, :password, :address, :phone, :image, :created_at, :updated_at, :role)";

            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':created_at', $now);
            $stmt->bindParam(':updated_at', $now);
            $stmt->bindParam(':role', $role);

            return $stmt->execute();
        }

        public function getUserById() {
            $id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
        
            if ($stmt->execute()) {
                return $stmt->fetch();
            }
            return false;
        }

        // public function updateUsertoDB($destPath) {
        //     // Lấy thông tin người dùng hiện tại từ DB
        //     $user = $this->getUserByID();
        //     if (!$user) {
        //         return false;
        //     }
        //     $id = $_GET['id'];
        //     // Giữ nguyên giá trị cũ nếu không có giá trị mới từ biểu mẫu
        //     // $name = !empty($_POST['name']) ? $_POST['name'] : $user->name;
        //     // $email = !empty($_POST['email']) ? $_POST['email'] : $user->email;
        //     // $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $user->password;
        //     // $address = !empty($_POST['address']) ? $_POST['address'] : $user->address;
        //     // $phone = !empty($_POST['phone']) ? $_POST['phone'] : $user->phone;
        //     // $role = !empty($_POST['role']) ? $_POST['role'] : $user->role;
        //     // $image = !empty($destPath) ? $destPath : $user->image; // Giữ ảnh cũ nếu không cập nhật ảnh mới
        //     // $now = date('Y-m-d H:i:s');
        //     $name = isset($_POST['name']) && $_POST['name'] !== '' ? $_POST['name'] : $user->name;
        //     $email = isset($_POST['email']) && $_POST['email'] !== '' ? $_POST['email'] : $user->email;
        //     $password = isset($_POST['password']) && $_POST['password'] !== '' ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $user->password;
        //     $address = isset($_POST['address']) && $_POST['address'] !== '' ? $_POST['address'] : $user->address;
        //     $phone = isset($_POST['phone']) && $_POST['phone'] !== '' ? $_POST['phone'] : $user->phone;
        //     $role = isset($_POST['role']) && $_POST['role'] !== '' ? $_POST['role'] : $user->role;
        //     $image = $destPath ?: $user->image; // Sử dụng ảnh mới nếu có, ngược lại giữ ảnh cũ
        //     $now = date('Y-m-d H:i:s');
        
            
        //     // Câu truy vấn cập nhật
        //     $sql = "
        //         UPDATE users SET 
        //             name = :name,
        //             email = :email,
        //             password = :password,
        //             address = :address,
        //             phone = :phone,
        //             image = :image,
        //             updated_at = :updated_at,
        //             role = :role 
        //         WHERE id = :id
        //     ";
        
        //     $stmt = $this->db->pdo->prepare($sql);
        //     $stmt->bindParam(':name', $name);
        //     $stmt->bindParam(':email', $email);
        //     $stmt->bindParam(':password', $password);
        //     $stmt->bindParam(':address', $address);
        //     $stmt->bindParam(':phone', $phone);
        //     $stmt->bindParam(':image', $image);
        //     $stmt->bindParam(':updated_at', $now);
        //     $stmt->bindParam(':role', $role);
        //     $stmt->bindParam(':id', $id);
        
        //     return $stmt->execute();
        // }

        public function updateUsertoDB($destPath) {
            // Lấy thông tin người dùng hiện tại từ DB
            $user = $this->getUserByID($_GET['id']);
            if (!$user) {
                return false;
            }
            $id = $_GET['id'];
            
            // Chỉ cập nhật các trường có dữ liệu mới
            $name = isset($_POST['name']) && $_POST['name'] !== '' ? $_POST['name'] : $user->name;
            $email = isset($_POST['email']) && $_POST['email'] !== '' ? $_POST['email'] : $user->email;
            $address = isset($_POST['address']) && $_POST['address'] !== '' ? $_POST['address'] : $user->address;
            $phone = isset($_POST['phone']) && $_POST['phone'] !== '' ? $_POST['phone'] : $user->phone;
            $role = isset($_POST['role']) && $_POST['role'] !== '' ? $_POST['role'] : $user->role;
            $image = $destPath ?: $user->image; // Sử dụng ảnh mới nếu có, ngược lại giữ ảnh cũ
            $now = date('Y-m-d H:i:s');
        
            // Xử lý mật khẩu
            $password = $user->password; // Giữ nguyên mật khẩu cũ
            if (isset($_POST['password']) && $_POST['password'] !== '') {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            }
        
            // Câu truy vấn cập nhật
            $sql = "
                UPDATE users SET 
                    name = :name,
                    email = :email,
                    password = :password,
                    address = :address,
                    phone = :phone,
                    image = :image,
                    updated_at = :updated_at,
                    role = :role 
                WHERE id = :id
            ";
        
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':updated_at', $now);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':id', $id);
        
            return $stmt->execute();
        }
        
        public function deleteUserById($id) {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
        
            return $stmt->execute();
        }
    }
?>