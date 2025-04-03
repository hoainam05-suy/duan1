<?php
class DashboardController{
    public function dashboard(){
        $categoryModel = new CategoryUserModel();
        $listCategory = $categoryModel->getCategoryDashboard();

        $productModel = new ProductUserModel();   
        $listProduct = $productModel-> getProductDashboard();

        include 'app/Views/Users/index.php';

    }
    public function myAccount()
    {
        $userModel = new UserModel();
        $user = $userModel->getUserById();

        include 'app/Views/Users/myAccount.php';
    }
    
}
