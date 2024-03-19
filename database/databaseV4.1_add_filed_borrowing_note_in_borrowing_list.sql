-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 05:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `se_g9`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowing`
--

CREATE TABLE `borrowing` (
  `borrowing_id` int(11) NOT NULL,
  `borrow_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `borrowing_note` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `not_approved_note` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `id_sender` int(11) DEFAULT NULL,
  `id_approver` int(11) DEFAULT NULL,
  `id_checker` int(11) DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `borrowing`
--

INSERT INTO `borrowing` (`borrowing_id`, `borrow_date`, `due_date`, `return_date`, `borrowing_note`, `not_approved_note`, `approved_date`, `id_sender`, `id_approver`, `id_checker`, `status`) VALUES
(1, '2023-08-01', '2024-03-08', '2024-03-06', 'ใช้ในงานจัดโต๊ะทำบุญบริษัท', NULL, '2024-03-18', 2, 2, 3, 'รอการพิจารณา'),
(2, '2023-12-20', '2024-03-27', '2024-03-22', 'อากาศร้อนมาก', NULL, '2024-03-18', 2, 2, 3, 'รอการพิจารณา'),
(3, '2023-03-13', NULL, NULL, 'ใช้นอกสถานที่', NULL, '2024-03-18', 1, 2, NULL, 'รอการพิจารณา'),
(4, '2024-03-13', NULL, NULL, 'อยากเอาไปขาย', NULL, NULL, 3, NULL, NULL, 'รอการพิจารณา'),
(5, '2024-03-16', NULL, NULL, 'ยืมใช้แผนกบัญชี', NULL, NULL, 3, NULL, NULL, 'รอการพิจารณา'),
(6, '2024-03-16', NULL, NULL, 'ยืมใช้ในแผนกบุคคล', NULL, NULL, 2, NULL, NULL, 'รอการพิจารณา');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_list`
--

CREATE TABLE `borrowing_list` (
  `borrowing_list_id` int(11) NOT NULL,
  `borrowing_id` int(11) NOT NULL,
  `durable_articles_id` int(11) NOT NULL,
  `status_approved` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `not_approved_note` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `borrowing_note` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `borrowing_list`
--

INSERT INTO `borrowing_list` (`borrowing_list_id`, `borrowing_id`, `durable_articles_id`, `status_approved`, `not_approved_note`, `borrowing_note`) VALUES
(1, 3, 1, 'อนุมัติแล้ว', NULL, NULL),
(2, 3, 4, 'ไม่อนุมัติ', 'ทดลอง', NULL),
(3, 2, 2, 'อนุมัติแล้ว', NULL, NULL),
(4, 1, 1, 'อนุมัติแล้ว', NULL, NULL),
(7, 4, 4, 'รอการอนุมัติ', NULL, NULL),
(8, 4, 1, 'รอการอนุมัติ', NULL, NULL),
(9, 4, 2, 'รอการอนุมัติ', NULL, NULL),
(10, 4, 3, 'รอการอนุมัติ', NULL, NULL),
(11, 4, 5, 'รอการอนุมัติ', NULL, NULL),
(12, 6, 1, 'รอการอนุมัติ', NULL, NULL),
(13, 6, 4, 'รอการอนุมัติ', NULL, NULL),
(14, 5, 3, 'รอการอนุมัติ', NULL, NULL),
(15, 5, 4, 'รอการอนุมัติ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `disbursement`
--

CREATE TABLE `disbursement` (
  `disbursement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checker_id` int(11) DEFAULT NULL,
  `date_disbursement` date NOT NULL,
  `date_approved` date DEFAULT NULL,
  `note_disbursement` text NOT NULL,
  `note_approved` text DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `disbursement`
--

INSERT INTO `disbursement` (`disbursement_id`, `user_id`, `checker_id`, `date_disbursement`, `date_approved`, `note_disbursement`, `note_approved`, `status`) VALUES
(1, 1, NULL, '2024-03-14', '2024-03-18', 'ใช้ทำงานนอกสถานที่', 'ไม่อนุมัติการยืม 1', 'ไม่อนุมัติ'),
(2, 1, 2, '2024-03-14', '2024-03-15', 'ใช้งานเอกสาร', 'เยอะไป', 'ไม่อนุมัติ'),
(3, 3, NULL, '2024-03-15', '2024-03-16', 'ใช้ในออฟฟิศ', 'ไม่อนุญาต', 'ไม่อนุมัติ'),
(4, 3, NULL, '2024-03-15', NULL, 'ใช้ในการประชุมงบประมาณ', NULL, 'รอการอนุมัติ'),
(5, 2, NULL, '2024-03-15', '2024-03-16', 'เอกสารนักศึกษาฝึกงาน', NULL, 'อนุมัติแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `disbursement_detail`
--

CREATE TABLE `disbursement_detail` (
  `disbursement_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `disbursement_detail`
--

INSERT INTO `disbursement_detail` (`disbursement_id`, `material_id`, `amount`) VALUES
(2, 1, 400),
(1, 2, 5),
(1, 9, 6),
(3, 3, 20),
(4, 1, 100),
(4, 3, 10),
(5, 1, 300);

-- --------------------------------------------------------

--
-- Table structure for table `durable_articles`
--

CREATE TABLE `durable_articles` (
  `durable_articles_id` int(11) NOT NULL COMMENT 'ไอดีที่ใช้เชื่อม',
  `durable_articles_code` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'หมายเลขครุภัณฑ์',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `availability_status` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `condition_status` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `durable_articles`
--

INSERT INTO `durable_articles` (`durable_articles_id`, `durable_articles_code`, `name`, `availability_status`, `condition_status`) VALUES
(1, 'DA001', 'โต๊ะ 1 เมตร', 'พร้อมใช้งาน', 'ปกติ'),
(2, 'DA002', 'พัดลม 20 นิ้ว', 'ไม่พร้อมใช้งาน', 'หาย'),
(3, 'DA003', 'เก้าอี้สำนักงาน', 'ถูกยืม', 'ปกติ'),
(4, 'DA004', 'โน้ตบุ๊ก asus 01', 'ไม่พร้อมใช้งาน', 'ชำรุด'),
(5, 'DA005', 'PC HP123', 'พร้อมใช้งาน', 'ปกติ');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `amount` int(8) NOT NULL,
  `unit` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `name`, `amount`, `unit`) VALUES
(1, 'กระดาษ', 50, 'รีม'),
(2, 'ดินสอ', 80, 'แท่ง'),
(3, 'คลิปหนีบกระดาษ', 120, 'อัน'),
(4, 'น้ำยาลบคำผิด', 40, 'ชิ้น'),
(5, 'กาวแท่ง', 45, 'แท่ง'),
(6, 'กาวน้ำ', 68, 'อัน'),
(7, 'เทปแลคซีน', 85, 'ม้วน'),
(8, 'ลวดเย็บกระดาษ', 99, 'แพ็ค'),
(9, 'ยางลบ', 20, 'แพ็ค');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair_list`
--

CREATE TABLE `repair_list` (
  `no` int(11) NOT NULL,
  `durable_articles_id` int(11) NOT NULL,
  `durable_articles_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `inspector_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `detail` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `repair_list`
--

INSERT INTO `repair_list` (`no`, `durable_articles_id`, `durable_articles_name`, `inspector_name`, `status`, `detail`) VALUES
(1, 1, 'โต๊ะ 1 เมตร', 'อิโนสุเกะ', 'ชำรุด', 'ขาหัก');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'แอดมิน'),
(2, 'ผู้ใช้งาน'),
(3, 'เจ้าหน้าที่พัสดุ'),
(4, 'ช่างซ่อมบำรุง');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(7, 1, 1),
(8, 2, 3),
(9, 1, 2),
(10, 1, 3),
(11, 1, 4),
(12, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `date_stock` date NOT NULL,
  `id_stocker` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `date_stock`, `id_stocker`) VALUES
(44, '2024-03-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stocks_lists`
--

CREATE TABLE `stocks_lists` (
  `id` int(11) NOT NULL,
  `id_stock` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL COMMENT 'จำนวน'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stocks_lists`
--

INSERT INTO `stocks_lists` (`id`, `id_stock`, `material_id`, `quantity`) VALUES
(61, 44, 1, 1),
(62, 44, 2, 2),
(63, 44, 3, 3),
(64, 44, 4, 4),
(65, 44, 5, 5),
(66, 44, 6, 6),
(67, 44, 7, 7),
(68, 44, 8, 8),
(69, 44, 9, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$12$vifA.PZ7tH7A7dbDmpCgX./n7FWXS0r9jt4ci2RQFNOMK24erTxXG', NULL, NULL, '2024-03-09 08:47:15'),
(2, 'parcel', 'officer', 'parcel.officer@gmail.com', NULL, '$2y$12$td9xMQIOFqKdarLLIWibG.VelWF1dGEd8bs64OMHPy/dc0s/KgOo2', NULL, '2024-03-07 10:14:05', '2024-03-07 10:14:05'),
(3, 'technician', 'officer', 'technician@gmail.com', NULL, '$2y$12$8IFVXz0wALIQ3A6uKkXKteLuuupSg/djpTiGnBKB1kFDPCqdP/e4e', NULL, '2024-03-10 07:03:01', '2024-03-10 07:03:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`borrowing_id`),
  ADD KEY `id` (`id_sender`),
  ADD KEY `id_approver` (`id_approver`),
  ADD KEY `id_checker` (`id_checker`);

--
-- Indexes for table `borrowing_list`
--
ALTER TABLE `borrowing_list`
  ADD PRIMARY KEY (`borrowing_list_id`),
  ADD KEY `borrowing_id` (`borrowing_id`),
  ADD KEY `durable_articles_id` (`durable_articles_id`);

--
-- Indexes for table `disbursement`
--
ALTER TABLE `disbursement`
  ADD PRIMARY KEY (`disbursement_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `checker_id` (`checker_id`);

--
-- Indexes for table `disbursement_detail`
--
ALTER TABLE `disbursement_detail`
  ADD KEY `disbursement_id` (`disbursement_id`),
  ADD KEY `item_id` (`material_id`);

--
-- Indexes for table `durable_articles`
--
ALTER TABLE `durable_articles`
  ADD PRIMARY KEY (`durable_articles_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `repair_list`
--
ALTER TABLE `repair_list`
  ADD PRIMARY KEY (`no`),
  ADD KEY `durable_articles_id` (`durable_articles_id`),
  ADD KEY `durable_articles_name` (`durable_articles_name`),
  ADD KEY `inspector_name` (`inspector_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_stocker` (`id_stocker`);

--
-- Indexes for table `stocks_lists`
--
ALTER TABLE `stocks_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_stock_2` (`id_stock`,`material_id`),
  ADD KEY `stocks_lists_ibfk_2` (`material_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `borrowing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `borrowing_list`
--
ALTER TABLE `borrowing_list`
  MODIFY `borrowing_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `disbursement`
--
ALTER TABLE `disbursement`
  MODIFY `disbursement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `durable_articles`
--
ALTER TABLE `durable_articles`
  MODIFY `durable_articles_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีที่ใช้เชื่อม', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repair_list`
--
ALTER TABLE `repair_list`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `stocks_lists`
--
ALTER TABLE `stocks_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `borrowing_ibfk_1` FOREIGN KEY (`id_sender`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `borrowing_ibfk_2` FOREIGN KEY (`id_approver`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `borrowing_ibfk_3` FOREIGN KEY (`id_checker`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `borrowing_list`
--
ALTER TABLE `borrowing_list`
  ADD CONSTRAINT `borrowing_list_ibfk_1` FOREIGN KEY (`borrowing_id`) REFERENCES `borrowing` (`borrowing_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrowing_list_ibfk_2` FOREIGN KEY (`durable_articles_id`) REFERENCES `durable_articles` (`durable_articles_id`);

--
-- Constraints for table `disbursement`
--
ALTER TABLE `disbursement`
  ADD CONSTRAINT `disbursement_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disbursement_ibfk_2` FOREIGN KEY (`checker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disbursement_detail`
--
ALTER TABLE `disbursement_detail`
  ADD CONSTRAINT `disbursement_detail_ibfk_1` FOREIGN KEY (`disbursement_id`) REFERENCES `disbursement` (`disbursement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disbursement_detail_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repair_list`
--
ALTER TABLE `repair_list`
  ADD CONSTRAINT `repair_list_ibfk_1` FOREIGN KEY (`durable_articles_id`) REFERENCES `durable_articles` (`durable_articles_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`id_stocker`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `stocks_lists`
--
ALTER TABLE `stocks_lists`
  ADD CONSTRAINT `stocks_lists_ibfk_1` FOREIGN KEY (`id_stock`) REFERENCES `stocks` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `stocks_lists_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
