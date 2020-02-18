-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Lut 2020, 22:05
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `patientcrm`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `diseases`
--

CREATE TABLE `diseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `diseases`
--

INSERT INTO `diseases` (`id`, `name`) VALUES
(1, 'Grypa'),
(2, 'Epidermodysplasia verruciformis, dysplazja Lewandowsky\'ego-Lutza'),
(3, 'Progeria (zespół progerii Hutchinsona-Gilforda, HGPS)'),
(4, 'Zespół Cotarda, syndrom chodzącego trupa, urojenie śmierci');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `disease_to_group`
--

CREATE TABLE `disease_to_group` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `disease_id` bigint(20) UNSIGNED NOT NULL,
  `disease_group_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `disease_to_group`
--

INSERT INTO `disease_to_group` (`id`, `disease_id`, `disease_group_id`) VALUES
(1, 1, 1),
(2, 1, 17),
(3, 1, 20),
(4, 2, 1),
(5, 2, 13),
(6, 3, 5),
(7, 4, 2),
(8, 4, 22);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `failed_jobs`
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
-- Struktura tabeli dla tabeli `group_diseases`
--

CREATE TABLE `group_diseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `group_diseases`
--

INSERT INTO `group_diseases` (`id`, `name`) VALUES
(1, 'somatyczne'),
(2, 'psychiczne'),
(3, 'autoimmunologiczne'),
(4, 'endokrynologiczne'),
(5, 'genetyczne'),
(6, 'hematologiczne'),
(7, 'metaboliczne'),
(8, 'narządów zmysłów'),
(9, 'neurologiczne'),
(10, 'nowotworowe'),
(11, 'pasożytnicze'),
(12, 'reumatyczne'),
(13, 'skóry'),
(14, 'stanu odżywiania'),
(15, 'taknki łącznej'),
(16, 'układu krążenia'),
(17, 'układu oddechowego'),
(18, 'układu trawiennego'),
(19, 'urologiczne'),
(20, 'zakaźne'),
(21, 'urazy lub przeciążenia'),
(22, 'zaburzenia psychiczne i zachowania'),
(23, 'zaburzenia rozwoju');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `group_medicines`
--

CREATE TABLE `group_medicines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `group_medicines`
--

INSERT INTO `group_medicines` (`id`, `name`) VALUES
(1, 'Anestetyki'),
(2, 'Analgetyki, przeciwbólowe, leki stosowane w medycynie paliatywnej'),
(3, 'Leki przeciwalergiczne, leki stosowane w anafilaksji'),
(4, 'Odtrutki, inne substancje stosowane w leczeniu zatrucia'),
(5, 'Leki przeciwpadaczkowe, przeciwdrgawkowe'),
(6, 'Leki stosowane w zakażeniach'),
(7, 'Leki stosowane w migrenie'),
(8, 'Leki immunomodulujące i przeciwnowotworowe'),
(9, 'Leki przeciwparkinsonowskie'),
(10, 'Leki wpływające na krew i układ krwiotwórczy'),
(11, 'Preparaty krwiopochodne pochodzenia ludzkiego i preparaty krwiozastępcze'),
(12, 'Leki stosowane w chorobach układu sercowo-naczyniowego'),
(13, 'Leki dermatologiczne stosowane zewnętrznie'),
(14, 'Środki diagnostyczne'),
(15, 'Środki antyseptyczne i dezynfekcyjne'),
(16, 'Leki moczopędne'),
(17, 'Leki stosowane w chorobach przewodu pokarmowego'),
(18, 'Leki stosowane chorobach układu hormonalnego'),
(19, 'Leki wpływające na układ odpornościowy'),
(20, 'Leki zwiotczające mięśnie działające obwodowo, inhibitory, cholinoesteraz'),
(21, 'Leki oftalmologiczne'),
(22, 'Leki stosowane dla zdrowie reprodukcyjnego i w opiece perinatalnej'),
(23, 'Płyn do dializy otrzewnowej'),
(24, 'Leki stosowane w zaburzeniach psychicznych i zaburzeniach zachowania'),
(25, 'Leki stosowane w leczeniu chorób układu oddechowego'),
(26, 'Płyny korygujące zaburzenia gospodarki wodno-elektrolitowej, równowagi kwasowo-zasadowej'),
(27, 'Witaminy i preparaty uzupełniające niedobór składników mineralnych'),
(28, 'Leki stosowane w chorobach uszu, nosa i gardła'),
(29, 'Leki stosowane w chorobach stawów');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `group_privileges`
--

CREATE TABLE `group_privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `privilege_id` bigint(20) UNSIGNED NOT NULL,
  `mode` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `group_users`
--

CREATE TABLE `group_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `group_users`
--

INSERT INTO `group_users` (`id`, `name`) VALUES
(1, 'superusers'),
(2, 'doctors'),
(3, 'receptionists'),
(4, 'patients');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `medicines`
--

CREATE TABLE `medicines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `price`) VALUES
(1, 'Kwas acetylosalicylowy, aspiryna', 0.00),
(2, 'Paracetamol, acetaminofen', 0.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `medicines_on_prescription`
--

CREATE TABLE `medicines_on_prescription` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `medicine_id` bigint(20) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `medicine_replacement`
--

CREATE TABLE `medicine_replacement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medicine_id` bigint(20) UNSIGNED NOT NULL,
  `medicine_replacement_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `medicine_to_group`
--

CREATE TABLE `medicine_to_group` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medicine_id` bigint(20) UNSIGNED NOT NULL,
  `group_medicine_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `medicine_to_group`
--

INSERT INTO `medicine_to_group` (`id`, `medicine_id`, `group_medicine_id`) VALUES
(1, 1, 2),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_02_06_201322_create_privileges_table', 1),
(5, '2020_02_06_211043_create_visit_types_table', 1),
(6, '2020_02_06_211221_create_visits_table', 1),
(7, '2020_02_06_220823_create_group_users_table', 1),
(8, '2020_02_06_221200_create_patient_authorisations_table', 1),
(9, '2020_02_06_223404_create_single_visit_types_table', 1),
(10, '2020_02_06_223556_create_single_visit_doctors_table', 1),
(11, '2020_02_06_223815_create_diseases_table', 1),
(12, '2020_02_06_223820_create_single_visit_diseases_table', 1),
(13, '2020_02_06_224040_create_medicines_table', 1),
(14, '2020_02_06_224050_create_single_visit_medicines_table', 1),
(15, '2020_02_06_224300_create_prescriptions_table', 1),
(16, '2020_02_06_224302_create_single_visit_prescription_table', 1),
(17, '2020_02_06_224735_create_specializations_table', 1),
(18, '2020_02_08_141344_create_user_specializations', 1),
(19, '2020_02_08_151635_create_user_to_group_table', 1),
(20, '2020_02_08_152036_create_group_medicines_table', 1),
(21, '2020_02_08_152105_create_medicine_to_group_table', 1),
(22, '2020_02_08_152703_create_medicine_replacement_table', 1),
(23, '2020_02_08_153805_create_group_diseases_table', 1),
(24, '2020_02_08_154037_create_disease_to-group_table', 1),
(25, '2020_02_08_161003_create_medicines_on_prescription_table', 1),
(26, '2020_02_08_161408_create_prescription_issued_to_user_table', 1),
(27, '2020_02_08_182047_create_user_profiles_table', 1),
(28, '2020_02_09_123437_create_group_privileges_table', 1),
(29, '2020_02_09_123630_create_user_privileges_table', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `patient_authorizations`
--

CREATE TABLE `patient_authorizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `authorized_person` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid_until` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `prescription_issued_to_user`
--

CREATE TABLE `prescription_issued_to_user` (
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiration_date` timestamp NULL DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `privileges`
--

CREATE TABLE `privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `single_visit_diseases`
--

CREATE TABLE `single_visit_diseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `visit_disease_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `single_visit_doctors`
--

CREATE TABLE `single_visit_doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `visit_doctor_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `single_visit_medicines`
--

CREATE TABLE `single_visit_medicines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `visit_medicine_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `single_visit_prescription`
--

CREATE TABLE `single_visit_prescription` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `visit_prescription_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `single_visit_types`
--

CREATE TABLE `single_visit_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `visit_type_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
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
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'martin11591', 'martin@patientcrm.pl', '2020-02-10 16:47:18', '$2y$10$hhe02Kj81df7iNyy7.SDMOh./AHrU0RiYkwLasovN03PCyoi5k/gS', 'Dc4HXMOYA5tDKoXIIojNhzxMlbUaYzYkV6TdllnunyW5yX3BIrAPtKb6u8B7', '2020-02-09 15:22:12', '2020-02-15 20:03:16');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_privileges`
--

CREATE TABLE `user_privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `privilege_id` bigint(20) UNSIGNED NOT NULL,
  `mode` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `names` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surnames` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` timestamp NULL DEFAULT NULL,
  `birth_zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered_zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `phone`, `names`, `surnames`, `doc_id`, `birth_date`, `birth_zip_code`, `birth_city`, `birth_country`, `registered_zip_code`, `registered_city`, `registered_country`, `correspondence_zip_code`, `correspondence_city`, `correspondence_country`) VALUES
(1, 1, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(2, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(3, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(4, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(5, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(6, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(7, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(8, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(9, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(10, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(11, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(12, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(13, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(14, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(15, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(16, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(17, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(18, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(19, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(20, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(21, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(22, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(23, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(24, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(25, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(26, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(27, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(28, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(29, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(30, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(31, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(32, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(33, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(34, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(35, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(36, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(37, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(38, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(39, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(40, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(41, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(42, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(43, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(44, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(45, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(46, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(47, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(48, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(49, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(50, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(51, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(52, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(53, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(54, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(55, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(56, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(57, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(58, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(59, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(60, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(61, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(62, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(63, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(64, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(65, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(66, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(67, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(68, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(69, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(70, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(71, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(72, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(73, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(74, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(75, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(76, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(77, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(78, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(79, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(80, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(81, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(82, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(83, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(84, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(85, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(86, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(87, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(88, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(89, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(90, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(91, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(92, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(93, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(94, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(95, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(96, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(97, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(98, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(99, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(100, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(101, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(102, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(103, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(104, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(105, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(106, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(107, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(108, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(109, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(110, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(111, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(112, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(113, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(114, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(115, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(116, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(117, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(118, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(119, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(120, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(121, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(122, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(123, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(124, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(125, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(126, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(127, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(128, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(129, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(130, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(131, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(132, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(133, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(134, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(135, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(136, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(137, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(138, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(139, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(140, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(141, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(142, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(143, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(144, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(145, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(146, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(147, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(148, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(149, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(150, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(151, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(152, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(153, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(154, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(155, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(156, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(157, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(158, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(159, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(160, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(161, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(162, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(163, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(164, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(165, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(166, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(167, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(168, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(169, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(170, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(171, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(172, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(173, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(174, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(175, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(176, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(177, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(178, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(179, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(180, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(181, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(182, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(183, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(184, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(185, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(186, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(187, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(188, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(189, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(190, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(191, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(192, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(193, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(194, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(195, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(196, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(197, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(198, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(199, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(200, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(201, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(202, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(203, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(204, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(205, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(206, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(207, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(208, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(209, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(210, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(211, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(212, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(213, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(214, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(215, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(216, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(217, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(218, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(219, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(220, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(221, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska'),
(222, NULL, '531300363', 'Marcin Łukasz Andrzej', 'Podraza', 'CBJ707968', '1991-10-14 22:00:00', '33-170', 'Tuchów', 'Polska', '33-159', 'Zalasowa', 'Polska', '42-202', 'Częstochowa', 'Polska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_specializations`
--

CREATE TABLE `user_specializations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `specialization_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_to_group`
--

CREATE TABLE `user_to_group` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user_to_group`
--

INSERT INTO `user_to_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `visits`
--

CREATE TABLE `visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `visit_types`
--

CREATE TABLE `visit_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `disease_to_group`
--
ALTER TABLE `disease_to_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disease_to_group_disease_id_foreign` (`disease_id`),
  ADD KEY `disease_to_group_disease_group_id_foreign` (`disease_group_id`);

--
-- Indeksy dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `group_diseases`
--
ALTER TABLE `group_diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `group_medicines`
--
ALTER TABLE `group_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `group_privileges`
--
ALTER TABLE `group_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_privileges_group_id_foreign` (`group_id`),
  ADD KEY `group_privileges_privilege_id_foreign` (`privilege_id`);

--
-- Indeksy dla tabeli `group_users`
--
ALTER TABLE `group_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `medicines_on_prescription`
--
ALTER TABLE `medicines_on_prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicines_on_prescription_prescription_id_foreign` (`prescription_id`),
  ADD KEY `medicines_on_prescription_medicine_id_foreign` (`medicine_id`);

--
-- Indeksy dla tabeli `medicine_replacement`
--
ALTER TABLE `medicine_replacement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicine_replacement_medicine_id_foreign` (`medicine_id`),
  ADD KEY `medicine_replacement_medicine_replacement_id_foreign` (`medicine_replacement_id`);

--
-- Indeksy dla tabeli `medicine_to_group`
--
ALTER TABLE `medicine_to_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicine_to_group_medicine_id_foreign` (`medicine_id`),
  ADD KEY `medicine_to_group_group_medicine_id_foreign` (`group_medicine_id`);

--
-- Indeksy dla tabeli `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeksy dla tabeli `patient_authorizations`
--
ALTER TABLE `patient_authorizations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_user_id_foreign` (`user_id`);

--
-- Indeksy dla tabeli `prescription_issued_to_user`
--
ALTER TABLE `prescription_issued_to_user`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `prescription_issued_to_user_user_id_foreign` (`user_id`);

--
-- Indeksy dla tabeli `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `single_visit_diseases`
--
ALTER TABLE `single_visit_diseases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `single_visit_diseases_visit_id_foreign` (`visit_id`),
  ADD KEY `single_visit_diseases_visit_disease_id_foreign` (`visit_disease_id`);

--
-- Indeksy dla tabeli `single_visit_doctors`
--
ALTER TABLE `single_visit_doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `single_visit_doctors_visit_id_foreign` (`visit_id`),
  ADD KEY `single_visit_doctors_visit_doctor_id_foreign` (`visit_doctor_id`);

--
-- Indeksy dla tabeli `single_visit_medicines`
--
ALTER TABLE `single_visit_medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `single_visit_medicines_visit_id_foreign` (`visit_id`),
  ADD KEY `single_visit_medicines_visit_medicine_id_foreign` (`visit_medicine_id`);

--
-- Indeksy dla tabeli `single_visit_prescription`
--
ALTER TABLE `single_visit_prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `single_visit_prescription_visit_id_foreign` (`visit_id`),
  ADD KEY `single_visit_prescription_visit_prescription_id_foreign` (`visit_prescription_id`);

--
-- Indeksy dla tabeli `single_visit_types`
--
ALTER TABLE `single_visit_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `single_visit_types_visit_id_foreign` (`visit_id`),
  ADD KEY `single_visit_types_visit_type_id_foreign` (`visit_type_id`);

--
-- Indeksy dla tabeli `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeksy dla tabeli `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_privileges_user_id_foreign` (`user_id`),
  ADD KEY `user_privileges_privilege_id_foreign` (`privilege_id`);

--
-- Indeksy dla tabeli `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user_specializations`
--
ALTER TABLE `user_specializations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_specializations_user_id_foreign` (`user_id`),
  ADD KEY `user_specializations_specialization_id_foreign` (`specialization_id`);

--
-- Indeksy dla tabeli `user_to_group`
--
ALTER TABLE `user_to_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_to_group_user_id_foreign` (`user_id`),
  ADD KEY `user_to_group_group_id_foreign` (`group_id`);

--
-- Indeksy dla tabeli `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visits_user_id_foreign` (`user_id`);

--
-- Indeksy dla tabeli `visit_types`
--
ALTER TABLE `visit_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `disease_to_group`
--
ALTER TABLE `disease_to_group`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `group_diseases`
--
ALTER TABLE `group_diseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `group_medicines`
--
ALTER TABLE `group_medicines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT dla tabeli `group_privileges`
--
ALTER TABLE `group_privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `group_users`
--
ALTER TABLE `group_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `medicines_on_prescription`
--
ALTER TABLE `medicines_on_prescription`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `medicine_replacement`
--
ALTER TABLE `medicine_replacement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `medicine_to_group`
--
ALTER TABLE `medicine_to_group`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT dla tabeli `patient_authorizations`
--
ALTER TABLE `patient_authorizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `single_visit_diseases`
--
ALTER TABLE `single_visit_diseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `single_visit_doctors`
--
ALTER TABLE `single_visit_doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `single_visit_medicines`
--
ALTER TABLE `single_visit_medicines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `single_visit_prescription`
--
ALTER TABLE `single_visit_prescription`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `single_visit_types`
--
ALTER TABLE `single_visit_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `user_privileges`
--
ALTER TABLE `user_privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT dla tabeli `user_specializations`
--
ALTER TABLE `user_specializations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user_to_group`
--
ALTER TABLE `user_to_group`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `visit_types`
--
ALTER TABLE `visit_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `disease_to_group`
--
ALTER TABLE `disease_to_group`
  ADD CONSTRAINT `disease_to_group_disease_group_id_foreign` FOREIGN KEY (`disease_group_id`) REFERENCES `group_diseases` (`id`),
  ADD CONSTRAINT `disease_to_group_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`);

--
-- Ograniczenia dla tabeli `group_privileges`
--
ALTER TABLE `group_privileges`
  ADD CONSTRAINT `group_privileges_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `group_users` (`id`),
  ADD CONSTRAINT `group_privileges_privilege_id_foreign` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`);

--
-- Ograniczenia dla tabeli `medicines_on_prescription`
--
ALTER TABLE `medicines_on_prescription`
  ADD CONSTRAINT `medicines_on_prescription_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`),
  ADD CONSTRAINT `medicines_on_prescription_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`);

--
-- Ograniczenia dla tabeli `medicine_replacement`
--
ALTER TABLE `medicine_replacement`
  ADD CONSTRAINT `medicine_replacement_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`),
  ADD CONSTRAINT `medicine_replacement_medicine_replacement_id_foreign` FOREIGN KEY (`medicine_replacement_id`) REFERENCES `medicines` (`id`);

--
-- Ograniczenia dla tabeli `medicine_to_group`
--
ALTER TABLE `medicine_to_group`
  ADD CONSTRAINT `medicine_to_group_group_medicine_id_foreign` FOREIGN KEY (`group_medicine_id`) REFERENCES `group_medicines` (`id`),
  ADD CONSTRAINT `medicine_to_group_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`);

--
-- Ograniczenia dla tabeli `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `prescription_issued_to_user`
--
ALTER TABLE `prescription_issued_to_user`
  ADD CONSTRAINT `prescription_issued_to_user_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`),
  ADD CONSTRAINT `prescription_issued_to_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `single_visit_diseases`
--
ALTER TABLE `single_visit_diseases`
  ADD CONSTRAINT `single_visit_diseases_visit_disease_id_foreign` FOREIGN KEY (`visit_disease_id`) REFERENCES `diseases` (`id`),
  ADD CONSTRAINT `single_visit_diseases_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`);

--
-- Ograniczenia dla tabeli `single_visit_doctors`
--
ALTER TABLE `single_visit_doctors`
  ADD CONSTRAINT `single_visit_doctors_visit_doctor_id_foreign` FOREIGN KEY (`visit_doctor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `single_visit_doctors_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`);

--
-- Ograniczenia dla tabeli `single_visit_medicines`
--
ALTER TABLE `single_visit_medicines`
  ADD CONSTRAINT `single_visit_medicines_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`),
  ADD CONSTRAINT `single_visit_medicines_visit_medicine_id_foreign` FOREIGN KEY (`visit_medicine_id`) REFERENCES `medicines` (`id`);

--
-- Ograniczenia dla tabeli `single_visit_prescription`
--
ALTER TABLE `single_visit_prescription`
  ADD CONSTRAINT `single_visit_prescription_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`),
  ADD CONSTRAINT `single_visit_prescription_visit_prescription_id_foreign` FOREIGN KEY (`visit_prescription_id`) REFERENCES `prescriptions` (`id`);

--
-- Ograniczenia dla tabeli `single_visit_types`
--
ALTER TABLE `single_visit_types`
  ADD CONSTRAINT `single_visit_types_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`),
  ADD CONSTRAINT `single_visit_types_visit_type_id_foreign` FOREIGN KEY (`visit_type_id`) REFERENCES `visit_types` (`id`);

--
-- Ograniczenia dla tabeli `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD CONSTRAINT `user_privileges_privilege_id_foreign` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`),
  ADD CONSTRAINT `user_privileges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `user_specializations`
--
ALTER TABLE `user_specializations`
  ADD CONSTRAINT `user_specializations_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`),
  ADD CONSTRAINT `user_specializations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `user_to_group`
--
ALTER TABLE `user_to_group`
  ADD CONSTRAINT `user_to_group_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `group_users` (`id`),
  ADD CONSTRAINT `user_to_group_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
