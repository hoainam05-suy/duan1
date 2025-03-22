<?php
session_start();
//database
include 'app/Database/Database.php';
//Model
include 'app/Models/Admin/HomeModel.php';
//controller
include 'app/Controllers/Admin/HomeController.php';


const BASE_URL = "http://localhost/duan1/";
//router
include 'router/web.php';
// echo password_hash('123456', PASSWORD_BCRYPT);
?>