-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-03-26 09:21:14
-- 伺服器版本： 10.4.21-MariaDB
-- PHP 版本： 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `web03`
--

-- --------------------------------------------------------

--
-- 資料表結構 `movie`
--

CREATE TABLE `movie` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `ondate` date DEFAULT NULL,
  `publish` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `director` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `trailer` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `poster` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `intro` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `sh` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- 傾印資料表的資料 `movie`
--

INSERT INTO `movie` (`id`, `name`, `level`, `length`, `ondate`, `publish`, `director`, `trailer`, `poster`, `intro`, `rank`, `sh`) VALUES
(3, '院線片2', 2, 120, '2022-03-06', '院線片2', '院線片2', '03B02v.mp4', '03B02.png', '院線片2院線片2院線片2', 4, 1),
(4, '院線片3', 3, 120, '2022-03-07', '院線片3', '院線片3', '03B03v.mp4', '03B03.png', '院線片3院線片3院線片3', 5, 1),
(5, '院線片4', 4, 90, '2022-03-08', '院線片4', '院線片4', '03B04v.mp4', '03B04.png', '院線片4院線片4院線片4', 6, 1),
(7, '院線片1', 1, 99, '2022-03-05', '院線片1', '院線片1', '03B01v.mp4', '03B01.png', '院線片1院線片1院線片1', 3, 1),
(8, '院線片5', 1, 90, '2022-03-03', '院線片5', '院線片5', '03B05v.mp4', '03B05.png', '院線片5院線片5', 8, 1),
(9, '院線片6', 2, 60, '2022-03-04', '院線片6', '院線片6', '03B06v.mp4', '03B06.png', '院線片6院線片6', 9, 1),
(10, '院線片7', 3, 120, '2022-03-05', '院線片7', '院線片7', '03B07v.mp4', '03B07.png', '院線片7院線片7', 10, 1),
(11, '院線片8', 1, 30, '2022-03-05', '院線片8', '院線片8', '03B08v.mp4', '03B08.png', '院線片8院線片8', 11, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `ord`
--

CREATE TABLE `ord` (
  `id` int(10) UNSIGNED NOT NULL,
  `no` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `movie` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `session` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `qt` int(11) DEFAULT NULL,
  `seat` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `poster`
--

CREATE TABLE `poster` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `sh` int(11) DEFAULT 1,
  `ani` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- 傾印資料表的資料 `poster`
--

INSERT INTO `poster` (`id`, `path`, `name`, `rank`, `sh`, `ani`) VALUES
(1, '03A01.jpg', '預告片1', 2, 1, 3),
(2, '03A02.jpg', '預告片2', 1, 1, 3),
(3, '03A03.jpg', '預告片3', 3, 1, 3),
(4, '03A04.jpg', '預告片4', 4, 1, 3),
(5, '03A05.jpg', '預告片5', 5, 1, 3),
(6, '03A06.jpg', '預告片6', 6, 1, 3),
(7, '03A07.jpg', '預告片7', 7, 1, 3),
(8, '03A08.jpg', '預告片8', 8, 1, 3),
(9, '03A09.jpg', '預告片9', 9, 1, 3),
(10, '03A09.jpg', '預告片10', 10, 1, 3),
(11, '03A09.jpg', '預告片11', 11, 1, 3);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `ord`
--
ALTER TABLE `ord`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ord`
--
ALTER TABLE `ord`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
