CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categories (name, description) VALUES
('Áo Thun', 'Các mẫu áo thun nam nữ đa dạng phong cách'),
('Áo Sơ Mi', 'Áo sơ mi công sở, áo sơ mi casual cho nam và nữ'),
('Quần Jean', 'Các loại quần jean phong cách, trẻ trung'),
('Quần Short', 'Quần short nam nữ phù hợp đi chơi, dạo phố'),
('Váy Đầm', 'Váy, đầm thiết kế thời trang dành cho nữ'),
('Đồ Thể Thao', 'Trang phục thể thao thoải mái, năng động'),
('Đồ Ngủ', 'Bộ đồ ngủ mềm mại, thoải mái cho nam nữ'),
('Phụ Kiện', 'Mũ, khăn, túi xách, thắt lưng và các phụ kiện thời trang');

