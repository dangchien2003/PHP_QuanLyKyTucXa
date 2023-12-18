-- add cột
ALTER TABLE `sinhvien` ADD `gioiTinh` TINYINT(1) NULL AFTER `hoTen`;
ALTER TABLE `nhanvien` ADD `gioiTinh` TINYINT(1) NULL AFTER `hoTen`;