<?php
   class CartUserModel{
      public $db;
      public function __construct()
      {
          $this->db = new Database();
      }

      // public function addCartModel() {
      //    $productId = $_POST['productId'];
      //    $quantity = $_POST['quantity'];
      //    $userId = $_SESSION['users']['id'];
      //    $now = date('Y-m-d H:i:s');

      //    $sql = "select * from cart where user_id = :user_id";
      //    $stmt = $this->db->pdo->prepare($sql);
      //    $stmt->bindParam(':user_id', $userId);
      //    $stmt->execute();
      //    $cart = $stmt->fetch();
      //    if(!$cart) {
      //       $sql = "INSERT INTO `cart`( `user_id`, `created_at`, `updated_at`) VALUES
      //        (:user_id, :created_at, :updated_at)";
      //         $stmt = $this->db->pdo->prepare($sql);
      //         $stmt->bindParam(':user_id', $userId);
      //         $stmt->bindParam(':created_at', $now);
      //         $stmt->bindParam(':updated_at', $now);

      //         if($stmt->execute()) {
      //          $cartId = $this->db->pdo->lastInsertId();
      //         }else{
      //          return false;
      //         }
      //    }else{
      //       $cartId = $cart->id;
      //    }

      //    $sql = "select * from cart_detail where cart_id = :cart_id and product_id = :product_id";
      //    $stmt = $this->db->pdo->prepare($sql);
      //    $stmt->bindParam(':cart_id', $cartId);
      //    $stmt->bindParam(':product_id', $productId);
      //    $stmt->execute();
      //    $cartDetail = $stmt->fetch();

      //    if($cartDetail) {
      //       $sql = "UPDATE `cart_detail` SET `quantity`= :quantity WHERE id = :cart_detail_id";
      //       $stmt = $this->db->pdo->prepare($sql);
      //       $stmt->bindParam(':cart_detail_id', $cartDetail->id);
      //       $newQuantity = intval($cartDetail->quantity) + intval($quantity);
      //       $stmt->bindParam(':quantity', $newQuantity);
      //       return $stmt->execute();
      //   } else {
      //       // Thêm mới sản phẩm vào giỏ
      //       $sql = "INSERT INTO `cart_detail`(`cart_id`, `product_id`, `quantity`) VALUES (:cart_id, :product_id, :quantity)";
      //       $stmt->bindParam(':cart_id', $cartId);
      //       $stmt->bindParam(':product_id', $productId);
      //       $stmt->bindParam(':quantity', $quantity);
      //        return $stmt->execute();
      //   }
      // }


   public function addCartModel() {
   // Lấy thông tin từ POST
   $productId = $_POST['productId'];
   $quantity = $_POST['quantity'];
   $userId = $_SESSION['users']['id'];
   $now = date('Y-m-d H:i:s');

   // Kiểm tra giỏ hàng của người dùng
   $sql = "SELECT * FROM cart WHERE user_id = :user_id";
   $stmt = $this->db->pdo->prepare($sql);
   $stmt->bindParam(':user_id', $userId);
   $stmt->execute();
   $cart = $stmt->fetch();

   // Nếu không có giỏ hàng, tạo mới giỏ hàng
   if (!$cart) {
       $sql = "INSERT INTO `cart`(`user_id`, `created_at`, `updated_at`) 
               VALUES (:user_id, :created_at, :updated_at)";
       $stmt = $this->db->pdo->prepare($sql);
       $stmt->bindParam(':user_id', $userId);
       $stmt->bindParam(':created_at', $now);
       $stmt->bindParam(':updated_at', $now);

       if ($stmt->execute()) {
           $cartId = $this->db->pdo->lastInsertId();
       } else {
           return false;  // Thêm giỏ hàng không thành công
       }
   } else {
       $cartId = $cart->id;  // Lấy cartId từ giỏ hàng hiện tại
   }

   // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
   $sql = "SELECT * FROM cart_detail WHERE cart_id = :cart_id AND product_id = :product_id";
   $stmt = $this->db->pdo->prepare($sql);
   $stmt->bindParam(':cart_id', $cartId);
   $stmt->bindParam(':product_id', $productId);
   $stmt->execute();
   $cartDetail = $stmt->fetch();

   if ($cartDetail) {
       // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
       $newQuantity = intval($cartDetail->quantity) + intval($quantity); // Tính toán số lượng mới
       $sql = "UPDATE `cart_detail` SET `quantity` = :quantity WHERE id = :cart_detail_id";
       $stmt = $this->db->pdo->prepare($sql);
       $stmt->bindParam(':cart_detail_id', $cartDetail->id);
       $stmt->bindParam(':quantity', $newQuantity);
      $stmt->execute();
      //  if ($stmt->execute()) {
      //      return true;  // Cập nhật số lượng thành công
      //  } else {
      //      return false;  // Cập nhật số lượng không thành công
      //  }
   } else {
       // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới sản phẩm vào giỏ
       $sql = "INSERT INTO `cart_detail`(`cart_id`, `product_id`, `quantity`) 
               VALUES (:cart_id, :product_id, :quantity)";
       $stmt = $this->db->pdo->prepare($sql);
       $stmt->bindParam(':cart_id', $cartId);
       $stmt->bindParam(':product_id', $productId);
       $stmt->bindParam(':quantity', $quantity);
       $stmt->execute();
      //  if ($stmt->execute()) {
      //      return true;  // Thêm sản phẩm thành công
      //  } else {
      //      return false;  // Thêm sản phẩm không thành công
      //  }
   }

   $sql = "select cart_detail.*, products.name, products.image_main, products.price, products.price_sale from cart_detail JOIN products on cart_detail.product_id = products.id where cart_detail.cart_id = :cart_id ";
   $stmt = $this->db->pdo->prepare($sql);
   $stmt->bindParam(':cart_id', $cartId);
   $stmt->execute();
   return $stmt->fetchAll();
}

public function showCartModel() {
    $userId = $_SESSION['users']['id'];
    $sql = "SELECT * FROM cart WHERE user_id = :user_id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $cart = $stmt->fetch();

    if (!$cart) {
        return []; // Nếu chưa có giỏ hàng
    }

$cartID = $cart->id;

    $sql = "SELECT cart_detail.*, products.name, products.image_main, products.price, products.price_sale 
            FROM cart_detail 
            JOIN products ON cart_detail.product_id = products.id 
            WHERE cart_detail.cart_id = :cart_id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindParam(':cart_id', $cartID);
    $stmt->execute();
    return $stmt->fetchAll();
}

   public function updateCartModel(){
        $cart_detail_Id = $_POST['cart_detail_id'];
        $action = $_POST['action'];

        switch ($action) {
            case 'increase': {
                $sql = "UPDATE `cart_detail` SET `quantity`= quantity + 1 WHERE id = :cart_detail_id";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindParam(':cart_detail_id', $cart_detail_Id);
                $stmt->execute();
                break;
            }

            case 'decrease': {
                $sql = "UPDATE `cart_detail` SET `quantity`= quantity - 1 WHERE id = :cart_detail_id and quantity > 1";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindParam(':cart_detail_id', $cart_detail_Id);
                $stmt->execute();
                break;
            }

            case 'delete': {
                $sql = "DELETE FROM `cart_detail` WHERE id = :cart_detail_id";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindParam(':cart_detail_id', $cart_detail_Id);
                $stmt->execute();
                break;
            }
        }
        return $this->showCartModel();
   }

   public function deleteCartDetail(){
        $userId = $_SESSION['users']['id'];
        $sql = "SELECT * FROM `cart` WHERE user_id = :user_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $cart = $stmt->fetch();
        if($cart) {
            $sql = "DELETE FROM `cart_detail` WHERE cart_id = :cart_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':cart_id', $cart->id);
            return $stmt->execute();

        }
        return false;
   }
   }
?>