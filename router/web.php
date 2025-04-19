<?php
$role = isset($_GET['role']) ? $_GET['role'] : "user";
$act = isset($_GET['act']) ? $_GET['act'] : "";

if($role =="user"){
    switch ($act) {
        case '': {
            $dashboardController = new DashboardController();
            $dashboardController -> dashboard();
            break;
        }
        case 'login':{
            $loginController = new LoginUserController();
            $loginController -> login();
            break;
        }
        case 'post-login':{
            $loginController = new LoginUserController();
            $loginController->postlogin();
            break;
        }
        case 'logout':{
            $loginController = new LoginUserController();
            $loginController->logout();
            break;
        }
        case 'register':{
            $loginController = new LoginUserController();
            $loginController->register();
            break;
        }
        case 'post-register':{
            $loginController = new LoginUserController();
            $loginController->postRegister();
            break;
        }
        case 'my-account':{
            $dashBoardController = new DashBoardController();
            $dashBoardController->myAccount();
            break;
        }
        case 'account-detail':{
            $dashBoardController = new DashBoardController();
            $dashBoardController->accountDetail();
            break;
        }
        case 'update-account'; {
            $dashBoardController = new DashboardController();
            $dashBoardController->accountUpdate();
            break;
        }
        case 'shop': {
            $dashBoardController = new DashboardController();
            $dashBoardController->showShop();
            break;
        }
        case 'product-detail': {
            $dashBoardController = new DashboardController();
            $dashBoardController->productDetail();
            break;
        }
        case 'add-to-cart': {
            $dashBoardController = new DashboardController();
            $dashBoardController->addToCart();
            break;
        }
        case 'show-to-cart': {
            $dashBoardController = new DashboardController();
            $dashBoardController->showToCart();
            break;
        }
        case 'update-cart': {
            $dashBoardController = new DashboardController();
            $dashBoardController->updateToCart();
            break;
        }
        case 'shopping-cart': {
            $dashBoardController = new DashboardController();
            $dashBoardController->shoppingCart();
            break;
        }
        case 'check-out': {
            $dashBoardController = new DashboardController();
            $dashBoardController->checkout();
            break;
        }
        case 'submit-check-out': {
            $dashBoardController = new DashboardController();
            $dashBoardController->submitCheckout();
            break;
        }
        case 'show-order': {
            $dashBoardController = new DashboardController();
            $dashBoardController->showOrrder();
            break;
        }
        case 'show-order-detail': {
            $dashBoardController = new DashboardController();
            $dashBoardController->showOrderDetail();
            break;
        }
        case 'cancel-order': {
            $dashBoardController = new DashboardController();
            $dashBoardController->cancelOrder();
            break;
        }
    }
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
            $productController->showAllProduct();
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

// end Tu add product
        case 'all-category': {
            $categoryController = new CategoryController();
            $categoryController->getAllCategory();
            break;
        }
        case 'add-category':{
            $categoryController = new CategoryController();
            $categoryController->addCategory();
            break;
        }
        case 'post-add-category':{
            $categoryController = new CategoryController();
            $categoryController->addPostCategory();
            break;
        }
        case 'update-category': {
            $categoryController = new CategoryController();
            $categoryController->updateCategory();
            break;
        }
        case 'update-post-category': {
            $categoryController = new CategoryController();
            $categoryController->updatePostCategory();
            break;
        }
        case 'delete-category': {
            $categoryController = new CategoryController();
            $categoryController->deleteCategory();
            break;
        }

        case 'show-order': {
            $orderController = new OrderController();
            $orderController->showOrder();
            break;
        }
        case 'show-order-detail': {
            $orderController = new OrderController();
            $orderController->showOrderDetail();
            break;
        }
        case 'order-change-status': {
            $orderController = new OrderController();
            $orderController->changeStatus();
            break;
        }

  
        
        
     

        default:{
            $homeController = new HomeController();
            $homeController->dashboard();
            break;
        }
    }
}



