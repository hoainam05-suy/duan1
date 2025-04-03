<?php
class DashboardController{
    public function dashboard(){
        $categoryModel = new CategoryUserModel();
        $listCategory = $categoryModel->getCategoryDashboard();

        $productModel = new ProductUserModel();
        $listCategory = $productModel->getProductDashboard();
        include 'app/Views/Users/index.php';
    }
}