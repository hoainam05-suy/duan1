<?php
class ProductController{

    public function showAllProduct() {
        $productModel = new ProductModel();
        $listProduct = $productModel->getAllProduct();
        $listCategory = $productModel->getCategories();
        include 'app/Views/Admin/products.php';
    }
     public function addProduct(){
        $categoryModel = new CategoryModel();
        $listCategory = $categoryModel->allCategory();
        include 'app/Views/Admin/add-product.php';
    }
    

    public function checkValidate() {
        $name = $_POST['name'] ?? null;
        $category_id = $_POST['category_id'] ?? null;
        $price = $_POST['price'] ?? null;

        if($name != "" && $category_id != "" && $price != "" ) {
            return true;
        } else {
            $_SESSION['error'] = "Bạn nhập thiếu thông tin";
            return false;
        }
    }
//code chuan
    public function addPostProduct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!$this->checkValidate()) {
                header("location: " . BASE_URL . "?role=admin&act=add-product");
                exit;
            }
            // them anh
            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = "";
            if (!empty($_FILES['image_main']['name'])) {
                $fileTmPath = $_FILES['image_main']['tmp_name'];
                $fileType = mime_content_type($fileTmPath);
                $fileName = basename($_FILES['image_main']['name']);
                $fileExtention = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $newFileName = uniqid() . '.' . $fileExtention;


                if (in_array($fileType, $allowedTypes)){
                    $destPath = $uploadDir . $newFileName;
                    if(!move_uploaded_file($fileTmPath, $destPath)) {
                        $destPath = "";
                    }
                    
                }
            }
            

            $productModel = new ProductModel();
            $message = $productModel->addProducttoDB($destPath);
            if ($message) {
                $_SESSION['message'] = "Them moi thanh cong";
                    header("location: " . BASE_URL . "?role=admin&act=all-product" );
                    exit;
            }else {
                $_SESSION['message'] = "Them moi khong thanh cong";
                header("location: " . BASE_URL . "?role=admin&act=add-product" );
                exit;
            }
        }
    }
    

    public function deleteProduct() {
        try {
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                $_SESSION['message'] = "Vui lòng chọn sản phẩm cần xóa";
                header("location: " . BASE_URL . "?role=admin&act=all-product");
                exit;
            }
    
            $productModel = new ProductModel();
            $product = $productModel->getProductById();
    
        if (!$product) {
            $_SESSION['message'] = "Không tìm thấy sản phẩm";
            header("location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    
        // Xóa ảnh nếu tồn tại
        if (!empty($product->image_main) && file_exists($product->image_main)) {
            unlink($product->image_main);
        }

        $isDeleted = $productModel->deleteProductToDB();

        if ($isDeleted) {
            $_SESSION['message'] = "Xóa sản phẩm thành công";
            header("location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        } else {
            $_SESSION['message'] = "Xóa sản phẩm không thành công";
            header("location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    
        header("location: " . BASE_URL . "?role=admin&act=all-product");
        exit;
    }
        catch (Exception $e) {
            $_SESSION['message'] = "Lỗi: " . $e->getMessage();
            header("location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    }
    

    public function updateProduct(){
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn product cần xóa";
            header("location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
        $categoryModel = new CategoryModel();
        $listCategory = $categoryModel->allCategory();

        $productModel = new ProductModel();
        $product = $productModel->getProductByID();
        $listProductImage = $productModel->getProductImageByID();
        include 'app/Views/Admin/update-product.php';

    }

    public function updatePostProduct(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                $_SESSION['message'] = "Vui lòng chọn product cần xóa";
                header("location: " . BASE_URL . "?role=admin&act=all-product");
                exit;
            }
            if(!$this->checkValidate()){
                header("Location: " . BASE_URL . "?role=admin&act=update-product&id=" . $_GET['id']);
                exit;
            }
            $productModel = new ProductModel();
            $product = $productModel->getProductByID();

            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = $product->image_main; // Giữ ảnh cũ nếu không có ảnh mới
            if (!empty($_FILES['image_main']['name'])) {
                $fileTmPath = $_FILES['image_main']['tmp_name'];
                $fileType = mime_content_type($fileTmPath);
                $fileName = basename($_FILES['image_main']['name']);
                $fileExtention = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $newFileName = uniqid() . '.' . $fileExtention;

                if (in_array($fileType, $allowedTypes)){
                    $destPath = $uploadDir . $newFileName;
                    if(move_uploaded_file($fileTmPath, $destPath)) {
                        // Xóa ảnh cũ nếu upload thành công
                        if($product->image_main && file_exists($product->image_main)) {
                            unlink($product->image_main);
                        }
                    } else {
                        $destPath = $product->image_main; // Giữ lại ảnh cũ nếu upload thất bại
                    }
                }
            }
            
            $message = $productModel->updateProducttoDB($destPath);
    
            if ($message) {
                $_SESSION['message'] = "Chỉnh sửa thành công";
                header("location: " . BASE_URL . "?role=admin&act=all-product" );
            } else {
                $_SESSION['message'] = "Chỉnh sửa không thành công";
                header("location: " . BASE_URL . "?role=admin&act=update-product&id=" . $_GET['id'] );
            }
            exit;
        }
    }

    public function showProduct(){
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn product cần xem";
            header("location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $product = $productModel->getProductByID();
        $listCategory = $categoryModel->getCategories();
        include 'app/Views/Admin/show-product.php';
    }

 
}
