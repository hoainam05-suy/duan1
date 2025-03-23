<?php
class HomeController{
    public function dashboard(){
        $homeModel = new HomeModel();
        $dataUsers = $homeModel->__getUsers();
        include 'app/Views/Admin/index.php';
    }

    public function login(){
        include 'app/Views/Admin/login.php';
    }

    public function postlogin(){
        // $_POST['name'];
        // $_POST['password'];
        $homeModel = new HomeModel();
        $dataUsers = $homeModel->checkLogin();
        // var_dump($dataUsers);
        if($dataUsers){
            header("Location:" . BASE_URL . "?role=admin&act=home");
            exit;
        }else{
            header("Location:" . BASE_URL . "?role=admin&act=login");
            exit;
        }

    }
}