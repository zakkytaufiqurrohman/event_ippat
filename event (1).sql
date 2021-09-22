-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2021 at 02:13 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_19_035514_create_pendaftars_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftars`
--

CREATE TABLE `pendaftars` (
  `kode` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengda_id` int(11) NOT NULL,
  `wa` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_sk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_sk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_foto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_bukti` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendaftars`
--

INSERT INTO `pendaftars` (`kode`, `id`, `pengda_id`, `wa`, `email`, `nama`, `nick_name`, `ktp`, `no_sk`, `img_sk`, `img_foto`, `img_bukti`, `created_at`, `updated_at`) VALUES
('R19980001', 21, 1, 'eyJpdiI6Im1hZzRUSEx4RmFqMWl6ZEVFVGprdlE9PSIsInZhbHVlIjoieHRDSkluZlBpanY2Y3E2S2xrTC9YQT09IiwibWFjIjoiMzdlOTgyNzFmMzk1YjBlN2I2M2NlODRlMzVjZWNjZjg0OGUxMzM2MDE2M2FlYzhhOTcxOThkZDgyMGQyNjk4MiIsInRhZyI6IiJ9', 'eyJpdiI6IjRGdEhTTnZGcFZHV29iVVJvREVBSnc9PSIsInZhbHVlIjoiZUVsaVBQcndiTnFMTmo1VHJSd2dkTVFkbms1dlJTRlZ5Q2RVRzRQYnJkQT0iLCJtYWMiOiIzZWE2MDY4ZjYzZTUyZGFhM2ZiYjk5MjBlYTk2MjQxNGM4YjdkOGJkZTMwMGU3NjEzNGIzNWVhYWZhOGNhZGE5IiwidGFnIjoiIn0=', 'eyJpdiI6IjlEZS9LemtQcFlkVkFRZUdwb1dvREE9PSIsInZhbHVlIjoielZxL0RObVFjQWY5MDVhbjVKcDV6QT09IiwibWFjIjoiOGQ4YmMzMDVhZmUwMWE1OTg2NmZkMmVlZWQ1Y2Y3MDMxZDlkZDBhY2I1YjdkN2EzMTJiYTE0YjdiNGExYmUxMiIsInRhZyI6IiJ9', 'afifah', 'eyJpdiI6Ik1acE1OcUlUVkczQ0cyYW5LM21TSXc9PSIsInZhbHVlIjoiaHlRUEJMcEpjUTVVRXJ1eTBDT1l0UT09IiwibWFjIjoiMzFjNzgzYmI3MGM2YWZmYjBhMzFjYzI1OWMyNDVjN2JhYTg0MGJlZmRlODE4MzZiNGEwNDNhMWY3YTQzMGMzYSIsInRhZyI6IiJ9', 'eyJpdiI6IjBMVjJkMWMwR1JzQXdISXV5am9aUXc9PSIsInZhbHVlIjoidnNrY2NPUXZnWEhYTzI4cnExTDdQZz09IiwibWFjIjoiMTAzODE5M2I4MmE1ZmVjOWIwNTFjOTg0YjY4ZTE0ZTIwMWNmMTVhMjMyNDU3NGEyMzlkMmEwMmZhYTJlMzM4NSIsInRhZyI6IiJ9', '1632233435_146.jpg', '1632233435_146.jpg', '1632233435_146.jpg', '2021-09-21 07:10:35', '2021-09-21 07:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `pengdas`
--

CREATE TABLE `pengdas` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengdas`
--

INSERT INTO `pengdas` (`id`, `nama`) VALUES
(1, 'rembang'),
(4, 'Adi Yudha Sambudiono, SH.M.Kn'),
(5, 'Afifah, SH'),
(6, 'Agam Cendekia, SH, M.Kn'),
(7, 'Agus Suherlie, SH, M.Kn'),
(8, 'Agus Suki Widodo,SH,M.Kn'),
(9, 'Agustin Budiningsih, SH, M.Kn'),
(10, 'Akbar Sasmita, SH. M.Kn'),
(11, 'Alfonsus Gustin Wibisono, SH, M.Kn'),
(12, 'Alvin Yahya, SH.MH.M.Kn'),
(13, 'Amalia Zuria,SH'),
(14, 'Anas Wisnu Prihatin, SH, M.Kn'),
(15, 'Andhy Fauzi Barasa, SH.M.Kn'),
(16, 'Andikha Natalis Prihandoko, SH,Mkn.'),
(17, 'Andreas Prasetyo Senoadji,SH,M.Kn'),
(18, 'Andria Luhur Prakoso, SH.M.Kn'),
(19, 'Angelina, SH, M.Kn'),
(20, 'Angga Adhyaksa Suryaputra, SH.M.Kn'),
(21, 'Anisa Kartika Sari, SH, M.Kn'),
(22, 'Anna Sari Dewi, SH., M.Kn.'),
(23, 'Aprilia Hanastuti, SH, M.Kn'),
(24, 'Ariadji Danurdono,SH'),
(25, 'Arif Widodo, SH, M.Kn'),
(26, 'Aryati Nurul Aini, SH, MH'),
(27, 'Ayu Soraya, SH.M.Kn'),
(28, 'Bagas Lugasa, SH, M.Kn'),
(29, 'Bagus Suhaarsonoo, SH'),
(30, 'Baiq Irviana Kumala Dewi, S.H., M.Kn.'),
(31, 'Betta Triyanto, SH, M.Kn'),
(32, 'Budi Srilestari, SH, SP.N'),
(33, 'Budi Winanto, SH, M.Kn'),
(34, 'Christiana Astuti Winarni,SH'),
(35, 'Christina Erna Widiastuti, SH.M.Kn'),
(36, 'Citra Widi Widiyawati, SH.M.Kn'),
(37, 'Danang Prasodjo,SH'),
(38, 'Dani Hamidiar,SH'),
(39, 'Dedy Zainal, SH, M.Kn'),
(40, 'Descha Suryantoro, SH.M.Kn'),
(41, 'Destamia Mutiara Arruum, S.H., M.Kn.'),
(42, 'Dewi tri Puji Astuti,SH,M.Kn'),
(43, 'Dian Cahayani, SH, SE, M.Kn'),
(44, 'Dimas Akbar, SH, M.Kn.'),
(45, 'Djoko Hadi Santoso, SE, SH, M.Kn, MH'),
(46, 'Dorry Elvana Sarie,SH,M.Kn'),
(47, 'Dra. Moempoeni Sri Pratiwiningsih, SH., M.Kn'),
(48, 'Dra. Theresia Widiati'),
(49, 'Duanto Kurniawan, SH'),
(50, 'Dwi Harto Wibowo,SH,M.Kn'),
(51, 'Dyah Widayati, SH, MH.'),
(52, 'Edhi Juwono, SH'),
(53, 'Eko Budi Prasetyo,SH'),
(54, 'Eko Hariyanti, SH.M.Kn'),
(55, 'Eliza Safitri, SH, M.Kn'),
(56, 'Elok Puspa Arum, SH, M.Kn'),
(57, 'Emy Puspita Sari Sudaryanto, SH.M.Kn'),
(58, 'Endang Purwaningsih, SH, M.Kn'),
(59, 'Eric Chandra Pradipta, SH, M.Kn'),
(60, 'Ermin Marikha, SH, M.Kn'),
(61, 'Eviana, SH, M.Kn'),
(62, 'Fadlyna Ulfa Faisal, SH, S.Sos, M.Kn'),
(63, 'Felisia Kurniati Hermawan,SH.MKn'),
(64, 'Fransisca Irawaty Soehendro, SH. CN'),
(65, 'Galih Herwibowo, SH, M.Kn'),
(66, 'Galuh Sawitri, S.H., M.Kn.'),
(67, 'Gunawan Bambang I, SH'),
(68, 'H. Irawan Ahmad, SH'),
(69, 'Hani Arifin, SH.,M.Kn'),
(70, 'Hargiyanto, SH'),
(71, 'Haris Surya Saputra, SH, M.Kn'),
(72, 'Harno Saputro, SH, M.Kn'),
(73, 'Haryainasir, SH, M.Kn'),
(74, 'Helan Hanita Herlambang, SH, M.Kn'),
(75, 'Heny Yuliyastanti, SH, M.Kn'),
(76, 'Herlina, SH.MH.'),
(77, 'Herry Hartanto Seputro, SH'),
(78, 'Heru Suparto, SH, M.Kn'),
(79, 'Holy Oktaviani Putri, SH, M.Kn'),
(80, 'I Nyoman Cakranegara, SH'),
(81, 'Ignatius Agus Saptono, SH'),
(82, 'Ikhsan Prajawan Fadli, SH, SHI, M.Kn'),
(83, 'Ikke Lucky Andari, SH'),
(84, 'Indira Putri Irvani, SH, M.Kn'),
(85, 'Ispriyanti Wandasari, SH, M.Kn'),
(86, 'Jefri Okta Wijaya,SH,M.Kn'),
(87, 'Kusumastuti Indri Hapsari, SH, M.Kn'),
(88, 'Kusumo Nindito, SH, M.Kn'),
(89, 'Laurensia Maria Srijani, SH'),
(90, 'Lenachristina Soeryaningsih, SH'),
(91, 'Lilik Fatkhi Hidayat, ST, SH, M.Kn'),
(92, 'M. Adi Cahyono Santoso, SH, M.Kn'),
(93, 'Mariana Kustantia,SH.M.Kn'),
(94, 'Maryana, SH, M.Kn'),
(95, 'Meiska Veranita, Sh, M.Kn'),
(96, 'Monique Sri Oktari,SH,M.Kn'),
(97, 'Muhammad Muchlis, SH, M.Kn'),
(98, 'Murtini, SH'),
(99, 'Musta\'in,SH'),
(100, 'Nandhini Ayu Sarastri,SH,M.Kn'),
(101, 'Nanik Kusumawardhani, SH'),
(102, 'Natalia Widayati, SH, M.Kn'),
(103, 'Ngadiman, SH,M.Kn'),
(104, 'Nicko Bayu Pradana, SH, M.Kn'),
(105, 'Novina Eky Dianti, Sh, M.Kn'),
(106, 'Noviyanti Ekatama, SH., M.Kn'),
(107, 'Nur Cahyo Wulandari, SH.,Mkn.'),
(108, 'Nur Hidhayah Megawati, SH, M.Kn'),
(109, 'Nur Ika Probowati'),
(110, 'Nur Sari Amalia, SH, M.Kn'),
(111, 'Nurrahmah Soraya Lubis, SH, M.Kn'),
(112, 'Partini, SH'),
(113, 'Prafidya Mayhendra Putra, SH, M.Kn'),
(114, 'Pramesworo Sunaryo, SH, M.Kn'),
(115, 'Pratami Wahyudi Ningsih,SH,MH,M.Kn'),
(116, 'Pritha Anggraini, SH, M.Kn'),
(117, 'Purwatik, SH, S.Hi, M.Kn'),
(118, 'Puspa Indah Ayu Agustin, SH, MH, M.Kn'),
(119, 'Putu Ernawati Putri, SH, M.Kn'),
(120, 'Rachmah Risandi, SH, M.Kn'),
(121, 'Ranti Adininggar Hernowo, SH, M.Kn'),
(122, 'Renny Listianita Suryaningsih, SH, M.Kn'),
(123, 'Respati Achmad Ardianto, SH, M.Kn'),
(124, 'Retno Ismindari, SH, M.Kn'),
(125, 'Revy Oscar Dae Panie, SH, M.Kn'),
(126, 'Rheni Cahya Megawati, SH, M.Kn'),
(127, 'Riana Candrasari, SH, M.Kn'),
(128, 'Rosita Ruhani, SH, M.Kn'),
(129, 'Rosyida Nahdi, SH, M.Kn'),
(130, 'Salasa Surya Dharmawan, SH, M.Kn'),
(131, 'Sang Hapsari Arum Kusuma Putri,SH,M.Kn'),
(132, 'Sarwondo,SH'),
(133, 'Seno Budi Santoso, SH, CN'),
(134, 'Shinta Yunianingsih, SH'),
(135, 'Shintowati Dwi Marhaeny, SH'),
(136, 'Singgih Adji Saputra, SH, M.Kn'),
(137, 'Siti Saeful Fatimah, SH'),
(138, 'Sri Hari Wijayanto, SH, M.Kn'),
(139, 'Sri Harsiwi Rahayu,SH'),
(140, 'Sri Mulyaningsih,SH'),
(141, 'Sri Rumiyanti,SH,Sp.N'),
(142, 'Sri Wulan Anita Dyah K,SH'),
(143, 'Supatni, SH'),
(144, 'Susana Nurwulandari,SH,M.Kn.'),
(145, 'Susilowardani, SH, M.Kn'),
(146, 'Tarindra Perbawati,SH,M.Kn, MH.'),
(147, 'Tattie Srie Sapartinah, SH'),
(148, 'Taufan Rochaditomi Dachlius, S.H., M.Kn.'),
(149, 'Tegar Dilaga Halimana, SH., M.Kn'),
(150, 'Tesalonika Marta Ayuning Tyas, SH, M.Kn'),
(151, 'Tinon Mahanani Sadubudi, SH, M.Kn'),
(152, 'Tondo Ajibirowo, S.H., M.Kn.'),
(153, 'Totok Sumaryoto, SH.,MKn.'),
(154, 'Trajuningsari Tresnawati,SH'),
(155, 'Tri Lestari Mulinawati,SH,M.Kn'),
(156, 'Twinike Sativa Febriandini, SH, M.Kn'),
(157, 'Umi Noor Jannah, S.Pd, SH, M.Kn'),
(158, 'Vivi Duma Sari Siahaan, SH, M.Kn'),
(159, 'Wagiyanto, SH'),
(160, 'Wahyu Analista, SH, M.Kn'),
(161, 'Wahyudi Eko Nugroho,SH'),
(162, 'Wedi Hermanto Putra ,SH'),
(163, 'Wedy Asmara, SH, Sp.Not'),
(164, 'YFR Tri Martiwi, SH'),
(165, 'Yoerista Arya Megasari, SH, M.Kn'),
(166, 'Yohana Dea Sacharissa, SH, M.Kn'),
(167, 'Yosephine Minar Juang Sintawati,SH,M.Kn'),
(168, 'Yuli Kurniawan, SH, M.Kn'),
(169, 'Yulistika Setyadewi, SH'),
(170, 'Yunia Wukirsari, SH, M.Kn'),
(171, 'Yuyun Mitaningrum, S.Sn., SH., M.Kn');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk`
--

CREATE TABLE `sk` (
  `id` bigint(20) NOT NULL,
  `pengda_id` int(11) NOT NULL,
  `nama` varchar(400) NOT NULL,
  `no_sk` text NOT NULL,
  `alamat` text NOT NULL,
  `nick_name` text CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pendaftars`
--
ALTER TABLE `pendaftars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengdas`
--
ALTER TABLE `pengdas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sk`
--
ALTER TABLE `sk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pendaftars`
--
ALTER TABLE `pendaftars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pengdas`
--
ALTER TABLE `pengdas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk`
--
ALTER TABLE `sk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
