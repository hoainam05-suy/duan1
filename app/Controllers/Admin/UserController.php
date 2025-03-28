<?php
class UserController{
    public function getAllUser() {
        $userModel = new UserModel();
        $listUser = $userModel->getAllData();

        include 'app/Views/Admin/user.php';
    }

    public function addUser() {
        include 'app/Views/Admin/add-user.php';
    }

    public function checkValidate() {
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $address = $_POST['address'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $role = $_POST['role'] ?? null;

        if($name != "" && $email != "" && $address != "" && $phone != "" && $role != "") {
            return true;
        } else {
            $_SESSION['error'] = "Bạn nhập thiếu thông tin";
            return false;
        }
    }

    public function addPostUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!$this->checkValidate()) {
                header("location: " . BASE_URL . "?role=admin&act=add-user");
                exit;
            }
            // them anh
            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = "";
            if (!empty($_FILES['image']['name'])) {
                $fileTmPath = $_FILES['image']['tmp_name'];
                $fileType = mime_content_type($fileTmPath);
                $fileName = basename($_FILES['image']['name']);
                $fileExtention = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $newFileName = uniqid() . '.' . $fileExtention;


                if (in_array($fileType, $allowedTypes)){
                    $destPath = $uploadDir . $newFileName;
                    if(!move_uploaded_file($fileTmPath, $destPath)) {
                        $destPath = "";
                    }
                    
                }
            }
            

            $userModel = new UserModel();
            $message = $userModel->addUsertoDB($destPath);

            if ($message) {
                $_SESSION['message'] = "Them moi thanh cong";
                    header("location: " . BASE_URL . "?role=admin&act=all-user" );
                    exit;
            }else {
                $_SESSION['message'] = "Them moi khong thanh cong";
                header("location: " . BASE_URL . "?role=admin&act=add-user" );
                exit;
            }
        }
    }

    public function updateUser() {
        if(!isset($_GET['id'])){
            $_SESSION['message'] = "Vui long chon user can sua";
            header("location: " . BASE_URL . "?role=admin&act=all-user" );
            exit;
        }
        $userModel = new UserModel();
        $user = $userModel->getUserByID();
        if(!$user) {
            $_SESSION['message'] = "Khong tim thay du lieu";
            header("location: " . BASE_URL . "?role=admin&act=all-user" );
            exit;
        }
        include 'app/Views/Admin/update-user.php';
    }

    public function updatePostUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!isset($_GET['id'])){
                $_SESSION['message'] = "Vui lòng chọn user cần sửa";
                header("location: " . BASE_URL . "?role=admin&act=all-user" );
                exit;
            }
            
            $userModel = new UserModel();
            $user = $userModel->getUserByID($_GET['id']);
            
            if (!$user) {
                $_SESSION['message'] = "Không tìm thấy người dùng";
                header("location: " . BASE_URL . "?role=admin&act=all-user" );
                exit;
            }
            
            // Xử lý ảnh
            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = $user->image; // Giữ ảnh cũ nếu không có ảnh mới
            if (!empty($_FILES['image']['name'])) {
                $fileTmPath = $_FILES['image']['tmp_name'];
                $fileType = mime_content_type($fileTmPath);
                $fileName = basename($_FILES['image']['name']);
                $fileExtention = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
                $newFileName = uniqid() . '.' . $fileExtention;
    
                if (in_array($fileType, $allowedTypes)){
                    $destPath = $uploadDir . $newFileName;
                    if(move_uploaded_file($fileTmPath, $destPath)) {
                        // Xóa ảnh cũ nếu upload thành công
                        if($user->image && file_exists($user->image)) {
                            unlink($user->image);
                        }
                    } else {
                        $destPath = $user->image; // Giữ lại ảnh cũ nếu upload thất bại
                    }
                }
            }
            
            $message = $userModel->updateUsertoDB($destPath);
    
            if ($message) {
                $_SESSION['message'] = "Chỉnh sửa thành công";
                header("location: " . BASE_URL . "?role=admin&act=all-user" );
            } else {
                $_SESSION['message'] = "Chỉnh sửa không thành công";
                header("location: " . BASE_URL . "?role=admin&act=update-user&id=" . $_GET['id'] );
            }
            exit;
        }
    }
    public function showUser() {
        if(!isset($_GET['id']) || empty($_GET['id'])){
            $_SESSION['message'] = "Vui long chon user can xoa";
            header("location: " . BASE_URL . "?role=admin&act=all-user" );
            exit;
        }
        $userModel = new UserModel();
        $user = $userModel->getUserById();

        include 'app/Views/Admin/show-user.php';
    }
    
    
    public function deleteUser() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn user cần xóa";
            header("location: " . BASE_URL . "?role=admin&act=all-user");
            exit;
        }
    
        $id = $_GET['id'];
        $userModel = new UserModel();
        $user = $userModel->getUserById();
    
        if (!$user) {
            $_SESSION['message'] = "Không tìm thấy người dùng";
            header("location: " . BASE_URL . "?role=admin&act=all-user");
            exit;
        }
    
        // Xóa ảnh nếu tồn tại
        if (!empty($user->image) && file_exists($user->image)) {
            unlink($user->image);
        }
    
        $isDeleted = $userModel->deleteUserById($id);
    
        if ($isDeleted) {
            $_SESSION['message'] = "Xóa người dùng thành công";
            header("location: " . BASE_URL . "?role=admin&act=all-user");
            exit;
        } else {
            $_SESSION['message'] = "Xóa người dùng không thành công";
            header("location: " . BASE_URL . "?role=admin&act=all-user");
            exit;
        }
    }
}