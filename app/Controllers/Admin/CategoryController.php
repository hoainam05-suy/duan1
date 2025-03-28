<?php
class CategoryController {
    

    public function getAllCategory() {
        $categoryModel = new CategoryModel();
        $listCategory = $categoryModel->getAllData();

        include 'app/Views/Admin/categories.php';
    }

    public function addCategory() {
        $categoryModel = new CategoryModel();
        $listCategory = $categoryModel->getCategories(); 
        include_once "./app/Views/Admin/add-category.php";
    }
    

    public function checkValidate() {
        $name = $_POST['name'] ?? null;
        $category_id = $_POST['category_id'] ?? null;

        if($name != "" && $category_id != "" ) {
            return true;
        } else {
            $_SESSION['error'] = "Bạn nhập thiếu thông tin";
            return false;
        }
    }

    public function addPostCategory() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!$this->checkValidate()) {
                header("location: " . BASE_URL > "?role=admin&act=add-category");
                exit;
            }         

            $categoryModel = new CategoryModel();
            $message = $categoryModel->addCategorytoDB($destPath);

            if ($message) {
                $_SESSION['message'] = "Them moi thanh cong";
                    header("location: " . BASE_URL . "?role=admin&act=all-category" );
                    exit;
            }else {
                $_SESSION['message'] = "Them moi khong thanh cong";
                header("location: " . BASE_URL . "?role=admin&act=add-category" );
                exit;
            }
        }
    }

    public function updateCategory() {
        if(!isset($_GET['id'])){
            $_SESSION['message'] = "Vui long chon danh muc can sua";
            header("location: " . BASE_URL . "?role=admin&act=all-category" );
            exit;
        }
        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategoryByID();
        if(!$category) {
            $_SESSION['message'] = "Khong tim thay du lieu";
            header("location: " . BASE_URL . "?role=admin&act=all-category" );
            exit;
        }
        include 'app/Views/Admin/update-category.php';
    }

    public function updatePostCategory() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!isset($_GET['id'])){
                $_SESSION['message'] = "Vui lòng chọn danh mục cần sửa";
                header("location: " . BASE_URL . "?role=admin&act=all-category" );
                exit;
            }
            
            $categoryModel = new CategoryModel();
            $category = $categoryModel->getCategoryByID($_GET['id']);
            
            if (!$category) {
                $_SESSION['message'] = "Không tìm thấy danh mục";
                header("location: " . BASE_URL . "?role=admin&act=all-category" );
                exit;
            }
            
            
            $message = $categoryModel->updateCategorytoDB();
    
            if ($message) {
                $_SESSION['message'] = "Chỉnh sửa thành công";
                header("location: " . BASE_URL . "?role=admin&act=all-category" );
            } else {
                $_SESSION['message'] = "Chỉnh sửa không thành công";
                header("location: " . BASE_URL . "?role=admin&act=update-category&id=" . $_GET['id'] );
            }
            exit;
        }
    }
    
    public function deleteCategory() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn danh mục cần xóa";
            header("location: " . BASE_URL . "?role=admin&act=all-category");
            exit;
        }
    
        $id = $_GET['id'];
        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategoryById();
    
        if (!$category) {
            $_SESSION['message'] = "Không tìm thấy danh mục";
            header("location: " . BASE_URL . "?role=admin&act=all-category");
            exit;
        }
    
        $isDeleted = $categoryModel->deleteCategoryById($id);
    
        if ($isDeleted) {
            $_SESSION['message'] = "Xóa danh mục thành công";
            header("location: " . BASE_URL . "?role=admin&act=all-category");
            exit;
        } else {
            $_SESSION['message'] = "Xóa danh mục không thành công";
            header("location: " . BASE_URL . "?role=admin&act=all-category");
            exit;
        }
    }
    
}