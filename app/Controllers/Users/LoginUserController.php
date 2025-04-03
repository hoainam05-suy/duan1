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
                    header("location: ".BASE_URL);
                    exit;
                }else{
        
                $_SESSION['message'] = 'Email hoac Password khong dung';
                header("location: ".BASE_URL."?act=login");
                exit;
                }
        }
    }
}