<?php
class ProductController{

    public function showAllProduct() {
        $productModel = new ProductModel();
        $listProduct = $productModel->getAllProduct();
        include 'app/Views/Admin/products.php';
    }
     public function addProduct(){
        $categoryModel = new CategoryModel();
        $listCategory = $categoryModel->allCategory();
        include 'app/Views/Admin/add-product.php';
    }
    

    public function checkValidate() {
        $name = $_POST['name'] ?? null;
        $category_id = $_POST['category'] ?? null;
        $category = $_POST['category'] ?? null;
        echo "category: " . $category . "<br>";

        $price = $_POST['price'] ?? null;
        $act = isset($_GET['act']) ? $_GET['act'] : "";
        echo "act: " . $act . "<br>";
        echo "name: " . $name . "<br>";
        echo "category_id" . $category_id."<br>";
        echo "price: " . $price . "<br>";

        
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

    // debug
    // public function addPostProduct() {
    //     echo "1. Bắt đầu addPostProduct()<br>";
    
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         echo "2. Nhận request POST<br>";
    
    //         if (!$this->checkValidate()) {
    //             echo "3. Validation thất bại<br>";
    //             die("Redirecting to: " . BASE_URL . "?role=admin&act=add-product");
    //         }
    
    //         echo "4. Validation thành công<br>";
    
    //         // Xử lý upload ảnh
    //         $uploadDir = 'assets/Admin/upload/';
    //         $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    //         $destPath = "";
    
    //         if (!empty($_FILES['image_main']['name'])) {
    //             echo "5. Ảnh được tải lên, bắt đầu kiểm tra file<br>";
    
    //             $fileTmPath = $_FILES['image_main']['tmp_name'];
    //             $fileType = mime_content_type($fileTmPath);
    //             $fileName = basename($_FILES['image_main']['name']);
    //             $fileExtention = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    //             echo "6. File nhận được: $fileName | Loại: $fileType | Đuôi: $fileExtention<br>";
    
    //             $newFileName = uniqid() . '.' . $fileExtention;
    
    //             if (in_array($fileType, $allowedTypes)) {
    //                 echo "7. File hợp lệ, chuẩn bị lưu<br>";
    
    //                 $destPath = $uploadDir . $newFileName;
    //                 if (!move_uploaded_file($fileTmPath, $destPath)) {
    //                     echo "8. Upload thất bại<br>";
    //                     $destPath = "";
    //                 } else {
    //                     echo "9. Upload thành công, đường dẫn: $destPath<br>";
    //                 }
    //             } else {
    //                 echo "10. Loại file không hợp lệ<br>";
    //             }
    //         } else {
    //             echo "11. Không có file nào được tải lên<br>";
    //         }
    
    //         // Lưu vào database
    //         $productModel = new ProductModel();
    //         echo "12. Đã tạo ProductModel, gọi addProducttoDB()<br>";
    
    //         $message = $productModel->addProducttoDB($destPath);
    //         echo "13. Kết quả từ addProducttoDB(): " . var_export($message, true) . "<br>";
    
    //         if ($message) {
    //             $_SESSION['message'] = "Thêm mới thành công";
    //             echo "14. Thêm mới thành công, chuyển hướng<br>";
                
    //             header("location: " . BASE_URL . "?role=admin&act=all-product" );
    //                 exit;
    //         } else {
    //             $_SESSION['message'] = "Thêm mới không thành công";
    //             echo "15. Thêm mới thất bại, chuyển hướng<br>";
    //             die("Redirecting to: " . BASE_URL . "?role=admin&act=add-product");
    //         }
    //     } else {
    //         echo "16. Không phải request POST<br>";
    //     }
    // }
    

    public function deleteProduct() {
        try {
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                $_SESSION['message'] = "Vui lòng chọn sản phẩm cần xóa";
                header("location: " . BASE_URL . "?role=admin&act=all-product");
                exit;
            }
    
            $productModel = new ProductModel();
            $product = $productModel->getProductById();
    
            if ($product->image_main !== null) {
                if (file_exists($product->image_main)) {
                    unlink($product->image_main);
                }
            }
    
            $listImage = $productModel->getProductImageByID();
            foreach ($listImage as $value) {
                if ($value->image !== null && file_exists($value->image)) {
                    unlink($value->image);
                }
            }
    
            $message = $productModel->deleteProductToDB();
    
            if ($message) {
                $_SESSION['message'] = "Xóa sản phẩm thành công";
            } else {
                $_SESSION['message'] = "Xóa sản phẩm không thành công";
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Lỗi: " . $e->getMessage();
        }
    
        header("location: " . BASE_URL . "?role=admin&act=all-product");
        exit;
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
            $destPath = $product->image_main;

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
                    unlink($product->image_main);
                }
            }

            $productModel = new ProductModel();
            $massage = $productModel->updateProductToDB($destPath);


            if (!$massage) {
                $_SESSION['message'] = "Chinh sua khong thanh cong";
                    header("location: " . BASE_URL . "?role=admin&act=update-product&id=" . $_GET['id'] );
                    exit;
            }

            // them thu vien anh
            if (isset($_FILES['image']) && count($_FILES['image']) > 0) {
                $listImage = $productModel->getProductImageByID();
                foreach ($listImage as $key => $value){
                    if($value->image !== null){
                        unlink($value->image);
                    }
                }
                $productModel->deleteImageGary();

                foreach ($_FILES['image']['name'] as $key => $name){
                    $destPathImage = "";
                    if (!empty($name)) {
                        $fileTmPath = $_FILES['image']['tmp_name'][$key];
                        $fileType = mime_content_type($fileTmPath);
                        $fileName = basename($name);
                        $fileExtention = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
                        $newFileName = uniqid() . '.' . $fileExtention;
        
                        if (in_array($fileType, $allowedTypes)){
                            $destPathImage = $uploadDir . $newFileName;
                            if(!move_uploaded_file($fileTmPath, $destPathImage)) {
                                $destPathImage = "";
                            }
                            
                        }
                    }
                    if ($destPathImage !== "") {
                        if (!$productModel->addGaryImage($destPathImage, $_GET['id'])) {
                            die("Lỗi: Không thể thêm ảnh vào cơ sở dữ liệu.");
                        }
                    }
                }
            }
            $_SESSION['message'] = "Chinh sua thanh cong";
            header("location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    }

}