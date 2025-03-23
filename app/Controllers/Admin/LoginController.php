<?php
    class LoginController{
        public function login() {
            include 'app/Views/Admin/login.php';
        }
        
        public function postlogin() {
            // $_POST['email'];
            // $_POST['password'];
            $homeModel = new HomeModel();
            $dataUsers = $homeModel->checkLogin();
            if ($dataUsers) {
                $_SESSION['users'] = [
                    'id' => $dataUsers->id,
                    'name' => $dataUsers->name,
                    'email' => $dataUsers->email,
                ];
                header("location: ".BASE_URL."?role=admin&act=home" );
                exit;
            }else{
    
            $_SESSION['error'] = 'Email hoac Password khong dung';
            header("location: ".BASE_URL."?role=admin&act=login" );
            exit;
            }
        }

        public function logout() {
            if (isset($_SESSION['users'])){
                unset($_SESSION['users']);
            }
            $_SESSION['error'] = 'Đăng xuất thành công';
            header("location: ".BASE_URL."?role=admin&act=login" );
            exit;
        }
    }
?>