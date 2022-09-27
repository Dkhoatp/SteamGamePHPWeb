-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 16, 2022 lúc 08:49 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `steam`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buy`
--

CREATE TABLE `buy` (
  `buyID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gameID` varchar(200) NOT NULL,
  `DateBuy` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `event`
--

CREATE TABLE `event` (
  `eventID` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sales` varchar(200) NOT NULL,
  `DateStart` varchar(200) NOT NULL,
  `DateEnd` varchar(200) NOT NULL,
  `Status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image`
--

CREATE TABLE `image` (
  `img` int(11) NOT NULL,
  `gameID` varchar(200) NOT NULL,
  `imgURL` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `image`
--

INSERT INTO `image` (`img`, `gameID`, `imgURL`) VALUES
(1, 'A11', 'https://cdn.tgdd.vn/Files/2020/04/17/1249881/valorant-2_800x450.jpg'),
(11, 'A11', 'https://estnn.com/wp-content/uploads/2020/08/valguideft-747x420.png'),
(12, 'A11', 'https://motgame.vn/wp-content/uploads/2021/10/riot-chinh-sua-jett-thumb.jpg'),
(13, 'A12', './img/imgproduct/2-HN.jpg'),
(14, 'a15', './img/imgproduct/gau-bong-to-cao-cap-438x400.jpg'),
(15, 'a15', './img/imgproduct/giao-hang-gau.png'),
(16, 'a15', './img/imgproduct/giat-gau.png'),
(17, 'a18', './img/imgproduct/tho-trai-cay-4-310x310.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pruduct`
--

CREATE TABLE `pruduct` (
  `gameID` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `publisher` varchar(200) NOT NULL,
  `developers` varchar(200) NOT NULL,
  `releaseDate` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `URLvideo` varchar(256) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `pruduct`
--

INSERT INTO `pruduct` (`gameID`, `type`, `name`, `publisher`, `developers`, `releaseDate`, `description`, `price`, `URLvideo`, `status`) VALUES
('A11', 'Real-Time Strategy', 'Valorant', 'vn3', 'cuscs', '12/12/2006', 'Gun tay to', '150000', 'v5AEF6RMeEs', 'true'),
('a18', 'Real-Time Strategy', 'html', 'sadas', 'a', '2022-02-18', 'ád', '220000', '3jCXfWFQGeM', 'true');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type`
--

CREATE TABLE `type` (
  `Type_ID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `type`
--

INSERT INTO `type` (`Type_ID`, `Name`) VALUES
(1, 'FBS'),
(2, 'Role-Playing Game '),
(3, 'Real-Time Strategy'),
(4, 'Sports games');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `email` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`email`, `type`, `username`, `password`, `status`) VALUES
('dihi@gmail.com', 'user', 'dihihi', '123123Di', 'true'),
('khoa@gmail.com', 'Admin', 'Admin', '123123', 'true'),
('khoahih@gmail.com', 'user', 'khoahihi', '123123Khoa', 'true'),
('kittyhatlr@gmail.com', 'user', 'thanhnguyen', 'Thanh1231456', 'true'),
('lill@gmail.com', 'user', 'lill', 'Lill123456', 'true'),
('thanhnguyen2001tlt@gmail.com', 'user', 'divtc', 'Di1234567', 'true');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`buyID`);

--
-- Chỉ mục cho bảng `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`);

--
-- Chỉ mục cho bảng `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`img`);

--
-- Chỉ mục cho bảng `pruduct`
--
ALTER TABLE `pruduct`
  ADD PRIMARY KEY (`gameID`);

--
-- Chỉ mục cho bảng `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`Type_ID`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `buy`
--
ALTER TABLE `buy`
  MODIFY `buyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `image`
--
ALTER TABLE `image`
  MODIFY `img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
