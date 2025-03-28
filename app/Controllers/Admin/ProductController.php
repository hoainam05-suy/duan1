<?php
class ProductController {
    public function getAllProduct() {
        $productModel = new ProductModel();
        $listProduct = $productModel->getAllData();

        include 'app/Views/Admin/products.php';
    }

    public function addProduct() {
        $productModel = new ProductModel();
        $listCategory = $productModel->getCategories(); 
    
        
        include_once "./app/Views/Admin/add-products.php";
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

    public function addPostProduct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!$this->checkValidate()) {
                header("location: " . BASE_URL > "?role=admin&act=add-product");
                exit;
            }
            // them anh
            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = "";
            if (!empty($_FILES['image']['name'])) {
                $fileTmPath = $_FILES['image']['tmp_name'];
                $fileType = mime_content_type($fileTmPath);
                $fileName = basename($_FILES['image']['name']);
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

    public function updateProduct() {
        if(!isset($_GET['id'])){
            $_SESSION['message'] = "Vui long chon san pham can sua";
            header("location: " . BASE_URL . "?role=admin&act=all-product" );
            exit;
        }
        $productModel = new ProductModel();
        $product = $productModel->getProductByID();
        if(!$product) {
            $_SESSION['message'] = "Khong tim thay du lieu";
            header("location: " . BASE_URL . "?role=admin&act=all-product" );
            exit;
        }
        include 'app/Views/Admin/update-products.php';
    }

    public function updatePostProduct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!isset($_GET['id'])){
                $_SESSION['message'] = "Vui lòng chọn san pham cần sửa";
                header("location: " . BASE_URL . "?role=admin&act=all-product" );
                exit;
            }
            
            $productModel = new ProductModel();
            $product = $productModel->getProductByID($_GET['id']);
            
            if (!$product) {
                $_SESSION['message'] = "Không tìm thấy sản phẩm";
                header("location: " . BASE_URL . "?role=admin&act=all-product" );
                exit;
            }
            
            // Xử lý ảnh
            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = $product->image; // Giữ ảnh cũ nếu không có ảnh mới
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
                        if($product->image && file_exists($product->image)) {
                            unlink($product->image);
                        }
                    } else {
                        $destPath = $product->image; // Giữ lại ảnh cũ nếu upload thất bại
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
    
    public function deleteProduct() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn sản phẩm cần xóa";
            header("location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    
        $id = $_GET['id'];
        $productModel = new ProductModel();
        $product = $productModel->getProductById();
    
        if (!$product) {
            $_SESSION['message'] = "Không tìm thấy sản phẩm";
            header("location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    
        // Xóa ảnh nếu tồn tại
        if (!empty($product->image) && file_exists($product->image)) {
            unlink($product->image);
        }
    
        $isDeleted = $productModel->deleteProductById($id);
    
        if ($isDeleted) {
            $_SESSION['message'] = "Xóa sản phẩm thành công";
            header("location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        } else {
            $_SESSION['message'] = "Xóa sản phẩm không thành công";
            header("location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    }
    
}