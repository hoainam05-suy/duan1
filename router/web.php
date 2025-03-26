<?php
$role = isset($_GET['role']) ? $_GET['role'] : "user";
$act = isset($_GET['act']) ? $_GET['act'] : "";

if($role =="user"){
    echo"trang user";
}else{
    switch($act){
        // http://localhost/duan1/?role=admin&act=home
        case 'home':{
            $homeController = new HomeController();
            $homeController->dashboard();
            break;
        }
              // http://localhost/duan1/?role=admin&act=login
        case 'login':{
            $homeController = new LoginController();
            $homeController->login();
            break;
        }
             // http://localhost/duan1/?role=admin&act=post-login
        case 'post-login':{
            $homeController = new LoginController();
            $homeController->postlogin();
            break;
        }
        case 'logout':{
            $homeController = new LoginController();
            $homeController->logout();
            break;
        }
        case 'all-user': {
            $userController = new UserController();
            $userController->getAllUser();
            break;
        }
        case 'product':{
    
        }
        default:{
            $homeController = new HomeController();
            $homeController->dashboard();
            break;
        }
    }
}



