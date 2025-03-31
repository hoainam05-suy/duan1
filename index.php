<?php
session_start();
//database
include 'app/Database/Database.php';
//Model
include 'app/Models/Admin/HomeModel.php';
include 'app/Models/Admin/UserModel.php';
include 'app/Models/Admin/ProductModel.php';
include 'app/Models/Admin/CategoryModel.php';
include 'app/Models/User/CartUserModel.php';
//controller
include 'app/Controllers/Admin/ControllerAdmin.php';
include 'app/Controllers/Admin/HomeController.php';
include 'app/Controllers/Admin/LoginController.php';
include 'app/Controllers/Admin/UserController.php';
include 'app/Controllers/Admin/ProductController.php';
include 'app/Controllers/Admin/CategoryController.php';
include 'app/Controllers/User/CartUserController.php';



const BASE_URL = "http://localhost/duan1/";
//router
include 'router/web.php';
// echo password_hash('123456', PASSWORD_BCRYPT);
?>