<?php
class UserController{
public function getAllUser() {
    $userModel = new UserModel();
    $listUser = $userModel->getAllData();

    include 'app/Views/Admin/user.php';
}
}