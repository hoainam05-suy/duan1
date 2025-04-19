<?php
// Dữ liệu giới thiệu
$companyName = "Công ty TNHH ABC";
$description = "Chúng tôi là đơn vị chuyên cung cấp các giải pháp công nghệ thông tin hàng đầu, với sứ mệnh mang lại giá trị bền vững cho khách hàng.";

// Danh sách thành viên hoặc dịch vụ (ví dụ)
$teamMembers = [
    ["name" => "Nguyễn Văn A", "role" => "Giám đốc điều hành"],
    ["name" => "Trần Thị B", "role" => "Trưởng phòng Kỹ thuật"],
    ["name" => "Lê Văn C", "role" => "Chuyên viên tư vấn"],
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giới thiệu - <?= $companyName ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        h1 { color: #2c3e50; }
        .member { margin-bottom: 10px; }
    </style>
</head>
<body>

    <h1>Giới thiệu về <?= $companyName ?></h1>
    <p><?= $description ?></p>

    <h2>Đội ngũ của chúng tôi</h2>
    <?php foreach ($teamMembers as $member): ?>
        <div class="member">
            <strong><?= $member['name'] ?></strong> - <?= $member['role'] ?>
        </div>
    <?php endforeach; ?>

</body>
</html>
