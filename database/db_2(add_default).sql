ALTER TABLE `nhanvien` CHANGE `kyHieu` `kyHieu` VARCHAR(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'NV';

ALTER TABLE `hoadondiennuoc` CHANGE `kyHieu` `kyHieu` VARCHAR(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'HDDN';

ALTER TABLE `hoadonguixe` CHANGE `kyHieu` `kyHieu` VARCHAR(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'HDX';

ALTER TABLE `hoadonphong` CHANGE `kyHieu` `kyHieu` VARCHAR(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'HDP';

ALTER TABLE `hopdong` CHANGE `kyHieu` `kyHieu` VARCHAR(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'HDCN';

ALTER TABLE `phong` CHANGE `kyHieu` `kyHieu` VARCHAR(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'P';

ALTER TABLE `sinhvien` CHANGE `kyHieu` `kyHieu` VARCHAR(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'SV';

ALTER TABLE `thexe` CHANGE `kyHieu` `kyHieu` VARCHAR(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'TX';

