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
        include 'app/Views/Users/myAccount.php';
    }
    
    public function accountDetail(){
        $userModel = new UserModel2();
        $user = $userModel->getCurrentUser();
        include 'app/Views/Users/account-detail.php';
    }

    public function accountUpdate(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->changePassword();

            $userModel = new UserModel2();
            $user = $userModel->getCurrentUser();
            
            if (!$user) {
                $_SESSION['message'] = "Không tìm thấy người dùng";
                header("location: " . BASE_URL . "?role=admin&act=all-user" );
                exit;
            }
            
            // Xử lý ảnh
            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = $user->image; // Giữ ảnh cũ nếu không có ảnh mới

            if (!empty($_FILES['image']['name'])) {
                $fileTmPath = $_FILES['image']['tmp_name'];
                $fileType = mime_content_type($fileTmPath);
                $fileName = basename($_FILES['image']['name']);
                $fileExtention = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
                $newFileName = uniqid() . '.' . $fileExtention;
    
                if (in_array($fileType, $allowedTypes)){
                    $destPath = $uploadDir . $newFileName;
                    if(move_uploaded_file($fileTmPath, $destPath)) {
                        // Xóa ảnh cũ nếu upload thành công
                        if($user->image && file_exists($user->image)) {
                            unlink($user->image);
                        }
                    } else {
                        $destPath = $user->image; // Giữ lại ảnh cũ nếu upload thất bại
                    }
                }
            }
            $userModel = new UserModel2();
            $message = $userModel->updateCurrentUser($destPath);
    
            if ($message) {
                $_SESSION['message'] = "Chỉnh sửa thành công";
                header("location: " . BASE_URL . "?act=account-detail" );
            } else {
                $_SESSION['message'] = "Chỉnh sửa không thành công";
                header("location: " . BASE_URL . "?act=account-detail" );
               exit;
            }
        }
    }
    public function changePassword(){
        if($_POST['current-password'] != "" && $_POST['new-password'] != "" && $_POST['confirm-password'] != "" && $_POST['new-password'] == $_POST['confirm-password']){
            $userModel = new UserModel2();
            $userModel->changePassword();
        }
    }
    public function showShop(){
        $productModel = new ProductUserModel();
        $listProduct = $productModel->getDataShop();
        $categoryModel = new CategoryUserModel();
        if (isset($_GET['category_id'])){
            $category =  $categoryModel->getCategoryById($_GET['category_id']);
        }
        $listCategory = $categoryModel->getCategoryDashboard();
        $stock = $productModel->getProductStock();
        if(isset($_GET['instock'])){
            $listProduct = array_filter($listProduct,function($product){
                return $product->stock > 0;
            });
        }
        if(isset($_GET['outstock'])){
            $listProduct = array_filter($listProduct,function($product){
                return $product->stock == 0;
            });  
        }
        if(isset($_GET['min'])){
            $listProduct = array_filter($listProduct, function($product){
                if($product->price_sale !=null){
                    return $product->price_sale > $_GET['min'];
                }
                return $product->price > $_GET['min'];
            });
        }
        if(isset($_GET['max'])){
            $listProduct = array_filter($listProduct, function($product){
                if($product->price_sale !=null){
                    return $product->price_sale < $_GET['max'];
                }
                return $product->price < $_GET['max'];
            });
        }
        if(isset($_GET['product-name'])){
            $listProduct = $productModel->getDataShopName();
        }
        include 'app/Views/Users/shop.php';
    }
    
}
