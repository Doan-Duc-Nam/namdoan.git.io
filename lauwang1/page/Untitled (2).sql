CREATE TABLE `Ban` (
  `MaBan` int PRIMARY KEY AUTO_INCREMENT,
  `SoNguoiToiDa` int,
  `TinhTrang` bit,
  `MaCS` int
);

CREATE TABLE `NhanVien` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `HoTen` varchar(50),
  `NgaySinh` date,
  `SDT` varchar(12),
  `DiaChi` varchar(100),
  `MatKhau` varchar(32),
  `userName` VARCHAR(30) NOT NULL UNIQUE
);

CREATE TABLE `ThucDon` (
  `Ma` int PRIMARY KEY AUTO_INCREMENT,
  `Ten` varchar(50),
  `gia` int,
  `MoTa` varchar(150)
);

CREATE TABLE `CoSo` (
  `Ma` int PRIMARY KEY AUTO_INCREMENT,
  `DiaChi` varchar(50)
);

CREATE TABLE `KhachHang` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `HoTen` varchar(50),
  `SDT` varchar(12),
  `GhiChu` varchar(200),
  `Ngay` date,
  `Gio` char(10),
  `num_adult` int,
  `num_child` int DEFAULT 0,
  `MaCS` int,
  `MaBan` int
);

CREATE TABLE `order_temp`
(
  `ma` int AUTO_INCREMENT PRIMARY KEY,
	`ho_ten` varchar(50),
    `sdt` char(15),
    `ngay` date,
    `gio` char(10),
    `dia_chi` int,
   	`num_adult` int,
    `num_child` int DEFAULT 0,
    `note` varchar(200),
    FOREIGN KEY (`dia_chi`) REFERENCES `coso`(`Ma`)
);

CREATE TABLE `endow` (
  `ID` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(100),
  `representativeImage` varchar(255),
  `description` varchar(255),
  `userName` varchar(30),
  `type` varchar(100),
  `created_at` datetime
);

ALTER TABLE `ban` ADD FOREIGN KEY (`MaCS`) REFERENCES `coso`(`Ma`);
ALTER TABLE `khachhang` ADD FOREIGN KEY (`MaCS`) REFERENCES `coso`(`Ma`);
ALTER TABLE `khachhang` ADD FOREIGN KEY (`MaBan`) REFERENCES `ban`(`MaBan`);
ALTER TABLE `thucdon` ADD `image` VARCHAR(255) NULL DEFAULT NULL AFTER `gia`;

-- Thêm các cơ sở
-- INSERT INTO coso(DiaChi)
-- VALUES
-- ("Xuân Phương - Nam Từ Liêm, HN"),
-- ("Cầu Diễn - Bắc Từ Liêm, HN"),
-- ("Quận 1 - Thủ Đức, TP-HCM")

-- Thêm Bàn(tình trạng: 0 là còn trống, 1 là đã có người đặt)
-- INSERT INTO ban(SoNguoiToiDa, TinhTrang, MaCS)
-- VALUES
-- (6, 0, 1),
-- (12, 0, 1),
-- (12, 0, 1),
-- (6, 0, 1),
-- (12, 0, 1),
-- (12, 0, 1)

-- INSERT INTO ban(SoNguoiToiDa, TinhTrang, MaCS)
-- VALUES
-- (6, 0, 2),
-- (12, 0, 2),
-- (12, 0, 2),
-- (6, 0, 2),
-- (12, 0, 2),
-- (12, 0, 2)

