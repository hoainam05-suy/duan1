<?php
class HomeController extends ControllerAdmin {
    public function dashboard() {
        $productModel = new ProductModel();
        $userModel = new UserModel();
        $orderModel = new OrderModel();

        $totalProducts = $productModel->countAll();
        $totalUsers = $userModel->countAll();
        $totalOrders = $orderModel->countAll();

        // Chỉ cần include layout chính
        include 'app/Views/Admin/index.php';
    }
}


