-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th3 04, 2022 lúc 08:55 AM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fakelink`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `bank_name` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `account_name` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `account_number` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `branch` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `account_name`, `account_number`, `branch`, `image`) VALUES
(2, 'Vietcombank', 'NGUYEN TAN THANH', '123456789', 'Tay Ninh', NULL),
(4, 'Ví MOMO', 'NGUYEN TAN THANH', '0947838128', '', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_logs`
--

CREATE TABLE `bank_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `tid` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `description` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time` datetime NOT NULL,
  `bank_name` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `trans_id` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `name` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `url_1` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `url_2` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `block_desktop` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `campaigns`
--

INSERT INTO `campaigns` (`id`, `user_id`, `trans_id`, `name`, `url_1`, `url_2`, `status`, `views`, `createdate`, `updatedate`, `block_desktop`) VALUES
(4, 1, '2B9NZM', 'Chiến dịch test', 'http://localhost/CMSNT/FAKELINK/test1.php', 'http://localhost/CMSNT/FAKELINK/test2.php', '1', 16, '2021-07-29 00:43:43', '2021-07-29 21:48:54', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `campaign_views`
--

CREATE TABLE `campaign_views` (
  `id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL DEFAULT 0,
  `country` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `UserAgent` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `device` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `browser` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `campaign_views`
--

INSERT INTO `campaign_views` (`id`, `campaign_id`, `country`, `ip`, `UserAgent`, `device`, `browser`, `redirect`, `createdate`) VALUES
(1, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test1.php', '2021-07-29 01:20:41'),
(2, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test1.php', '2021-07-29 01:20:48'),
(3, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test2.php', '2021-07-29 01:20:57'),
(4, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test2.php', '2021-07-29 01:21:01'),
(5, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test2.php', '2021-07-29 01:21:10'),
(6, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test2.php', '2021-07-29 01:21:14'),
(7, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test2.php', '2021-07-29 01:21:35'),
(8, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test1.php', '2021-07-29 01:21:55'),
(9, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test1.php', '2021-07-29 01:21:59'),
(10, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test1.php', '2021-07-29 01:22:11'),
(11, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test1.php', '2021-07-29 02:06:12'),
(12, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test1.php', '2021-07-29 02:06:15'),
(13, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test2.php', '2021-07-29 02:12:58'),
(14, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test1.php', '2021-07-29 23:50:19'),
(15, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test1.php', '2021-08-02 08:35:49'),
(16, 4, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', 'Desktop', 'Google Chrome', 'http://localhost/CMSNT/FAKELINK/test1.php', '2021-08-03 02:35:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `domains`
--

CREATE TABLE `domains` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `domain` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `share` int(11) NOT NULL DEFAULT 0,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `domains`
--

INSERT INTO `domains` (`id`, `user_id`, `domain`, `status`, `share`, `createdate`, `updatedate`) VALUES
(1, 1, 'http://localhost/CMSNT.CO/FAKELINK', 1, 1, '2021-09-16 11:26:09', '2021-09-16 12:41:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dongtien`
--

CREATE TABLE `dongtien` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `sotientruoc` int(11) NOT NULL DEFAULT 0,
  `sotienthaydoi` int(11) NOT NULL DEFAULT 0,
  `sotiensau` int(11) NOT NULL DEFAULT 0,
  `thoigian` datetime NOT NULL,
  `noidung` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `dongtien`
--

INSERT INTO `dongtien` (`id`, `user_id`, `sotientruoc`, `sotienthaydoi`, `sotiensau`, `thoigian`, `noidung`) VALUES
(1, 1, 10000000, 100000, 9900000, '2021-07-31 23:58:55', 'Thanh toán gói Basic'),
(2, 1, 9900000, 100000, 9800000, '2021-07-31 23:59:52', 'Thanh toán gói Basic'),
(3, 1, 9800000, 100000, 9700000, '2021-08-01 00:00:11', 'Thanh toán gói Basic'),
(4, 1, 9700000, 100000, 9600000, '2021-08-01 00:00:42', 'Thanh toán gói Basic'),
(5, 1, 9600000, 100000, 9500000, '2021-08-01 00:01:43', 'Thanh toán gói Basic'),
(6, 1, 9500000, 100000, 9400000, '2021-08-01 00:02:34', 'Thanh toán gói Basic'),
(7, 1, 9400000, 300000, 9100000, '2021-08-01 00:02:43', 'Thanh toán gói Standard'),
(8, 1, 9100000, 100000, 9000000, '2021-08-01 00:05:11', 'Thanh toán gói Basic'),
(9, 1, 9000000, 100000, 8900000, '2021-08-01 00:05:13', 'Thanh toán gói Basic'),
(10, 1, 8900000, 100000, 8800000, '2021-08-01 00:05:40', 'Thanh toán gói Basic'),
(11, 1, 8800000, 100000, 8700000, '2021-08-01 01:12:14', 'Thanh toán gói Basic'),
(12, 1, 8700000, 3000000, 5700000, '2021-08-01 01:54:46', 'Thanh toán gói Premium');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `url_img` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `url_href` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `domain` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `url_fake` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `links`
--

INSERT INTO `links` (`id`, `title`, `description`, `url_img`, `url_href`, `domain`, `url_fake`, `createdate`, `updatedate`, `status`, `views`, `user_id`) VALUES
(1, 'Test', '', 'assets/storage/images/flink_42365.png', 'https://my.vnpt.com.vn/', 'http://localhost/CMSNT.CO/FAKELINK', 'qOgh5', '2021-10-20 19:55:44', '2021-10-20 19:56:08', '1', 0, 1),
(2, 'Test', '', 'assets/storage/images/flink_42365.png', 'https://my.vnpt.com.vn/', 'http://localhost/CMSNT.CO/FAKELINK', 'iV5Ysh9', '2021-10-20 19:56:20', '2021-10-20 19:56:20', '1', 0, 1),
(3, 'Test', '', 'assets/storage/images/flink_42365.png', 'https://my.vnpt.com.vn/', 'http://localhost/CMSNT.CO/FAKELINK', 'YJ0d3TH', '2021-10-20 19:56:20', '2021-10-20 19:56:20', '1', 0, 1),
(4, 'Test', '', 'assets/storage/images/flink_42365.png', 'https://my.vnpt.com.vn/', 'http://localhost/CMSNT.CO/FAKELINK', 'ct1ZYnz', '2021-10-20 19:56:20', '2021-10-20 19:56:20', '1', 0, 1),
(5, 'Test', '', 'assets/storage/images/flink_42365.png', 'https://my.vnpt.com.vn/', 'http://localhost/CMSNT.CO/FAKELINK', 'G6yxYSh', '2021-10-20 19:56:20', '2021-10-20 19:56:20', '1', 2, 1),
(6, 'Test', '', 'assets/storage/images/flink_42365.png', 'https://my.vnpt.com.vn/', 'http://localhost/CMSNT.CO/FAKELINK', 'qrf5O4F', '2021-10-20 19:56:20', '2021-10-20 19:56:20', '1', 0, 1),
(7, 'Test', '', 'assets/storage/images/flink_42365.png', 'https://my.vnpt.com.vn/', 'http://localhost/CMSNT.CO/FAKELINK', 'VnISHX7', '2021-10-20 20:01:03', '2021-10-20 20:01:03', '1', 0, 1),
(8, 'Test', '', 'assets/storage/images/flink_42365.png', 'https://my.vnpt.com.vn/', 'http://localhost/CMSNT.CO/FAKELINK', 'xMvJUBy', '2021-10-20 20:01:03', '2021-10-20 20:01:03', '1', 0, 1),
(9, 'Test', '', 'assets/storage/images/flink_42365.png', 'https://my.vnpt.com.vn/', 'http://localhost/CMSNT.CO/FAKELINK', 'C2rTpP9', '2021-10-20 20:01:03', '2021-10-20 20:01:03', '1', 0, 1),
(10, 'Test', '', 'assets/storage/images/flink_42365.png', 'https://my.vnpt.com.vn/', 'http://localhost/CMSNT.CO/FAKELINK', '4tpKrx7', '2021-10-20 20:01:03', '2021-10-20 20:01:03', '1', 0, 1),
(11, 'Test', '', 'assets/storage/images/flink_42365.png', 'https://my.vnpt.com.vn/', 'http://localhost/CMSNT.CO/FAKELINK', 'QJkU2PB', '2021-10-20 20:01:03', '2021-10-20 20:01:03', '1', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `link_views`
--

CREATE TABLE `link_views` (
  `id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL DEFAULT 0,
  `country` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `UserAgent` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `device` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `browser` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `online` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `link_views`
--

INSERT INTO `link_views` (`id`, `link_id`, `country`, `ip`, `UserAgent`, `device`, `browser`, `redirect`, `createdate`, `online`) VALUES
(13, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', NULL, '2021-07-28 04:59:38', 1644427964),
(14, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Tablet', 'Google Chrome', NULL, '2021-07-28 04:59:38', 0),
(16, 1, 'VN', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:88.0) Gecko/20100101 Firefox/88.0', 'Desktop', 'Mozilla Firefox', NULL, '2021-07-28 05:00:26', 1644427964),
(17, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Opera', NULL, '2021-07-28 05:02:12', 0),
(18, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Phone', 'Apple Safari', NULL, '2021-07-28 05:02:12', 0),
(19, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Internet Explorer', NULL, '2021-07-28 05:02:12', 0),
(20, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Mozilla Firefox', NULL, '2021-07-28 05:03:03', 1644429147),
(21, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', NULL, '2021-07-28 05:03:03', 0),
(22, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', NULL, '2021-07-28 05:20:25', 1644427964),
(23, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Mozilla Firefox', NULL, '2021-07-28 05:20:29', 0),
(24, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', NULL, '2021-07-28 05:21:59', 0),
(25, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', NULL, '2021-07-28 05:23:16', 1644429147),
(26, 1, 'VN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36', 'Desktop', 'Google Chrome', NULL, '2021-07-28 06:14:35', 0),
(27, 6, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36', 'Desktop', 'Google Chrome', 'https://card24h.com/', '2021-09-16 11:26:20', 0),
(28, 6, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36', 'Desktop', 'Google Chrome', 'https://card24h.com/', '2021-09-16 11:26:26', 1644429147),
(29, 6, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36', 'Desktop', 'Google Chrome', 'https://card24h.com/', '2021-09-16 11:29:34', 0),
(30, 6, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36', 'Desktop', 'Google Chrome', 'https://card24h.com/', '2021-09-16 11:29:39', 0),
(31, 6, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36', 'Desktop', 'Google Chrome', 'https://card24h.com/', '2021-09-16 12:12:05', 1644429147),
(32, 6, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36', 'Desktop', 'Google Chrome', 'https://card24h.com/', '2021-09-16 12:41:43', 0),
(33, 37, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36', 'Desktop', 'Google Chrome', 'https://card24h.com/', '2021-09-16 14:25:05', 1644429147),
(34, 5, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36', 'Desktop', 'Google Chrome', 'https://my.vnpt.com.vn/', '2021-10-20 20:00:12', 1644429147),
(35, 5, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36', 'Desktop', 'Google Chrome', 'https://my.vnpt.com.vn/', '2021-10-20 20:00:33', 0),
(36, 11, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36', 'Desktop', 'Google Chrome', 'https://my.vnpt.com.vn/', '2021-10-23 17:49:46', 0),
(37, 5, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36', 'Desktop', 'Google Chrome', 'https://my.vnpt.com.vn/', '2021-10-20 20:00:12', 1644429147),
(38, 5, 'VN', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36', 'Desktop', 'Google Chrome', 'https://my.vnpt.com.vn/', '2021-10-20 20:00:12', 1644429147);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `href` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `icon` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `target` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `momo_logs`
--

CREATE TABLE `momo_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `tranId` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `partnerId` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `partnerName` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `comment` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `expired` int(11) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `packages`
--

INSERT INTO `packages` (`id`, `name`, `expired`, `price`) VALUES
(1, 'Basic', 7, 100000),
(3, 'Standard', 30, 300000),
(4, 'Premium', 365, 3000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `package_logs`
--

CREATE TABLE `package_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `expired` int(11) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL DEFAULT 0,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `package_logs`
--

INSERT INTO `package_logs` (`id`, `user_id`, `name`, `expired`, `price`, `createdate`) VALUES
(1, 1, 'Basic', 7, 100000, '2021-07-31 23:58:55'),
(2, 1, 'Basic', 7, 100000, '2021-07-31 23:59:52'),
(3, 1, 'Basic', 7, 100000, '2021-08-01 00:00:11'),
(4, 1, 'Basic', 7, 100000, '2021-08-01 00:00:42'),
(5, 1, 'Basic', 7, 100000, '2021-08-01 00:01:43'),
(6, 1, 'Basic', 7, 100000, '2021-08-01 00:02:34'),
(7, 1, 'Standard', 30, 300000, '2021-08-01 00:02:43'),
(8, 1, 'Basic', 7, 100000, '2021-08-01 00:05:11'),
(9, 1, 'Basic', 7, 100000, '2021-08-01 00:05:13'),
(10, 1, 'Basic', 7, 100000, '2021-08-01 00:05:40'),
(11, 1, 'Basic', 7, 100000, '2021-08-01 01:12:14'),
(12, 1, 'Premium', 365, 3000000, '2021-08-01 01:54:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'logo', 'assets/img/cmsnt_light.png'),
(2, 'title', 'CMSNT.CO'),
(3, 'thongbao', '<p>Th&ocirc;ng b&aacute;o to&agrave;n hệ thống tại đ&acirc;y...............................................................<img alt=\"smiley\" src=\"http://localhost/CMSNT/FAKELINK/template/ckeditor/plugins/smiley/images/regular_smile.png\" style=\"height:23px; width:23px\" title=\"smiley\" /></p>\r\n'),
(4, 'logo_light', 'assets/img/cmsnt_light.png'),
(5, 'logo_dark', 'assets/img/cmsnt_dark.png'),
(6, 'image', 'assets/storage/images/imageLHX.png'),
(7, 'favicon', 'assets/storage/images/faviconJS8.png'),
(8, 'description', ''),
(9, 'keywords', ''),
(10, 'author', ''),
(11, 'status', '1'),
(12, 'status_bank', '1'),
(13, 'type_bank', 'Vietcombank'),
(14, 'stk_bank', ''),
(15, 'name_bank', ''),
(16, 'mk_bank', ''),
(17, 'status_momo', '1'),
(18, 'token_momo', ''),
(19, 'sdt_momo', ''),
(20, 'name_momo', ''),
(21, 'timeUpdate', ''),
(22, 'rate_package_7', '100000'),
(23, 'rate_package_30', '300000'),
(24, 'rate_package_365', '3000000'),
(25, 'recharge_content', 'NAPTIEN'),
(26, 'recharge_notice', '<ul>\r\n	<li><span style=\"font-size:18px\">Vui l&ograve;ng nhập đ&uacute;ng th&ocirc;ng tin v&agrave; nội dung chuyển tiền.</span></li>\r\n	<li><span style=\"font-size:18px\">Hệ thống sẽ xử l&yacute; nạp tiền tự động khi qu&yacute; kh&aacute;ch nhập đ&uacute;ng nội dung chuyển tiền.</span></li>\r\n	<li><span style=\"font-size:18px\">Sai s&oacute;t trong qu&aacute; tr&igrave;nh nạp tiền vui l&ograve;ng inbox ngay cho Admin để được xử l&yacute;.</span></li>\r\n</ul>\r\n'),
(27, 'token_bank', ''),
(28, 'javascript', '<div class=\"snowflakes\" aria-hidden=\"true\">\r\n  <div class=\"snowflake\">❅</div>\r\n  <div class=\"snowflake\">❆</div>\r\n  <div class=\"snowflake\">❅</div>\r\n  <div class=\"snowflake\">❆</div>\r\n  <div class=\"snowflake\">❅</div>\r\n  <div class=\"snowflake\">❆</div>\r\n  <div class=\"snowflake\">❅</div>\r\n  <div class=\"snowflake\">❆</div>\r\n  <div class=\"snowflake\">❅</div>\r\n  <div class=\"snowflake\">❆</div>\r\n  <div class=\"snowflake\">❅</div>\r\n  <div class=\"snowflake\">❆</div>\r\n</div>\r\n\r\n<style>\r\n  @-webkit-keyframes snowflakes-fall {\r\n    0% {top:-10%}\r\n    100% {top:100%}\r\n  }\r\n  @-webkit-keyframes snowflakes-shake {\r\n    0%,100% {-webkit-transform:translateX(0);transform:translateX(0)}\r\n    50% {-webkit-transform:translateX(80px);transform:translateX(80px)}\r\n  }\r\n  @keyframes snowflakes-fall {\r\n    0% {top:-10%}\r\n    100% {top:100%}\r\n  }\r\n  @keyframes snowflakes-shake {\r\n    0%,100%{ transform:translateX(0)}\r\n    50% {transform:translateX(80px)}\r\n  }\r\n  .snowflake {\r\n    color: #fff;\r\n    font-size: 1em;\r\n    font-family: Arial, sans-serif;\r\n    text-shadow: 0 0 5px #000;\r\n    position:fixed;\r\n    top:-10%;\r\n    z-index:9999;\r\n    -webkit-user-select:none;\r\n    -moz-user-select:none;\r\n    -ms-user-select:none;\r\n    user-select:none;\r\n    cursor:default;\r\n    -webkit-animation-name:snowflakes-fall,snowflakes-shake;\r\n    -webkit-animation-duration:10s,3s;\r\n    -webkit-animation-timing-function:linear,ease-in-out;\r\n    -webkit-animation-iteration-count:infinite,infinite;\r\n    -webkit-animation-play-state:running,running;\r\n    animation-name:snowflakes-fall,snowflakes-shake;\r\n    animation-duration:10s,3s;\r\n    animation-timing-function:linear,ease-in-out;\r\n    animation-iteration-count:infinite,infinite;\r\n    animation-play-state:running,running;\r\n  }\r\n  .snowflake:nth-of-type(0){\r\n    left:1%;-webkit-animation-delay:0s,0s;animation-delay:0s,0s\r\n  }\r\n  .snowflake:nth-of-type(1){\r\n    left:10%;-webkit-animation-delay:1s,1s;animation-delay:1s,1s\r\n  }\r\n  .snowflake:nth-of-type(2){\r\n    left:20%;-webkit-animation-delay:6s,.5s;animation-delay:6s,.5s\r\n  }\r\n  .snowflake:nth-of-type(3){\r\n    left:30%;-webkit-animation-delay:4s,2s;animation-delay:4s,2s\r\n  }\r\n  .snowflake:nth-of-type(4){\r\n    left:40%;-webkit-animation-delay:2s,2s;animation-delay:2s,2s\r\n  }\r\n  .snowflake:nth-of-type(5){\r\n    left:50%;-webkit-animation-delay:8s,3s;animation-delay:8s,3s\r\n  }\r\n  .snowflake:nth-of-type(6){\r\n    left:60%;-webkit-animation-delay:6s,2s;animation-delay:6s,2s\r\n  }\r\n  .snowflake:nth-of-type(7){\r\n    left:70%;-webkit-animation-delay:2.5s,1s;animation-delay:2.5s,1s\r\n  }\r\n  .snowflake:nth-of-type(8){\r\n    left:80%;-webkit-animation-delay:1s,0s;animation-delay:1s,0s\r\n  }\r\n  .snowflake:nth-of-type(9){\r\n    left:90%;-webkit-animation-delay:3s,1.5s;animation-delay:3s,1.5s\r\n  }\r\n  .snowflake:nth-of-type(10){\r\n    left:25%;-webkit-animation-delay:2s,0s;animation-delay:2s,0s\r\n  }\r\n  .snowflake:nth-of-type(11){\r\n    left:65%;-webkit-animation-delay:4s,2.5s;animation-delay:4s,2.5s\r\n  }\r\n</style>'),
(29, 'boclink_notice', '<p>Lưu &yacute; ri&ecirc;ng cho chức năng BỌC LINK VPCS</p>\r\n'),
(30, 'fakelink_notice', '<p>Lưu &yacute; ri&ecirc;ng cho chức năng FAKE LINK</p>\r\n'),
(31, 'email_smtp', ''),
(32, 'pass_email_smtp', ''),
(33, 'shortenlink_notice', ''),
(34, 'bg_login', 'template/DeskApp/vendors/images/login-page-img.png'),
(35, 'bg_register', 'template/DeskApp/vendors/images/register-page-img.png'),
(36, 'time_cron_24h', '0'),
(37, 'status_demo', '0'),
(38, 'url_fake', 'i'),
(39, 'license_key', 'f23be68135fa7f0b43d2abacc4387221');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email_verified` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time_verified` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `full_name` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `birthday` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `gender` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `money` int(11) DEFAULT 0,
  `total_money` int(11) DEFAULT 0,
  `used_money` int(11) DEFAULT 0,
  `createdate` datetime DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `admin` int(11) DEFAULT 0,
  `banned` int(11) DEFAULT 0,
  `phone` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `otp` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time_otp` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time_session` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `expired` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified`, `time_verified`, `full_name`, `birthday`, `gender`, `password`, `money`, `total_money`, `used_money`, `createdate`, `updatedate`, `device`, `ip`, `admin`, `banned`, `phone`, `otp`, `time_otp`, `time_session`, `expired`) VALUES
(1, 'admin', 'ntt2001811@gmail.com', 'jg6THXbItW5k13B8ys7DKhQzeA0LJOSq', '1627867905', 'Nguyễn Thành', '02 Tháng Tám 2021', 'Male', 'admin', 5700000, 10000000, 0, '2021-07-29 04:48:18', '2022-03-04 14:53:30', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36', '::1', 1, 0, '0947838128', '', '', '1646380410', 464),
(3, 'adad', 'adad@gmail.com', '', NULL, NULL, NULL, NULL, 'adad', 0, 0, 0, '2021-07-29 04:48:07', '2021-07-29 04:48:07', '', '', 0, 0, '', '', '', '1628247419', 0),
(4, 'adadadad', 'adaadadd@gmail.com', '', NULL, NULL, NULL, NULL, 'adad', 0, 0, 0, '2021-07-29 04:50:10', '2021-07-29 04:50:10', '', '', 0, 0, '', '', '', '1621547419', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bank_logs`
--
ALTER TABLE `bank_logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`),
  ADD UNIQUE KEY `trans_id_2` (`trans_id`),
  ADD UNIQUE KEY `trans_id_3` (`trans_id`),
  ADD UNIQUE KEY `trans_id_4` (`trans_id`),
  ADD UNIQUE KEY `trans_id_5` (`trans_id`),
  ADD UNIQUE KEY `trans_id_6` (`trans_id`),
  ADD UNIQUE KEY `trans_id_7` (`trans_id`),
  ADD UNIQUE KEY `trans_id_8` (`trans_id`),
  ADD UNIQUE KEY `trans_id_9` (`trans_id`),
  ADD UNIQUE KEY `trans_id_10` (`trans_id`),
  ADD UNIQUE KEY `trans_id_11` (`trans_id`),
  ADD UNIQUE KEY `trans_id_12` (`trans_id`),
  ADD UNIQUE KEY `trans_id_13` (`trans_id`),
  ADD UNIQUE KEY `trans_id_14` (`trans_id`),
  ADD UNIQUE KEY `trans_id_15` (`trans_id`),
  ADD UNIQUE KEY `trans_id_16` (`trans_id`),
  ADD UNIQUE KEY `trans_id_17` (`trans_id`);

--
-- Chỉ mục cho bảng `campaign_views`
--
ALTER TABLE `campaign_views`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `link_views`
--
ALTER TABLE `link_views`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `momo_logs`
--
ALTER TABLE `momo_logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `package_logs`
--
ALTER TABLE `package_logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `bank_logs`
--
ALTER TABLE `bank_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `campaign_views`
--
ALTER TABLE `campaign_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `link_views`
--
ALTER TABLE `link_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `momo_logs`
--
ALTER TABLE `momo_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `package_logs`
--
ALTER TABLE `package_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
