-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 11:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meganet`
--

-- --------------------------------------------------------

--
-- Table structure for table `megaprojects`
--

CREATE TABLE `megaprojects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `segments` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `megaprojects`
--

INSERT INTO `megaprojects` (`id`, `segments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Residential', '2023-07-31 10:08:22', '2023-07-31 10:08:22', NULL),
(2, 'Office', '2023-07-31 10:08:22', '2023-07-31 10:08:22', NULL),
(3, 'Mixed-Use', '2023-07-31 10:08:22', '2023-07-31 10:08:22', NULL),
(4, 'Hotel & Casino', '2023-07-31 10:08:22', '2023-07-31 10:08:22', NULL),
(5, 'Industrial and Warehouse', '2023-07-31 10:08:22', '2023-07-31 10:08:22', NULL),
(6, 'Low-Cost Housing', '2023-07-31 10:08:22', '2023-07-31 10:08:22', NULL),
(7, 'Socialized Housing', '2023-07-31 10:08:22', '2023-07-31 10:08:22', NULL),
(8, 'Land Transport Infrastructure', '2023-07-31 10:08:22', '2023-07-31 10:08:22', NULL),
(9, 'Airport Infrastructure', '2023-07-31 10:08:22', '2023-07-31 10:08:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `megaproject_segments`
--

CREATE TABLE `megaproject_segments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `megaproject_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `megaproject_segments`
--

INSERT INTO `megaproject_segments` (`id`, `megaproject_id`, `title`, `details`, `created_at`, `updated_at`, `deleted_at`) VALUES
(22, 1, 'THE PROSCENIUM', '<p>Client: Rockwell Land Corporation</p><p>GFA: 211,754 sq. m.<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:07:53', '2023-09-10 22:07:53', NULL),
(23, 2, 'ARTHALAND CENTURY PACIFIC TOWER', '<p>Client: Arthaland Corporation</p><p>GFA: 47,008 sq. m.<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:08:39', '2023-09-10 22:08:39', NULL),
(24, 3, 'DOUBLEDRAGON PLAZA', '<p>Client: DoubleDragon Properties Corp.</p><p>GFA: 230,130 sq. m.<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:09:21', '2023-09-10 22:09:21', NULL),
(25, 4, 'WESTSIDE CITY RESORTS WORLD PHASES A & B', '<p>Clients: Travellers International Hotel Group Inc. (Phase A)</p><p>Suntrust Home Developers, Inc. (Phase B)</p><p>GFA: 328,628.15 sq. m.<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:10:44', '2023-09-10 22:10:44', NULL),
(26, 5, 'LANDERS BALINTAWAK | OTIS | ALABANG | ARCOVIA', '<p>Client: Southeast Asia Retail Incorporated</p><p>                                                \r\n                                            </p>', '2023-09-10 22:11:30', '2023-09-10 22:11:30', NULL),
(27, 6, 'URBAN DECA MANILA', '<p>Client: 8990 Holdings, Inc.</p><p>GFA: 410,447 sq. m.<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:12:04', '2023-09-10 22:12:04', NULL),
(28, 7, 'NHA CAMARIN MASS HOUSING', '<p>Client: National Housing Authority</p><p>GFA: Phase 1 37,542 sq. m.<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:12:37', '2023-09-10 22:12:37', NULL),
(29, 8, 'MALOLOS-CLARK RAILWAY PROJECT', '<p>Contractor: Hyundai Engineering and Construction Co. Ltd.,</p><p>Megawide and Dong-ah Geological Engineering</p><p>Company Ltd. Joint Venture<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:13:22', '2023-09-10 22:13:22', NULL),
(30, 9, 'MACTAN-CEBU INTERNATIONAL AIRPORT', '<p>Developer: GMR MEGAWIDE Cebu Airport Corporation</p><p>                                                \r\n                                            </p>', '2023-09-10 22:14:00', '2023-09-10 22:14:00', NULL),
(31, 2, 'WORLD PLAZA', '<p>Client: Daiichi Properties</p><p>GFA: 69,339 sq. m.<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:14:37', '2023-09-10 22:14:37', NULL),
(32, 1, 'SHANGRI-LA SALCEDO', '<p>Client: Shang Properties, Inc.</p><p>GFA: 165,183 sq. m.<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:15:09', '2023-09-10 22:15:09', NULL),
(33, 4, 'ASCOTT-DD MERIDIAN PARK', '<p>Clients: DoubleDragon Properties Corp.</p><p>GFA: 49,365.25 sq. m.<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:15:42', '2023-09-10 22:15:42', NULL),
(34, 4, 'CITY OF DREAMS MANILA', '<p>Clients: Belle Corporation</p><p>GFA: 157,440.00 sq. m.<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:16:10', '2023-09-10 22:16:10', NULL),
(35, 9, 'CLARK INTERNATIONAL AIRPORT NEW PASSENGER TERMINAL BUILDING', '<p>Developer: MEGAWIDE GMR Construction Joint Venture</p><p>                                                \r\n                                            </p>', '2023-09-10 22:16:56', '2023-09-10 22:16:56', NULL),
(36, 8, 'MALOLOS-CLARK RAILWAY PROJECT (Apalit)', '<p>Contractor: Hyundai Engineering and Construction Co. Ltd.,</p><p>Megawide and Dong-ah Geological Engineering</p><p>Company Ltd. Joint Venture<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:17:39', '2023-09-10 22:17:39', NULL),
(37, 8, 'PARAÑAQUE INTEGRATED TERMINAL EXCHANGE', '<p>Developers: MWM Terminals Inc., a subsidiary of Megawide</p><p>                                                \r\n                                            </p>', '2023-09-10 22:18:08', '2023-09-10 22:18:08', NULL),
(38, 6, 'URBAN DECA ORTIGAS', '<p>Client: 8990 Holdings, Inc.</p><p>GFA: 818,109.81 sq. m.<br></p><p>                                                \r\n                                            </p>', '2023-09-10 22:18:37', '2023-09-10 22:18:37', NULL),
(39, 7, 'CARBON DISTRICT MODERNIZATION', 'Developer: Joint Venture of Megawide and Cebu City Local Government<br>', '2023-09-10 22:19:09', '2023-09-10 22:19:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `megaproject_segment_images`
--

CREATE TABLE `megaproject_segment_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `megaproject_segment_id` bigint(20) UNSIGNED NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `megaproject_segment_images`
--

INSERT INTO `megaproject_segment_images` (`id`, `megaproject_segment_id`, `image`, `created_at`, `updated_at`) VALUES
(4, 22, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694383675/zcmabdsja3u27mkia9fl.jpg', '2023-09-10 22:07:55', '2023-09-10 22:07:55'),
(5, 23, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694383722/wxwqh0gdk4vc9boldw31.png', '2023-09-10 22:08:43', '2023-09-10 22:08:43'),
(6, 24, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694383762/oxbha2xswtl0ignopppx.jpg', '2023-09-10 22:09:23', '2023-09-10 22:09:23'),
(7, 25, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694383846/azmtdnivdpicqiwfwifz.png', '2023-09-10 22:10:47', '2023-09-10 22:10:47'),
(8, 26, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694383893/edts6xjucu6krr0g8ths.jpg', '2023-09-10 22:11:33', '2023-09-10 22:11:33'),
(9, 27, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694383926/eef8blpket04f2hzvcbx.png', '2023-09-10 22:12:06', '2023-09-10 22:12:06'),
(10, 28, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694383960/bwoqmqmhlnxlayhrmz8z.jpg', '2023-09-10 22:12:40', '2023-09-10 22:12:40'),
(11, 29, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694384005/p94adidygmq6v9mzvhwy.png', '2023-09-10 22:13:25', '2023-09-10 22:13:25'),
(12, 30, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694384042/nhu0kiw41gm8wn1biux2.jpg', '2023-09-10 22:14:03', '2023-09-10 22:14:03'),
(13, 31, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694384078/hvrgcjslxrnadldg1elu.jpg', '2023-09-10 22:14:39', '2023-09-10 22:14:39'),
(14, 32, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694384112/xhctfwuan5agxoxctctw.jpg', '2023-09-10 22:15:12', '2023-09-10 22:15:12'),
(15, 33, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694384144/vbyvj7dxy32xh4ljxnkf.jpg', '2023-09-10 22:15:44', '2023-09-10 22:15:44'),
(16, 34, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694384172/vxurjwnyplt7x4uu7pvl.jpg', '2023-09-10 22:16:13', '2023-09-10 22:16:13'),
(17, 35, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694384218/awejytqjq8khmjcqgubq.png', '2023-09-10 22:16:59', '2023-09-10 22:16:59'),
(18, 36, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694384261/gbsjtpo5wgjyuakhwc2c.jpg', '2023-09-10 22:17:41', '2023-09-10 22:17:41'),
(19, 37, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694384290/jpaw5z3jn6vb73jyf3do.png', '2023-09-10 22:18:10', '2023-09-10 22:18:10'),
(20, 38, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694384319/tioyaenu6nb0gf8gjnct.jpg', '2023-09-10 22:18:39', '2023-09-10 22:18:39'),
(21, 39, 'https://res.cloudinary.com/dtcr2h8sb/image/upload/v1694384351/fug9lpjrbgyh5ydv5bce.jpg', '2023-09-10 22:19:11', '2023-09-10 22:19:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `megaprojects`
--
ALTER TABLE `megaprojects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `megaproject_segments`
--
ALTER TABLE `megaproject_segments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `megaproject_segments_megaproject_id_foreign` (`megaproject_id`);

--
-- Indexes for table `megaproject_segment_images`
--
ALTER TABLE `megaproject_segment_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `megaproject_segment_images_megaproject_segment_id_foreign` (`megaproject_segment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `megaprojects`
--
ALTER TABLE `megaprojects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `megaproject_segments`
--
ALTER TABLE `megaproject_segments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `megaproject_segment_images`
--
ALTER TABLE `megaproject_segment_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `megaproject_segments`
--
ALTER TABLE `megaproject_segments`
  ADD CONSTRAINT `megaproject_segments_megaproject_id_foreign` FOREIGN KEY (`megaproject_id`) REFERENCES `megaprojects` (`id`);

--
-- Constraints for table `megaproject_segment_images`
--
ALTER TABLE `megaproject_segment_images`
  ADD CONSTRAINT `megaproject_segment_images_megaproject_segment_id_foreign` FOREIGN KEY (`megaproject_segment_id`) REFERENCES `megaproject_segments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
