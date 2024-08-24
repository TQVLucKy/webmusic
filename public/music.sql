-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 24, 2024 lúc 04:59 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `music`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `IdAccount` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`IdAccount`, `UserName`, `Password`) VALUES
(1, '123', '$2y$10$JhgQkfatL0K2reo.5IOs.eDnCyitOwYrxlpB./aColv0vd2fTwjXe'),
(2, '111', '111'),
(3, 'hasagi1', '132'),
(5, 'LucKy', '$2y$10$BNzXmRhGjP67t/T0Og9joeSI9rPgPMB4dQ2lMA3pYb1q3mTxzcg7a');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_album`
--

CREATE TABLE `account_album` (
  `IdAccount` int(11) NOT NULL,
  `IdAlbum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account_album`
--

INSERT INTO `account_album` (`IdAccount`, `IdAlbum`) VALUES
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_library`
--

CREATE TABLE `account_library` (
  `IdAccount` int(11) NOT NULL,
  `IdList` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account_library`
--

INSERT INTO `account_library` (`IdAccount`, `IdList`) VALUES
(1, 16),
(1, 12),
(1, 15),
(2, 18),
(0, 19),
(5, 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `album`
--

CREATE TABLE `album` (
  `IdAlbum` int(11) NOT NULL,
  `NameAlbum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `album`
--

INSERT INTO `album` (`IdAlbum`, `NameAlbum`) VALUES
(1, 'à thế à'),
(4, 'test'),
(5, 'test'),
(6, 'test'),
(7, 'thu'),
(8, '1 lan'),
(9, '2'),
(10, '3'),
(11, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `album_song`
--

CREATE TABLE `album_song` (
  `IdAlbum` int(11) NOT NULL,
  `IdMusic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `album_song`
--

INSERT INTO `album_song` (`IdAlbum`, `IdMusic`) VALUES
(1, 194),
(18, 141),
(18, 160),
(18, 163),
(18, 210),
(18, 234),
(7, 140),
(7, 168),
(7, 193),
(7, 213),
(7, 245),
(7, 262),
(7, 273),
(7, 221),
(8, 167),
(8, 171),
(8, 141),
(8, 213),
(8, 216),
(8, 223),
(9, 243),
(9, 247),
(9, 249),
(9, 252),
(9, 246),
(9, 245),
(10, 241),
(10, 239),
(10, 237),
(10, 235),
(10, 240),
(10, 215),
(10, 212);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `artist`
--

CREATE TABLE `artist` (
  `IdArtist` int(11) NOT NULL,
  `NameArtist` varchar(255) NOT NULL,
  `NameImageArtist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `artist`
--

INSERT INTO `artist` (`IdArtist`, `NameArtist`, `NameImageArtist`) VALUES
(1, 'Den', 0),
(12, 'Daniel Powter', 0),
(14, 'Sơn Tùng', 0),
(15, 'Da LAB', 0),
(16, 'Ngô Kiến Huy', 0),
(17, 'JUSTATEE', 0),
(18, 'Phương Ly', 0),
(19, 'SOOBIN Hoàng Sơn', 0),
(20, 'Hoàng Thùy Linh', 0),
(21, 'Vũ Cát Tường', 0),
(22, 'elijah wooods', 0),
(23, 'Mark Ambor', 0),
(24, 'Mergui', 0),
(26, 'Porter Robinson', 0),
(27, 'LF SYSTEM', 0),
(28, 'Alan Walker', 0),
(29, 'Dezko', 0),
(30, 'Ina Wroldsen', 0),
(31, 'Dash Berlin', 0),
(32, 'Vikkstar', 0),
(33, 'Daya', 0),
(34, 'Tove Lo', 0),
(35, 'SG Lewis', 0),
(36, 'David Guetta', 0),
(37, 'OneRepublic', 0),
(38, 'The Chainsmokers', 0),
(39, 'Sabrina Carpenter', 0),
(40, 'Farruko', 0),
(41, 'Creeds', 0),
(42, 'D.O.D', 0),
(43, 'CYRIL', 0),
(44, 'Lost Frequencies', 0),
(45, 'Alesso', 0),
(46, 'Katy Perry', 0),
(47, 'Táo', 0),
(48, 'Đen', 0),
(49, 'Nicki Minaj', 0),
(50, 'Lynk Lee', 0),
(51, 'Linh Cáo', 0),
(52, 'HEARTSTEEL', 0),
(53, 'Cheng', 0),
(54, 'Nguyên Thảo', 0),
(55, 'Lil Wuyn', 0),
(56, 'Thành Đồng', 0),
(57, 'Ngọc Linh', 0),
(58, 'PiaLinh', 0),
(59, 'VANT', 0),
(60, 'Eminem', 0),
(61, 'BINZ', 0),
(62, 'MTV Band', 0),
(63, 'Flo Rida', 0),
(64, 'XG', 0),
(65, 'Maroon 5', 0),
(66, 'Taylor Swift', 0),
(67, 'Britney Spears', 0),
(68, 'Bon Jovi', 0),
(69, 'Marshmello', 0),
(70, 'Kane Brown', 0),
(71, 'Imagine Dragons', 0),
(72, 'Nicky Youre', 0),
(73, '王OK', 0),
(74, 'Olly Murs', 0),
(75, 'Kings Of Leon', 0),
(76, 'Coldplay', 0),
(77, 'Charlie Puth', 0),
(78, 'Selena Gomez', 0),
(79, 'Shakira', 0),
(80, 'Kahlani', 0),
(81, 'Victoria Monét', 0),
(82, 'Tems', 0),
(83, 'Omah Lay', 0),
(84, 'Kali Uchis', 0),
(85, 'Khalid', 0),
(86, ' Chris Brown', 0),
(87, 'SZA', 0),
(88, 'SiR', 0),
(89, '阿冗', 0),
(90, '后弦', 0),
(91, '葛东琪', 0),
(92, '甘草片r', 0),
(93, '音闕詩聽', 0),
(94, '等什么君', 0),
(95, '丸子呦', 0),
(96, 'Ice Paper', 0),
(97, '花粥', 0),
(98, '王勝男', 0),
(99, '蒋雪儿', 0),
(100, 'BTS', 0),
(101, 'NewJeans', 0),
(102, 'BigBang', 0),
(103, 'Twice', 0),
(104, 'Khánh Ly', 0),
(105, 'Mộc San', 0),
(109, 'Phúc Du', 1722842570);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `IdCategory` int(11) NOT NULL,
  `NameCategory` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`IdCategory`, `NameCategory`) VALUES
(2, 'V-Pop'),
(3, 'Pop'),
(5, 'Dance'),
(6, 'Hip-Hop'),
(7, 'R&B'),
(8, 'C-Pop'),
(9, 'K-Pop'),
(10, 'Nhạc Trịnh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `library`
--

CREATE TABLE `library` (
  `IdList` int(11) NOT NULL,
  `NameList` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `library`
--

INSERT INTO `library` (`IdList`, `NameList`) VALUES
(12, 'abc'),
(15, 'Test'),
(16, 'cuộc sống mà'),
(17, 'Den'),
(18, '123'),
(19, 'thu'),
(20, 'test');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `listmusic`
--

CREATE TABLE `listmusic` (
  `IdMusic` int(11) NOT NULL,
  `IdList` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `listmusic`
--

INSERT INTO `listmusic` (`IdMusic`, `IdList`) VALUES
(194, 12),
(141, 12),
(158, 12),
(161, 12),
(140, 12),
(140, 15),
(194, 15),
(161, 16),
(159, 12),
(159, 16),
(141, 18),
(140, 20),
(158, 20),
(161, 20),
(211, 20),
(237, 20),
(264, 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `song_artist`
--

CREATE TABLE `song_artist` (
  `IdMusic` int(11) NOT NULL,
  `IdArtist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `song_artist`
--

INSERT INTO `song_artist` (`IdMusic`, `IdArtist`) VALUES
(140, 15),
(141, 16),
(143, 14),
(158, 17),
(158, 18),
(159, 14),
(160, 17),
(161, 19),
(162, 14),
(163, 20),
(164, 21),
(165, 22),
(166, 23),
(167, 12),
(168, 24),
(170, 26),
(171, 27),
(172, 28),
(173, 29),
(174, 28),
(174, 30),
(175, 28),
(175, 31),
(175, 32),
(176, 28),
(177, 28),
(178, 28),
(178, 33),
(179, 34),
(179, 35),
(180, 36),
(180, 37),
(181, 38),
(182, 28),
(182, 39),
(182, 40),
(183, 41),
(184, 28),
(187, 43),
(188, 28),
(190, 44),
(191, 28),
(192, 28),
(193, 45),
(193, 46),
(194, 47),
(196, 48),
(197, 49),
(198, 47),
(199, 48),
(199, 50),
(200, 48),
(200, 51),
(201, 52),
(202, 48),
(202, 53),
(203, 48),
(203, 54),
(204, 55),
(204, 48),
(205, 48),
(205, 56),
(206, 48),
(206, 57),
(207, 48),
(207, 58),
(208, 59),
(209, 60),
(210, 61),
(211, 49),
(212, 15),
(213, 48),
(213, 62),
(214, 63),
(215, 64),
(216, 65),
(217, 66),
(219, 67),
(220, 68),
(221, 69),
(221, 70),
(222, 71),
(223, 72),
(224, 73),
(225, 71),
(226, 65),
(227, 74),
(229, 75),
(230, 76),
(231, 77),
(231, 78),
(232, 79),
(233, 80),
(234, 81),
(235, 82),
(236, 83),
(237, 82),
(238, 84),
(239, 85),
(240, 86),
(241, 87),
(242, 88),
(243, 89),
(244, 90),
(245, 91),
(246, 92),
(247, 93),
(248, 94),
(249, 95),
(251, 96),
(252, 97),
(252, 98),
(253, 99),
(254, 100),
(255, 101),
(256, 100),
(257, 102),
(258, 101),
(259, 103),
(260, 100),
(261, 101),
(262, 103),
(263, 103),
(264, 104),
(265, 104),
(266, 104),
(267, 104),
(268, 105),
(269, 104),
(270, 104),
(271, 105),
(272, 104),
(273, 104);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `song_category`
--

CREATE TABLE `song_category` (
  `IdMusic` int(11) NOT NULL,
  `IdCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `song_category`
--

INSERT INTO `song_category` (`IdMusic`, `IdCategory`) VALUES
(140, 2),
(141, 2),
(143, 2),
(158, 2),
(158, 2),
(159, 2),
(160, 2),
(161, 2),
(162, 2),
(163, 2),
(164, 2),
(165, 3),
(166, 3),
(167, 3),
(168, 3),
(170, 3),
(171, 5),
(172, 5),
(173, 5),
(174, 5),
(174, 5),
(175, 5),
(175, 5),
(175, 5),
(176, 5),
(177, 5),
(178, 5),
(178, 5),
(179, 5),
(179, 5),
(180, 5),
(180, 5),
(181, 5),
(182, 5),
(182, 5),
(182, 5),
(183, 5),
(184, 5),
(187, 5),
(188, 5),
(190, 5),
(191, 5),
(192, 5),
(193, 5),
(193, 5),
(194, 6),
(196, 6),
(197, 6),
(198, 6),
(199, 6),
(199, 6),
(200, 6),
(200, 6),
(201, 6),
(202, 6),
(202, 6),
(203, 6),
(203, 6),
(204, 6),
(204, 6),
(205, 6),
(205, 6),
(206, 6),
(206, 6),
(207, 6),
(207, 6),
(208, 6),
(209, 6),
(210, 6),
(211, 6),
(212, 6),
(213, 6),
(213, 6),
(214, 6),
(215, 6),
(216, 3),
(217, 3),
(219, 3),
(220, 3),
(221, 3),
(221, 3),
(222, 3),
(223, 3),
(224, 3),
(225, 3),
(226, 3),
(227, 3),
(229, 3),
(230, 3),
(231, 3),
(231, 3),
(232, 3),
(233, 7),
(234, 7),
(235, 7),
(236, 7),
(237, 7),
(238, 7),
(239, 7),
(240, 7),
(241, 7),
(242, 7),
(243, 8),
(244, 8),
(245, 8),
(246, 8),
(247, 8),
(248, 8),
(249, 8),
(251, 8),
(252, 8),
(252, 8),
(253, 8),
(254, 9),
(255, 9),
(256, 9),
(257, 9),
(258, 9),
(259, 9),
(260, 9),
(261, 9),
(262, 9),
(263, 9),
(264, 10),
(265, 10),
(266, 10),
(267, 10),
(268, 10),
(269, 10),
(270, 10),
(271, 10),
(272, 10),
(273, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `storemusic`
--

CREATE TABLE `storemusic` (
  `IdMusic` int(11) NOT NULL,
  `NameMusic` varchar(1000) NOT NULL,
  `NameImageMusic` varchar(100) NOT NULL,
  `View` int(11) NOT NULL DEFAULT 0,
  `state` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `storemusic`
--

INSERT INTO `storemusic` (`IdMusic`, `NameMusic`, `NameImageMusic`, `View`, `state`) VALUES
(140, 'Thức giấc', '1720665343.jpg', 104, b'01'),
(141, 'Truyền Thái Y', '1720666623.jpg', 6, b'01'),
(143, 'Lạc Trôi', '1720667233.jpg', 4, b'00'),
(158, 'Thằng Điên', '1722222043.jpg', 2, b'00'),
(159, 'Chúng ta của tương lai', '1722224310.jpg', 2, b'00'),
(160, 'Đã lỡ yêu em nhiều', '1722224617.jpg', 3, b'00'),
(161, 'Đi để trở về', '1722224887.jpg', 4, b'01'),
(162, 'Đừng Làm Trái Tim Anh Đau', '1722224938.jpg', 1, b'00'),
(163, 'See Tình', '1722224983.jpg', 1, b'00'),
(164, 'Từng Là', '1722225054.jpg', 1, b'00'),
(165, '24-7-365', '1722385851.jpg', 1, b'00'),
(166, 'Belong Together', '1722385916.jpg', 1, b'00'),
(167, 'Bad Day', '1722385967.jpg', 1, b'00'),
(168, 'Cry', '1722386225.jpg', 1, b'01'),
(170, 'Everything Goes On', '1722386862.jpg', 1, b'00'),
(171, 'Afraid To Feel', '1722581111.jpg', 1, b'00'),
(172, 'Alone', '1722581257.jpg', 0, b'00'),
(173, 'Ascend', '1722581324.jpg', 1, b'00'),
(174, 'Barcelona', '1722581445.jpg', 0, b'00'),
(175, 'Better Off', '1722581547.jpg', 0, b'00'),
(176, 'Darkside', '1722581652.jpg', 0, b'00'),
(177, 'Faded', '1722581702.jpg', 0, b'00'),
(178, 'Heart over Mind', '1722581762.jpg', 0, b'00'),
(179, 'HEAT', '1722581863.jpg', 0, b'00'),
(180, 'I Don\'t Wanna Wait', '1722581939.jpg', 0, b'00'),
(181, 'No Shade at Pitti', '1722582046.jpg', 0, b'00'),
(182, 'On My Way', '1722582100.jpg', 0, b'00'),
(183, 'Push Up', '1722582181.jpg', 0, b'00'),
(184, 'Sing Me To Sleep', '1722582228.jpg', 0, b'00'),
(187, 'StumblinIn', '1722582568.jpg', 0, b'00'),
(188, 'Sing Me To Sleep', '1722582647.jpg', 0, b'00'),
(190, 'The Feeling', '1722582808.jpg', 0, b'00'),
(191, 'The Spectre', '1722582849.jpg', 0, b'00'),
(192, 'Welcome to Walkerworld', '1722582911.jpg', 0, b'00'),
(193, 'When I\'m Gone', '1722583026.jpg', 0, b'00'),
(194, '2 5', '1722584477.jpg', 1, b'01'),
(196, 'Ai muốn nghe không', '1722584567.jpg', 0, b'00'),
(197, 'Anaconda', '1722584704.jpg', 0, b'00'),
(198, 'Blue Tequila', '1722584755.jpg', 0, b'01'),
(199, 'Cô Gái Bàn Bên ', '1722584840.jpg', 0, b'00'),
(200, 'Đưa Nhau Đi Trốn', '1722584897.jpg', 0, b'00'),
(201, 'PARANOIA', '1722585009.jpg', 0, b'00'),
(202, 'Luôn yêu đời', '1722585051.jpg', 0, b'00'),
(203, 'Mang Tiền Về Cho Mẹ', '1722585094.jpg', 0, b'00'),
(204, 'Mở Mắt', '1722585187.jpg', 0, b'00'),
(205, 'một triệu like', '1722585245.jpg', 0, b'00'),
(206, 'Mười Năm', '1722585276.jpg', 0, b'00'),
(207, 'Nấu ăn cho em', '1722585305.jpg', 0, b'00'),
(208, 'PARKING LOT', '1722585351.jpg', 0, b'00'),
(209, 'Rap God ', '1722585382.jpg', 0, b'00'),
(210, 'SOFAR', '1722585429.jpg', 1, b'00'),
(211, 'Starships', '1722585479.jpg', 0, b'00'),
(212, 'Thanh Xuân', '1722585518.jpg', 0, b'00'),
(213, 'Trốn Tìm ', '1722586029.jpg', 0, b'00'),
(214, 'Whistle', '1722586061.jpg', 0, b'00'),
(215, 'WOKE UP', '1722586096.jpg', 0, b'00'),
(216, 'Girls Like You', '1722590524.jpg', 0, b'00'),
(217, 'I Can Do It With a Broken Heart', '1722590562.jpg', 0, b'00'),
(219, 'Britney Spears', '1722590684.jpg', 0, b'00'),
(220, 'It\'s My Life', '1722590744.jpg', 0, b'00'),
(221, 'Miles On It', '1722590787.jpg', 0, b'00'),
(222, 'Nice to Meet You', '1722590827.jpg', 0, b'00'),
(223, 'S.A.D', '1722590913.A', 0, b'00'),
(224, 'Shadow Of The Sun (Cover))', '1722591024.jpg', 0, b'00'),
(225, 'Shots', '1722591073.jpg', 0, b'00'),
(226, 'Sugar', '1722591113.jpg', 0, b'00'),
(227, 'That Girl', '1722591165.jpg', 0, b'00'),
(229, 'Use Somebody', '1722591309.jpg', 0, b'00'),
(230, 'Viva La Vida', '1722591356.jpg', 0, b'00'),
(231, 'We Don\'t Talk Anymore', '1722591490.jpg', 0, b'00'),
(232, 'Whenever, Wherever', '1722591560.jpg', 0, b'00'),
(233, 'After Hours', '1722591650.jpg', 0, b'00'),
(234, 'Alright', '1722591680.jpg', 0, b'00'),
(235, 'Burning', '1722591705.jpg', 0, b'00'),
(236, 'Holy Ghost', '1722591733.jpg', 0, b'00'),
(237, 'Me & U', '1722591762.jpg', 0, b'00'),
(238, 'Never Be Yours', '1722591833.jpg', 0, b'00'),
(239, 'Please Don\'t Fall In Love With Me', '1722591861.jpg', 0, b'00'),
(240, 'Residuals', '1722591896.jpg', 0, b'00'),
(241, 'Snooze', '1722591928.jpg', 0, b'00'),
(242, 'YOU', '1722591959.jpg', 0, b'00'),
(243, 'Đáp án của bạn', '1722592184.jpg', 0, b'00'),
(244, 'Dứt cơn mưa này', '1722593174.jpg', 0, b'00'),
(245, 'Hỉ', '1722593225.jpg', 0, b'00'),
(246, 'Just Say Hello (Acoustic Version)', '1722593564.jpg', 0, b'00'),
(247, 'Mang Chủng', '1722593623.jpg', 0, b'00'),
(248, 'Quan Sơn Tửu', '1722593663.jpg', 0, b'00'),
(249, 'Quảng Hàn Cung', '1722593782.jpg', 0, b'00'),
(251, 'Tâm Lặng Như Nước', '1722593894.jpg', 0, b'00'),
(252, 'Xuất Sơn', '1722593936.jpg', 0, b'00'),
(253, 'Yến Vô Hiết', '1722594014.jpg', 0, b'00'),
(254, 'Boy With Luv', '1722594210.jpg', 0, b'00'),
(255, 'Ditto', '1722594267.jpg', 0, b'00'),
(256, 'Dynamite', '1722594290.jpg', 0, b'00'),
(257, 'Haru Haru', '1722594320.jpg', 0, b'00'),
(258, 'How Sweet', '1722594350.jpg', 0, b'00'),
(259, 'Likey', '1722594374.jpg', 0, b'00'),
(260, 'Permission to Dance', '1722594417.jpg', 0, b'00'),
(261, 'Supernatural', '1722594455.jpg', 0, b'00'),
(262, 'TT', '1722594482.jpg', 0, b'00'),
(263, 'What is Love', '1722594503.jpg', 0, b'01'),
(264, 'Biển nhớ', '1722596070.jpg', 0, b'00'),
(265, 'Cát Bụi', '1722596138.jpg', 0, b'00'),
(266, 'Chiếc Lá Thu Phai', '1722596183.jpg', 0, b'00'),
(267, 'ĐẠI BÁC RU ĐÊM', '1722596228.jpg', 0, b'00'),
(268, 'Hát Cho Người Nằm Xuống ', '1722596279.jpg', 0, b'00'),
(269, 'MỘT CÕI ĐI VỀ', '1722596314.jpg', 0, b'00'),
(270, 'Như Một Lời Chia Tay', '1722596344.jpg', 0, b'00'),
(271, 'Phôi Pha', '1722596395.jpg', 0, b'00'),
(272, 'Tuổi Đá Buồn', '1722596437.jpg', 0, b'00'),
(273, 'TUỔI ĐỜI MÊNH MÔNG', '1722596489.jpg', 0, b'00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`IdAccount`);

--
-- Chỉ mục cho bảng `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`IdAlbum`);

--
-- Chỉ mục cho bảng `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`IdArtist`),
  ADD UNIQUE KEY `ArtistName` (`NameArtist`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`IdCategory`);

--
-- Chỉ mục cho bảng `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`IdList`);

--
-- Chỉ mục cho bảng `storemusic`
--
ALTER TABLE `storemusic`
  ADD PRIMARY KEY (`IdMusic`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `IdAccount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `album`
--
ALTER TABLE `album`
  MODIFY `IdAlbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `artist`
--
ALTER TABLE `artist`
  MODIFY `IdArtist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `IdCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `library`
--
ALTER TABLE `library`
  MODIFY `IdList` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `storemusic`
--
ALTER TABLE `storemusic`
  MODIFY `IdMusic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `album_song`
--
ALTER TABLE `album_song`
  ADD CONSTRAINT `album_song_ibfk_2` FOREIGN KEY (`IdMusic`) REFERENCES `storemusic` (`IdMusic`);

--
-- Các ràng buộc cho bảng `listmusic`
--
ALTER TABLE `listmusic`
  ADD CONSTRAINT `listmusic_ibfk_2` FOREIGN KEY (`IdList`) REFERENCES `library` (`IdList`);

--
-- Các ràng buộc cho bảng `song_artist`
--
ALTER TABLE `song_artist`
  ADD CONSTRAINT `song_artist_ibfk_1` FOREIGN KEY (`IdMusic`) REFERENCES `storemusic` (`IdMusic`),
  ADD CONSTRAINT `song_artist_ibfk_2` FOREIGN KEY (`IdArtist`) REFERENCES `artist` (`IdArtist`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
