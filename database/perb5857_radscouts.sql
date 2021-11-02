-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2021 pada 01.49
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perb5857_radscouts`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `appoinment`
--

CREATE TABLE `appoinment` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_10_15_000000_create_roles_permissions_tables', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'home/list', 'web', NULL, NULL),
(2, 'appoinment/list', 'web', NULL, NULL),
(3, 'appoinment/view', 'web', NULL, NULL),
(4, 'appoinment/add', 'web', NULL, NULL),
(5, 'appoinment/store', 'web', NULL, NULL),
(6, 'appoinment/edit', 'web', NULL, NULL),
(7, 'appoinment/delete', 'web', NULL, NULL),
(8, 'user/list', 'web', NULL, NULL),
(9, 'user/view', 'web', NULL, NULL),
(10, 'user/add', 'web', NULL, NULL),
(11, 'user/store', 'web', NULL, NULL),
(12, 'user/edit', 'web', NULL, NULL),
(13, 'user/delete', 'web', NULL, NULL),
(14, 'account/list', 'web', NULL, NULL),
(15, 'account/edit', 'web', NULL, NULL),
(16, 'pitch_xscouts/list', 'web', NULL, NULL),
(17, 'pitch_xscouts/view', 'web', NULL, NULL),
(18, 'pitch_xscouts/add', 'web', NULL, NULL),
(19, 'pitch_xscouts/store', 'web', NULL, NULL),
(20, 'pitch_xscouts/edit', 'web', NULL, NULL),
(21, 'pitch_xscouts/delete', 'web', NULL, NULL),
(22, 'model_has_permissions/list', 'web', NULL, NULL),
(23, 'model_has_permissions/view', 'web', NULL, NULL),
(24, 'model_has_permissions/add', 'web', NULL, NULL),
(25, 'model_has_permissions/store', 'web', NULL, NULL),
(26, 'model_has_permissions/edit', 'web', NULL, NULL),
(27, 'model_has_permissions/delete', 'web', NULL, NULL),
(28, 'model_has_roles/list', 'web', NULL, NULL),
(29, 'model_has_roles/view', 'web', NULL, NULL),
(30, 'model_has_roles/add', 'web', NULL, NULL),
(31, 'model_has_roles/store', 'web', NULL, NULL),
(32, 'model_has_roles/edit', 'web', NULL, NULL),
(33, 'model_has_roles/delete', 'web', NULL, NULL),
(34, 'permissions/list', 'web', NULL, NULL),
(35, 'permissions/view', 'web', NULL, NULL),
(36, 'permissions/add', 'web', NULL, NULL),
(37, 'permissions/store', 'web', NULL, NULL),
(38, 'permissions/edit', 'web', NULL, NULL),
(39, 'permissions/delete', 'web', NULL, NULL),
(40, 'role_has_permissions/list', 'web', NULL, NULL),
(41, 'role_has_permissions/view', 'web', NULL, NULL),
(42, 'role_has_permissions/add', 'web', NULL, NULL),
(43, 'role_has_permissions/store', 'web', NULL, NULL),
(44, 'role_has_permissions/edit', 'web', NULL, NULL),
(45, 'role_has_permissions/delete', 'web', NULL, NULL),
(46, 'roles/list', 'web', NULL, NULL),
(47, 'roles/view', 'web', NULL, NULL),
(48, 'roles/add', 'web', NULL, NULL),
(49, 'roles/store', 'web', NULL, NULL),
(50, 'roles/edit', 'web', NULL, NULL),
(51, 'roles/delete', 'web', NULL, NULL),
(52, 'pitch_xscouts/list_review', 'web', NULL, NULL),
(53, 'home/list', 'web', NULL, NULL),
(54, 'account/list', 'web', NULL, NULL),
(55, 'account/edit', 'web', NULL, NULL),
(56, 'pitch_xscouts/list_review', 'web', NULL, NULL),
(57, 'home/list', 'web', NULL, NULL),
(58, 'appoinment/list', 'web', NULL, NULL),
(59, 'appoinment/view', 'web', NULL, NULL),
(60, 'appoinment/add', 'web', NULL, NULL),
(61, 'appoinment/store', 'web', NULL, NULL),
(62, 'appoinment/edit', 'web', NULL, NULL),
(63, 'appoinment/delete', 'web', NULL, NULL),
(64, 'appoinment/importdata', 'web', NULL, NULL),
(65, 'user/list', 'web', NULL, NULL),
(66, 'user/view', 'web', NULL, NULL),
(67, 'user/add', 'web', NULL, NULL),
(68, 'user/store', 'web', NULL, NULL),
(69, 'user/edit', 'web', NULL, NULL),
(70, 'user/delete', 'web', NULL, NULL),
(71, 'user/importdata', 'web', NULL, NULL),
(72, 'pitch_xscouts/list', 'web', NULL, NULL),
(73, 'pitch_xscouts/view', 'web', NULL, NULL),
(74, 'pitch_xscouts/add', 'web', NULL, NULL),
(75, 'pitch_xscouts/store', 'web', NULL, NULL),
(76, 'pitch_xscouts/edit', 'web', NULL, NULL),
(77, 'pitch_xscouts/delete', 'web', NULL, NULL),
(78, 'pitch_xscouts/importdata', 'web', NULL, NULL),
(79, 'model_has_permissions/list', 'web', NULL, NULL),
(80, 'model_has_permissions/view', 'web', NULL, NULL),
(81, 'model_has_permissions/add', 'web', NULL, NULL),
(82, 'model_has_permissions/store', 'web', NULL, NULL),
(83, 'model_has_permissions/edit', 'web', NULL, NULL),
(84, 'model_has_permissions/delete', 'web', NULL, NULL),
(85, 'model_has_permissions/importdata', 'web', NULL, NULL),
(86, 'model_has_roles/list', 'web', NULL, NULL),
(87, 'model_has_roles/view', 'web', NULL, NULL),
(88, 'model_has_roles/add', 'web', NULL, NULL),
(89, 'model_has_roles/store', 'web', NULL, NULL),
(90, 'model_has_roles/edit', 'web', NULL, NULL),
(91, 'model_has_roles/delete', 'web', NULL, NULL),
(92, 'model_has_roles/importdata', 'web', NULL, NULL),
(93, 'permissions/list', 'web', NULL, NULL),
(94, 'permissions/view', 'web', NULL, NULL),
(95, 'permissions/add', 'web', NULL, NULL),
(96, 'permissions/store', 'web', NULL, NULL),
(97, 'permissions/edit', 'web', NULL, NULL),
(98, 'permissions/delete', 'web', NULL, NULL),
(99, 'permissions/importdata', 'web', NULL, NULL),
(100, 'role_has_permissions/list', 'web', NULL, NULL),
(101, 'role_has_permissions/view', 'web', NULL, NULL),
(102, 'role_has_permissions/add', 'web', NULL, NULL),
(103, 'role_has_permissions/store', 'web', NULL, NULL),
(104, 'role_has_permissions/edit', 'web', NULL, NULL),
(105, 'role_has_permissions/delete', 'web', NULL, NULL),
(106, 'role_has_permissions/importdata', 'web', NULL, NULL),
(107, 'roles/list', 'web', NULL, NULL),
(108, 'roles/view', 'web', NULL, NULL),
(109, 'roles/add', 'web', NULL, NULL),
(110, 'roles/store', 'web', NULL, NULL),
(111, 'roles/edit', 'web', NULL, NULL),
(112, 'roles/delete', 'web', NULL, NULL),
(113, 'roles/importdata', 'web', NULL, NULL),
(114, 'account/list', 'web', NULL, NULL),
(115, 'account/edit', 'web', NULL, NULL),
(116, 'pitch_xscouts/list_review', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pitch_xscouts`
--

CREATE TABLE `pitch_xscouts` (
  `id` int(15) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `focus_field` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spec_subject` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prog` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposal` blob NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `review_status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approval_status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review_date` datetime DEFAULT NULL,
  `approval_date` datetime DEFAULT NULL,
  `meeting_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pitch_xscouts`
--

INSERT INTO `pitch_xscouts` (`id`, `name`, `company`, `phone`, `email`, `focus_field`, `spec_subject`, `prog`, `message`, `proposal`, `created_date`, `review_status`, `approval_status`, `meeting_status`, `review_date`, `approval_date`, `meeting_date`) VALUES
(1, 'Hendra Rukmana', 'FAM 18', '0812635586536', 'dimarzhio@gmail.com', 'New Renewable Energy', 'Solar Panel', 'PP', 'Percobaan', 0x68747470733a2f2f70657274616d696e616e657776656e74757265732e636f6d2f77702d636f6e74656e742f75706c6f6164732f656c656d656e746f722f666f726d732f363135336233656565393064642e706466, '2021-09-29 07:31:43', '', '', '', NULL, NULL, NULL),
(2, 'Ida', 'ida power', '0481995495', 'atma.wiguna85@gmail.com', 'New Renewable Energy', 'Solar Panel', 'PP', 'Halo', 0x68747470733a2f2f70657274616d696e616e657776656e74757265732e636f6d2f77702d636f6e74656e742f75706c6f6164732f656c656d656e746f722f666f726d732f363135336362313563333232622e706466, '2021-09-29 09:10:30', 'Yes', '', '', '2021-10-29 12:00:00', NULL, NULL),
(3, 'Ida', 'Ida Battery', '0481995495', 'atma.wiguna85@gmail.com', 'New Renewable Energy', 'Battery Swapping', 'GP', '', 0x68747470733a2f2f70657274616d696e616e657776656e74757265732e636f6d2f77702d636f6e74656e742f75706c6f6164732f656c656d656e746f722f666f726d732f363135336431353133353737382e706466, '2021-09-29 09:37:05', '', '', '', NULL, NULL, NULL),
(4, 'Ida Test', 'Ida Power', '0811111111', 'dimarzhio@gmail.com', 'New Renewable Energy', 'Battery Swapping', 'PP', 'Ida', 0x68747470733a2f2f70657274616d696e616e657776656e74757265732e636f6d2f77702d636f6e74656e742f75706c6f6164732f656c656d656e746f722f666f726d732f363135336439376439623636322e706466, '2021-09-29 10:11:57', '', '', '', NULL, NULL, NULL),
(5, 'Sandi Febri Wijaya', 'Indospace.net', '082278394230', 'dimarzhio@gmail.com', 'Supporting Future Technology', 'Softwares in Energy Industry', 'GP', '', 0x68747470733a2f2f70657274616d696e616e657776656e74757265732e636f6d2f77702d636f6e74656e742f75706c6f6164732f656c656d656e746f722f666f726d732f363135336538376235343861362e706466, '2021-09-29 11:15:55', '', '', '', NULL, NULL, NULL),
(6, 'ida', 'ida power', '081111111', 'dimarzhio@gmail.com', 'New Renewable Energy', 'Solar Panel', 'PP', 'Halo', 0x68747470733a2f2f70657274616d696e616e657776656e74757265732e636f6d2f77702d636f6e74656e742f75706c6f6164732f656c656d656e746f722f666f726d732f363135336635333734363036342e706466, '2021-09-29 12:10:15', '', '', '', NULL, NULL, NULL),
(7, 'Sri Baskoro Julianto', 'PT. Kreasi Indirama Nusantara', '08888992000', 'dimarzhio@gmail.com', 'Supporting Future Technology', 'Others', 'GP', 'PT. Kreasi Indirama Nusantara (kindy.id) mempunyai aplikasi berbasis Android yang mendorong perubahan perilaku manusia untuk hidup sehat sekaligus mengajak masyarakat agar dapat menjaga kelestarian alam dan ekosistemnya serta untuk mendukung mereka yang telah membuat perubahan, baik para relawan melalui kegiatan kemanusiaan mereka, atau mereka yang telah membuat inovasi produk untuk menyelamatkan bumi dari polusi udara. penebangan hutan liar, perburuan hewan dilindungi, yang dapat menyebabkan bencana alam seperti banjir, gempa bumi, kekeringan, tanah longsor dan kepunahan. Dengan konsep usaha menggunakan sistem pembiayaan bersama (crowdfunding)/ melalui donasi masyarakat kepada para pelaku usaha, inovator, aktivis lingkungan dan pembuat kampanye sosial & lingkungan lainnya (fundraiser) demi untuk mendukung & mensukseskan tujuan dari SDGs poin ke 7 & 8 (energi bersih & terjangkau & pekerjaan layak serta pertumbuhan ekonomi).', 0x68747470733a2f2f70657274616d696e616e657776656e74757265732e636f6d2f77702d636f6e74656e742f75706c6f6164732f656c656d656e746f722f666f726d732f363135383139616234366433642e706466, '2021-10-02 15:34:51', '', '', '', NULL, NULL, NULL),
(8, 'Muhaimin Iqbal', 'New Energy Asia', '+6281297424633', 'dimarzhio@gmail.com', 'New Renewable Energy', 'Biofuels', 'PP', 'We are developing three technologies to enable Local Fuels - fuels which are produced and used in the same area .  It can be applied through out Indonesia, up to the smallest island.\r\n\r\nDetails in our web www.nue.sia or video explanation at : https://youtu.be/_wVItVYNlXg', 0x68747470733a2f2f70657274616d696e616e657776656e74757265732e636f6d2f77702d636f6e74656e742f75706c6f6164732f656c656d656e746f722f666f726d732f363135626437303739376164362e706466, '2021-10-05 11:39:36', 'Yes', '', '', '2021-10-29 12:00:00', NULL, NULL),
(9, 'Puji Akmal Sapriant', 'serlok', '081383962126', 'dimarzhio@gmail.com', 'New Renewable Energy', 'Big Data Analysis', 'PP', 'Yang Terhormat Bapak/Ibu \r\nPimpinan Pertamina dan Kementrian BUMN Indonesia \r\n\r\nMohon izin perkenalkan saya Puji akmal sapriant/Akmal selaku Pendiri serlok yaitu suatu aplikasi/platform jaringan sosial karya anak bangsa yang dapat terhubung dengan Bank Sampah dan tujuan mengajukan proposal ini agar serlok dapat menjalin kerjasama dengan pertamina untuk mewujudkan bersama-sama dan seluas-luasnya dalam mengembangkan Program Pertamina terhadap Bank Sampah sehingga Indonesia lebih maju terdepan terhadap energi terbarukan, dalam hal ini serlok selaku platform jaringan sosial memiliki kesamaan visi dan misi apa yang dicita-citakan Bapak Presiden Jokowi agar Indonesia bersih,  sehingga startup serlok jaringan sosial ini hadir dengan terintegrasi Bank Sampah yang saat ini belum ada platform jaringan sosial untuk solusi lingkungan atau yang kita pun masih ketergantungan terhadap jaringan sosial dari luar.\r\n\r\nBesar harapan saya agar dapat terlajin bekerjasama dengan Pertamina untuk tujuan SDG / Sutainable Development Goals bersama-sama dan akhir kata semoga Bapak/Ibu diberikan Rahmat dan Kesehatan selalu oleh TUHAN YANG MAHA ESA \r\n\r\nSalam dan Terima kasih atas kesempatan diberikan \r\nAkmal\r\nserlok.co', 0x68747470733a2f2f70657274616d696e616e657776656e74757265732e636f6d2f77702d636f6e74656e742f75706c6f6164732f656c656d656e746f722f666f726d732f363135646638376630653062632e706466, '2021-10-07 02:26:55', 'Yes', '', '', '2021-10-30 12:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2021-10-30 00:47:15', '2021-10-30 00:47:15'),
(2, 'user', 'web', '2021-10-30 00:47:17', '2021-10-30 00:47:17'),
(3, 'developer', 'web', '2021-10-30 00:47:17', '2021-10-30 00:47:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 3),
(3, 1),
(3, 3),
(4, 1),
(4, 3),
(5, 1),
(5, 3),
(6, 1),
(6, 3),
(7, 1),
(7, 3),
(8, 1),
(8, 3),
(9, 1),
(9, 3),
(10, 1),
(10, 3),
(11, 1),
(11, 3),
(12, 1),
(12, 3),
(13, 1),
(13, 3),
(14, 1),
(14, 2),
(14, 3),
(15, 1),
(15, 2),
(15, 3),
(16, 1),
(16, 3),
(17, 1),
(17, 3),
(18, 1),
(18, 3),
(19, 1),
(19, 3),
(20, 1),
(20, 3),
(21, 1),
(21, 3),
(22, 1),
(22, 3),
(23, 1),
(23, 3),
(24, 1),
(24, 3),
(25, 1),
(25, 3),
(26, 1),
(26, 3),
(27, 1),
(27, 3),
(28, 1),
(28, 3),
(29, 1),
(29, 3),
(30, 1),
(30, 3),
(31, 1),
(31, 3),
(32, 1),
(32, 3),
(33, 1),
(33, 3),
(34, 1),
(34, 3),
(35, 1),
(35, 3),
(36, 1),
(36, 3),
(37, 1),
(37, 3),
(38, 1),
(38, 3),
(39, 1),
(39, 3),
(40, 1),
(40, 3),
(41, 1),
(41, 3),
(42, 1),
(42, 3),
(43, 1),
(43, 3),
(44, 1),
(44, 3),
(45, 1),
(45, 3),
(46, 1),
(46, 3),
(47, 1),
(47, 3),
(48, 1),
(48, 3),
(49, 1),
(49, 3),
(50, 1),
(50, 3),
(51, 1),
(51, 3),
(52, 1),
(52, 2),
(52, 3),
(64, 3),
(71, 3),
(78, 3),
(85, 3),
(92, 3),
(99, 3),
(106, 3),
(113, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` blob NOT NULL,
  `user_role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `photo`, `user_role`) VALUES
(1, 'mabrur', '$2y$10$OgCfI5pJcTc5IZr/x844r.nkXy57HXCj8C4.RMqLlvl56LudaLMDe', 'dimarzhio@gmail.com', 0x75706c6f6164732f66696c65732f36316435323133392d616337392d343536312d383036362d6166613765386337633465322e6a7067, 'administrator'),
(2, 'mabrur18', '$2y$10$LGVbKlAYdYhR63iO78U3a.XuqTWW1OlQKuJDtE2KG509voJ7VAWh6', 'moehziend@gmail.com', 0x75706c6f6164732f66696c65732f38316462663836632d613534612d346432322d623964662d3634303037396439333533382e6a7067, 'developer'),
(3, 'idabagus', '$2y$10$xtnaD.eGx8QuXcHW0YMwyOP2xrV8ljOaw6BzIvUgniMy.hgdhpFD2', 'idabagus@gmail.com', 0x75706c6f6164732f66696c65732f36356538333032342d653639302d343837332d623335642d3433346562643430633538622e706e67, 'administrator'),
(4, 'operator', '$2y$10$YYveP0WZESbuA3IF5ZN.ueQWo3CeP1LFjrx6IUc4ynGpBn4HT8N3S', 'idabagus@pertamina.com', 0x75706c6f6164732f66696c65732f34656661653731622d656462332d343633372d623832392d3830336531343661653361632e6a7067, 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `appoinment`
--
ALTER TABLE `appoinment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pitch_xscouts`
--
ALTER TABLE `pitch_xscouts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `appoinment`
--
ALTER TABLE `appoinment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT untuk tabel `pitch_xscouts`
--
ALTER TABLE `pitch_xscouts`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
