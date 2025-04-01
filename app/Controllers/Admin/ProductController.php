<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
class ProductController extends ControllerAdmin {

    public function showAllProduct() {
        $productModel = new ProductModel();
        $listProduct = $productModel->getAllData();

        include 'app/Views/Admin/products.php';
    }
    public function getAllProduct() {
        $productModel = new ProductModel();
        $listProduct = $productModel->getAllData();

        include 'app/Views/Admin/products.php';
    }

    public function addProduct() {
        $productModel = new ProductModel();
        $listCategory = $productModel->getcategores(); 
    
        
        include_once "./app/Views/Admin/add-product.php";
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
                header("location: " . BASE_URL > "?role=admin&act=add-product");
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
        include 'app/Views/Admin/update-product.php';
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
        if (!empty($product->image_main) && file_exists($product->image_main)) {
            unlink($product->image_main);
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