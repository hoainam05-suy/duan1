<?php
    class ControllerAdmin {
        public function __construct()
        {
            if(!isset($_SESSION['users'])) {
                $_SESSION['error'] = 'Ban phai dang nhap truoc';
                header("location: " . BASE_URL . "?role=admin&act=login" );
                exit;
            }
        }
    }
?>