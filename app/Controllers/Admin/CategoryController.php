<?php
class CategoryController {
    

    public function getAllCategory() {
        $categoryModel = new CategoryModel();
        $listCategory = $categoryModel->allCategory();

        include 'app/Views/Admin/categories.php';
    }

    public function addCategory() {
        $categoryModel = new CategoryModel();
        $listCategory = $categoryModel->getCategories(); 
        include "./app/Views/Admin/add-category.php";
    }

    public function checkValidate() {
        $name = $_POST['name'] ?? null;

        if($name != ""  ) {
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
            $message = $categoryModel->addCategory();

            if ($message) {
                $_SESSION['message'] = "Them moi thanh cong";
                header("location: " . BASE_URL . "?role=admin&act=all-category");
                exit;
            } else {
                $_SESSION['message'] = "Them moi khong thanh cong";
                header("location: " . BASE_URL . "?role=admin&act=add-category");
                exit;
            }
        }  else {
            header("Location: " . BASE_URL . "?role=admin&act=add-category");
            exit;
        }
    }


    public function updateCategory()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui long chon danh muc can sua";
            header("location: " . BASE_URL . "?role=admin&act=all-category");
            exit;
        }
        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategoryByID();
        
        include 'app/Views/Admin/update-category.php';
    }

    public function updatePostCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!isset($_GET['id'])){
                $_SESSION['message'] = "Vui lòng chọn danh mục cần sửa";
                header("location: " . BASE_URL . "?role=admin&act=all-category");
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
                header("location: " . BASE_URL . "?role=admin&act=all-category");
                exit;
            } else {
                $_SESSION['message'] = "Chỉnh sửa không thành công";
                header("location: " . BASE_URL . "?role=admin&act=update-category&id=" . $_GET['id']);
                exit;
            }
          
        }else {
            header("Location: " . BASE_URL . "?role=admin&act=update-category&id=" . $_GET['id']);
            exit;
        }
    }

    public function deleteCategory() {
        try {
            if (!isset($_GET['id'])) {
                $_SESSION['message'] = "Vui lòng chọn danh mục cần xóa";
                header("location: " . BASE_URL . "?role=admin&act=all-category");
                exit;
            }
    
            $categoryModel = new CategoryModel();
            $message = $categoryModel->deleteCategory();
    
            if ($message) {
                $_SESSION['message'] = "Xóa danh mục thành công";
            } else {
                $_SESSION['message'] = "Xóa danh mục không thành công";
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Lỗi: " . $e->getMessage();
        }
    
        header("location: " . BASE_URL . "?role=admin&act=all-category");
        exit;
    }
    
}
