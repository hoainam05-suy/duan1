<?php
    class ProductModel {
        public $db;
        public function __construct()
        {
            $this->db = new Database();
        }

        public function getAllData() {
            $sql = "SELECT products.id, products.name, products.category_id, products.price, products.price_sale, products.stock, products.image_main, categories.name AS categoryName 
                    FROM products join categories on products.category_id = categories.id;";
            $query = $this->db->pdo->query($sql);
            $result = $query->fetchAll();
            return $result;
        }

        public function addProducttoDB($destPath) {
            echo "Hàm addProducttoDB() đã được gọi!<br>"; // Kiểm tra hàm có chạy không
            $name = $_POST['name'];
            $category_id =  $_POST['category'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $price_sale = $_POST['price_sale'];
            $stock = $_POST['stock'];
            $image_main = "$destPath";
            $now = date('Y-m-d H:i:s');
            echo "Hàm addProducttoDB() đã được gọi>>>>>1<br>"; // Kiểm tra hàm có chạy không

            $sql = "INSERT INTO products (name, category_id, description, price, price_sale, stock, image_main, created_at, updated_at) 
            VALUES (:name, :category_id, :description, :price, :price_sale, :stock, :image_main ,:created_at, :updated_at)";
            echo "Hàm addProducttoDB() đã được gọi>>>>>12<br>"; // Kiểm tra hàm có chạy không

            $stmt = $this->db->pdo->prepare($sql);
            echo "Hàm addProducttoDB() đã được gọi>>>>>155<br>"; // Kiểm tra hàm có chạy không
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':price_sale', $price_sale);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':image_main', $image_main);
            $stmt->bindParam(':created_at', $now);
            $stmt->bindParam(':updated_at', $now);

            echo "Hàm addProducttoDB() đã được gọi>>>>>1989<br>"; // Kiểm tra hàm có chạy không
           
            // return $stmt->execute();

            try {
                $stmt->execute();
                echo "Thêm sản phẩm thành công!";
                return true; // Trả về true nếu thành công
            } catch (PDOException $e) {
                echo "Lỗi khi thêm sản phẩm: " . $e->getMessage(); // Hiển thị lỗi cụ thể
                return false;
            }
            
            
        }


        // public function addProducttoDB($imagePath) {
        //     echo "Hàm addProducttoDB() đã được gọi!<br>"; // Kiểm tra hàm có chạy không
            
        //     try {
        //         $stmt = $this->pdo->prepare("INSERT INTO products (name, category_id, price, price_sale, stock, image_main) 
        //                                      VALUES (:name, :category, :price, :price_sale, :stock, :image)");
                
        //         $stmt->bindParam(':name', $_POST['name']);
        //         $stmt->bindParam(':category', $_POST['category']);
        //         $stmt->bindParam(':price', $_POST['price']);
        //         $stmt->bindParam(':price_sale', $_POST['price-sale']);
        //         $stmt->bindParam(':stock', $_POST['stock']);
        //         $stmt->bindParam(':image', $imagePath);
                
        //         $stmt->execute();
        //         echo "✅ INSERT thành công!<br>";
        //         return true;
        //     } catch (PDOException $e) {
        //         echo "❌ Lỗi khi INSERT: " . $e->getMessage(); // Hiển thị lỗi cụ thể
        //         return false;
        //     }
        // }
        



        public function getProductById() {
            $id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
        
            if ($stmt->execute()) {
                return $stmt->fetch();
            }
            return false;
        }
        

       
        public function updateProducttoDB($destPath) {
            // Lấy thông tin sanr phẩm hiện tại từ DB
            $user = $this->getProductByID($_GET['id']);
            if (!$user) {
                return false;
            }
            $id = $_GET['id'];
            
            $name = isset($_POST['name']) && $_POST['name'] !== '' ? $_POST['name'] : $user->name;
            $category_id = isset($_POST['category_id']) && $_POST['category_id'] !== '' ? $_POST['category_id'] : $product->category_id;
            $description = isset($_POST['description']) && $_POST['description'] !== '' ? $_POST['description'] : $product->description;
            $price = isset($_POST['price']) && $_POST['price'] !== '' ? $_POST['price'] : $product->price;
            $price_sale = isset($_POST['price_sale']) && $_POST['price_sale'] !== '' ? $_POST['price_sale'] : $product->price_sale;
            $stock = isset($_POST['stock']) && $_POST['stock'] !== '' ? $_POST['stock'] : $product->stock;
            $image_main = $destPath ?: $product->image_main; // Sử dụng ảnh mới nếu có, ngược lại giữ ảnh cũ
            $now = date('Y-m-d H:i:s');
           
            // Câu truy vấn cập nhật
            $sql = "
                UPDATE products SET 
                    name = :name,
                    category_id = :category_id,
                    description = :description,
                    price = :price,
                    price_sale = :price_sale,
                    stock = :stock,
                    image_main = :image_main,
                    updated_at = :updated_at
                WHERE id = :id
            ";
        
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':price_sale', $price_sale);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':image_main', $image);
            $stmt->bindParam(':updated_at', $now);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }
        
        public function deleteProductById($id) {
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
        
            return $stmt->execute();
        }

        public function getCategories() {
            try {
                $sql = "SELECT id, name FROM categories"; 
                $stmt = $this->db->pdo->prepare($sql); // Sử dụng $this->db->pdo thay vì $this->conn
                $stmt->execute();
                $categories = $stmt->fetchAll(PDO::FETCH_OBJ);
        
                return $categories;
            } catch (PDOException $e) {
                echo "<p style='color: red;'>Lỗi SQL: " . $e->getMessage() . "</p>";
                return [];
            }
        }
        
    }
?>

