-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 30, 2022 lúc 05:14 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `foodpicky2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(6, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@gmail.com', '', '2022-03-20 09:36:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_codes`
--

CREATE TABLE `admin_codes` (
  `id` int(222) NOT NULL,
  `codes` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `codes`) VALUES
(1, 'QX5ZMN'),
(2, 'QFE6ZM'),
(3, 'QMZR92'),
(4, 'QPGIOV'),
(5, 'QSTE52'),
(6, 'QMTZ2J');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES
(3, 7, 'Combo 1', '1 Hamburger + 1 Đùi gà + 1 Pepsi', '35000', 'burger_ga_pep.png'),
(5, 7, 'Combo 2', '1 Cơm trắng + 1 Gà giòn + 1 Pepsi + 1 Canh rong biển', '35000', 'com_ga_pep.png'),
(7, 7, 'Combo 3', '1 Mỳ ý sốt + 1 pepsi + 1 gà giòn', '35000', 'my_ga_pep.png'),
(10, 1, '4 Miếng gà giòn', '', '70000', '4_mieng_ga_gion.png'),
(11, 1, '2 Miếng gà giòn', '', '30000', '2_mieng_ga_gion.png'),
(12, 1, 'Gà sốt cay', '', '25000', 'ga_sot_cay.png'),
(13, 1, '6 Miếng gà giòn', '', '90000', '6_ga_gion.png'),
(22, 4, 'Hamburger bò trứng', '', '26000', 'Hamburger_bo_trung.png'),
(40, 4, 'Hamburger tôm', '', '26000', 'burger_tom.png'),
(44, 4, 'Hamburger bò phô mai', '', '29000', 'burger_phomai.png'),
(62, 8, '7 up', '', '10000', '7up.png'),
(64, 4, 'Hamburger gà quay', '', '25000', 'burger_ga_quay.png'),
(65, 5, 'Cơm gà giòn', '', '30000', 'com_ga_gion.png'),
(67, 5, 'Cơm gà viên', '', '32000', 'com_ga_vien.png'),
(68, 5, 'Cơm thịt bò', '', '32000', 'com_thit_bo.png'),
(69, 1, '1 Miếng gà giòn', '', '25000', 'ga_gion.png'),
(70, 4, 'Hamburger bò', '', '25000', 'Hamburger_bo.png'),
(71, 4, 'Hamburger cá', '', '25000', 'Hamburger_ca.png'),
(72, 1, 'Gà không xương', '', '22000', 'ga_ko_xuong_gion.png'),
(73, 3, 'Kem dâu', '', '8000', 'kemdau.png'),
(74, 3, 'Kem socola', '', '8000', 'kemsocola.png'),
(75, 8, 'Pepsi', '', '10000', 'pepsi.png'),
(76, 8, 'Mirinda cam', '', '10000', 'mirinda_cam.png'),
(77, 8, 'Nước suối', '', '8000', 'nuocsuoi.png'),
(79, 5, 'Mỳ ý sốt bò bằm', '', '27000', 'my_y_sot.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(71, 39, 'in process', 'Dispatching...', '2022-03-17 12:31:14'),
(72, 39, 'closed', 'Order delivered.', '2022-03-17 12:35:00'),
(73, 42, 'closed', 'Order delivered & payment received successfully.', '2022-03-23 13:53:20'),
(74, 47, 'rejected', 'Order Cancelled by User.', '2022-03-23 13:54:08'),
(75, 43, 'in process', 'Expected Delivery: 25th March, Friday ', '2022-03-23 14:07:03'),
(76, 43, 'closed', 'xong', '2022-09-14 11:20:50'),
(77, 48, 'rejected', 'huy', '2022-09-14 11:21:22'),
(78, 49, 'closed', '11', '2022-09-14 11:24:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `restaurant`
--

CREATE TABLE `restaurant` (
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `restaurant`
--

INSERT INTO `restaurant` (`rs_id`, `title`, `image`, `date`) VALUES
(1, 'Gà', 'logo_ga.png', '2022-09-30 03:06:13'),
(3, 'Kem', 'kemlogo.png', '2022-09-30 03:05:02'),
(4, 'Hamburger', 'burger_logo.png', '2022-09-30 03:07:24'),
(5, 'Mỳ ý - Cơm', 'rice_logo.png', '2022-09-30 03:04:53'),
(7, 'Combo', 'combo_logo.png', '2022-09-30 03:04:28'),
(8, 'Đồ uống', 'douonglogo.png', '2022-09-30 03:05:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `res_category`
--

CREATE TABLE `res_category` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`, `date`) VALUES
(12, 'Cafe', '2022-03-05 14:07:48'),
(13, 'Chettinadu', '2022-03-05 14:10:18'),
(14, 'Multicuisine', '2022-03-05 14:10:36'),
(15, 'North-Indian', '2022-03-09 15:39:06'),
(16, 'South-Indian', '2022-03-09 15:38:14'),
(17, 'Chinese', '2022-03-05 14:11:08'),
(18, 'French', '2022-03-05 14:11:22'),
(19, 'Italian', '2022-03-05 14:11:30'),
(20, 'Continental', '2022-03-17 12:10:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(39, 'trantan', 'tran', 'tan', 'tantran@gmail.com', '0934721789', '001122', 'so 3 duong ABC ', 1, '2022-09-14 11:17:48'),
(40, 'thanhminh', 'minh', 'thanh', 'minhthanh@gmail.com', '7629313490', '18275a3df7a93d896d3179c612d92fe1', 'so 15 phan ngoc hien ', 1, '2022-09-14 11:18:58'),
(45, 'trong', 'Tô', 'Trọng', 'trong@gmail.com', '0999999999', '4297f44b13955235245b2497399d7a93', '', 1, '2022-09-14 11:23:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES
(42, 42, 'Creamy Herb Chicken', 1, '499.00', 'closed', '2022-03-23 13:53:20'),
(44, 41, 'Chicken Chettinad Curry', 1, '350.00', NULL, '2022-03-23 13:47:01'),
(45, 43, 'Coconut Rice', 1, '150.00', NULL, '2022-03-23 13:47:38'),
(46, 44, 'Schezwan Fried Rice', 1, '200.00', NULL, '2022-03-23 13:51:12'),
(47, 44, 'Schezwan Noodles', 1, '150.00', 'rejected', '2022-03-23 13:54:08');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Chỉ mục cho bảng `admin_codes`
--
ALTER TABLE `admin_codes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Chỉ mục cho bảng `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`rs_id`);

--
-- Chỉ mục cho bảng `res_category`
--
ALTER TABLE `res_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Chỉ mục cho bảng `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `admin_codes`
--
ALTER TABLE `admin_codes`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT cho bảng `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `rs_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `res_category`
--
ALTER TABLE `res_category`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
