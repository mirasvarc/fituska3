-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 18. dub 2021, 18:22
-- Verze serveru: 10.4.17-MariaDB
-- Verze PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `fituska`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `calendar`
--

CREATE TABLE `calendar` (
  `id` int(10) UNSIGNED NOT NULL,
  `calendar_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `calendar`
--

INSERT INTO `calendar` (`id`, `calendar_id`, `created_at`, `updated_at`) VALUES
(5, '8r180cfcvjttu5of58o5lu7fu8@group.calendar.google.com', '2021-04-18 10:43:45', '2021-04-18 10:43:45');

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upvotes` int(11) NOT NULL,
  `downvotes` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `comments`
--

INSERT INTO `comments` (`id`, `author_id`, `post_id`, `parent_id`, `content`, `upvotes`, `downvotes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '<p>Ahoj</p>', 0, 0, '2021-02-15 18:39:21', '2021-02-15 18:39:21'),
(2, 1, 1, 1, '<p>Odpověď</p>', 0, 0, '2021-02-15 18:40:26', '2021-02-15 18:40:26'),
(3, 1, 2, NULL, '<p>test</p>', 0, 0, '2021-02-26 06:47:46', '2021-02-26 06:47:46'),
(4, 1, 3, NULL, '<p>test</p>', 0, 0, '2021-02-26 06:50:43', '2021-02-26 06:50:43'),
(5, 1, 3, NULL, '<p>test</p>', 0, 0, '2021-02-26 06:52:03', '2021-02-26 06:52:03'),
(6, 1, 3, NULL, '<p>ahoj</p>', 0, 0, '2021-02-26 06:53:20', '2021-02-26 06:53:20'),
(7, 1, 3, NULL, '<p>ccc</p>', 0, 0, '2021-02-26 06:56:43', '2021-02-26 06:56:43'),
(8, 1, 3, NULL, '<p>ahoj</p>', 0, 0, '2021-02-26 06:57:57', '2021-02-26 06:57:57'),
(9, 1, 3, NULL, '<p>xxx</p>', 0, 0, '2021-02-26 07:24:18', '2021-02-26 07:24:18'),
(10, 1, 3, 9, '<p>Test</p>', 0, 0, '2021-03-12 12:13:52', '2021-03-12 12:13:52'),
(11, 1, 1, 1, '<p>xxx</p>', 0, 0, '2021-03-12 12:16:35', '2021-03-12 12:16:35'),
(12, 1, 1, NULL, '<p>Nevim</p>', 0, 0, '2021-03-12 12:16:43', '2021-03-12 12:16:43'),
(13, 1, 1, 12, '<p>Joj</p>', 0, 0, '2021-03-12 12:16:49', '2021-03-12 12:16:49'),
(14, 1, 1, 12, '<p>Haha</p>', 0, 0, '2021-03-12 12:16:55', '2021-03-12 12:16:55'),
(15, 1, 1, 12, '<p>Odpověd na Ahoj 1</p>', 0, 0, '2021-03-13 09:44:53', '2021-03-13 09:44:53'),
(16, 1, 1, 1, '<p>qwertz</p>', 0, 0, '2021-03-13 09:52:49', '2021-03-13 09:52:49'),
(17, 1, 1, NULL, '<p>tat</p>', 0, 0, '2021-03-13 09:53:12', '2021-03-13 09:53:12'),
(18, 1, 1, 1, '<p>reset</p>', 0, 0, '2021-03-13 09:54:13', '2021-03-13 09:54:13'),
(19, 1, 1, 1, '<p>znovu</p>', 0, 0, '2021-03-13 09:56:23', '2021-03-13 09:56:23'),
(20, 1, 1, NULL, '<p>response</p>', 0, 0, '2021-03-13 11:37:45', '2021-03-13 11:37:45'),
(21, 1, 1, NULL, '<p>res</p>', 0, 0, '2021-03-13 11:38:52', '2021-03-13 11:38:52'),
(22, 1, 2, NULL, '<p>lalal</p>', 0, 0, '2021-03-21 11:54:20', '2021-03-21 11:54:20'),
(23, 1, 34, NULL, '<p>test</p>', 0, 0, '2021-03-21 11:57:47', '2021-03-21 11:57:47'),
(25, 6, 78, NULL, 'Test', 0, 0, '2021-04-07 16:04:00', '2021-04-07 16:04:00'),
(26, 1, 86, NULL, '<p>[a+b=c]</p>', 0, 0, '2021-04-17 08:07:34', '2021-04-17 08:07:34'),
(27, 1, 86, NULL, '<p>[[a+b=c]]</p>', 0, 0, '2021-04-17 08:07:44', '2021-04-17 08:07:44'),
(28, 1, 86, NULL, '<p><img src=\"/storage/uploads/latex/1618654090.png\"></p>', 0, 0, '2021-04-17 08:08:10', '2021-04-17 08:08:10'),
(29, 1, 86, 28, '<p><img src=\"/storage/uploads/latex/1618654099.png\"></p>', 0, 0, '2021-04-17 08:08:19', '2021-04-17 08:08:19'),
(30, 1, 86, NULL, '<p>test</p>', 0, 0, '2021-04-17 08:12:22', '2021-04-17 08:12:22'),
(31, 1, 86, 30, '<p>haha</p>', 0, 0, '2021-04-17 08:12:29', '2021-04-17 08:12:29');

-- --------------------------------------------------------

--
-- Struktura tabulky `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `contact_form`
--

INSERT INTO `contact_form` (`id`, `full_name`, `email`, `msg`, `created_at`, `updated_at`) VALUES
(1, 'Miroslav Švarc', 'mirasvarc1@gmail.com', 'Test', '2021-03-16 16:55:54', '2021-03-16 16:55:54'),
(2, 'Test Test', 'miroslav.svarc@4g.cz', 'T', '2021-03-16 16:58:49', '2021-03-16 16:58:49'),
(3, 'Miroslav Švarc', 'mirasvarc1@gmail.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Pellentesque sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Integer malesuada. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam quis quam. Maecenas lorem. Nulla est. Nulla pulvinar eleifend sem. Donec iaculis gravida nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.', '2021-03-16 17:08:17', '2021-03-16 17:08:17');

-- --------------------------------------------------------

--
-- Struktura tabulky `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calendar_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `courses`
--

INSERT INTO `courses` (`id`, `code`, `full_name`, `calendar_id`, `created_at`, `updated_at`) VALUES
(1, 'IFJ', 'Formální jazyky a překladače', 'gag7s5a3hemc486g6ft2oo0l4g@group.calendar.google.com', NULL, '2021-04-15 08:09:23'),
(2, 'IAL', 'Algoritmy', '232kiqcas43d63d8h7ukqikais@group.calendar.google.com', '2021-04-07 17:09:43', '2021-04-15 08:15:05'),
(7, 'AEU', 'Angličtina pro Evropu', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(8, 'AGS', 'Agentní a multiagentní systémy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(9, 'AVS', 'Architektury výpočetních systémů', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(10, 'AIS', 'Analýza a návrh informačních systémů', '8prin5h2eoj1i4jjclc2b6ket0@group.calendar.google.com', '2021-04-11 12:09:44', '2021-04-15 08:16:07'),
(11, 'AIT', 'Angličtina pro IT', 'ql2aeodk0hq6kgmmfp1a1jrc30@group.calendar.google.com', '2021-04-11 12:09:44', '2021-04-15 11:38:32'),
(12, 'ALG', 'Algebra', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(13, 'APD', 'Vybraná témata z analýzy a překladu jazyků', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(14, 'PPP', 'Praktické paralelní programování', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(15, 'ASD', 'Zpracování řeči a audia člověkem a počítačem', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(16, 'ATA', 'Automatizované testování a dynamická analýza', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(17, 'BAN2', 'Angličtina 2: mírně pokročilí 2', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(18, 'BAN3', 'Angličtina 3: středně pokročilí 1', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(19, 'BAN4', 'Angličtina 4: středně pokročilí 2', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(20, 'BAYa', 'Bayesovské modely pro strojové učení (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(21, 'BID', 'Bezpečnost informačních systémů a kryptografie', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(22, 'BIF', 'Bioinformatika', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(23, 'BIN', 'Biologií inspirované počítače', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(24, 'BIO', 'Biometrické systémy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(25, 'BIS', 'Bezpečnost informačních systémů', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(26, 'BMS', 'Bezdrátové a mobilní sítě', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(27, 'BZA', 'Bezpečná zařízení', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(28, 'CCS', 'Pokročilý návrh a zabezpečení podnikových sítí', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(29, 'I1C', 'Síťová kabeláž a směrování (CCNA1+CCNA2)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(30, 'CPSa', 'Návrh kyberfyzikálních systémů  (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(31, 'CSOa', 'CCNA Kybernetická bezpečnost (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(32, 'CZSa', 'Číslicové zpracování signálů (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(33, 'DFAa', 'Digitální forenzní analýza (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(34, 'DIPe', 'Diplomová práce Erasmus (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(35, 'DIPa', 'Diplomová práce (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(36, 'DIP', 'Diplomová práce', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(37, 'DJA', 'Dynamické jazyky', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(38, 'DMA1', 'Statistika, stochastické procesy, operační výzkum', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(39, 'DPC-TK1', 'Optimalizační metody a teorie hromadné obsluhy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(40, 'DS_2p', 'Datové sklady (pro FP)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(41, 'EUD', 'Evoluční a neurální hardware', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(42, 'EVD', 'Evoluční výpočetní techniky', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(43, 'EVO', 'Aplikované evoluční algoritmy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(44, 'FAD', 'Formální analýza programů', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(45, 'IFAN', 'Finanční analýza', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(46, 'SAV', 'Statická analýza a verifikace', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(47, 'FCE', 'Angličtina: praktický kurz obchodní konverzace a prezentace', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(48, 'FIK', 'Filozofie a kultura', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(49, 'FIT', 'Dějiny a filozofie techniky', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(50, 'FLP', 'Funkcionální a logické programování', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(51, 'FVS', 'Funkční verifikace číslicových systémů', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(52, 'FYO', 'Fyzikální optika', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(53, 'FYOe', 'Fyzikální optika (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(54, 'GAL', 'Grafové algoritmy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(55, 'GALe', 'Grafové algoritmy (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(56, 'GJA', 'Grafická uživatelská rozhraní v Javě', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(57, 'GJAe', 'Grafická uživatelská rozhraní v Javě (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(58, 'GMU', 'Grafické a multimediální procesory', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(59, 'GZN', 'Grafická a zvuková rozhraní a normy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(60, 'HKO', 'Manažerská komunikace a prezentace', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(61, 'HSCe', 'Hardware/Software Codesign (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(62, 'HSC', 'Hardware/Software Codesign', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(63, 'HVR', 'Manažerské vedení lidí a řízení času', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(64, 'IACH', 'Architektura 20. století', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(65, 'IALe', 'Algoritmy (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(66, 'IAL', 'Algoritmy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(67, 'IAM', 'Pokročilá matematika', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(68, 'IAN', 'Analýza binárního kódu', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(69, 'ISU', 'Programování na strojové úrovni', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(70, 'IBS', 'Bezpečnost a počítačové sítě', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(71, 'IBTe', 'Bakalářská práce Erasmus (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(72, 'IBT', 'Bakalářská práce', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(73, 'ICP', 'Seminář C++', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(74, 'ICS', 'Seminář C#', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(75, 'ICUL', 'České umění 2. poloviny 20. století v souvislostech - letní', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(76, 'ICUZ', 'České umění 1. poloviny 20. století v souvislostech - zimní', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(77, 'IDF1', 'Dějiny a kontexty fotografie 1 - zimní', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(78, 'IDF2', 'Dějiny a kontexty fotografie 2 - letní', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(79, 'IDM', 'Diskrétní matematika', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(80, 'IDSe', 'Databázové systémy (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(81, 'IDS', 'Databázové systémy', 'm28toccq6kfgin73o9q476b3i4@group.calendar.google.com', '2021-04-11 12:09:44', '2021-04-15 08:25:56'),
(82, 'ID2L', 'Dějiny designu 2 - letní', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(83, 'ID2Z', 'Dějiny designu 2 - zimní', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(84, 'IEL', 'Elektronika pro informační technologie', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(85, 'IFAI', 'Fyzika 1 - fyzika pro audio inženýrství', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(86, 'IFEa', 'Fyzika v elektrotechnice (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(87, 'IFJ', 'Formální jazyky a překladače', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(88, 'IFJe', 'Formální jazyky a překladače (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(89, 'IFS', 'Fyzikální seminář', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(90, 'IIS', 'Informační systémy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(91, 'IJA', 'Seminář Java', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(92, 'IJAe', 'Seminář Java (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(93, 'IJC', 'Jazyk C', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(94, 'SUR', 'Strojové učení a rozpoznávání', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(95, 'ILG', 'Lineární algebra', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(96, 'ILI', 'Pokročilá témata administrace operačního systému Linux', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(97, 'IMA1', 'Matematická analýza 1', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(98, 'IMA2', 'Matematická analýza 2', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(99, 'IMF', 'Matematické základy fuzzy logiky', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(100, 'IMPe', 'Mikroprocesorové a vestavěné systémy (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(101, 'IMP', 'Mikroprocesorové a vestavěné systémy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(102, 'IMS', 'Modelování a simulace', 'tjrsft189mhd1q6nqmov2kgrt0@group.calendar.google.com', '2021-04-11 12:09:44', '2021-04-15 08:39:46'),
(103, 'INC', 'Návrh číslicových systémů', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(104, 'INCe', 'Návrh číslicových systémů (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(105, 'INI', 'Návrh a implementace IT služeb', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(106, 'INP', 'Návrh počítačových systémů', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(107, 'IOS', 'Operační systémy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(108, 'IPK', 'Počítačové komunikace a sítě', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(109, 'IPMA', 'Management', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(110, 'IPPe', 'Principy programovacích jazyků a OOP (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(111, 'IPP', 'Principy programovacích jazyků a OOP', 't0hhb1pls3581aac428gti1m6s@group.calendar.google.com', '2021-04-11 12:09:44', '2021-04-15 07:58:55'),
(112, 'IPS', 'Programovací seminář', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(113, 'IPT', 'Pravděpodobnost a statistika', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(114, 'IP1e', 'Projektová praxe 1 (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(115, 'IP1', 'Projektová praxe 1', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(116, 'IP2', 'Projektová praxe 2', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(117, 'IP2e', 'Projektová praxe 2 (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(118, 'IP3', 'Projektová praxe 3', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(119, 'ISA', 'Síťové aplikace a správa sítí', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(120, 'ISC', 'Počítačový seminář', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(121, 'ISD', 'Inteligentní systémy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(122, 'ISJ', 'Skriptovací jazyky', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(123, 'ISM', 'Matematický seminář', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(124, 'ISS', 'Signály a systémy', 'jv7io7pl5atcr52npulhkn0v9g@group.calendar.google.com', '2021-04-11 12:09:44', '2021-04-15 08:23:26'),
(125, 'ITS', 'Testování a dynamická analýza', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(126, 'ITTe', 'Semestrální projekt Erasmus  (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(127, 'ITT', 'Semestrální projekt', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(128, 'ITU', 'Tvorba uživatelských rozhraní', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(129, 'ITUe', 'Tvorba uživatelských rozhraní (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(130, 'ITW', 'Tvorba webových stránek', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(131, 'ITWe', 'Tvorba webových stránek (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(132, 'ITY', 'Typografie a publikování', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(133, 'IUS', 'Úvod do softwarového inženýrství', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(134, 'IVG', 'Informační výchova a gramotnost', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(135, 'IVH', 'Seminář VHDL', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(136, 'IVP1', 'Vybrané partie z matematiky I.', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(137, 'IVP2', 'Vybrané partie z matematiky II.', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(138, 'IVS', 'Praktické aspekty vývoje software', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(139, 'IV108', 'Bioinformatika', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(140, 'IZA', 'Programování zařízení Apple', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(141, 'IZG', 'Základy počítačové grafiky', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(142, 'IZP', 'Základy programování', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(143, 'IZSL', 'Zobrazovací systémy v lékařství', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(144, 'IZU', 'Základy umělé inteligence', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(145, 'IZUe', 'Základy umělé inteligence (v angličtině)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(146, 'I2C', 'Technologie sítí LAN a WAN (CCNA3+4)', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(147, 'JAD', 'Zkouška z jazyka anglického pro Ph.D.', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(148, 'JA3', 'Anglická konverzace na aktuální témata', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(149, 'JA6D', 'Angličtina pro doktorandy', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(150, 'JS1', 'Španělština: začátečníci 2/2', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(151, 'JS1', 'Španělština: začátečníci 1/2', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(152, 'KKO', 'Kódování a komprese dat', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(153, 'KNN', 'Konvoluční neuronové sítě', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(154, 'IKPT', 'Kultura projevu a tvorba textů', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(155, 'KRD', 'Klasifikace a rozpoznávání', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(156, 'KRY', 'Kryptografie', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(157, 'LOG', 'Logika', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(158, 'IMAE', 'Makroekonomie', NULL, '2021-04-11 12:09:44', '2021-04-11 12:09:44'),
(159, 'MATe', 'Matematické struktury v informatice (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(160, 'MID', 'Moderní matematické metody v informatice', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(161, 'IMIE', 'Mikroekonomie', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(162, 'MLD', 'Matematická logika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(163, 'MMAT', 'Maticový a tenzorový počet', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(164, 'MMD', 'Moderní metody zobrazování 3D scény', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(165, 'MOG', 'Molekulární genetika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(166, 'MPR', 'Management projektů', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(167, 'MSD', 'Modelování a simulace', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(168, 'MSP', 'Statistika a pravděpodobnost', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(169, 'MTIa', 'Moderní trendy informatiky (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(170, 'MULe', 'Multimédia (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(171, 'MUL', 'Multimédia', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(172, 'IW1', 'Desktop systémy Microsoft Windows', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(173, 'IW2', 'Serverové systémy Microsoft Windows', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(174, 'IW5', 'Programování v .NET a C#', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(175, 'MZD', 'Moderní metody zpracování řeči', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(176, 'NAV', 'Návrh vestavěných systémů', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(177, 'NSB', 'Návrh, správa a bezpečnost', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(178, 'OPD', 'Optika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(179, 'OPM', 'Optimalizace', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(180, 'ORID', 'Optimální řízení a identifikace', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(181, 'IPA', 'Pokročilé asemblery', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(182, 'PBD', 'Pokročilé biometrické systémy', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(183, 'PBI', 'Pokročilá bioinformatika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(184, 'PCG', 'Paralelní výpočty na GPU', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(185, 'PCS', 'Pokročilé číslicové systémy', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(186, 'PDBe', 'Pokročilé databázové systémy (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(187, 'PDB', 'Pokročilé databázové systémy', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(188, 'PDD', 'Aplikace paralelních počítačů', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(189, 'PDI', 'Prostředí distribuovaných aplikací', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(190, 'PDS', 'Přenos dat, počítačové sítě a protokoly', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(191, 'PDSe', 'Přenos dat, počítačové sítě a protokoly (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(192, 'MBA', 'Analýza systémů založená na modelech', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(193, 'IIPD', 'Inženýrská pedagogika a didaktika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(194, 'PGD', 'Počítačová grafika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(195, 'PGPa', 'Pokročilá počítačová grafika (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(196, 'PGRe', 'Počítačová grafika (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(197, 'PGR', 'Počítačová grafika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(198, 'PIS', 'Pokročilé informační systémy', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(199, 'PKS', 'Pokročilé komunikační systémy', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(200, 'PMA', 'Projektový manažer', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(201, 'PND', 'Pokročilé techniky návrhu číslicových systémů', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(202, 'POVa', 'Počítačové vidění (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(203, 'IPPK', 'Počítačová podpora konstruování', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(204, 'IUCE', 'Účetnictví', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(205, 'PP1', 'Projektová praxe 1', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(206, 'PP1e', 'Projektová praxe 1 (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(207, 'PP2', 'Projektová praxe 2', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(208, 'PRL', 'Paralelní a distribuované algoritmy', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(209, 'PRM', 'Právní minimum', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(210, 'IPSO', 'Pedagogická psychologie', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(211, 'PTD', 'Principy syntézy testovatelných obvodů', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(212, 'RET', 'Rétorika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(213, 'RGD', 'Regulované gramatiky a automaty', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(214, 'ROBa', 'Robotika (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(215, 'RTSa', 'Systémy pracující v reálném čase (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(216, 'SEM', 'Senzory a měření', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(217, 'SEPe', 'Semestrální projekt Erasmus (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(218, 'SEP', 'Semestrální projekt', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(219, 'SEPa', 'Semestrální projekt (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(220, 'SFC', 'Soft Computing', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(221, 'SIN', 'Inteligentní systémy', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(222, 'SLA', 'Lineární algebra', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(223, 'SLOa', 'Složitost (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(224, 'SNT', 'Simulační nástroje a techniky', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(225, 'SOD', 'Systémy odolné proti poruchám', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(226, 'SPP', 'Systémy odolné proti poruchám', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(227, 'SRI', 'Strategické řízení informačních systémů', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(228, 'SUI', 'Umělá inteligence a strojové učení', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(229, 'SYS', 'Systémová biologie', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(230, 'TAD', 'Teorie a aplikace Petriho sítí', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(231, 'TAMa', 'Tvorba aplikací pro mobilní zařízení (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(232, 'THE', 'Teorie her', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(233, 'TID', 'Moderní teoretická informatika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(234, 'TINe', 'Teoretická informatika (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(235, 'TIN', 'Teoretická informatika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(236, 'TJD', 'Teorie programovacích jazyků', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(237, 'TKD', 'Teorie kategorií v informatice', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(238, 'TOI', 'Principy a návrh IoT systémů', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(239, 'UPA', 'Ukládání a příprava dat', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(240, 'UXIa', 'Uživatelská zkušenost a návrh rozhraní a služeb (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(241, 'VDD', 'Vědecké publikování od A do Z', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(242, 'VGE', 'Výpočetní geometrie', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(243, 'VGEe', 'Výpočetní geometrie (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(244, 'VIN', 'Výtvarná informatika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(245, 'VIZa', 'Vizualizace a CAD (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(246, 'VKD', 'Vybrané kapitoly z algoritmů', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(247, 'VND', 'Vysoce náročné výpočty', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(248, 'VNV', 'Vysoce náročné výpočty', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(249, 'VPD', 'Vybrané problémy informačních systémů', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(250, 'VYF', 'Výpočetní fotografie', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(251, 'VYPa', 'Výstavba překladačů (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(252, 'WAP', 'Internetové aplikace', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(253, 'IZEP', 'Základy ekonomiky podniku', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(254, 'IZFI', 'Základy financování', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(255, 'ZHA', 'Základy hudební akustiky', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(256, 'IZMA', 'Základy marketingu', 'beipcj03mnqfbn5hj5m6t1e8hs@group.calendar.google.com', '2021-04-11 12:09:45', '2021-04-18 09:55:01'),
(257, 'ZPD', 'Zpracování přirozeného jazyka', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(258, 'ZPO', 'Zpracování obrazu', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(259, 'ZPOe', 'Zpracování obrazu (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(260, 'ZPX', 'Zahraniční odborná praxe', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(261, 'ZREe', 'Zpracování řečových signálů (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(262, 'ZRE', 'Zpracování řečových signálů', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(263, 'ZZN', 'Získávání znalostí z databází', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(264, 'IKPO', 'Kurz pornostudií', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(265, 'IATD', 'Aktuální témata grafického designu', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(266, 'IODI', '3D optická digitalizace - zimní', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(267, 'I3T1', 'Digitální sochařství - 3D tisk 1', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(268, 'I3T2', 'Digitální sochařství - 3D tisk 2', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(269, 'IDH1', 'Vizuální styly digitálních her 1', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(270, 'IDH2', 'Vizuální styly digitálních her 2', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(271, 'IAHS', 'Aplikovaná herní studia - výzkum a design', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(272, 'IKAH', 'Kritická analýza digitálních her', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(273, 'IHS', 'Herní studia', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(274, 'PP2e', 'Projektová praxe 2 (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(275, 'IZV', 'Zpracování a vizualizace dat v prostředí Python', '8r180cfcvjttu5of58o5lu7fu8@group.calendar.google.com', '2021-04-11 12:09:45', '2021-04-18 10:43:46'),
(276, 'IFTE', 'Finanční trhy pro ekonomické informatiky', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(277, 'IFIM', 'Finanční management pro informatiky', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(278, 'IECa', 'Elektronický obchod (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(279, 'IMMa', 'Digitální marketing a sociální média (v angličtině)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(280, 'IPSM', 'Plošné spoje a povrchová montáž', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(281, 'IAUD', 'Audio elektronika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(282, 'IZSY', 'Zabezpečovací systémy', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(283, 'IPDS', 'Projektování datových sítí', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(284, 'INRP', 'Návrh a realizace elektronických přístrojů', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(285, 'IRBM', 'Robotika a manipulátory', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(286, 'IIOT', 'Komunikační systémy pro IoT', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(287, 'IELS', 'Elektrotechnický seminář', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(288, 'IELA', 'Elektroakustika 1', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(289, 'IDSY', 'Daňový systém ČR', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(290, 'IANA', 'Analogová technika', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(291, 'IMV', 'Matematické výpočty pomocí MAPLE', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(292, 'IMSO', 'Matematický software', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(293, 'IPF2', 'Počítačová fyzika II', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(294, 'IPF1', 'Počítačová fyzika I', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(295, 'IMR', 'Mobilní roboty', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(296, 'IPL', 'Podnikatelská laboratoř', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(297, 'C1P', 'Směrování v rozsáhlých sítích (ROUTE)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(298, 'C2P', 'Sítě s vícevrstevným přepínáním (SWITCH)', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(299, 'IAE1', 'Analogová elektronika 1', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(300, 'IAE2', 'Analogová elektronika 2', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(301, 'DMKZI', 'Metody kvantového zpracování informace', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(302, 'IA082', 'Fyzikální koncepty kvantového zpracování informace', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(303, 'BISSIT', 'Brno International Summer School in Information Technology', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45'),
(304, 'IM2A', 'Matematika 2', NULL, '2021-04-11 12:09:45', '2021-04-11 12:09:45');

-- --------------------------------------------------------

--
-- Struktura tabulky `exams`
--

CREATE TABLE `exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `failed_jobs`
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
-- Struktura tabulky `file`
--

CREATE TABLE `file` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(10) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_exam` tinyint(1) DEFAULT NULL,
  `is_su` int(11) DEFAULT NULL,
  `is_su_private` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `file`
--

INSERT INTO `file` (`id`, `name`, `author_id`, `type`, `path`, `is_exam`, `is_su`, `is_su_private`, `created_at`, `updated_at`) VALUES
(1, 'PotvrzeniOStudiu_zadost_44109.pdf', 1, 'pdf', 'PotvrzeniOStudiu_zadost_44109.pdf', NULL, NULL, NULL, '2021-03-03 16:16:17', '2021-03-03 16:16:17'),
(2, 'COVID19-okresy_-_VZOR-Potvrzeni_zamestnavatele_na_cesty_do_mista_vykonu_prace_-_20210228.pdf', 1, 'pdf', 'COVID19-okresy_-_VZOR-Potvrzeni_zamestnavatele_na_cesty_do_mista_vykonu_prace_-_20210228.pdf', 0, NULL, NULL, '2021-03-03 16:21:33', '2021-03-03 16:21:33'),
(3, 'KRITERIA_Mgr_2021_2022.doc', 1, 'doc', 'KRITERIA_Mgr_2021_2022.doc', 1, NULL, NULL, '2021-03-03 16:22:27', '2021-03-03 16:22:27'),
(4, 'fituska_archiv.png', 1, 'png', 'fituska_archiv.png', 0, 1, 1, '2021-04-17 08:33:11', '2021-04-17 08:33:11'),
(5, 'fituska_scheme.png', 1, 'png', 'fituska_scheme.png', 0, 1, NULL, '2021-04-17 08:34:30', '2021-04-17 08:34:30');

-- --------------------------------------------------------

--
-- Struktura tabulky `forums`
--

CREATE TABLE `forums` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `has_file`
--

CREATE TABLE `has_file` (
  `post_id` int(10) UNSIGNED DEFAULT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `file_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `has_file`
--

INSERT INTO `has_file` (`post_id`, `course_id`, `file_id`, `created_at`, `updated_at`) VALUES
(33, 1, 1, '2021-03-03 16:16:17', '2021-03-03 16:16:17'),
(NULL, 1, 2, '2021-03-03 16:21:33', '2021-03-03 16:21:33'),
(NULL, 1, 3, '2021-03-03 16:22:27', '2021-03-03 16:22:27');

-- --------------------------------------------------------

--
-- Struktura tabulky `has_received_messages`
--

CREATE TABLE `has_received_messages` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `message_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `has_role`
--

CREATE TABLE `has_role` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `has_role`
--

INSERT INTO `has_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(14, 1, 1, '2021-03-13 09:28:19', '2021-03-13 09:28:19'),
(18, 1, 4, '2021-04-17 08:35:32', '2021-04-17 08:35:32'),
(19, 1, 3, '2021-04-17 08:35:59', '2021-04-17 08:35:59');

-- --------------------------------------------------------

--
-- Struktura tabulky `has_seen_post`
--

CREATE TABLE `has_seen_post` (
  `id` int(10) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `has_seen_post`
--

INSERT INTO `has_seen_post` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-02-15 18:39:17', '2021-02-15 18:39:17'),
(2, 1, 2, '2021-02-19 14:02:33', '2021-02-19 14:02:33'),
(3, 1, 3, '2021-02-19 14:02:41', '2021-02-19 14:02:41'),
(4, 1, 5, '2021-02-26 06:39:07', '2021-02-26 06:39:07'),
(11, 1, 33, '2021-03-03 16:16:17', '2021-03-03 16:16:17'),
(12, 1, 34, '2021-03-09 17:52:03', '2021-03-09 17:52:03'),
(13, 1, 4, '2021-03-12 12:13:41', '2021-03-12 12:13:41'),
(42, 1, 68, '2021-03-18 17:04:41', '2021-03-18 17:04:41'),
(45, 1, 78, '2021-04-11 08:32:02', '2021-04-11 08:32:02'),
(46, 1, 7, '2021-04-11 09:01:35', '2021-04-11 09:01:35'),
(47, 1, 84, '2021-04-11 18:24:23', '2021-04-11 18:24:23'),
(48, 1, 85, '2021-04-11 18:29:10', '2021-04-11 18:29:10'),
(49, 1, 86, '2021-04-13 10:09:35', '2021-04-13 10:09:35'),
(51, 1, 90, '2021-04-13 10:16:40', '2021-04-13 10:16:40'),
(52, 1, 91, '2021-04-15 13:26:52', '2021-04-15 13:26:52'),
(53, 1, 92, '2021-04-17 08:03:45', '2021-04-17 08:03:45');

-- --------------------------------------------------------

--
-- Struktura tabulky `has_sent_messages`
--

CREATE TABLE `has_sent_messages` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `message_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `is_following_calendar`
--

CREATE TABLE `is_following_calendar` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `calendar_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `is_following_calendar`
--

INSERT INTO `is_following_calendar` (`user_id`, `calendar_id`, `created_at`, `updated_at`) VALUES
(1, 5, '2021-04-18 10:46:19', '2021-04-18 10:46:19'),
(1, 5, '2021-04-18 10:51:06', '2021-04-18 10:51:06'),
(1, 5, '2021-04-18 10:51:53', '2021-04-18 10:51:53'),
(1, 5, '2021-04-18 10:51:58', '2021-04-18 10:51:58'),
(1, 5, '2021-04-18 10:53:02', '2021-04-18 10:53:02');

-- --------------------------------------------------------

--
-- Struktura tabulky `is_following_course`
--

CREATE TABLE `is_following_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `is_following_course`
--

INSERT INTO `is_following_course` (`id`, `course_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 2, 1, '2021-04-11 10:15:20', '2021-04-11 10:15:20'),
(5, 10, 1, '2021-04-11 14:24:24', '2021-04-11 14:24:24'),
(6, 1, 1, '2021-04-11 17:43:02', '2021-04-11 17:43:02');

-- --------------------------------------------------------

--
-- Struktura tabulky `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_04_06_173105_create_courses_table', 1),
(5, '2020_04_06_173146_create_is_following_course_table', 1),
(6, '2020_04_06_173155_create__exams_table', 1),
(7, '2020_04_06_173203_create_roles_table', 1),
(8, '2020_04_06_173210_create_has_role_table', 1),
(9, '2020_04_06_173220_create_calendar_table', 1),
(10, '2020_04_06_173229_create_is_following_calendar_table', 1),
(11, '2020_04_06_173244_create_messages_table', 1),
(12, '2020_04_06_173252_create_has_sent_messages_table', 1),
(13, '2020_04_06_173301_create_has_received_messages_table', 1),
(14, '2020_04_06_173345_create_file_table', 1),
(15, '2020_08_29_183811_create_user_settings_table', 1),
(16, '2021_02_15_185442_create_modules_table', 1),
(17, '2021_02_15_190255_create_topics_table', 1),
(18, '2021_04_06_173316_create_posts_table', 1),
(19, '2021_04_06_173324_create_comments_table', 1),
(20, '2021_04_06_173337_create_has_seen_post_table', 1),
(21, '2021_04_06_173348_create_has_file_table', 1),
(22, '2021_03_14_154223_create_user_vote_table', 2),
(23, '2021_03_14_155745_create_user_has_voted_table', 3),
(24, '2021_03_16_175233_create_contact_form_table', 4),
(25, '2021_04_11_103432_create_user_voted_post_table', 5);

-- --------------------------------------------------------

--
-- Struktura tabulky `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `installed` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `modules`
--

INSERT INTO `modules` (`id`, `name`, `installed`, `created_at`, `updated_at`) VALUES
(1, 'Google calendar', 1, NULL, '2021-03-02 18:36:25'),
(2, 'Discord API', 1, NULL, NULL),
(3, 'Facebook API', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `topic_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upvotes` int(11) NOT NULL,
  `downvotes` int(11) NOT NULL,
  `type` enum('Zadání','Materiály','Diskuze','Otázka','Ostatní') COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_post_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `topic_id`, `course_id`, `title`, `content`, `upvotes`, `downvotes`, `type`, `facebook_post_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Testovací příspěvek', '<p>Test&iacute;k</p>', 12, 7, 'Zadání', NULL, '2021-02-15 18:39:17', '2021-04-15 11:46:11'),
(2, 1, 1, 1, 'Test', '<p>TEst</p>', 0, 0, 'Zadání', NULL, '2021-02-19 14:02:33', '2021-02-19 14:02:33'),
(3, 1, 1, 1, 'Ahoj', '<p>ss</p>', 1, 0, 'Zadání', NULL, '2021-02-19 14:02:41', '2021-04-11 08:59:31'),
(4, 1, 1, 1, 'Paginate test', 'Paginate test', 0, 0, 'Zadání', NULL, NULL, NULL),
(5, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(7, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 15, 7, 'Zadání', NULL, NULL, '2021-04-11 09:11:24'),
(8, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(11, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(12, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(13, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(14, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(15, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(16, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(17, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(18, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(19, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(20, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(21, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(22, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(23, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(24, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(25, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(26, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(27, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(28, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(29, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(30, 1, 1, 1, 'Paginate test 2', 'Paginate test 2', 0, 0, 'Zadání', NULL, NULL, NULL),
(32, 1, 1, 1, 'File', 'File', 0, 0, 'Zadání', NULL, '2021-03-03 16:13:49', '2021-03-03 16:13:49'),
(33, 1, 1, 1, 'File', 'File', 0, 0, 'Zadání', NULL, '2021-03-03 16:16:17', '2021-03-03 16:16:17'),
(34, 1, 2, NULL, 'Ahoj', 'Ahojky', 0, 0, 'Zadání', NULL, '2021-03-09 17:46:36', '2021-03-09 17:46:36'),
(35, 1, 1, 1, 'DC TEST', '<p>DC TEST</p>', 0, 0, 'Zadání', NULL, '2021-03-18 16:22:23', '2021-03-18 16:22:23'),
(38, 1, 1, 1, 'x', '<p>x</p>', 0, 0, 'Zadání', NULL, '2021-03-18 16:24:47', '2021-03-18 16:24:47'),
(39, 1, 1, 1, 'x', '<p>x</p>', 0, 0, 'Zadání', NULL, '2021-03-18 16:25:05', '2021-03-18 16:25:05'),
(40, 1, 1, 1, 'x', '<p>x</p>', 0, 0, 'Zadání', NULL, '2021-03-18 16:25:31', '2021-03-18 16:25:31'),
(41, 1, 1, 1, 'Ahoj', '<p>aa</p>', 0, 0, 'Zadání', NULL, '2021-03-18 16:29:00', '2021-03-18 16:29:00'),
(68, 1, 1, 1, 'Zkouška', '<p>Ahoj, nevim</p>', 0, 0, 'Zadání', NULL, '2021-03-18 17:04:40', '2021-03-18 17:04:40'),
(78, 6, 3, 1, 'Facebook post', '<p> Kdy bude zkouška?</p>', 2, 1, 'Diskuze', '1722428574572165_1930689933746027', '2021-04-07 16:04:00', '2021-04-11 08:58:48'),
(79, 1, 1, 1, 'xxx', '<p>lalal <img src=\"storage/uploads/latex/storage/uploads/latex/1618172462.jpg\"> co to je <img src=\"storage/uploads/latex/storage/uploads/latex/1618172463.jpg\"> nevim</p>', 0, 0, 'Zadání', NULL, '2021-04-11 18:21:03', '2021-04-11 18:21:03'),
(80, 1, 1, 1, 'xxx', '<p>lalal <img src=\"storage/uploads/latex/storage/uploads/latex/1618172478.jpg\"> co to je <img src=\"storage/uploads/latex/storage/uploads/latex/1618172479.jpg\"> nevim</p>', 0, 0, 'Zadání', NULL, '2021-04-11 18:21:20', '2021-04-11 18:21:20'),
(81, 1, 1, 1, 'xxx', '<p>lalal <img src=\"storage/uploads/latex/storage/uploads/latex/1618172532.jpg\"> co to je <img src=\"storage/uploads/latex/storage/uploads/latex/1618172533.jpg\"> nevim</p>', 0, 0, 'Zadání', NULL, '2021-04-11 18:22:13', '2021-04-11 18:22:13'),
(82, 1, 1, 1, 'xxx', '<p>lalal <img src=\"storage/uploads/latex/storage/uploads/latex/1618172559.jpg\"> co to je <img src=\"storage/uploads/latex/storage/uploads/latex/1618172560.jpg\"> nevim</p>', 0, 0, 'Zadání', NULL, '2021-04-11 18:22:40', '2021-04-11 18:22:40'),
(83, 1, 1, 1, 'xxx', '<p>lalal <img src=\"storage/uploads/latex/storage/uploads/latex/1618172571.jpg\"> co to je <img src=\"storage/uploads/latex/storage/uploads/latex/1618172571.jpg\"> nevim</p>', 0, 0, 'Zadání', NULL, '2021-04-11 18:22:51', '2021-04-11 18:22:51'),
(84, 1, 1, 1, 'xxx', '<p>lalal <img src=\"storage/uploads/latex/storage/uploads/latex/1618172662.jpg\"> co to je <img src=\"storage/uploads/latex/storage/uploads/latex/1618172663.jpg\"> nevim</p>', 0, 0, 'Zadání', NULL, '2021-04-11 18:24:23', '2021-04-11 18:24:23'),
(85, 1, 1, 1, 'Latex test', '<p>Ahoj, tohle je test latexu <img src=\"/storage/uploads/latex/1618172948.jpg\"> protože latex je potřeba <img src=\"/storage/uploads/latex/1618172949.jpg\"></p>', 0, 0, 'Zadání', NULL, '2021-04-11 18:29:09', '2021-04-11 18:29:09'),
(86, 1, 5, 2, 'xxx', '<p>DC test</p>', 0, 0, 'Zadání', NULL, '2021-04-13 10:09:33', '2021-04-13 10:09:33'),
(87, 1, 5, 2, 'test', '<p>bot nejde</p>', 0, 0, 'Zadání', NULL, '2021-04-13 10:11:43', '2021-04-13 10:11:43'),
(88, 1, 5, 2, 'sss', '<p>sss</p>', 0, 0, 'Zadání', NULL, '2021-04-13 10:13:55', '2021-04-13 10:13:55'),
(90, 1, 5, 2, 'Exception test', '<p>Exception test</p>', 0, 0, 'Zadání', NULL, '2021-04-13 10:16:37', '2021-04-13 10:16:37'),
(91, 1, 5, 2, 'LaTex', '<p>Test LaTexu <img src=\"/storage/uploads/latex/1618500410.png\"></p>', 0, 0, 'Zadání', NULL, '2021-04-15 13:26:50', '2021-04-15 13:26:50'),
(92, 1, 5, 2, 'dsd', '<p>[a^{6}=4]</p>', 0, 0, 'Zadání', NULL, '2021-04-17 08:03:42', '2021-04-17 08:03:42');

-- --------------------------------------------------------

--
-- Struktura tabulky `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrátor', NULL, NULL),
(2, 'Student', NULL, NULL),
(3, 'Vedení SU', NULL, NULL),
(4, 'Člen SU', NULL, NULL),
(5, 'Učitel', NULL, NULL),
(6, 'Doktorand', NULL, NULL),
(7, 'Ověřený učitel', NULL, NULL),
(8, 'Ověřený doktorand', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `topics`
--

CREATE TABLE `topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `forum_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `topics`
--

INSERT INTO `topics` (`id`, `name`, `course_id`, `forum_id`, `created_at`, `updated_at`) VALUES
(1, 'Test', 1, NULL, '2021-02-15 18:37:41', '2021-02-15 18:37:41'),
(2, 'Diskuze test', NULL, 1, '2021-03-09 16:58:31', '2021-03-09 16:58:31'),
(3, 'Facebook', 1, NULL, '2021-04-06 17:06:33', '2021-04-06 17:06:33'),
(4, 'Q&A', NULL, 1, '2021-04-06 19:03:15', '2021-04-06 19:03:15'),
(5, 'Test', 2, NULL, '2021-04-13 10:09:21', '2021-04-13 10:09:21');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_of_study` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `school_mail`, `first_name`, `surname`, `about`, `mail`, `password`, `year_of_study`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ms', 'xsvarc06@stud.fit.vutbr.cz', 'Miroslav', 'Švarc', '', 'mirasvarc1@gmail.com', '$2y$10$BZr0c1gg7hMSIpe0nNIZwuuUNFnt0iWeHvEtohWUChER4TZvuLXUK', '', NULL, '2021-02-15 18:33:32', '2021-02-26 16:18:55'),
(6, 'FITuŠka', 'fituska.mail@gmail.com', 'FITuŠka', 'FITuŠka', NULL, '', 'aac1851384a2127a7154ad2b3fa92cd7', '', NULL, NULL, NULL),
(7, 'test', 'xsvarc06@stud.fit.vutbr.cz', 'Miroslav', 'Švarc', '', 'mirasvarc1@gmail.com', '$2y$10$BZr0c1gg7hMSIpe0nNIZwuuUNFnt0iWeHvEtohWUChER4TZvuLXUK', '', NULL, '2021-02-15 18:33:32', '2021-02-26 16:18:55');

-- --------------------------------------------------------

--
-- Struktura tabulky `user_has_voted`
--

CREATE TABLE `user_has_voted` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `vote_id` int(10) UNSIGNED NOT NULL,
  `vote` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `user_has_voted`
--

INSERT INTO `user_has_voted` (`id`, `user_id`, `vote_id`, `vote`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 'yes', '2021-03-14 15:21:50', '2021-03-14 15:21:50');

-- --------------------------------------------------------

--
-- Struktura tabulky `user_settings`
--

CREATE TABLE `user_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_settings_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`user_settings_json`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `user_settings`
--

INSERT INTO `user_settings` (`id`, `user_id`, `user_settings_json`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"compact\":\"true\",\"compact_mode\":\"false\"}', NULL, '2021-02-15 18:38:55');

-- --------------------------------------------------------

--
-- Struktura tabulky `user_vote`
--

CREATE TABLE `user_vote` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_current` int(10) UNSIGNED NOT NULL,
  `role_new` int(10) UNSIGNED NOT NULL,
  `vote_yes` int(11) NOT NULL,
  `vote_no` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `user_voted_post`
--

CREATE TABLE `user_voted_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `vote_value` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `user_voted_post`
--

INSERT INTO `user_voted_post` (`id`, `user_id`, `post_id`, `vote_value`, `created_at`, `updated_at`) VALUES
(1, 1, 78, 1, '2021-04-11 08:51:44', '2021-04-11 08:51:44'),
(23, 1, 7, 1, '2021-04-11 09:11:22', '2021-04-11 09:11:22'),
(24, 1, 7, 1, '2021-04-11 09:11:23', '2021-04-11 09:11:23'),
(25, 1, 7, 1, '2021-04-11 09:11:24', '2021-04-11 09:11:24'),
(26, 1, 1, 1, '2021-04-15 11:46:11', '2021-04-15 11:46:11');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_author_id_foreign` (`author_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Klíče pro tabulku `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_course_id_foreign` (`course_id`);

--
-- Klíče pro tabulku `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `has_file`
--
ALTER TABLE `has_file`
  ADD KEY `has_file_post_id_foreign` (`post_id`),
  ADD KEY `has_file_course_id_foreign` (`course_id`),
  ADD KEY `has_file_file_id_foreign` (`file_id`);

--
-- Klíče pro tabulku `has_received_messages`
--
ALTER TABLE `has_received_messages`
  ADD KEY `has_received_messages_message_id_foreign` (`message_id`),
  ADD KEY `has_received_messages_user_id_foreign` (`user_id`);

--
-- Klíče pro tabulku `has_role`
--
ALTER TABLE `has_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `has_role_role_id_foreign` (`role_id`),
  ADD KEY `has_role_user_id_foreign` (`user_id`);

--
-- Klíče pro tabulku `has_seen_post`
--
ALTER TABLE `has_seen_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `has_seen_post_post_id_foreign` (`post_id`),
  ADD KEY `has_seen_post_user_id_foreign` (`user_id`);

--
-- Klíče pro tabulku `has_sent_messages`
--
ALTER TABLE `has_sent_messages`
  ADD KEY `has_sent_messages_message_id_foreign` (`message_id`),
  ADD KEY `has_sent_messages_user_id_foreign` (`user_id`);

--
-- Klíče pro tabulku `is_following_calendar`
--
ALTER TABLE `is_following_calendar`
  ADD KEY `is_following_calendar_calendar_id_foreign` (`calendar_id`),
  ADD KEY `is_following_calendar_user_id_foreign` (`user_id`);

--
-- Klíče pro tabulku `is_following_course`
--
ALTER TABLE `is_following_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_following_course_course_id_foreign` (`course_id`),
  ADD KEY `is_following_course_user_id_foreign` (`user_id`);

--
-- Klíče pro tabulku `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Klíče pro tabulku `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_author_id_foreign` (`author_id`),
  ADD KEY `posts_topic_id_foreign` (`topic_id`);

--
-- Klíče pro tabulku `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topics_course_id_foreign` (`course_id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `user_has_voted`
--
ALTER TABLE `user_has_voted`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_settings_user_id_foreign` (`user_id`);

--
-- Klíče pro tabulku `user_vote`
--
ALTER TABLE `user_vote`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `user_voted_post`
--
ALTER TABLE `user_voted_post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pro tabulku `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT pro tabulku `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `file`
--
ALTER TABLE `file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `has_role`
--
ALTER TABLE `has_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pro tabulku `has_seen_post`
--
ALTER TABLE `has_seen_post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pro tabulku `is_following_course`
--
ALTER TABLE `is_following_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pro tabulku `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pro tabulku `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `user_has_voted`
--
ALTER TABLE `user_has_voted`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `user_vote`
--
ALTER TABLE `user_vote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `user_voted_post`
--
ALTER TABLE `user_voted_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `has_file`
--
ALTER TABLE `has_file`
  ADD CONSTRAINT `has_file_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `has_file_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `has_file_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `has_received_messages`
--
ALTER TABLE `has_received_messages`
  ADD CONSTRAINT `has_received_messages_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `has_received_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `has_role`
--
ALTER TABLE `has_role`
  ADD CONSTRAINT `has_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `has_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `has_seen_post`
--
ALTER TABLE `has_seen_post`
  ADD CONSTRAINT `has_seen_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `has_seen_post_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `has_sent_messages`
--
ALTER TABLE `has_sent_messages`
  ADD CONSTRAINT `has_sent_messages_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `has_sent_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `is_following_calendar`
--
ALTER TABLE `is_following_calendar`
  ADD CONSTRAINT `is_following_calendar_calendar_id_foreign` FOREIGN KEY (`calendar_id`) REFERENCES `calendar` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `is_following_calendar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `is_following_course`
--
ALTER TABLE `is_following_course`
  ADD CONSTRAINT `is_following_course_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `is_following_course_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `user_settings`
--
ALTER TABLE `user_settings`
  ADD CONSTRAINT `user_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
