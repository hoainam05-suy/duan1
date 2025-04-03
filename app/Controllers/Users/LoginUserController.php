<?php
class LoginUserController{
    public function login(){
        include 'app/Views/Users/login.php';
    }
    public function postlogin(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $loginModel = new LoginModel();
            $dataUsers = $loginModel->checkLogin();
            if ($dataUsers) {
                $_SESSION['users'] = [
                    'id' => $dataUsers->id,
                    'name' => $dataUsers->name,
                    'email' => $dataUsers->email,
                ];
                header("location: ".BASE_URL );
                exit;
            }else{

            $_SESSION['error'] = 'Email hoac Password khong dung';
            header("location: ".BASE_URL."?act=login" );
            exit;
            }
        }
    }
    public function logout() {
        if (isset($_SESSION['users'])) {
            unset($_SESSION['users']);
        }
        header("location: ".BASE_URL."?act=login" );
        exit;
    }
    public function register() {
        include 'app/Views/Users/register.php';
    }
    public function postRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $loginModel = new LoginModel();
            $message = $loginModel->addUsertoDB();

            if ($message) {
                $_SESSION['message'] = 'Đăng ký thành công';
                header("location: ".BASE_URL."?act=login" );
                exit;
            }else{
                $_SESSION['error'] = 'Đăng ký không thành công';
                header("location: ".BASE_URL."?act=register" );
                exit;
            }
        }    
    }
}
    
