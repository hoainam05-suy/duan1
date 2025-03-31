<?php
include 'app/Database/Database.php';


// Kiểm tra kết nối
$db = new Database(); // Gọi class Database
if ($db->pdo) {
    echo "✅ Kết nối MySQL thành công!";
} else {
    echo "❌ Kết nối MySQL thất bại!";
}
?>
