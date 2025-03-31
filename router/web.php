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
            $loginController = new LoginController();
            $loginController->login();
            break;
        }
             // http://localhost/duan1/?role=admin&act=post-login
        case 'post-login':{
            $loginController = new LoginController();
            $loginController->postlogin();
            break;
        }
        case 'logout':{
            $loginController = new LoginController();
            $loginController->logout();
            break;
        }
        case 'all-user': {
            $userController = new UserController();
            $userController->getAllUser();
            break;
        }
        case 'add-user':{
            $userController = new UserController();
            $userController->addUser();
            break;
        }
        case 'post-add-user':{
            $userController = new UserController();
            $userController->addPostUser();
            break;
        }
        case 'update-user': {
            $userController = new UserController();
            $userController->updateUser();
            break;
        }
        case 'update-post-user': {
            $userController = new UserController();
            $userController->updatePostUser();
            break;
        }
        case 'show-user': {
            $userController = new UserController();
            $userController->showUser();
            break;
        }
        case 'delete-user': {
            $userController = new UserController();
            $userController->deleteUser();
            break;
        }



/* tú add product  
tạo ProductController.php
*/
        case 'all-product': {
            $productController = new ProductController();
            $productController->getAllProduct();
            break;
        }
        case 'add-product':{
            $productController = new ProductController();
            $productController->addProduct();
            break;
        }

        case 'post-add-product':{
            $productController = new ProductController();
            $productController->addPostProduct();
            break;
        }
        case 'update-product': {
            $productController = new ProductController();
            $productController->updateProduct();
            break;
        }
        case 'update-post-product': {
            $productController = new ProductController();
            $productController->updatePostProduct();
            break;
        }
        case 'delete-product': {
            $productController = new ProductController();
            $productController->deleteProduct();
            break;
        }




        default:{
            $homeController = new HomeController();
            $homeController->dashboard();
            break;
        }
    }
}



