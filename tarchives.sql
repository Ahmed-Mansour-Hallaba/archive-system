-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2020 at 08:47 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tarchives`
--
CREATE DATABASE IF NOT EXISTS `tarchives` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tarchives`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_type` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`, `email`, `level`, `user_type`, `user_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '$2b$10$hXF2Hyem/5d5OfhJWdfFVeNJJqw4cix4nFJmrYduzIY5X8J1FSXwm\r\n', 'admin@123', '0', '0', NULL, NULL, '2019-10-10 22:46:13', '2019-10-23 05:18:19'),
(3, 'شعبة الإمداد والتموين', '$2b$10$hXF2Hyem/5d5OfhJWdfFVeNJJqw4cix4nFJmrYduzIY5X8J1FSXwm\r\n', 'store@123', '1', '0', 1, NULL, '2019-10-21 07:24:03', '2019-10-21 07:24:03'),
(4, 'فرع التحركات البحرى', '$2y$10$sEkJ1OYeTbV6j6KP2uuhnexgvCEX49c1lBpGx297/SmA7pao68LyK', 'trans@123', '1', '1', 2, NULL, '2019-10-21 07:33:36', '2019-10-21 07:33:36'),
(5, 'فرع الوقود البحرى', '$2y$10$CJNWUukQhpbxkHaMg5J5leQykOaMGkznI52YXNVNWDyXxnXea5q7m', 'gas@123', '1', '1', 3, NULL, '2019-10-21 07:34:50', '2019-10-21 07:34:50'),
(6, 'فرع التعيينات البحرى', '$2y$10$MTO6HWlwEr.jZLAP.bycM.k3IV4mnVNnEMfy1XuXI.rti1zCx0dB2', 'supp@123', '1', '1', 4, NULL, '2019-10-21 07:40:14', '2019-10-21 07:40:14'),
(7, 'فرع المهمات البحرى', '$2y$10$sfrrogT0JPmVKBjyCWmEOehbk/OALaNS77SXP0ww0KOw0mSXcTHYi', 'wears@123', '1', '1', 5, NULL, '2019-10-21 07:41:31', '2019-10-21 07:41:31'),
(8, 'فرع الخدمات الطبية البحرى', '$2y$10$Pva3IQt9bX2b7.JP3nGN4eDdHsZSHuFWD1Av3zCI.CYSHhXevu2RG', 'medic@123', '1', '1', 6, NULL, '2019-10-21 07:42:30', '2019-10-21 07:42:30'),
(9, 'فرع الخدمات البيطرية البحرى', '$2y$10$nGd9CC9AVtdr9Gjivhs9QOQEBHGfvcuZBUpDHI6ouG46OCnvkaWDW', 'vet@123', '1', '1', 7, NULL, '2019-10-21 07:43:37', '2019-10-21 07:43:37'),
(10, 'فرع المطبوعات والنشر البحرى', '$2y$10$S1bgDWsJy7iAg5yjJgATOOsKuHbE5PkE5pCgxCwd6I8UQ.CSDSk.i', 'pub@123', '1', '1', 8, NULL, '2019-10-21 07:44:52', '2019-10-21 07:44:52'),
(11, 'فرع الإطفاء البحرى', '$2y$10$667kCe/c5rQ3rMhzuj8z1.KtVOb1z6kweMvPyhIDcxurGM3qFZwXq', 'fire@123', '1', '1', 9, NULL, '2019-10-21 07:46:12', '2019-10-21 07:46:12'),
(12, 'شعبة التنظيم والإدارة البحرية', '$2y$10$/ub7C/nwyR6JlFgpbB6ybeTlHZQuCBdr898YEVqElMsS3Fr5qi0uq', 'tanzeem@123', '0', '0', 2, NULL, '2019-10-22 06:46:12', '2020-08-23 08:56:57'),
(13, 'شعبة التنظيم والإدارة البحرية - فرع الإدارة العسكرية', '$2y$10$0nDfp.IfXuEWjZquNIosTOesmK/ENsvjAwlOb3hgM2EFT0sT5Ef0C', 'mang@123', '0', '1', 10, NULL, '2019-10-22 06:48:53', '2019-10-22 06:48:53'),
(14, 'شعبة التنظيم والإدارة البحرية - فرع الأفراد', '$2y$10$0nDfp.IfXuEWjZquNIosTOesmK/ENsvjAwlOb3hgM2EFT0sT5Ef0C', 'person@123', '0', '1', 11, NULL, '2019-10-22 06:50:10', '2019-10-22 06:50:10'),
(15, 'شعبة التنظيم والإدارة البحرية - فرع السجلات', '$2y$10$AO/IqRsyz8zr6CU9nZTp5edDSLNkaSyXUrMBJC89SLHXvf4HY8Eje', 'log@123', '1', '1', 12, NULL, '2019-10-22 06:51:55', '2019-10-22 06:51:55'),
(16, 'شعبة التنظيم والإدارة البحرية - فرع التعبئة', '$2y$10$N6fPt59AnieaC1hLK.SspepeTQAXNYItA5Rkb4MroMhW3moT5S3Ky', 'packing@123', '1', '1', 13, NULL, '2019-10-22 07:27:48', '2019-10-22 07:27:48'),
(17, 'شعبة التنظيم والإدارة البحرية - فرع التخطيط', '$2y$10$zg01aHh.N1cKxjqgumvIo.yUekm1ASRAWCxabNCLdNTKmz0.0zraG', 'planning@123', '1', '1', 14, NULL, '2019-10-22 07:28:58', '2019-10-22 07:28:58'),
(18, 'شعبة التنظيم والإدارة البحرية - فرع تنظيم المرتبات', '$2y$10$f3gcQhgtdYySq0XyJAtE3OpkXq5snTJtFaHddPvvg3A9TQKlO8Z3q', 'salary@123', '1', '1', 15, NULL, '2019-10-22 07:30:48', '2019-10-22 07:30:48'),
(19, 'شعبة التنظيم والإدارة البحرية - فرع الشئون الشخصية', '$2y$10$FxqtDL6vvcLRwrjnlmh0T.xRf8qFDSZ04nvKLbhokiEOTcfsL3uFa', 'affairs@123', '1', '1', 16, NULL, '2019-10-22 07:46:42', '2019-10-22 07:46:42'),
(20, 'شعبة التنظيم والإدارة البحرية - قسم بيانات التسليح', '$2y$10$/y/1sxV.DyHU.b.AB4QU3e221267nQ1KHBMHUTDBAzPGg9HvixnRe', 'ardata@123', '1', '1', 17, NULL, '2019-10-22 07:48:27', '2019-10-22 07:48:27'),
(21, 'شعبة التنظيم والإدارة البحرية - فرع المراسم', '$2y$10$O2LbIEBhnyai/NjGLSifIeWaODFhzQI3x5N3arpf8voxr7SpBI/Hm', 'ceremony@123', '1', '1', 18, NULL, '2019-10-22 07:52:46', '2019-10-22 07:52:46'),
(22, 'شعبة التنظيم والإدارة البحرية - فرع الإدارة العسكرية - قسم التحقيقات', '$2y$10$vuldszG5GreaHZLmMzZuF.8I7iEU.8b3oNTs.rZsCb84Arjo5BvMm', 'invest@123', '1', '2', 1, NULL, '2019-10-22 07:56:19', '2019-10-22 07:56:19'),
(23, 'جهاز كبير مهندسي القوات البحرية', '$2y$10$0nDfp.IfXuEWjZquNIosTOesmK/ENsvjAwlOb3hgM2EFT0sT5Ef0C', 'beng@123', '1', '1', 19, NULL, '2019-10-22 08:53:31', '2019-10-22 08:53:31'),
(24, 'فرع الشئون المعنوية البحرى', '$2y$10$POM1TquaO7kk/oiUpcLuc.th1xj0sMzp1NDcMRu1sXHiLZ1G6s4nu', 'motiv@123', '1', '1', 20, NULL, '2019-10-22 16:32:36', '2019-10-22 16:32:36'),
(25, 'فرع القضاء العسكرى', '$2y$10$X3OI4dwgADNR/M2oxE2ueOQBLkFoIwqBWcsSecsABB8f9PzKiaXoG', 'judi@123', '1', '1', 21, NULL, '2019-10-23 05:37:04', '2019-10-23 05:37:04'),
(26, 'شعبة التدريب البحرى', '$2y$10$c3YpkxclQt631JTVGrNXr.A30uZB9WsaiVkAzY/VM0tLhDNlBYuBO', 'training@123', '1', '0', 3, NULL, '2019-10-23 06:16:19', '2019-10-23 06:16:19'),
(27, 'شعبة التدريب البحرى - فرع التخطيط', '$2y$10$IRnTz2gPPeVNvNPJw1f4f.iCiAVtb5qTe9Dsg/gOaJ18NLEHMrUjK', 'plan@123', '1', '1', 22, NULL, '2019-10-23 06:18:04', '2019-10-23 06:18:04'),
(28, 'شعبة التدريب البحرى - فرع التدريب التكتيكي', '$2y$10$ajrrdvtqgw4Ii7VXYqk.WOoW/qXHs/WbGeE3cw01jUxwZb77J9MGi', 'tact@123', '1', '1', 23, NULL, '2019-10-23 06:18:53', '2019-10-23 06:18:53'),
(29, 'شعبة التدريب البحرى - فرع الإخصائيين', '$2y$10$LsWj6K3IKB1pn2BLWR14CeK4E5gOiJdSXjt0ZK4CMfzcfuA2ynctu', 'spec@123', '1', '1', 24, NULL, '2019-10-23 06:20:56', '2019-10-23 06:20:56'),
(30, 'شعبة التدريب البحرى - فرع التدريب العام', '$2y$10$LEASlSK1NGsoyumffeL4..GLVk8YlGYNINr5W9A1zBUBKHzvum2lu', 'gtraining@123', '1', '1', 25, NULL, '2019-10-23 06:21:50', '2019-10-23 06:21:50'),
(31, 'شعبة التدريب البحرى - فرع المنشآت التعليمية', '$2y$10$Dden8wgUAKzmzLtoS1G8UOWJbr8EVdaSukh0EtiwP9BpiGL5.hkvi', 'edu@123', '1', '1', 26, NULL, '2019-10-23 06:23:01', '2019-10-23 06:23:01'),
(32, 'شعبة التسليح البحرى', '$2y$10$PyZd3DfzUwf6OUaJU0XvoeCpc86XsxQuChP/8HhpfNDVqvhkXNGnq', 'arming@123', '1', '0', 4, NULL, '2019-10-26 07:30:33', '2019-10-26 07:30:33'),
(33, 'شعبة التفتيش البحرى', '$2y$10$WvdYelQOwsjKLrC5iMvg/O4PWUvsZ7nXDf/O8qpkaA2Cnoj/zzxYe', 'insp@123', '1', '0', 5, NULL, '2019-10-26 08:26:34', '2019-10-26 08:26:34'),
(34, 'شعبة العمليات البحرية - رئيس فرع العمليات', '$2y$10$0rt8tjhJu1.IDnC/hpiy0.v4ctPPNWRXu7bv3XspwgcE0OQcctKEu', 'prmaster@123', '0', '0', 6, NULL, '2019-10-28 13:46:46', '2019-10-28 13:46:46'),
(35, 'شعبة العمليات البحرية - ألية القيادة والسيطرة ', '$2y$10$bOaVnaERXgf93sQG5TcL9.KJRIQ0/h24v8d1u6pZmdygPi9nXT5e2', 'leader@123', '1', '1', 27, NULL, '2019-10-28 13:50:02', '2019-10-28 13:50:02'),
(36, 'شعبة العمليات البحرية - قائد مركز العمليات', '$2y$10$GmbWpcDIjOZr4IUgbe6xfe1NabbvJD1MdfK/mk9SMXDyDS.Ip5S.m', 'prcenter@123', '1', '1', 28, NULL, '2019-10-28 13:56:45', '2019-10-28 13:56:45'),
(37, 'شعبة العمليات البحرية - محور البحر الأحمر', '$2y$10$Szuaai/KBzbaqSvfi0WLC.mNjUofj71rfi22IpTQwWnTg2Y1LX1PS', 'redseah@123', '1', '1', 29, NULL, '2019-10-28 14:01:11', '2019-10-28 14:01:11'),
(38, 'شعبة العمليات البحرية - محور البحر المتوسط', '$2y$10$JKlBcur3ryH5c1b2lwOsHObWM6nDoJC8t9Dsr/ugkqAzvn.1TiANq', 'whiteseah@123', '1', '1', 30, NULL, '2019-10-28 14:14:51', '2019-10-28 14:14:51'),
(39, 'شعبة العمليات البحرية - محور تجاري', '$2y$10$D8eEudwAt2ZHfWcqVwJNx.Rsv9rCLxGbKXG4qWnt1CKmtOMndcP/u', 'commerch@123', '1', '1', 31, NULL, '2019-10-28 14:17:00', '2019-10-28 14:17:00'),
(40, 'شعبة العمليات البحرية - رئيس فرع الخطط', '$2y$10$uq9zEQPDVSxJrucOhxpLDucArD.xpM7J47dEMiPuOTxP6HUXNnam2', 'planmaster@123', '1', '1', 32, NULL, '2019-10-28 14:19:27', '2019-10-28 14:19:27'),
(41, 'شعبة العمليات البحرية - محور المعلومات', '$2y$10$PswathfPEQ9L6jSnGAPiyOLhuvTA3VuAVEeziVdz5NWwG96onuiMq', 'infoh@123', '1', '1', 33, NULL, '2019-10-28 15:02:52', '2019-10-28 15:02:52'),
(42, 'شعبة العمليات البحرية - الموقف الفني', '$2y$10$AoRpuIrNfrulW6DTyeMUyO4zqLop1BpKlYuyEwHgdwKuQ5aTYf.tO', 'technsit@123', '1', '1', 34, NULL, '2019-10-28 15:04:48', '2019-10-28 15:04:48'),
(43, 'شعبة العمليات البحرية - ضابط التسليح', '$2y$10$GN0Uius/IvdarIWTm9bAqeEDgdCZI7E/MjDVKlEMW4i52pG3D9WBa', 'armofficer@123', '1', '1', 35, NULL, '2019-10-28 15:06:43', '2019-10-28 15:06:43'),
(44, 'شعبة العمليات البحرية - فرع التدريب التعبوي', '$2y$10$CaW3.BiGrse44BJTbiTqgOJoFos10f8cUtl9SnfmZu13q3dmRbk.K', 'trdraft@123', '1', '1', 36, NULL, '2019-10-28 15:08:42', '2019-10-28 15:08:42'),
(45, 'شعبة العمليات البحرية - ضابط التعاون العسكري', '$2y$10$vBEyDpstmRIbBiDG43vkxOnGtbthMMgHKBHtqdhO.5fE5eh0yXbKC', 'armcop@123', '1', '1', 37, NULL, '2019-10-28 15:10:27', '2019-10-28 15:10:27'),
(46, 'شعبة العمليات البحرية - فرع إفرع إعداد دولة للحرب', '$2y$10$pQm2/xoEMny4RKgcVLJmm.0.wYvl2SlBJOCP3LDiZo3Prp7lIt5iS', 'prepwar@123', '1', '1', 38, NULL, '2019-10-28 15:12:13', '2019-10-28 15:12:13'),
(47, 'شعبة العمليات البحرية - رئيس شعبة العمليات', '$2y$10$2qq/hSxzzySEWNChHqDGIOiXqjwBtbqgQ5Zz3HREv2afNr59y5EWC', 'promaster@123', '1', '1', 39, NULL, '2019-10-28 15:15:42', '2019-10-28 15:15:42'),
(48, 'شعبة العمليات البحرية - نائب رئيس شعبة العمليات البحرية', '$2y$10$nv.Z19vqU8yJJ7dSr0zTLu2nG7v3mYFkdPtwOeoZq41q3Ux5ze15q', 'voipromas@123', '1', '1', 40, NULL, '2019-10-28 15:18:28', '2019-10-28 15:18:28'),
(49, 'فرع شئون العاملين', '$2y$10$DlFeR.dktfvpHbtmvEN17OyVrbovr3Uf1knTHKmmSCycxWAfxw0UC', 'employees@123', '0', '1', 41, NULL, '2019-11-03 08:57:39', '2019-11-03 08:57:39'),
(50, 'قسم الإنضباط العسكري', '$2y$10$0uHp68p/4U1xQsV3.1CswOCQuw3xz0bpdzebdykufdP9UkC7qMwB2', 'military@123', '1', '2', 2, NULL, '2019-11-03 10:09:37', '2019-11-03 10:09:37'),
(51, 'قسم الإدارة الداخلية', '$2y$10$a5K5JzilaNTi4o1SalpK8uUXa99.gV6fcfRrnpuU7z3LonJI2S9y.', 'innerman@123', '1', '2', 3, NULL, '2019-11-03 10:10:32', '2019-11-03 10:10:32'),
(52, 'قسم الشكاوي', '$2y$10$TcEW6YYByq6F6BrYoDDpDesfy9RQGfNaEyiIwlYGwtGWT/wcxHXdC', 'complain@123', '1', '2', 4, NULL, '2019-11-03 10:11:17', '2019-11-03 10:11:17'),
(53, 'فرع نظم المعلومات قيادة القوات البحرية', '$2y$10$Tacc/8nlXCSRIogoKQieqOyt3VKbGe4W0wpA2v843u8BmK/y1V3zW', 'nozom@123', '0', '1', 42, NULL, '2020-02-18 10:55:00', '2020-07-05 06:08:19'),
(55, 'فرع شئون الضباط', '$2y$10$sQsUEdZ5N4G8ZuQ49GXn9OrmdQt5LW0MmAyONm1Jh39cnAIbORFWS', 'officers@123', '0', '1', 43, NULL, '2020-03-03 09:19:52', '2020-03-03 09:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `master_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `master_id`, `created_at`, `updated_at`) VALUES
(2, 'فرع التحركات البحرى', 1, '2019-10-21 07:31:59', '2019-10-21 07:31:59'),
(3, 'فرع الوقود البحرى', 1, '2019-10-21 07:34:09', '2019-10-21 07:34:09'),
(4, 'فرع التعيينات البحرى', 1, '2019-10-21 07:35:16', '2019-10-21 07:35:16'),
(5, 'فرع المهمات البحرى', 1, '2019-10-21 07:35:31', '2019-10-21 07:35:31'),
(6, 'فرع الخدمات الطبية البحرى', 1, '2019-10-21 07:35:51', '2019-10-21 07:35:51'),
(7, 'فرع الخدمات البيطرية البحرى', 1, '2019-10-21 07:36:13', '2019-10-21 07:36:13'),
(8, 'فرع المطبوعات والنشر البحرى', 1, '2019-10-21 07:36:48', '2019-10-21 07:36:48'),
(9, 'فرع الإطفاء البحرى', 1, '2019-10-21 07:37:11', '2019-10-21 07:37:11'),
(10, 'فرع الإدارة العسكرية', 2, '2019-10-22 06:19:57', '2019-10-22 06:19:57'),
(11, 'فرع الأفراد', 2, '2019-10-22 06:20:12', '2019-10-22 06:20:12'),
(12, 'فرع السجلات', 2, '2019-10-22 06:28:18', '2019-10-22 06:28:18'),
(13, 'فرع التعبئة', 2, '2019-10-22 06:29:11', '2019-10-22 06:29:11'),
(14, 'فرع التخطيط', 2, '2019-10-22 06:35:29', '2019-10-22 06:35:29'),
(15, 'فرع تنظيم المرتبات', 2, '2019-10-22 06:36:37', '2019-10-22 06:36:37'),
(16, 'فرع الشئون الشخصية', 2, '2019-10-22 06:37:42', '2019-10-22 06:37:42'),
(17, 'قسم بيانات التسليح', 2, '2019-10-22 06:40:20', '2019-10-22 06:40:20'),
(18, 'فرع المراسم', 2, '2019-10-22 07:52:09', '2019-10-22 07:52:09'),
(19, 'جهاز كبير مهندسي القوات البحرية', NULL, '2019-10-22 08:52:47', '2019-10-22 08:52:47'),
(20, 'فرع الشئون المعنوية البحرى', NULL, '2019-10-22 16:31:55', '2019-10-22 16:31:55'),
(21, 'فرع القضاء العسكرى', NULL, '2019-10-23 05:35:55', '2019-10-23 05:35:55'),
(22, 'فرع التخطيط', 3, '2019-10-23 06:06:56', '2019-10-23 06:06:56'),
(23, 'فرع التدريب التكتيكي', 3, '2019-10-23 06:07:34', '2019-10-23 06:07:34'),
(24, 'فرع الإخصائيين', 3, '2019-10-23 06:08:18', '2019-10-23 06:08:18'),
(25, 'فرع التدريب العام', 3, '2019-10-23 06:08:53', '2019-10-23 06:08:53'),
(26, 'فرع المنشآت التعليمية', 3, '2019-10-23 06:09:17', '2019-10-23 06:09:17'),
(27, 'ألية القيادة والسيطرة ', 6, '2019-10-28 13:48:16', '2019-10-28 13:48:16'),
(28, 'قائد مركز العمليات', 6, '2019-10-28 13:51:54', '2019-10-28 13:51:54'),
(29, 'محور البحر الأحمر', 6, '2019-10-28 13:57:41', '2019-10-28 13:57:41'),
(30, 'محور البحر المتوسط', 6, '2019-10-28 14:13:39', '2019-10-28 14:13:39'),
(31, 'محور تجاري', 6, '2019-10-28 14:15:24', '2019-10-28 14:15:24'),
(32, 'رئيس فرع الخطط', 6, '2019-10-28 14:17:37', '2019-10-28 14:17:37'),
(33, 'محور المعلومات', 6, '2019-10-28 15:02:05', '2019-10-28 15:02:05'),
(34, 'الموقف الفني', 6, '2019-10-28 15:03:47', '2019-10-28 15:03:47'),
(35, 'ضابط التسليح', 6, '2019-10-28 15:05:48', '2019-10-28 15:05:48'),
(36, 'التدريب التعبوي', 6, '2019-10-28 15:07:36', '2019-10-28 15:07:36'),
(37, 'ضابط التعاون العسكري', 6, '2019-10-28 15:09:34', '2019-10-28 15:09:34'),
(38, 'فرع إعداد دولة للحرب', 6, '2019-10-28 15:11:22', '2019-10-28 15:11:22'),
(39, 'رئيس شعبة العمليات', 6, '2019-10-28 15:13:47', '2019-10-28 15:13:47'),
(40, 'نائب رئيس شعبة العمليات البحرية', 6, '2019-10-28 15:17:20', '2019-10-28 15:17:20'),
(41, 'فرع شئون العاملين', NULL, '2019-11-03 08:56:00', '2019-11-03 08:56:00'),
(42, 'فرع نظم المعلومات قيادة القوات البحرية', NULL, '2020-02-18 10:53:58', '2020-02-18 10:53:58'),
(43, 'فرع شئون الضباط', NULL, '2020-03-03 09:18:06', '2020-03-03 09:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'قسم التحقيقات', 10, '2019-10-22 07:54:05', '2019-10-22 07:54:05'),
(2, 'قسم الإنضباط العسكري', 10, '2019-11-03 10:07:54', '2019-11-03 10:07:54'),
(3, 'قسم الإدارة الداخلية', 10, '2019-11-03 10:08:21', '2019-11-03 10:08:21'),
(4, 'قسم الشكاوي', 10, '2019-11-03 10:08:43', '2019-11-03 10:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reciever` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `rep_date` date DEFAULT NULL,
  `copy_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'بدون',
  `user_type` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `logged_user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `number`, `subject`, `sender`, `reciever`, `date`, `rep_date`, `copy_to`, `type`, `image`, `folder`, `user_type`, `logged_user_id`, `created_at`, `updated_at`) VALUES
(160000026, '111', 'تجربة', 'فرع نظم المعلومات قيادة القوات البحرية', 'شعبة التنظيم والإدارة البحرية', '2020-10-11', NULL, 'شعبة التسليح البحرى', '0', '1602436722_image_unnamed.png', 'افتتاح فرقاطة جو ويند', '1', 42, '2020-10-11 15:18:42', '2020-10-12 05:51:42'),
(160000027, '123', 'تجربة تنظيم', 'شعبة التنظيم والإدارة البحرية', 'شعبة الإمداد والتموين البحرية', '2020-10-12', '2020-10-19', 'فرع نظم المعلومات قيادة القوات البحرية; فرع تنظيم المرتبات', '0', '1602436774_image_laravel_1270x500.png', 'متابعة', '0', 2, '2020-10-11 15:19:34', '2020-10-12 05:52:37'),
(160000028, '4444', 'مممممممممممم', 'فرع نظم المعلومات قيادة القوات البحرية', 'شعبة التنظيم والإدارة البحرية', '2020-10-18', '2020-10-17', 'قسم الشكاوي; شعبة التدريب البحرى', '0', '1602484934_image_download.jpg', 'افتتاح فرقاطة جو ويند', '1', 42, '2020-10-12 04:42:14', '2020-10-18 03:46:47'),
(160000031, '44444444', 'ووردااالت', 'شعبة الإمداد والتموين البحرية', 'شعبة التنظيم والإدارة البحرية', '2020-10-13', NULL, 'فرع التخطيط', '0', '1602611848_image_test - 2.docx|1602611848_image_test -1.docx|1602611848_image_test.docx', 'متابعة', '0', 2, '2020-10-13 15:57:28', '2020-10-18 04:44:26'),
(160000032, '6623', 'وووووووووووورد', 'شعبة الإمداد والتموين البحرية', 'شعبة التنظيم والإدارة البحرية', '2020-10-13', NULL, 'فرع التعبئة', '0', '1602613245_image_test - 2.docx|1602613245_image_test -1.docx|1602613245_image_test.docx', 'متابعة', '0', 2, '2020-10-13 16:20:45', '2020-10-18 04:44:28'),
(160000033, '1111', 'بي دي اف', 'شعبة الإمداد والتموين البحرية', 'شعبة التنظيم والإدارة البحرية', '2020-10-13', NULL, 'فرع السجلات', '0', '1602614211_image_test.pdf', 'بدون', '0', 2, '2020-10-13 16:36:51', '2020-10-13 16:36:51'),
(160000035, '45242424', 'فيري اسبيشال كيييس', 'شعبة الإمداد والتموين البحرية', 'شعبة التنظيم والإدارة البحرية', '2020-10-13', NULL, 'فرع الأفراد', '0', '1602614293_image_test.docx|1602614293_image_test.pdf|1602614293_image_Untitled-5.png', 'متابعة', '0', 2, '2020-10-13 16:38:13', '2020-10-18 04:44:17'),
(160000037, '3141', 'aaa', 'شعبة الإمداد والتموين البحرية', 'شعبة التنظيم والإدارة البحرية', '2020-10-18', NULL, 'فرع الأفراد', '0', '1603001500_image_10.0.0.2-2020-01-18-10-21-34.png', 'متابعة', '0', 2, '2020-10-18 04:11:40', '2020-10-18 04:44:17'),
(160000038, '24124', 'asdada', 'شعبة الإمداد والتموين البحرية', 'شعبة التنظيم والإدارة البحرية', '2020-10-18', '2020-10-21', 'فرع الإدارة العسكرية; فرع الأفراد', '0', '1603001524_image_default-image.PNG', 'متابعة', '0', 2, '2020-10-18 04:12:04', '2020-10-18 05:47:41'),
(160000039, '3333', 'word', 'شعبة التنظيم والإدارة البحرية', 'شعبة التنظيم والإدارة البحرية', '2020-10-18', NULL, 'فرع الأفراد', '0', '1603008442_image_test.docx', 'بدون', '0', 2, '2020-10-18 06:07:22', '2020-10-18 06:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `logged_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `name`, `user_type`, `logged_user_id`) VALUES
(1, 'متابعة', 0, 2),
(4, 'متابعة', 1, 42),
(5, 'افتتاح فرقاطة جو ويند', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `masters`
--

CREATE TABLE `masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `masters`
--

INSERT INTO `masters` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'شعبة الإمداد والتموين البحرية', '2019-10-21 07:23:05', '2019-10-21 07:23:05'),
(2, 'شعبة التنظيم والإدارة البحرية', '2019-10-22 06:07:40', '2019-10-22 06:07:40'),
(3, 'شعبة التدريب البحرى', '2019-10-23 06:06:13', '2019-10-23 06:06:13'),
(4, 'شعبة التسليح البحرى', '2019-10-26 06:43:12', '2019-10-26 06:43:12'),
(5, 'شعبة التفتيش البحرى', '2019-10-26 08:23:16', '2019-10-26 08:23:16'),
(6, 'شعبة العمليات البحرية', '2019-10-28 13:39:32', '2019-10-28 13:39:32'),
(7, 'قياده الاسطول الشمالي', '2020-03-23 06:43:56', '2020-03-23 06:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_15_201212_create_admins_table', 1),
(2, '2019_09_09_074547_create_documents_table', 1),
(3, '2019_09_18_122859_create_replies_table', 1),
(4, '2019_10_04_121421_add_table_master', 1),
(5, '2019_10_04_121448_add_table_branch', 1),
(6, '2019_10_04_121514_add_table_department', 1);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reciever` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `copy_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `logged_user_id` int(10) UNSIGNED NOT NULL,
  `document_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `number`, `subject`, `sender`, `reciever`, `date`, `copy_to`, `image`, `user_type`, `logged_user_id`, `document_id`, `created_at`, `updated_at`) VALUES
(160000014, '33333333', 'تجربة تنظيم', 'شعبة التنظيم والإدارة البحرية', 'شعبة الإمداد والتموين البحرية', '2020-10-11', 'فرع تنظيم المرتبات', '1602441168_image_2584663_0 (1).jpg', '0', 2, 160000027, '2020-10-11 16:32:48', '2020-10-13 04:10:50'),
(160000015, '44444', 'تجربة تنظيم', 'شعبة التنظيم والإدارة البحرية', 'شعبة الإمداد والتموين البحرية', '2020-10-12', 'فرع تنظيم المرتبات', '1602488821_image_blabla.PNG', '0', 2, 160000027, '2020-10-12 05:47:01', '2020-10-12 05:47:01'),
(160000018, '333333331133', 'تجربة تنظيم تعديل', 'شعبة التنظيم والإدارة البحرية', 'شعبة الإمداد والتموين البحرية', '2020-10-12', 'فرع شئون العاملين; فرع شئون الضباط', '1602569310_image_b089e65055a2cada53a77d903e0d9c56.jpg', '1', 42, 160000027, '2020-10-13 04:04:19', '2020-10-13 04:11:48'),
(160000019, '5555555555', 'مممممممممممم', 'شعبة التدريب البحرى', 'شعبة التنظيم والإدارة البحرية', '2020-10-18', 'فرع الإدارة العسكرية', '1602999453_image_24900181_1683211135071117_4351367374415273755_n.jpg', '0', 2, 160000028, '2020-10-18 03:37:33', '2020-10-18 03:37:33'),
(160000020, '61616', 'تجربة تنظيم', 'فرع نظم المعلومات قيادة القوات البحرية', 'شعبة الإمداد والتموين البحرية; شعبة التنظيم والإدارة البحرية', '2020-10-18', 'فرع تنظيم المرتبات', '1602999546_image_2584663_0 (1).jpg', '0', 2, 160000027, '2020-10-18 03:39:06', '2020-10-18 03:39:06'),
(160000021, '951', 'asdada', 'فرع الأفراد', 'شعبة التنظيم والإدارة البحرية', '2020-10-18', ' ', '1603003612_image_download.jpg', '1', 11, 160000038, '2020-10-18 04:46:52', '2020-10-18 04:46:52'),
(160000022, '321', 'aaa', 'فرع الأفراد', 'شعبة التنظيم والإدارة البحرية', '2020-10-18', ' ', '1603003638_image_logo.png', '1', 11, 160000037, '2020-10-18 04:47:18', '2020-10-18 04:47:18'),
(160000023, '411', 'asdada', 'فرع الإدارة العسكرية', 'شعبة التنظيم والإدارة البحرية', '2020-10-18', ' ', '1603007353_image_default-image.PNG', '1', 10, 160000038, '2020-10-18 05:49:13', '2020-10-18 05:49:13'),
(160000024, '55555', 'word', 'فرع الأفراد', 'شعبة التنظيم والإدارة البحرية', '2020-10-18', ' ', '1603008471_image_test - 2.docx', '1', 11, 160000039, '2020-10-18 06:07:51', '2020-10-18 06:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`) VALUES
(75, 'شعبة الإمداد والتموين البحرية'),
(76, 'شعبة التنظيم والإدارة البحرية'),
(77, 'شعبة التدريب البحرى'),
(78, 'شعبة التسليح البحرى'),
(79, 'شعبة التفتيش البحرى'),
(80, 'شعبة العمليات البحرية'),
(81, 'قياده الاسطول الشمالي'),
(82, 'جهاز كبير مهندسي القوات البحرية'),
(83, 'فرع الشئون المعنوية البحرى'),
(84, 'فرع القضاء العسكرى'),
(85, 'فرع شئون العاملين'),
(86, 'فرع نظم المعلومات قيادة القوات البحرية'),
(87, 'فرع شئون الضباط');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_master_id_foreign` (`master_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masters`
--
ALTER TABLE `masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_document_id_foreign` (`document_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160000040;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `masters`
--
ALTER TABLE `masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160000025;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_master_id_foreign` FOREIGN KEY (`master_id`) REFERENCES `masters` (`id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
