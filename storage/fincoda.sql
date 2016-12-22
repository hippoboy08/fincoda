-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2016 at 02:30 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fincoda`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `company_code`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Fincoda Corporation', 'FINCODA_skdjfksjd123', 'fincoda_corporation', '2016-09-04 18:23:54', '2016-10-05 17:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `company_profiles`
--

CREATE TABLE `company_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `postcode` int(11) NOT NULL,
  `time_zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_profiles`
--

INSERT INTO `company_profiles` (`id`, `company_id`, `type`, `country`, `city`, `street`, `email`, `phone`, `postcode`, `time_zone`, `created_at`, `updated_at`) VALUES
(1, 1, 'education', 'Ascension Island', 'Turku', 'joukahaisenkatu', 'fincoda@corporation.com', 234556678, 20567, 'Europe/Helsinki', '2016-09-04 18:24:33', '2016-11-14 10:59:10');

-- --------------------------------------------------------

--
-- Table structure for table `indicators`
--

CREATE TABLE `indicators` (
  `id` int(10) UNSIGNED NOT NULL,
  `indicator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `indicators`
--

INSERT INTO `indicators` (`id`, `indicator`, `group_id`) VALUES
(1, 'Think differently and adopt different perspectives.', 1),
(2, 'Be attentive when others are speaking, and respond effectively to others’ comments during the conversation.', 4),
(3, 'Use intuition and own knowledge to start actions.', 1),
(4, 'Invite feedback and comments .', 4),
(5, 'Foster improvements in work organization.', 3),
(6, 'Obtain constructive comments from colleagues.', 4),
(7, 'Find new ways to implement ideas.', 1),
(8, 'Identify sources of conflict between oneself and others, or among other people, and to take steps to overcome disharmony', 4),
(9, 'Take an acceptable level of risk to support new ideas .', 3),
(10, 'Go beyond expectations in the assignment, task, or job description without being asked  .', 3),
(11, 'Meet people with different kinds of ideas and perspectives to extend your own knowledge domains .', 5),
(12, 'Convince people to support an innovative idea .', 3),
(13, 'Systematically introduce new ideas into work practices.', 3),
(14, 'Act quickly and energetically.', 3),
(15, 'Generate original solutions for problems or to opportunities.', 1),
(16, 'Use trial and error for problem solving.', 2),
(17, 'Develop and experiment with new ways of problem solving .', 2),
(18, 'Acquire, assimilate, transform and exploit external knowledge to establish, manage and learn from informal organisational ties .', 5),
(19, 'Challenge the status quo.', 2),
(20, 'Face the task from different points of view.', 2),
(21, 'Make suggestions to improve current process products or services.', 1),
(22, 'Present novel ideas.', 1),
(23, 'Forecast impact on users.', 2),
(24, 'Show inventiveness in using resources.', 1),
(25, 'Search out new working methods, techniques or instruments.', 1),
(26, 'Provide constructive feedback, cooperation, coaching or help to team colleagues.', 4),
(27, 'Work well with others, understanding their needs and being sympathetic with them.', 4),
(28, 'Share timely information with the appropriate stakeholders.', 4),
(29, 'Consult about essential changes .', 4),
(30, 'Build relationships outside the team/organization.', 5),
(31, 'Refine ideas into a useful form.', 1),
(32, 'Engage outsiders of the core work group from the beginning.', 5),
(33, 'Ask “Why?” and “Why not?” and “What if?” with a purpose', 2),
(34, 'Work in multidisciplinary environments ', 5);

-- --------------------------------------------------------

--
-- Table structure for table `indicator_groups`
--

CREATE TABLE `indicator_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `indicator_groups`
--

INSERT INTO `indicator_groups` (`id`, `name`) VALUES
(1, 'CREATIVITY'),
(2, 'CRITICAL THINKING'),
(3, 'INITIATIVE'),
(4, 'TEAMWORK'),
(5, 'NETWORKING');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_05_11_201305_entrust_setup_tables', 1),
('2016_05_19_164743_create_companies_table', 1),
('2016_05_19_170513_create_company_profiles_tables', 1),
('2016_05_19_171832_create_table_user_profiles', 1),
('2016_05_22_195321_create_indicator_group_table', 1),
('2016_05_22_195630_create_indicator_tables', 1),
('2016_05_22_211307_create_survey_type_table', 1),
('2016_05_23_065232_create_survey_categories_table', 1),
('2016_06_01_123855_create_surveys_table', 1),
('2016_06_01_130339_create_participants_table', 1),
('2016_06_06_070251_create_user_group_table', 1),
('2016_06_06_072329_create_user_in_groups', 1),
('2016_06_11_120242_results', 1),
('2016_06_17_075924_create_peer_survey_table', 1),
('2016_06_17_075952_create_peer_result_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reminder` tinyint(1) NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `survey_id`, `user_id`, `reminder`, `completed`, `created_at`, `updated_at`) VALUES
(14, 100, 2, 0, 1, '2016-11-15 09:55:05', '2016-11-15 10:01:05'),
(15, 100, 3, 0, 1, '2016-11-15 09:55:05', '2016-11-15 10:03:43'),
(16, 100, 15, 0, 1, '2016-11-15 09:55:05', '2016-11-15 10:02:29'),
(17, 100, 16, 0, 1, '2016-11-15 09:55:05', '2016-11-15 10:05:04'),
(18, 100, 17, 0, 1, '2016-11-15 09:55:05', '2016-11-15 10:06:18'),
(19, 100, 18, 0, 1, '2016-11-15 09:55:05', '2016-11-15 10:07:41'),
(20, 100, 19, 0, 1, '2016-11-15 09:55:05', '2016-11-15 10:09:14'),
(21, 100, 20, 0, 1, '2016-11-15 09:55:05', '2016-11-15 10:10:29'),
(22, 100, 21, 0, 1, '2016-11-15 09:55:05', '2016-11-15 10:11:51'),
(23, 100, 22, 0, 1, '2016-11-15 09:55:05', '2016-11-15 10:13:04'),
(24, 100, 23, 0, 0, '2016-11-15 09:55:05', '2016-11-15 09:55:05'),
(25, 101, 2, 0, 3, '2016-11-15 09:55:59', '2016-11-15 10:52:58'),
(26, 101, 3, 0, 3, '2016-11-15 09:55:59', '2016-11-15 10:53:36'),
(27, 101, 15, 0, 3, '2016-11-15 09:55:59', '2016-11-15 10:54:17'),
(28, 101, 16, 0, 3, '2016-11-15 09:55:59', '2016-11-15 10:54:57'),
(29, 101, 17, 0, 3, '2016-11-15 09:56:00', '2016-11-15 10:55:36'),
(30, 101, 18, 0, 3, '2016-11-15 09:56:00', '2016-11-15 12:29:57'),
(31, 101, 19, 0, 3, '2016-11-15 09:56:00', '2016-11-15 12:30:43'),
(32, 101, 20, 0, 0, '2016-11-15 09:56:00', '2016-11-15 09:56:00'),
(33, 101, 21, 0, 0, '2016-11-15 09:56:00', '2016-11-15 09:56:00'),
(34, 101, 22, 0, 0, '2016-11-15 09:56:00', '2016-11-15 09:56:00'),
(35, 101, 23, 0, 0, '2016-11-15 09:56:00', '2016-11-15 09:56:00'),
(38, 102, 17, 0, 1, '2016-11-15 12:38:49', '2016-11-15 12:52:35'),
(39, 102, 18, 0, 1, '2016-11-15 12:38:50', '2016-11-15 12:58:26'),
(40, 102, 19, 0, 1, '2016-11-15 12:38:51', '2016-11-15 13:02:18'),
(41, 102, 3, 0, 1, '2016-11-15 12:38:52', '2016-11-15 12:44:49'),
(42, 102, 15, 0, 1, NULL, '2016-11-15 12:46:55'),
(43, 102, 16, 0, 1, NULL, '2016-11-15 12:49:24'),
(46, 103, 17, 0, 3, '2016-11-15 12:41:02', '2016-11-15 13:24:09'),
(47, 103, 18, 0, 3, '2016-11-15 12:41:03', '2016-11-15 13:24:49'),
(48, 103, 19, 0, 3, '2016-11-15 12:41:04', '2016-11-15 13:25:30'),
(49, 103, 3, 0, 5, '2016-11-15 12:41:06', '2016-11-15 13:03:07'),
(50, 103, 15, 0, 3, NULL, '2016-11-15 13:03:52'),
(51, 103, 16, 0, 3, NULL, '2016-11-15 13:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@fincoda.com', '2aee07dcdc360918663e8a4803acd237d362c237f742f923fe940e4b8fecd1e1', '2016-10-06 11:33:32'),
('davis.kawalya@edu.turkuamk.fi', 'd0ad9885b140a96dc1d0cb0a8d9b3371b5692ba85bcdc89b2a658e81ce989f8b', '2016-10-21 10:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `peer_results`
--

CREATE TABLE `peer_results` (
  `id` int(10) UNSIGNED NOT NULL,
  `peer_survey_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `peer_id` int(10) UNSIGNED NOT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `answer` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `peer_results`
--

INSERT INTO `peer_results` (`id`, `peer_survey_id`, `user_id`, `peer_id`, `indicator_id`, `answer`, `created_at`, `updated_at`) VALUES
(1, 101, 2, 15, 1, 3, NULL, NULL),
(2, 101, 2, 15, 2, 3, NULL, NULL),
(3, 101, 2, 15, 3, 4, NULL, NULL),
(4, 101, 2, 15, 4, 4, NULL, NULL),
(5, 101, 2, 15, 5, 4, NULL, NULL),
(6, 101, 2, 15, 6, 5, NULL, NULL),
(7, 101, 2, 15, 7, 4, NULL, NULL),
(8, 101, 2, 15, 8, 4, NULL, NULL),
(9, 101, 2, 15, 9, 3, NULL, NULL),
(10, 101, 2, 15, 10, 4, NULL, NULL),
(11, 101, 2, 15, 11, 4, NULL, NULL),
(12, 101, 2, 15, 12, 5, NULL, NULL),
(13, 101, 2, 15, 13, 4, NULL, NULL),
(14, 101, 2, 15, 14, 3, NULL, NULL),
(15, 101, 2, 15, 15, 4, NULL, NULL),
(16, 101, 2, 15, 16, 5, NULL, NULL),
(17, 101, 2, 15, 17, 4, NULL, NULL),
(18, 101, 2, 15, 18, 3, NULL, NULL),
(19, 101, 2, 15, 19, 3, NULL, NULL),
(20, 101, 2, 15, 20, 4, NULL, NULL),
(21, 101, 2, 15, 21, 5, NULL, NULL),
(22, 101, 2, 15, 22, 4, NULL, NULL),
(23, 101, 2, 15, 23, 3, NULL, NULL),
(24, 101, 2, 15, 24, 3, NULL, NULL),
(25, 101, 2, 15, 25, 3, NULL, NULL),
(26, 101, 2, 15, 26, 4, NULL, NULL),
(27, 101, 2, 15, 27, 5, NULL, NULL),
(28, 101, 2, 15, 28, 4, NULL, NULL),
(29, 101, 2, 15, 29, 3, NULL, NULL),
(30, 101, 2, 15, 30, 3, NULL, NULL),
(31, 101, 2, 15, 31, 4, NULL, NULL),
(32, 101, 2, 15, 32, 5, NULL, NULL),
(33, 101, 2, 15, 33, 4, NULL, NULL),
(34, 101, 2, 15, 34, 4, NULL, NULL),
(35, 101, 3, 15, 1, 3, NULL, NULL),
(36, 101, 3, 15, 2, 3, NULL, NULL),
(37, 101, 3, 15, 3, 2, NULL, NULL),
(38, 101, 3, 15, 4, 2, NULL, NULL),
(39, 101, 3, 15, 5, 3, NULL, NULL),
(40, 101, 3, 15, 6, 4, NULL, NULL),
(41, 101, 3, 15, 7, 4, NULL, NULL),
(42, 101, 3, 15, 8, 4, NULL, NULL),
(43, 101, 3, 15, 9, 3, NULL, NULL),
(44, 101, 3, 15, 10, 3, NULL, NULL),
(45, 101, 3, 15, 11, 4, NULL, NULL),
(46, 101, 3, 15, 12, 5, NULL, NULL),
(47, 101, 3, 15, 13, 4, NULL, NULL),
(48, 101, 3, 15, 14, 3, NULL, NULL),
(49, 101, 3, 15, 15, 3, NULL, NULL),
(50, 101, 3, 15, 16, 4, NULL, NULL),
(51, 101, 3, 15, 17, 4, NULL, NULL),
(52, 101, 3, 15, 18, 5, NULL, NULL),
(53, 101, 3, 15, 19, 4, NULL, NULL),
(54, 101, 3, 15, 20, 3, NULL, NULL),
(55, 101, 3, 15, 21, 4, NULL, NULL),
(56, 101, 3, 15, 22, 3, NULL, NULL),
(57, 101, 3, 15, 23, 4, NULL, NULL),
(58, 101, 3, 15, 24, 5, NULL, NULL),
(59, 101, 3, 15, 25, 4, NULL, NULL),
(60, 101, 3, 15, 26, 4, NULL, NULL),
(61, 101, 3, 15, 27, 3, NULL, NULL),
(62, 101, 3, 15, 28, 3, NULL, NULL),
(63, 101, 3, 15, 29, 4, NULL, NULL),
(64, 101, 3, 15, 30, 5, NULL, NULL),
(65, 101, 3, 15, 31, 4, NULL, NULL),
(66, 101, 3, 15, 32, 3, NULL, NULL),
(67, 101, 3, 15, 33, 3, NULL, NULL),
(68, 101, 3, 15, 34, 4, NULL, NULL),
(69, 101, 2, 16, 1, 4, NULL, NULL),
(70, 101, 2, 16, 2, 4, NULL, NULL),
(71, 101, 2, 16, 3, 4, NULL, NULL),
(72, 101, 2, 16, 4, 3, NULL, NULL),
(73, 101, 2, 16, 5, 4, NULL, NULL),
(74, 101, 2, 16, 6, 4, NULL, NULL),
(75, 101, 2, 16, 7, 4, NULL, NULL),
(76, 101, 2, 16, 8, 3, NULL, NULL),
(77, 101, 2, 16, 9, 4, NULL, NULL),
(78, 101, 2, 16, 10, 4, NULL, NULL),
(79, 101, 2, 16, 11, 3, NULL, NULL),
(80, 101, 2, 16, 12, 3, NULL, NULL),
(81, 101, 2, 16, 13, 4, NULL, NULL),
(82, 101, 2, 16, 14, 5, NULL, NULL),
(83, 101, 2, 16, 15, 4, NULL, NULL),
(84, 101, 2, 16, 16, 3, NULL, NULL),
(85, 101, 2, 16, 17, 3, NULL, NULL),
(86, 101, 2, 16, 18, 3, NULL, NULL),
(87, 101, 2, 16, 19, 4, NULL, NULL),
(88, 101, 2, 16, 20, 5, NULL, NULL),
(89, 101, 2, 16, 21, 4, NULL, NULL),
(90, 101, 2, 16, 22, 3, NULL, NULL),
(91, 101, 2, 16, 23, 3, NULL, NULL),
(92, 101, 2, 16, 24, 4, NULL, NULL),
(93, 101, 2, 16, 25, 5, NULL, NULL),
(94, 101, 2, 16, 26, 4, NULL, NULL),
(95, 101, 2, 16, 27, 3, NULL, NULL),
(96, 101, 2, 16, 28, 4, NULL, NULL),
(97, 101, 2, 16, 29, 4, NULL, NULL),
(98, 101, 2, 16, 30, 5, NULL, NULL),
(99, 101, 2, 16, 31, 4, NULL, NULL),
(100, 101, 2, 16, 32, 4, NULL, NULL),
(101, 101, 2, 16, 33, 5, NULL, NULL),
(102, 101, 2, 16, 34, 5, NULL, NULL),
(103, 101, 3, 16, 1, 3, NULL, NULL),
(104, 101, 3, 16, 2, 3, NULL, NULL),
(105, 101, 3, 16, 3, 3, NULL, NULL),
(106, 101, 3, 16, 4, 2, NULL, NULL),
(107, 101, 3, 16, 5, 2, NULL, NULL),
(108, 101, 3, 16, 6, 3, NULL, NULL),
(109, 101, 3, 16, 7, 4, NULL, NULL),
(110, 101, 3, 16, 8, 4, NULL, NULL),
(111, 101, 3, 16, 9, 4, NULL, NULL),
(112, 101, 3, 16, 10, 3, NULL, NULL),
(113, 101, 3, 16, 11, 3, NULL, NULL),
(114, 101, 3, 16, 12, 4, NULL, NULL),
(115, 101, 3, 16, 13, 5, NULL, NULL),
(116, 101, 3, 16, 14, 4, NULL, NULL),
(117, 101, 3, 16, 15, 3, NULL, NULL),
(118, 101, 3, 16, 16, 3, NULL, NULL),
(119, 101, 3, 16, 17, 2, NULL, NULL),
(120, 101, 3, 16, 18, 3, NULL, NULL),
(121, 101, 3, 16, 19, 4, NULL, NULL),
(122, 101, 3, 16, 20, 5, NULL, NULL),
(123, 101, 3, 16, 21, 4, NULL, NULL),
(124, 101, 3, 16, 22, 3, NULL, NULL),
(125, 101, 3, 16, 23, 3, NULL, NULL),
(126, 101, 3, 16, 24, 3, NULL, NULL),
(127, 101, 3, 16, 25, 4, NULL, NULL),
(128, 101, 3, 16, 26, 4, NULL, NULL),
(129, 101, 3, 16, 27, 5, NULL, NULL),
(130, 101, 3, 16, 28, 4, NULL, NULL),
(131, 101, 3, 16, 29, 3, NULL, NULL),
(132, 101, 3, 16, 30, 3, NULL, NULL),
(133, 101, 3, 16, 31, 4, NULL, NULL),
(134, 101, 3, 16, 32, 5, NULL, NULL),
(135, 101, 3, 16, 33, 5, NULL, NULL),
(136, 101, 3, 16, 34, 4, NULL, NULL),
(137, 101, 15, 16, 1, 3, NULL, NULL),
(138, 101, 15, 16, 2, 3, NULL, NULL),
(139, 101, 15, 16, 3, 4, NULL, NULL),
(140, 101, 15, 16, 4, 4, NULL, NULL),
(141, 101, 15, 16, 5, 4, NULL, NULL),
(142, 101, 15, 16, 6, 4, NULL, NULL),
(143, 101, 15, 16, 7, 4, NULL, NULL),
(144, 101, 15, 16, 8, 4, NULL, NULL),
(145, 101, 15, 16, 9, 3, NULL, NULL),
(146, 101, 15, 16, 10, 4, NULL, NULL),
(147, 101, 15, 16, 11, 5, NULL, NULL),
(148, 101, 15, 16, 12, 5, NULL, NULL),
(149, 101, 15, 16, 13, 4, NULL, NULL),
(150, 101, 15, 16, 14, 4, NULL, NULL),
(151, 101, 15, 16, 15, 3, NULL, NULL),
(152, 101, 15, 16, 16, 4, NULL, NULL),
(153, 101, 15, 16, 17, 4, NULL, NULL),
(154, 101, 15, 16, 18, 5, NULL, NULL),
(155, 101, 15, 16, 19, 4, NULL, NULL),
(156, 101, 15, 16, 20, 4, NULL, NULL),
(157, 101, 15, 16, 21, 3, NULL, NULL),
(158, 101, 15, 16, 22, 4, NULL, NULL),
(159, 101, 15, 16, 23, 5, NULL, NULL),
(160, 101, 15, 16, 24, 4, NULL, NULL),
(161, 101, 15, 16, 25, 4, NULL, NULL),
(162, 101, 15, 16, 26, 4, NULL, NULL),
(163, 101, 15, 16, 27, 5, NULL, NULL),
(164, 101, 15, 16, 28, 5, NULL, NULL),
(165, 101, 15, 16, 29, 4, NULL, NULL),
(166, 101, 15, 16, 30, 3, NULL, NULL),
(167, 101, 15, 16, 31, 3, NULL, NULL),
(168, 101, 15, 16, 32, 4, NULL, NULL),
(169, 101, 15, 16, 33, 4, NULL, NULL),
(170, 101, 15, 16, 34, 5, NULL, NULL),
(171, 101, 2, 17, 1, 3, NULL, NULL),
(172, 101, 2, 17, 2, 2, NULL, NULL),
(173, 101, 2, 17, 3, 1, NULL, NULL),
(174, 101, 2, 17, 4, 2, NULL, NULL),
(175, 101, 2, 17, 5, 3, NULL, NULL),
(176, 101, 2, 17, 6, 4, NULL, NULL),
(177, 101, 2, 17, 7, 5, NULL, NULL),
(178, 101, 2, 17, 8, 4, NULL, NULL),
(179, 101, 2, 17, 9, 3, NULL, NULL),
(180, 101, 2, 17, 10, 2, NULL, NULL),
(181, 101, 2, 17, 11, 3, NULL, NULL),
(182, 101, 2, 17, 12, 4, NULL, NULL),
(183, 101, 2, 17, 13, 5, NULL, NULL),
(184, 101, 2, 17, 14, 4, NULL, NULL),
(185, 101, 2, 17, 15, 3, NULL, NULL),
(186, 101, 2, 17, 16, 2, NULL, NULL),
(187, 101, 2, 17, 17, 2, NULL, NULL),
(188, 101, 2, 17, 18, 3, NULL, NULL),
(189, 101, 2, 17, 19, 4, NULL, NULL),
(190, 101, 2, 17, 20, 3, NULL, NULL),
(191, 101, 2, 17, 21, 4, NULL, NULL),
(192, 101, 2, 17, 22, 3, NULL, NULL),
(193, 101, 2, 17, 23, 4, NULL, NULL),
(194, 101, 2, 17, 24, 3, NULL, NULL),
(195, 101, 2, 17, 25, 4, NULL, NULL),
(196, 101, 2, 17, 26, 5, NULL, NULL),
(197, 101, 2, 17, 27, 4, NULL, NULL),
(198, 101, 2, 17, 28, 4, NULL, NULL),
(199, 101, 2, 17, 29, 5, NULL, NULL),
(200, 101, 2, 17, 30, 4, NULL, NULL),
(201, 101, 2, 17, 31, 5, NULL, NULL),
(202, 101, 2, 17, 32, 4, NULL, NULL),
(203, 101, 2, 17, 33, 4, NULL, NULL),
(204, 101, 2, 17, 34, 5, NULL, NULL),
(205, 101, 3, 17, 1, 4, NULL, NULL),
(206, 101, 3, 17, 2, 4, NULL, NULL),
(207, 101, 3, 17, 3, 5, NULL, NULL),
(208, 101, 3, 17, 4, 4, NULL, NULL),
(209, 101, 3, 17, 5, 4, NULL, NULL),
(210, 101, 3, 17, 6, 5, NULL, NULL),
(211, 101, 3, 17, 7, 4, NULL, NULL),
(212, 101, 3, 17, 8, 4, NULL, NULL),
(213, 101, 3, 17, 9, 5, NULL, NULL),
(214, 101, 3, 17, 10, 4, NULL, NULL),
(215, 101, 3, 17, 11, 3, NULL, NULL),
(216, 101, 3, 17, 12, 4, NULL, NULL),
(217, 101, 3, 17, 13, 5, NULL, NULL),
(218, 101, 3, 17, 14, 4, NULL, NULL),
(219, 101, 3, 17, 15, 3, NULL, NULL),
(220, 101, 3, 17, 16, 4, NULL, NULL),
(221, 101, 3, 17, 17, 5, NULL, NULL),
(222, 101, 3, 17, 18, 4, NULL, NULL),
(223, 101, 3, 17, 19, 3, NULL, NULL),
(224, 101, 3, 17, 20, 4, NULL, NULL),
(225, 101, 3, 17, 21, 5, NULL, NULL),
(226, 101, 3, 17, 22, 4, NULL, NULL),
(227, 101, 3, 17, 23, 3, NULL, NULL),
(228, 101, 3, 17, 24, 4, NULL, NULL),
(229, 101, 3, 17, 25, 5, NULL, NULL),
(230, 101, 3, 17, 26, 4, NULL, NULL),
(231, 101, 3, 17, 27, 3, NULL, NULL),
(232, 101, 3, 17, 28, 4, NULL, NULL),
(233, 101, 3, 17, 29, 5, NULL, NULL),
(234, 101, 3, 17, 30, 4, NULL, NULL),
(235, 101, 3, 17, 31, 4, NULL, NULL),
(236, 101, 3, 17, 32, 5, NULL, NULL),
(237, 101, 3, 17, 33, 5, NULL, NULL),
(238, 101, 3, 17, 34, 5, NULL, NULL),
(239, 101, 15, 17, 1, 3, NULL, NULL),
(240, 101, 15, 17, 2, 4, NULL, NULL),
(241, 101, 15, 17, 3, 5, NULL, NULL),
(242, 101, 15, 17, 4, 4, NULL, NULL),
(243, 101, 15, 17, 5, 4, NULL, NULL),
(244, 101, 15, 17, 6, 5, NULL, NULL),
(245, 101, 15, 17, 7, 4, NULL, NULL),
(246, 101, 15, 17, 8, 4, NULL, NULL),
(247, 101, 15, 17, 9, 3, NULL, NULL),
(248, 101, 15, 17, 10, 4, NULL, NULL),
(249, 101, 15, 17, 11, 5, NULL, NULL),
(250, 101, 15, 17, 12, 4, NULL, NULL),
(251, 101, 15, 17, 13, 3, NULL, NULL),
(252, 101, 15, 17, 14, 4, NULL, NULL),
(253, 101, 15, 17, 15, 5, NULL, NULL),
(254, 101, 15, 17, 16, 4, NULL, NULL),
(255, 101, 15, 17, 17, 3, NULL, NULL),
(256, 101, 15, 17, 18, 4, NULL, NULL),
(257, 101, 15, 17, 19, 5, NULL, NULL),
(258, 101, 15, 17, 20, 4, NULL, NULL),
(259, 101, 15, 17, 21, 4, NULL, NULL),
(260, 101, 15, 17, 22, 3, NULL, NULL),
(261, 101, 15, 17, 23, 4, NULL, NULL),
(262, 101, 15, 17, 24, 5, NULL, NULL),
(263, 101, 15, 17, 25, 4, NULL, NULL),
(264, 101, 15, 17, 26, 3, NULL, NULL),
(265, 101, 15, 17, 27, 4, NULL, NULL),
(266, 101, 15, 17, 28, 5, NULL, NULL),
(267, 101, 15, 17, 29, 4, NULL, NULL),
(268, 101, 15, 17, 30, 3, NULL, NULL),
(269, 101, 15, 17, 31, 4, NULL, NULL),
(270, 101, 15, 17, 32, 5, NULL, NULL),
(271, 101, 15, 17, 33, 4, NULL, NULL),
(272, 101, 15, 17, 34, 5, NULL, NULL),
(273, 101, 16, 17, 1, 3, NULL, NULL),
(274, 101, 16, 17, 2, 3, NULL, NULL),
(275, 101, 16, 17, 3, 2, NULL, NULL),
(276, 101, 16, 17, 4, 3, NULL, NULL),
(277, 101, 16, 17, 5, 4, NULL, NULL),
(278, 101, 16, 17, 6, 5, NULL, NULL),
(279, 101, 16, 17, 7, 4, NULL, NULL),
(280, 101, 16, 17, 8, 3, NULL, NULL),
(281, 101, 16, 17, 9, 2, NULL, NULL),
(282, 101, 16, 17, 10, 3, NULL, NULL),
(283, 101, 16, 17, 11, 4, NULL, NULL),
(284, 101, 16, 17, 12, 5, NULL, NULL),
(285, 101, 16, 17, 13, 4, NULL, NULL),
(286, 101, 16, 17, 14, 4, NULL, NULL),
(287, 101, 16, 17, 15, 3, NULL, NULL),
(288, 101, 16, 17, 16, 3, NULL, NULL),
(289, 101, 16, 17, 17, 4, NULL, NULL),
(290, 101, 16, 17, 18, 5, NULL, NULL),
(291, 101, 16, 17, 19, 5, NULL, NULL),
(292, 101, 16, 17, 20, 4, NULL, NULL),
(293, 101, 16, 17, 21, 3, NULL, NULL),
(294, 101, 16, 17, 22, 4, NULL, NULL),
(295, 101, 16, 17, 23, 4, NULL, NULL),
(296, 101, 16, 17, 24, 3, NULL, NULL),
(297, 101, 16, 17, 25, 3, NULL, NULL),
(298, 101, 16, 17, 26, 4, NULL, NULL),
(299, 101, 16, 17, 27, 5, NULL, NULL),
(300, 101, 16, 17, 28, 4, NULL, NULL),
(301, 101, 16, 17, 29, 3, NULL, NULL),
(302, 101, 16, 17, 30, 3, NULL, NULL),
(303, 101, 16, 17, 31, 4, NULL, NULL),
(304, 101, 16, 17, 32, 5, NULL, NULL),
(305, 101, 16, 17, 33, 4, NULL, NULL),
(306, 101, 16, 17, 34, 5, NULL, NULL),
(307, 101, 2, 19, 1, 4, NULL, NULL),
(308, 101, 2, 19, 2, 3, NULL, NULL),
(309, 101, 2, 19, 3, 4, NULL, NULL),
(310, 101, 2, 19, 4, 5, NULL, NULL),
(311, 101, 2, 19, 5, 4, NULL, NULL),
(312, 101, 2, 19, 6, 4, NULL, NULL),
(313, 101, 2, 19, 7, 4, NULL, NULL),
(314, 101, 2, 19, 8, 4, NULL, NULL),
(315, 101, 2, 19, 9, 3, NULL, NULL),
(316, 101, 2, 19, 10, 4, NULL, NULL),
(317, 101, 2, 19, 11, 5, NULL, NULL),
(318, 101, 2, 19, 12, 4, NULL, NULL),
(319, 101, 2, 19, 13, 3, NULL, NULL),
(320, 101, 2, 19, 14, 4, NULL, NULL),
(321, 101, 2, 19, 15, 5, NULL, NULL),
(322, 101, 2, 19, 16, 4, NULL, NULL),
(323, 101, 2, 19, 17, 3, NULL, NULL),
(324, 101, 2, 19, 18, 4, NULL, NULL),
(325, 101, 2, 19, 19, 5, NULL, NULL),
(326, 101, 2, 19, 20, 4, NULL, NULL),
(327, 101, 2, 19, 21, 4, NULL, NULL),
(328, 101, 2, 19, 22, 5, NULL, NULL),
(329, 101, 2, 19, 23, 4, NULL, NULL),
(330, 101, 2, 19, 24, 4, NULL, NULL),
(331, 101, 2, 19, 25, 5, NULL, NULL),
(332, 101, 2, 19, 26, 4, NULL, NULL),
(333, 101, 2, 19, 27, 4, NULL, NULL),
(334, 101, 2, 19, 28, 3, NULL, NULL),
(335, 101, 2, 19, 29, 4, NULL, NULL),
(336, 101, 2, 19, 30, 5, NULL, NULL),
(337, 101, 2, 19, 31, 4, NULL, NULL),
(338, 101, 2, 19, 32, 3, NULL, NULL),
(339, 101, 2, 19, 33, 4, NULL, NULL),
(340, 101, 2, 19, 34, 5, NULL, NULL),
(341, 101, 3, 19, 1, 3, NULL, NULL),
(342, 101, 3, 19, 2, 4, NULL, NULL),
(343, 101, 3, 19, 3, 5, NULL, NULL),
(344, 101, 3, 19, 4, 4, NULL, NULL),
(345, 101, 3, 19, 5, 3, NULL, NULL),
(346, 101, 3, 19, 6, 4, NULL, NULL),
(347, 101, 3, 19, 7, 5, NULL, NULL),
(348, 101, 3, 19, 8, 4, NULL, NULL),
(349, 101, 3, 19, 9, 3, NULL, NULL),
(350, 101, 3, 19, 10, 4, NULL, NULL),
(351, 101, 3, 19, 11, 4, NULL, NULL),
(352, 101, 3, 19, 12, 5, NULL, NULL),
(353, 101, 3, 19, 13, 4, NULL, NULL),
(354, 101, 3, 19, 14, 5, NULL, NULL),
(355, 101, 3, 19, 15, 4, NULL, NULL),
(356, 101, 3, 19, 16, 3, NULL, NULL),
(357, 101, 3, 19, 17, 4, NULL, NULL),
(358, 101, 3, 19, 18, 5, NULL, NULL),
(359, 101, 3, 19, 19, 4, NULL, NULL),
(360, 101, 3, 19, 20, 4, NULL, NULL),
(361, 101, 3, 19, 21, 3, NULL, NULL),
(362, 101, 3, 19, 22, 4, NULL, NULL),
(363, 101, 3, 19, 23, 5, NULL, NULL),
(364, 101, 3, 19, 24, 4, NULL, NULL),
(365, 101, 3, 19, 25, 3, NULL, NULL),
(366, 101, 3, 19, 26, 4, NULL, NULL),
(367, 101, 3, 19, 27, 5, NULL, NULL),
(368, 101, 3, 19, 28, 4, NULL, NULL),
(369, 101, 3, 19, 29, 4, NULL, NULL),
(370, 101, 3, 19, 30, 5, NULL, NULL),
(371, 101, 3, 19, 31, 5, NULL, NULL),
(372, 101, 3, 19, 32, 4, NULL, NULL),
(373, 101, 3, 19, 33, 3, NULL, NULL),
(374, 101, 3, 19, 34, 4, NULL, NULL),
(375, 101, 15, 19, 1, 4, NULL, NULL),
(376, 101, 15, 19, 2, 3, NULL, NULL),
(377, 101, 15, 19, 3, 4, NULL, NULL),
(378, 101, 15, 19, 4, 4, NULL, NULL),
(379, 101, 15, 19, 5, 4, NULL, NULL),
(380, 101, 15, 19, 6, 5, NULL, NULL),
(381, 101, 15, 19, 7, 4, NULL, NULL),
(382, 101, 15, 19, 8, 3, NULL, NULL),
(383, 101, 15, 19, 9, 4, NULL, NULL),
(384, 101, 15, 19, 10, 5, NULL, NULL),
(385, 101, 15, 19, 11, 4, NULL, NULL),
(386, 101, 15, 19, 12, 3, NULL, NULL),
(387, 101, 15, 19, 13, 4, NULL, NULL),
(388, 101, 15, 19, 14, 5, NULL, NULL),
(389, 101, 15, 19, 15, 4, NULL, NULL),
(390, 101, 15, 19, 16, 4, NULL, NULL),
(391, 101, 15, 19, 17, 3, NULL, NULL),
(392, 101, 15, 19, 18, 4, NULL, NULL),
(393, 101, 15, 19, 19, 4, NULL, NULL),
(394, 101, 15, 19, 20, 5, NULL, NULL),
(395, 101, 15, 19, 21, 4, NULL, NULL),
(396, 101, 15, 19, 22, 3, NULL, NULL),
(397, 101, 15, 19, 23, 4, NULL, NULL),
(398, 101, 15, 19, 24, 4, NULL, NULL),
(399, 101, 15, 19, 25, 5, NULL, NULL),
(400, 101, 15, 19, 26, 4, NULL, NULL),
(401, 101, 15, 19, 27, 3, NULL, NULL),
(402, 101, 15, 19, 28, 4, NULL, NULL),
(403, 101, 15, 19, 29, 5, NULL, NULL),
(404, 101, 15, 19, 30, 5, NULL, NULL),
(405, 101, 15, 19, 31, 4, NULL, NULL),
(406, 101, 15, 19, 32, 4, NULL, NULL),
(407, 101, 15, 19, 33, 5, NULL, NULL),
(408, 101, 15, 19, 34, 5, NULL, NULL),
(409, 101, 16, 19, 1, 3, NULL, NULL),
(410, 101, 16, 19, 2, 3, NULL, NULL),
(411, 101, 16, 19, 3, 4, NULL, NULL),
(412, 101, 16, 19, 4, 3, NULL, NULL),
(413, 101, 16, 19, 5, 4, NULL, NULL),
(414, 101, 16, 19, 6, 4, NULL, NULL),
(415, 101, 16, 19, 7, 5, NULL, NULL),
(416, 101, 16, 19, 8, 4, NULL, NULL),
(417, 101, 16, 19, 9, 3, NULL, NULL),
(418, 101, 16, 19, 10, 4, NULL, NULL),
(419, 101, 16, 19, 11, 4, NULL, NULL),
(420, 101, 16, 19, 12, 5, NULL, NULL),
(421, 101, 16, 19, 13, 4, NULL, NULL),
(422, 101, 16, 19, 14, 3, NULL, NULL),
(423, 101, 16, 19, 15, 4, NULL, NULL),
(424, 101, 16, 19, 16, 5, NULL, NULL),
(425, 101, 16, 19, 17, 4, NULL, NULL),
(426, 101, 16, 19, 18, 3, NULL, NULL),
(427, 101, 16, 19, 19, 4, NULL, NULL),
(428, 101, 16, 19, 20, 5, NULL, NULL),
(429, 101, 16, 19, 21, 4, NULL, NULL),
(430, 101, 16, 19, 22, 4, NULL, NULL),
(431, 101, 16, 19, 23, 3, NULL, NULL),
(432, 101, 16, 19, 24, 4, NULL, NULL),
(433, 101, 16, 19, 25, 5, NULL, NULL),
(434, 101, 16, 19, 26, 4, NULL, NULL),
(435, 101, 16, 19, 27, 4, NULL, NULL),
(436, 101, 16, 19, 28, 4, NULL, NULL),
(437, 101, 16, 19, 29, 5, NULL, NULL),
(438, 101, 16, 19, 30, 4, NULL, NULL),
(439, 101, 16, 19, 31, 4, NULL, NULL),
(440, 101, 16, 19, 32, 5, NULL, NULL),
(441, 101, 16, 19, 33, 4, NULL, NULL),
(442, 101, 16, 19, 34, 5, NULL, NULL),
(443, 101, 17, 19, 1, 3, NULL, NULL),
(444, 101, 17, 19, 2, 4, NULL, NULL),
(445, 101, 17, 19, 3, 5, NULL, NULL),
(446, 101, 17, 19, 4, 4, NULL, NULL),
(447, 101, 17, 19, 5, 3, NULL, NULL),
(448, 101, 17, 19, 6, 4, NULL, NULL),
(449, 101, 17, 19, 7, 4, NULL, NULL),
(450, 101, 17, 19, 8, 4, NULL, NULL),
(451, 101, 17, 19, 9, 5, NULL, NULL),
(452, 101, 17, 19, 10, 4, NULL, NULL),
(453, 101, 17, 19, 11, 3, NULL, NULL),
(454, 101, 17, 19, 12, 4, NULL, NULL),
(455, 101, 17, 19, 13, 5, NULL, NULL),
(456, 101, 17, 19, 14, 4, NULL, NULL),
(457, 101, 17, 19, 15, 4, NULL, NULL),
(458, 101, 17, 19, 16, 3, NULL, NULL),
(459, 101, 17, 19, 17, 4, NULL, NULL),
(460, 101, 17, 19, 18, 5, NULL, NULL),
(461, 101, 17, 19, 19, 4, NULL, NULL),
(462, 101, 17, 19, 20, 3, NULL, NULL),
(463, 101, 17, 19, 21, 4, NULL, NULL),
(464, 101, 17, 19, 22, 3, NULL, NULL),
(465, 101, 17, 19, 23, 4, NULL, NULL),
(466, 101, 17, 19, 24, 5, NULL, NULL),
(467, 101, 17, 19, 25, 4, NULL, NULL),
(468, 101, 17, 19, 26, 3, NULL, NULL),
(469, 101, 17, 19, 27, 4, NULL, NULL),
(470, 101, 17, 19, 28, 4, NULL, NULL),
(471, 101, 17, 19, 29, 4, NULL, NULL),
(472, 101, 17, 19, 30, 5, NULL, NULL),
(473, 101, 17, 19, 31, 4, NULL, NULL),
(474, 101, 17, 19, 32, 3, NULL, NULL),
(475, 101, 17, 19, 33, 4, NULL, NULL),
(476, 101, 17, 19, 34, 5, NULL, NULL),
(477, 101, 15, 2, 1, 4, NULL, NULL),
(478, 101, 15, 2, 2, 3, NULL, NULL),
(479, 101, 15, 2, 3, 3, NULL, NULL),
(480, 101, 15, 2, 4, 4, NULL, NULL),
(481, 101, 15, 2, 5, 4, NULL, NULL),
(482, 101, 15, 2, 6, 3, NULL, NULL),
(483, 101, 15, 2, 7, 4, NULL, NULL),
(484, 101, 15, 2, 8, 5, NULL, NULL),
(485, 101, 15, 2, 9, 4, NULL, NULL),
(486, 101, 15, 2, 10, 3, NULL, NULL),
(487, 101, 15, 2, 11, 4, NULL, NULL),
(488, 101, 15, 2, 12, 4, NULL, NULL),
(489, 101, 15, 2, 13, 4, NULL, NULL),
(490, 101, 15, 2, 14, 4, NULL, NULL),
(491, 101, 15, 2, 15, 5, NULL, NULL),
(492, 101, 15, 2, 16, 4, NULL, NULL),
(493, 101, 15, 2, 17, 4, NULL, NULL),
(494, 101, 15, 2, 18, 3, NULL, NULL),
(495, 101, 15, 2, 19, 4, NULL, NULL),
(496, 101, 15, 2, 20, 5, NULL, NULL),
(497, 101, 15, 2, 21, 4, NULL, NULL),
(498, 101, 15, 2, 22, 4, NULL, NULL),
(499, 101, 15, 2, 23, 3, NULL, NULL),
(500, 101, 15, 2, 24, 4, NULL, NULL),
(501, 101, 15, 2, 25, 5, NULL, NULL),
(502, 101, 15, 2, 26, 4, NULL, NULL),
(503, 101, 15, 2, 27, 4, NULL, NULL),
(504, 101, 15, 2, 28, 3, NULL, NULL),
(505, 101, 15, 2, 29, 4, NULL, NULL),
(506, 101, 15, 2, 30, 5, NULL, NULL),
(507, 101, 15, 2, 31, 4, NULL, NULL),
(508, 101, 15, 2, 32, 4, NULL, NULL),
(509, 101, 15, 2, 33, 5, NULL, NULL),
(510, 101, 15, 2, 34, 5, NULL, NULL),
(511, 101, 16, 2, 1, 3, NULL, NULL),
(512, 101, 16, 2, 2, 4, NULL, NULL),
(513, 101, 16, 2, 3, 4, NULL, NULL),
(514, 101, 16, 2, 4, 4, NULL, NULL),
(515, 101, 16, 2, 5, 5, NULL, NULL),
(516, 101, 16, 2, 6, 4, NULL, NULL),
(517, 101, 16, 2, 7, 3, NULL, NULL),
(518, 101, 16, 2, 8, 4, NULL, NULL),
(519, 101, 16, 2, 9, 5, NULL, NULL),
(520, 101, 16, 2, 10, 4, NULL, NULL),
(521, 101, 16, 2, 11, 3, NULL, NULL),
(522, 101, 16, 2, 12, 4, NULL, NULL),
(523, 101, 16, 2, 13, 5, NULL, NULL),
(524, 101, 16, 2, 14, 5, NULL, NULL),
(525, 101, 16, 2, 15, 4, NULL, NULL),
(526, 101, 16, 2, 16, 4, NULL, NULL),
(527, 101, 16, 2, 17, 3, NULL, NULL),
(528, 101, 16, 2, 18, 4, NULL, NULL),
(529, 101, 16, 2, 19, 5, NULL, NULL),
(530, 101, 16, 2, 20, 4, NULL, NULL),
(531, 101, 16, 2, 21, 4, NULL, NULL),
(532, 101, 16, 2, 22, 3, NULL, NULL),
(533, 101, 16, 2, 23, 4, NULL, NULL),
(534, 101, 16, 2, 24, 5, NULL, NULL),
(535, 101, 16, 2, 25, 4, NULL, NULL),
(536, 101, 16, 2, 26, 4, NULL, NULL),
(537, 101, 16, 2, 27, 3, NULL, NULL),
(538, 101, 16, 2, 28, 4, NULL, NULL),
(539, 101, 16, 2, 29, 5, NULL, NULL),
(540, 101, 16, 2, 30, 5, NULL, NULL),
(541, 101, 16, 2, 31, 4, NULL, NULL),
(542, 101, 16, 2, 32, 5, NULL, NULL),
(543, 101, 16, 2, 33, 4, NULL, NULL),
(544, 101, 16, 2, 34, 3, NULL, NULL),
(545, 101, 17, 2, 1, 3, NULL, NULL),
(546, 101, 17, 2, 2, 2, NULL, NULL),
(547, 101, 17, 2, 3, 1, NULL, NULL),
(548, 101, 17, 2, 4, 1, NULL, NULL),
(549, 101, 17, 2, 5, 2, NULL, NULL),
(550, 101, 17, 2, 6, 3, NULL, NULL),
(551, 101, 17, 2, 7, 4, NULL, NULL),
(552, 101, 17, 2, 8, 3, NULL, NULL),
(553, 101, 17, 2, 9, 2, NULL, NULL),
(554, 101, 17, 2, 10, 2, NULL, NULL),
(555, 101, 17, 2, 11, 3, NULL, NULL),
(556, 101, 17, 2, 12, 4, NULL, NULL),
(557, 101, 17, 2, 13, 5, NULL, NULL),
(558, 101, 17, 2, 14, 4, NULL, NULL),
(559, 101, 17, 2, 15, 3, NULL, NULL),
(560, 101, 17, 2, 16, 2, NULL, NULL),
(561, 101, 17, 2, 17, 1, NULL, NULL),
(562, 101, 17, 2, 18, 2, NULL, NULL),
(563, 101, 17, 2, 19, 3, NULL, NULL),
(564, 101, 17, 2, 20, 4, NULL, NULL),
(565, 101, 17, 2, 21, 4, NULL, NULL),
(566, 101, 17, 2, 22, 3, NULL, NULL),
(567, 101, 17, 2, 23, 3, NULL, NULL),
(568, 101, 17, 2, 24, 4, NULL, NULL),
(569, 101, 17, 2, 25, 5, NULL, NULL),
(570, 101, 17, 2, 26, 5, NULL, NULL),
(571, 101, 17, 2, 27, 4, NULL, NULL),
(572, 101, 17, 2, 28, 3, NULL, NULL),
(573, 101, 17, 2, 29, 2, NULL, NULL),
(574, 101, 17, 2, 30, 3, NULL, NULL),
(575, 101, 17, 2, 31, 4, NULL, NULL),
(576, 101, 17, 2, 32, 4, NULL, NULL),
(577, 101, 17, 2, 33, 5, NULL, NULL),
(578, 101, 17, 2, 34, 5, NULL, NULL),
(579, 101, 19, 2, 1, 3, NULL, NULL),
(580, 101, 19, 2, 2, 4, NULL, NULL),
(581, 101, 19, 2, 3, 5, NULL, NULL),
(582, 101, 19, 2, 4, 4, NULL, NULL),
(583, 101, 19, 2, 5, 3, NULL, NULL),
(584, 101, 19, 2, 6, 3, NULL, NULL),
(585, 101, 19, 2, 7, 4, NULL, NULL),
(586, 101, 19, 2, 8, 5, NULL, NULL),
(587, 101, 19, 2, 9, 4, NULL, NULL),
(588, 101, 19, 2, 10, 3, NULL, NULL),
(589, 101, 19, 2, 11, 2, NULL, NULL),
(590, 101, 19, 2, 12, 3, NULL, NULL),
(591, 101, 19, 2, 13, 4, NULL, NULL),
(592, 101, 19, 2, 14, 5, NULL, NULL),
(593, 101, 19, 2, 15, 4, NULL, NULL),
(594, 101, 19, 2, 16, 3, NULL, NULL),
(595, 101, 19, 2, 17, 3, NULL, NULL),
(596, 101, 19, 2, 18, 2, NULL, NULL),
(597, 101, 19, 2, 19, 3, NULL, NULL),
(598, 101, 19, 2, 20, 4, NULL, NULL),
(599, 101, 19, 2, 21, 5, NULL, NULL),
(600, 101, 19, 2, 22, 4, NULL, NULL),
(601, 101, 19, 2, 23, 3, NULL, NULL),
(602, 101, 19, 2, 24, 3, NULL, NULL),
(603, 101, 19, 2, 25, 4, NULL, NULL),
(604, 101, 19, 2, 26, 5, NULL, NULL),
(605, 101, 19, 2, 27, 4, NULL, NULL),
(606, 101, 19, 2, 28, 3, NULL, NULL),
(607, 101, 19, 2, 29, 3, NULL, NULL),
(608, 101, 19, 2, 30, 4, NULL, NULL),
(609, 101, 19, 2, 31, 3, NULL, NULL),
(610, 101, 19, 2, 32, 4, NULL, NULL),
(611, 101, 19, 2, 33, 5, NULL, NULL),
(612, 101, 19, 2, 34, 5, NULL, NULL),
(613, 101, 2, 18, 1, 4, NULL, NULL),
(614, 101, 2, 18, 2, 4, NULL, NULL),
(615, 101, 2, 18, 3, 4, NULL, NULL),
(616, 101, 2, 18, 4, 3, NULL, NULL),
(617, 101, 2, 18, 5, 2, NULL, NULL),
(618, 101, 2, 18, 6, 3, NULL, NULL),
(619, 101, 2, 18, 7, 4, NULL, NULL),
(620, 101, 2, 18, 8, 4, NULL, NULL),
(621, 101, 2, 18, 9, 4, NULL, NULL),
(622, 101, 2, 18, 10, 3, NULL, NULL),
(623, 101, 2, 18, 11, 4, NULL, NULL),
(624, 101, 2, 18, 12, 3, NULL, NULL),
(625, 101, 2, 18, 13, 3, NULL, NULL),
(626, 101, 2, 18, 14, 2, NULL, NULL),
(627, 101, 2, 18, 15, 3, NULL, NULL),
(628, 101, 2, 18, 16, 4, NULL, NULL),
(629, 101, 2, 18, 17, 4, NULL, NULL),
(630, 101, 2, 18, 18, 3, NULL, NULL),
(631, 101, 2, 18, 19, 3, NULL, NULL),
(632, 101, 2, 18, 20, 3, NULL, NULL),
(633, 101, 2, 18, 21, 4, NULL, NULL),
(634, 101, 2, 18, 22, 5, NULL, NULL),
(635, 101, 2, 18, 23, 4, NULL, NULL),
(636, 101, 2, 18, 24, 3, NULL, NULL),
(637, 101, 2, 18, 25, 3, NULL, NULL),
(638, 101, 2, 18, 26, 4, NULL, NULL),
(639, 101, 2, 18, 27, 5, NULL, NULL),
(640, 101, 2, 18, 28, 4, NULL, NULL),
(641, 101, 2, 18, 29, 3, NULL, NULL),
(642, 101, 2, 18, 30, 3, NULL, NULL),
(643, 101, 2, 18, 31, 4, NULL, NULL),
(644, 101, 2, 18, 32, 5, NULL, NULL),
(645, 101, 2, 18, 33, 5, NULL, NULL),
(646, 101, 2, 18, 34, 5, NULL, NULL),
(647, 101, 3, 18, 1, 1, NULL, NULL),
(648, 101, 3, 18, 2, 2, NULL, NULL),
(649, 101, 3, 18, 3, 3, NULL, NULL),
(650, 101, 3, 18, 4, 4, NULL, NULL),
(651, 101, 3, 18, 5, 4, NULL, NULL),
(652, 101, 3, 18, 6, 4, NULL, NULL),
(653, 101, 3, 18, 7, 3, NULL, NULL),
(654, 101, 3, 18, 8, 3, NULL, NULL),
(655, 101, 3, 18, 9, 4, NULL, NULL),
(656, 101, 3, 18, 10, 4, NULL, NULL),
(657, 101, 3, 18, 11, 3, NULL, NULL),
(658, 101, 3, 18, 12, 3, NULL, NULL),
(659, 101, 3, 18, 13, 4, NULL, NULL),
(660, 101, 3, 18, 14, 4, NULL, NULL),
(661, 101, 3, 18, 15, 3, NULL, NULL),
(662, 101, 3, 18, 16, 4, NULL, NULL),
(663, 101, 3, 18, 17, 4, NULL, NULL),
(664, 101, 3, 18, 18, 4, NULL, NULL),
(665, 101, 3, 18, 19, 3, NULL, NULL),
(666, 101, 3, 18, 20, 2, NULL, NULL),
(667, 101, 3, 18, 21, 3, NULL, NULL),
(668, 101, 3, 18, 22, 4, NULL, NULL),
(669, 101, 3, 18, 23, 4, NULL, NULL),
(670, 101, 3, 18, 24, 3, NULL, NULL),
(671, 101, 3, 18, 25, 3, NULL, NULL),
(672, 101, 3, 18, 26, 4, NULL, NULL),
(673, 101, 3, 18, 27, 4, NULL, NULL),
(674, 101, 3, 18, 28, 3, NULL, NULL),
(675, 101, 3, 18, 29, 3, NULL, NULL),
(676, 101, 3, 18, 30, 4, NULL, NULL),
(677, 101, 3, 18, 31, 5, NULL, NULL),
(678, 101, 3, 18, 32, 4, NULL, NULL),
(679, 101, 3, 18, 33, 3, NULL, NULL),
(680, 101, 3, 18, 34, 4, NULL, NULL),
(681, 101, 15, 18, 1, 3, NULL, NULL),
(682, 101, 15, 18, 2, 2, NULL, NULL),
(683, 101, 15, 18, 3, 1, NULL, NULL),
(684, 101, 15, 18, 4, 2, NULL, NULL),
(685, 101, 15, 18, 5, 3, NULL, NULL),
(686, 101, 15, 18, 6, 4, NULL, NULL),
(687, 101, 15, 18, 7, 4, NULL, NULL),
(688, 101, 15, 18, 8, 4, NULL, NULL),
(689, 101, 15, 18, 9, 3, NULL, NULL),
(690, 101, 15, 18, 10, 2, NULL, NULL),
(691, 101, 15, 18, 11, 2, NULL, NULL),
(692, 101, 15, 18, 12, 3, NULL, NULL),
(693, 101, 15, 18, 13, 4, NULL, NULL),
(694, 101, 15, 18, 14, 4, NULL, NULL),
(695, 101, 15, 18, 15, 3, NULL, NULL),
(696, 101, 15, 18, 16, 2, NULL, NULL),
(697, 101, 15, 18, 17, 3, NULL, NULL),
(698, 101, 15, 18, 18, 4, NULL, NULL),
(699, 101, 15, 18, 19, 5, NULL, NULL),
(700, 101, 15, 18, 20, 4, NULL, NULL),
(701, 101, 15, 18, 21, 3, NULL, NULL),
(702, 101, 15, 18, 22, 2, NULL, NULL),
(703, 101, 15, 18, 23, 3, NULL, NULL),
(704, 101, 15, 18, 24, 4, NULL, NULL),
(705, 101, 15, 18, 25, 4, NULL, NULL),
(706, 101, 15, 18, 26, 3, NULL, NULL),
(707, 101, 15, 18, 27, 3, NULL, NULL),
(708, 101, 15, 18, 28, 4, NULL, NULL),
(709, 101, 15, 18, 29, 4, NULL, NULL),
(710, 101, 15, 18, 30, 3, NULL, NULL),
(711, 101, 15, 18, 31, 3, NULL, NULL),
(712, 101, 15, 18, 32, 4, NULL, NULL),
(713, 101, 15, 18, 33, 5, NULL, NULL),
(714, 101, 15, 18, 34, 5, NULL, NULL),
(715, 101, 16, 18, 1, 3, NULL, NULL),
(716, 101, 16, 18, 2, 3, NULL, NULL),
(717, 101, 16, 18, 3, 4, NULL, NULL),
(718, 101, 16, 18, 4, 4, NULL, NULL),
(719, 101, 16, 18, 5, 3, NULL, NULL),
(720, 101, 16, 18, 6, 4, NULL, NULL),
(721, 101, 16, 18, 7, 4, NULL, NULL),
(722, 101, 16, 18, 8, 5, NULL, NULL),
(723, 101, 16, 18, 9, 4, NULL, NULL),
(724, 101, 16, 18, 10, 4, NULL, NULL),
(725, 101, 16, 18, 11, 3, NULL, NULL),
(726, 101, 16, 18, 12, 3, NULL, NULL),
(727, 101, 16, 18, 13, 4, NULL, NULL),
(728, 101, 16, 18, 14, 4, NULL, NULL),
(729, 101, 16, 18, 15, 4, NULL, NULL),
(730, 101, 16, 18, 16, 3, NULL, NULL),
(731, 101, 16, 18, 17, 4, NULL, NULL),
(732, 101, 16, 18, 18, 5, NULL, NULL),
(733, 101, 16, 18, 19, 4, NULL, NULL),
(734, 101, 16, 18, 20, 4, NULL, NULL),
(735, 101, 16, 18, 21, 3, NULL, NULL),
(736, 101, 16, 18, 22, 4, NULL, NULL),
(737, 101, 16, 18, 23, 4, NULL, NULL),
(738, 101, 16, 18, 24, 4, NULL, NULL),
(739, 101, 16, 18, 25, 4, NULL, NULL),
(740, 101, 16, 18, 26, 3, NULL, NULL),
(741, 101, 16, 18, 27, 4, NULL, NULL),
(742, 101, 16, 18, 28, 5, NULL, NULL),
(743, 101, 16, 18, 29, 4, NULL, NULL),
(744, 101, 16, 18, 30, 4, NULL, NULL),
(745, 101, 16, 18, 31, 4, NULL, NULL),
(746, 101, 16, 18, 32, 5, NULL, NULL),
(747, 101, 16, 18, 33, 5, NULL, NULL),
(748, 101, 16, 18, 34, 5, NULL, NULL),
(749, 101, 17, 18, 1, 3, NULL, NULL),
(750, 101, 17, 18, 2, 4, NULL, NULL),
(751, 101, 17, 18, 3, 4, NULL, NULL),
(752, 101, 17, 18, 4, 4, NULL, NULL),
(753, 101, 17, 18, 5, 4, NULL, NULL),
(754, 101, 17, 18, 6, 4, NULL, NULL),
(755, 101, 17, 18, 7, 4, NULL, NULL),
(756, 101, 17, 18, 8, 3, NULL, NULL),
(757, 101, 17, 18, 9, 4, NULL, NULL),
(758, 101, 17, 18, 10, 4, NULL, NULL),
(759, 101, 17, 18, 11, 4, NULL, NULL),
(760, 101, 17, 18, 12, 3, NULL, NULL),
(761, 101, 17, 18, 13, 4, NULL, NULL),
(762, 101, 17, 18, 14, 4, NULL, NULL),
(763, 101, 17, 18, 15, 4, NULL, NULL),
(764, 101, 17, 18, 16, 5, NULL, NULL),
(765, 101, 17, 18, 17, 4, NULL, NULL),
(766, 101, 17, 18, 18, 4, NULL, NULL),
(767, 101, 17, 18, 19, 3, NULL, NULL),
(768, 101, 17, 18, 20, 4, NULL, NULL),
(769, 101, 17, 18, 21, 5, NULL, NULL),
(770, 101, 17, 18, 22, 4, NULL, NULL),
(771, 101, 17, 18, 23, 5, NULL, NULL),
(772, 101, 17, 18, 24, 4, NULL, NULL),
(773, 101, 17, 18, 25, 4, NULL, NULL),
(774, 101, 17, 18, 26, 4, NULL, NULL),
(775, 101, 17, 18, 27, 4, NULL, NULL),
(776, 101, 17, 18, 28, 4, NULL, NULL),
(777, 101, 17, 18, 29, 3, NULL, NULL),
(778, 101, 17, 18, 30, 3, NULL, NULL),
(779, 101, 17, 18, 31, 4, NULL, NULL),
(780, 101, 17, 18, 32, 5, NULL, NULL),
(781, 101, 17, 18, 33, 5, NULL, NULL),
(782, 101, 17, 18, 34, 5, NULL, NULL),
(783, 101, 19, 18, 1, 4, NULL, NULL),
(784, 101, 19, 18, 2, 5, NULL, NULL),
(785, 101, 19, 18, 3, 4, NULL, NULL),
(786, 101, 19, 18, 4, 3, NULL, NULL),
(787, 101, 19, 18, 5, 3, NULL, NULL),
(788, 101, 19, 18, 6, 2, NULL, NULL),
(789, 101, 19, 18, 7, 3, NULL, NULL),
(790, 101, 19, 18, 8, 4, NULL, NULL),
(791, 101, 19, 18, 9, 4, NULL, NULL),
(792, 101, 19, 18, 10, 3, NULL, NULL),
(793, 101, 19, 18, 11, 3, NULL, NULL),
(794, 101, 19, 18, 12, 4, NULL, NULL),
(795, 101, 19, 18, 13, 5, NULL, NULL),
(796, 101, 19, 18, 14, 4, NULL, NULL),
(797, 101, 19, 18, 15, 3, NULL, NULL),
(798, 101, 19, 18, 16, 4, NULL, NULL),
(799, 101, 19, 18, 17, 3, NULL, NULL),
(800, 101, 19, 18, 18, 3, NULL, NULL),
(801, 101, 19, 18, 19, 2, NULL, NULL),
(802, 101, 19, 18, 20, 3, NULL, NULL),
(803, 101, 19, 18, 21, 4, NULL, NULL),
(804, 101, 19, 18, 22, 4, NULL, NULL),
(805, 101, 19, 18, 23, 4, NULL, NULL),
(806, 101, 19, 18, 24, 4, NULL, NULL),
(807, 101, 19, 18, 25, 3, NULL, NULL),
(808, 101, 19, 18, 26, 3, NULL, NULL),
(809, 101, 19, 18, 27, 4, NULL, NULL),
(810, 101, 19, 18, 28, 5, NULL, NULL),
(811, 101, 19, 18, 29, 4, NULL, NULL),
(812, 101, 19, 18, 30, 3, NULL, NULL),
(813, 101, 19, 18, 31, 4, NULL, NULL),
(814, 101, 19, 18, 32, 4, NULL, NULL),
(815, 101, 19, 18, 33, 5, NULL, NULL),
(816, 101, 19, 18, 34, 5, NULL, NULL),
(919, 101, 18, 2, 1, 4, NULL, NULL),
(920, 101, 18, 2, 2, 3, NULL, NULL),
(921, 101, 18, 2, 3, 4, NULL, NULL),
(922, 101, 18, 2, 4, 4, NULL, NULL),
(923, 101, 18, 2, 5, 4, NULL, NULL),
(924, 101, 18, 2, 6, 5, NULL, NULL),
(925, 101, 18, 2, 7, 5, NULL, NULL),
(926, 101, 18, 2, 8, 5, NULL, NULL),
(927, 101, 18, 2, 9, 5, NULL, NULL),
(928, 101, 18, 2, 10, 4, NULL, NULL),
(929, 101, 18, 2, 11, 3, NULL, NULL),
(930, 101, 18, 2, 12, 4, NULL, NULL),
(931, 101, 18, 2, 13, 5, NULL, NULL),
(932, 101, 18, 2, 14, 5, NULL, NULL),
(933, 101, 18, 2, 15, 4, NULL, NULL),
(934, 101, 18, 2, 16, 3, NULL, NULL),
(935, 101, 18, 2, 17, 4, NULL, NULL),
(936, 101, 18, 2, 18, 5, NULL, NULL),
(937, 101, 18, 2, 19, 5, NULL, NULL),
(938, 101, 18, 2, 20, 4, NULL, NULL),
(939, 101, 18, 2, 21, 4, NULL, NULL),
(940, 101, 18, 2, 22, 3, NULL, NULL),
(941, 101, 18, 2, 23, 4, NULL, NULL),
(942, 101, 18, 2, 24, 5, NULL, NULL),
(943, 101, 18, 2, 25, 4, NULL, NULL),
(944, 101, 18, 2, 26, 3, NULL, NULL),
(945, 101, 18, 2, 27, 4, NULL, NULL),
(946, 101, 18, 2, 28, 5, NULL, NULL),
(947, 101, 18, 2, 29, 4, NULL, NULL),
(948, 101, 18, 2, 30, 4, NULL, NULL),
(949, 101, 18, 2, 31, 5, NULL, NULL),
(950, 101, 18, 2, 32, 5, NULL, NULL),
(951, 101, 18, 2, 33, 4, NULL, NULL),
(952, 101, 18, 2, 34, 5, NULL, NULL),
(953, 101, 18, 17, 1, 3, NULL, NULL),
(954, 101, 18, 17, 2, 4, NULL, NULL),
(955, 101, 18, 17, 3, 4, NULL, NULL),
(956, 101, 18, 17, 4, 4, NULL, NULL),
(957, 101, 18, 17, 5, 4, NULL, NULL),
(958, 101, 18, 17, 6, 4, NULL, NULL),
(959, 101, 18, 17, 7, 3, NULL, NULL),
(960, 101, 18, 17, 8, 2, NULL, NULL),
(961, 101, 18, 17, 9, 3, NULL, NULL),
(962, 101, 18, 17, 10, 4, NULL, NULL),
(963, 101, 18, 17, 11, 5, NULL, NULL),
(964, 101, 18, 17, 12, 4, NULL, NULL),
(965, 101, 18, 17, 13, 3, NULL, NULL),
(966, 101, 18, 17, 14, 3, NULL, NULL),
(967, 101, 18, 17, 15, 4, NULL, NULL),
(968, 101, 18, 17, 16, 5, NULL, NULL),
(969, 101, 18, 17, 17, 4, NULL, NULL),
(970, 101, 18, 17, 18, 3, NULL, NULL),
(971, 101, 18, 17, 19, 4, NULL, NULL),
(972, 101, 18, 17, 20, 4, NULL, NULL),
(973, 101, 18, 17, 21, 5, NULL, NULL),
(974, 101, 18, 17, 22, 4, NULL, NULL),
(975, 101, 18, 17, 23, 3, NULL, NULL),
(976, 101, 18, 17, 24, 4, NULL, NULL),
(977, 101, 18, 17, 25, 4, NULL, NULL),
(978, 101, 18, 17, 26, 4, NULL, NULL),
(979, 101, 18, 17, 27, 4, NULL, NULL),
(980, 101, 18, 17, 28, 5, NULL, NULL),
(981, 101, 18, 17, 29, 4, NULL, NULL),
(982, 101, 18, 17, 30, 3, NULL, NULL),
(983, 101, 18, 17, 31, 4, NULL, NULL),
(984, 101, 18, 17, 32, 5, NULL, NULL),
(985, 101, 18, 17, 33, 5, NULL, NULL),
(986, 101, 18, 17, 34, 4, NULL, NULL),
(987, 101, 19, 17, 1, 4, NULL, NULL),
(988, 101, 19, 17, 2, 4, NULL, NULL),
(989, 101, 19, 17, 3, 3, NULL, NULL),
(990, 101, 19, 17, 4, 2, NULL, NULL),
(991, 101, 19, 17, 5, 3, NULL, NULL),
(992, 101, 19, 17, 6, 4, NULL, NULL),
(993, 101, 19, 17, 7, 3, NULL, NULL),
(994, 101, 19, 17, 8, 4, NULL, NULL),
(995, 101, 19, 17, 9, 4, NULL, NULL),
(996, 101, 19, 17, 10, 3, NULL, NULL),
(997, 101, 19, 17, 11, 3, NULL, NULL),
(998, 101, 19, 17, 12, 4, NULL, NULL),
(999, 101, 19, 17, 13, 4, NULL, NULL),
(1000, 101, 19, 17, 14, 3, NULL, NULL),
(1001, 101, 19, 17, 15, 3, NULL, NULL),
(1002, 101, 19, 17, 16, 4, NULL, NULL),
(1003, 101, 19, 17, 17, 5, NULL, NULL),
(1004, 101, 19, 17, 18, 4, NULL, NULL),
(1005, 101, 19, 17, 19, 3, NULL, NULL),
(1006, 101, 19, 17, 20, 4, NULL, NULL),
(1007, 101, 19, 17, 21, 5, NULL, NULL),
(1008, 101, 19, 17, 22, 5, NULL, NULL),
(1009, 101, 19, 17, 23, 5, NULL, NULL),
(1010, 101, 19, 17, 24, 4, NULL, NULL),
(1011, 101, 19, 17, 25, 4, NULL, NULL),
(1012, 101, 19, 17, 26, 5, NULL, NULL),
(1013, 101, 19, 17, 27, 5, NULL, NULL),
(1014, 101, 19, 17, 28, 5, NULL, NULL),
(1015, 101, 19, 17, 29, 4, NULL, NULL),
(1016, 101, 19, 17, 30, 5, NULL, NULL),
(1017, 101, 19, 17, 31, 4, NULL, NULL),
(1018, 101, 19, 17, 32, 4, NULL, NULL),
(1019, 101, 19, 17, 33, 5, NULL, NULL),
(1020, 101, 19, 17, 34, 5, NULL, NULL),
(1021, 103, 3, 15, 1, 4, NULL, NULL),
(1022, 103, 3, 15, 2, 3, NULL, NULL),
(1023, 103, 3, 15, 3, 4, NULL, NULL),
(1024, 103, 3, 15, 4, 4, NULL, NULL),
(1025, 103, 3, 15, 5, 5, NULL, NULL),
(1026, 103, 3, 15, 6, 4, NULL, NULL),
(1027, 103, 3, 15, 7, 3, NULL, NULL),
(1028, 103, 3, 15, 8, 4, NULL, NULL),
(1029, 103, 3, 15, 9, 5, NULL, NULL),
(1030, 103, 3, 15, 10, 4, NULL, NULL),
(1031, 103, 3, 15, 11, 4, NULL, NULL),
(1032, 103, 3, 15, 12, 3, NULL, NULL),
(1033, 103, 3, 15, 13, 4, NULL, NULL),
(1034, 103, 3, 15, 14, 5, NULL, NULL),
(1035, 103, 3, 15, 15, 4, NULL, NULL),
(1036, 103, 3, 15, 16, 4, NULL, NULL),
(1037, 103, 3, 15, 17, 5, NULL, NULL),
(1038, 103, 3, 15, 18, 4, NULL, NULL),
(1039, 103, 3, 15, 19, 4, NULL, NULL),
(1040, 103, 3, 15, 20, 3, NULL, NULL),
(1041, 103, 3, 15, 21, 4, NULL, NULL),
(1042, 103, 3, 15, 22, 5, NULL, NULL),
(1043, 103, 3, 15, 23, 4, NULL, NULL),
(1044, 103, 3, 15, 24, 4, NULL, NULL),
(1045, 103, 3, 15, 25, 3, NULL, NULL),
(1046, 103, 3, 15, 26, 4, NULL, NULL),
(1047, 103, 3, 15, 27, 5, NULL, NULL),
(1048, 103, 3, 15, 28, 4, NULL, NULL),
(1049, 103, 3, 15, 29, 3, NULL, NULL),
(1050, 103, 3, 15, 30, 4, NULL, NULL),
(1051, 103, 3, 15, 31, 5, NULL, NULL),
(1052, 103, 3, 15, 32, 4, NULL, NULL),
(1053, 103, 3, 15, 33, 4, NULL, NULL),
(1054, 103, 3, 15, 34, 5, NULL, NULL),
(1055, 103, 3, 16, 1, 2, NULL, NULL),
(1056, 103, 3, 16, 2, 3, NULL, NULL),
(1057, 103, 3, 16, 3, 4, NULL, NULL),
(1058, 103, 3, 16, 4, 4, NULL, NULL),
(1059, 103, 3, 16, 5, 3, NULL, NULL),
(1060, 103, 3, 16, 6, 4, NULL, NULL),
(1061, 103, 3, 16, 7, 4, NULL, NULL),
(1062, 103, 3, 16, 8, 5, NULL, NULL),
(1063, 103, 3, 16, 9, 5, NULL, NULL),
(1064, 103, 3, 16, 10, 4, NULL, NULL),
(1065, 103, 3, 16, 11, 3, NULL, NULL),
(1066, 103, 3, 16, 12, 3, NULL, NULL),
(1067, 103, 3, 16, 13, 4, NULL, NULL),
(1068, 103, 3, 16, 14, 5, NULL, NULL),
(1069, 103, 3, 16, 15, 4, NULL, NULL),
(1070, 103, 3, 16, 16, 4, NULL, NULL),
(1071, 103, 3, 16, 17, 3, NULL, NULL),
(1072, 103, 3, 16, 18, 4, NULL, NULL),
(1073, 103, 3, 16, 19, 5, NULL, NULL),
(1074, 103, 3, 16, 20, 5, NULL, NULL),
(1075, 103, 3, 16, 21, 4, NULL, NULL),
(1076, 103, 3, 16, 22, 3, NULL, NULL),
(1077, 103, 3, 16, 23, 4, NULL, NULL),
(1078, 103, 3, 16, 24, 5, NULL, NULL),
(1079, 103, 3, 16, 25, 5, NULL, NULL),
(1080, 103, 3, 16, 26, 4, NULL, NULL),
(1081, 103, 3, 16, 27, 3, NULL, NULL),
(1082, 103, 3, 16, 28, 4, NULL, NULL),
(1083, 103, 3, 16, 29, 5, NULL, NULL),
(1084, 103, 3, 16, 30, 4, NULL, NULL),
(1085, 103, 3, 16, 31, 4, NULL, NULL),
(1086, 103, 3, 16, 32, 3, NULL, NULL),
(1087, 103, 3, 16, 33, 4, NULL, NULL),
(1088, 103, 3, 16, 34, 5, NULL, NULL),
(1089, 103, 15, 16, 1, 3, NULL, NULL),
(1090, 103, 15, 16, 2, 4, NULL, NULL),
(1091, 103, 15, 16, 3, 5, NULL, NULL),
(1092, 103, 15, 16, 4, 4, NULL, NULL),
(1093, 103, 15, 16, 5, 4, NULL, NULL),
(1094, 103, 15, 16, 6, 3, NULL, NULL),
(1095, 103, 15, 16, 7, 4, NULL, NULL),
(1096, 103, 15, 16, 8, 5, NULL, NULL),
(1097, 103, 15, 16, 9, 4, NULL, NULL),
(1098, 103, 15, 16, 10, 3, NULL, NULL),
(1099, 103, 15, 16, 11, 4, NULL, NULL),
(1100, 103, 15, 16, 12, 5, NULL, NULL),
(1101, 103, 15, 16, 13, 4, NULL, NULL),
(1102, 103, 15, 16, 14, 4, NULL, NULL),
(1103, 103, 15, 16, 15, 3, NULL, NULL),
(1104, 103, 15, 16, 16, 4, NULL, NULL),
(1105, 103, 15, 16, 17, 5, NULL, NULL),
(1106, 103, 15, 16, 18, 4, NULL, NULL),
(1107, 103, 15, 16, 19, 3, NULL, NULL),
(1108, 103, 15, 16, 20, 4, NULL, NULL),
(1109, 103, 15, 16, 21, 5, NULL, NULL),
(1110, 103, 15, 16, 22, 4, NULL, NULL),
(1111, 103, 15, 16, 23, 5, NULL, NULL),
(1112, 103, 15, 16, 24, 4, NULL, NULL),
(1113, 103, 15, 16, 25, 5, NULL, NULL),
(1114, 103, 15, 16, 26, 4, NULL, NULL),
(1115, 103, 15, 16, 27, 4, NULL, NULL),
(1116, 103, 15, 16, 28, 5, NULL, NULL),
(1117, 103, 15, 16, 29, 5, NULL, NULL),
(1118, 103, 15, 16, 30, 4, NULL, NULL),
(1119, 103, 15, 16, 31, 5, NULL, NULL),
(1120, 103, 15, 16, 32, 4, NULL, NULL),
(1121, 103, 15, 16, 33, 3, NULL, NULL),
(1122, 103, 15, 16, 34, 4, NULL, NULL),
(1123, 103, 3, 17, 1, 4, NULL, NULL),
(1124, 103, 3, 17, 2, 4, NULL, NULL),
(1125, 103, 3, 17, 3, 4, NULL, NULL),
(1126, 103, 3, 17, 4, 2, NULL, NULL),
(1127, 103, 3, 17, 5, 4, NULL, NULL),
(1128, 103, 3, 17, 6, 5, NULL, NULL),
(1129, 103, 3, 17, 7, 4, NULL, NULL),
(1130, 103, 3, 17, 8, 3, NULL, NULL),
(1131, 103, 3, 17, 9, 4, NULL, NULL),
(1132, 103, 3, 17, 10, 4, NULL, NULL),
(1133, 103, 3, 17, 11, 5, NULL, NULL),
(1134, 103, 3, 17, 12, 4, NULL, NULL),
(1135, 103, 3, 17, 13, 3, NULL, NULL),
(1136, 103, 3, 17, 14, 4, NULL, NULL),
(1137, 103, 3, 17, 15, 5, NULL, NULL),
(1138, 103, 3, 17, 16, 4, NULL, NULL),
(1139, 103, 3, 17, 17, 4, NULL, NULL),
(1140, 103, 3, 17, 18, 3, NULL, NULL),
(1141, 103, 3, 17, 19, 4, NULL, NULL),
(1142, 103, 3, 17, 20, 5, NULL, NULL),
(1143, 103, 3, 17, 21, 4, NULL, NULL),
(1144, 103, 3, 17, 22, 4, NULL, NULL),
(1145, 103, 3, 17, 23, 5, NULL, NULL),
(1146, 103, 3, 17, 24, 4, NULL, NULL),
(1147, 103, 3, 17, 25, 3, NULL, NULL),
(1148, 103, 3, 17, 26, 3, NULL, NULL),
(1149, 103, 3, 17, 27, 4, NULL, NULL),
(1150, 103, 3, 17, 28, 5, NULL, NULL),
(1151, 103, 3, 17, 29, 4, NULL, NULL),
(1152, 103, 3, 17, 30, 4, NULL, NULL),
(1153, 103, 3, 17, 31, 5, NULL, NULL),
(1154, 103, 3, 17, 32, 4, NULL, NULL),
(1155, 103, 3, 17, 33, 5, NULL, NULL),
(1156, 103, 3, 17, 34, 5, NULL, NULL),
(1157, 103, 15, 17, 1, 2, NULL, NULL),
(1158, 103, 15, 17, 2, 3, NULL, NULL),
(1159, 103, 15, 17, 3, 4, NULL, NULL),
(1160, 103, 15, 17, 4, 5, NULL, NULL),
(1161, 103, 15, 17, 5, 4, NULL, NULL),
(1162, 103, 15, 17, 6, 3, NULL, NULL),
(1163, 103, 15, 17, 7, 3, NULL, NULL),
(1164, 103, 15, 17, 8, 3, NULL, NULL),
(1165, 103, 15, 17, 9, 4, NULL, NULL),
(1166, 103, 15, 17, 10, 5, NULL, NULL),
(1167, 103, 15, 17, 11, 4, NULL, NULL),
(1168, 103, 15, 17, 12, 3, NULL, NULL),
(1169, 103, 15, 17, 13, 4, NULL, NULL),
(1170, 103, 15, 17, 14, 5, NULL, NULL),
(1171, 103, 15, 17, 15, 4, NULL, NULL),
(1172, 103, 15, 17, 16, 4, NULL, NULL),
(1173, 103, 15, 17, 17, 3, NULL, NULL),
(1174, 103, 15, 17, 18, 4, NULL, NULL),
(1175, 103, 15, 17, 19, 4, NULL, NULL),
(1176, 103, 15, 17, 20, 4, NULL, NULL),
(1177, 103, 15, 17, 21, 5, NULL, NULL),
(1178, 103, 15, 17, 22, 4, NULL, NULL),
(1179, 103, 15, 17, 23, 4, NULL, NULL),
(1180, 103, 15, 17, 24, 5, NULL, NULL),
(1181, 103, 15, 17, 25, 4, NULL, NULL),
(1182, 103, 15, 17, 26, 4, NULL, NULL),
(1183, 103, 15, 17, 27, 5, NULL, NULL),
(1184, 103, 15, 17, 28, 5, NULL, NULL),
(1185, 103, 15, 17, 29, 4, NULL, NULL),
(1186, 103, 15, 17, 30, 5, NULL, NULL),
(1187, 103, 15, 17, 31, 4, NULL, NULL),
(1188, 103, 15, 17, 32, 5, NULL, NULL),
(1189, 103, 15, 17, 33, 5, NULL, NULL),
(1190, 103, 15, 17, 34, 5, NULL, NULL),
(1191, 103, 16, 17, 1, 3, NULL, NULL),
(1192, 103, 16, 17, 2, 4, NULL, NULL),
(1193, 103, 16, 17, 3, 4, NULL, NULL),
(1194, 103, 16, 17, 4, 4, NULL, NULL),
(1195, 103, 16, 17, 5, 3, NULL, NULL),
(1196, 103, 16, 17, 6, 4, NULL, NULL),
(1197, 103, 16, 17, 7, 4, NULL, NULL),
(1198, 103, 16, 17, 8, 3, NULL, NULL),
(1199, 103, 16, 17, 9, 4, NULL, NULL),
(1200, 103, 16, 17, 10, 5, NULL, NULL),
(1201, 103, 16, 17, 11, 4, NULL, NULL),
(1202, 103, 16, 17, 12, 3, NULL, NULL),
(1203, 103, 16, 17, 13, 4, NULL, NULL),
(1204, 103, 16, 17, 14, 5, NULL, NULL),
(1205, 103, 16, 17, 15, 4, NULL, NULL),
(1206, 103, 16, 17, 16, 4, NULL, NULL),
(1207, 103, 16, 17, 17, 5, NULL, NULL),
(1208, 103, 16, 17, 18, 4, NULL, NULL),
(1209, 103, 16, 17, 19, 5, NULL, NULL),
(1210, 103, 16, 17, 20, 5, NULL, NULL),
(1211, 103, 16, 17, 21, 4, NULL, NULL),
(1212, 103, 16, 17, 22, 3, NULL, NULL),
(1213, 103, 16, 17, 23, 4, NULL, NULL),
(1214, 103, 16, 17, 24, 5, NULL, NULL),
(1215, 103, 16, 17, 25, 4, NULL, NULL),
(1216, 103, 16, 17, 26, 4, NULL, NULL),
(1217, 103, 16, 17, 27, 5, NULL, NULL),
(1218, 103, 16, 17, 28, 4, NULL, NULL),
(1219, 103, 16, 17, 29, 3, NULL, NULL),
(1220, 103, 16, 17, 30, 4, NULL, NULL),
(1221, 103, 16, 17, 31, 5, NULL, NULL),
(1222, 103, 16, 17, 32, 4, NULL, NULL),
(1223, 103, 16, 17, 33, 4, NULL, NULL),
(1224, 103, 16, 17, 34, 5, NULL, NULL),
(1225, 103, 3, 18, 1, 3, NULL, NULL),
(1226, 103, 3, 18, 2, 3, NULL, NULL),
(1227, 103, 3, 18, 3, 4, NULL, NULL),
(1228, 103, 3, 18, 4, 4, NULL, NULL),
(1229, 103, 3, 18, 5, 4, NULL, NULL),
(1230, 103, 3, 18, 6, 5, NULL, NULL),
(1231, 103, 3, 18, 7, 5, NULL, NULL),
(1232, 103, 3, 18, 8, 4, NULL, NULL),
(1233, 103, 3, 18, 9, 4, NULL, NULL),
(1234, 103, 3, 18, 10, 5, NULL, NULL),
(1235, 103, 3, 18, 11, 5, NULL, NULL),
(1236, 103, 3, 18, 12, 4, NULL, NULL),
(1237, 103, 3, 18, 13, 3, NULL, NULL),
(1238, 103, 3, 18, 14, 4, NULL, NULL),
(1239, 103, 3, 18, 15, 5, NULL, NULL),
(1240, 103, 3, 18, 16, 5, NULL, NULL),
(1241, 103, 3, 18, 17, 5, NULL, NULL),
(1242, 103, 3, 18, 18, 4, NULL, NULL),
(1243, 103, 3, 18, 19, 3, NULL, NULL),
(1244, 103, 3, 18, 20, 4, NULL, NULL),
(1245, 103, 3, 18, 21, 4, NULL, NULL),
(1246, 103, 3, 18, 22, 4, NULL, NULL),
(1247, 103, 3, 18, 23, 5, NULL, NULL),
(1248, 103, 3, 18, 24, 5, NULL, NULL),
(1249, 103, 3, 18, 25, 4, NULL, NULL),
(1250, 103, 3, 18, 26, 4, NULL, NULL),
(1251, 103, 3, 18, 27, 5, NULL, NULL),
(1252, 103, 3, 18, 28, 5, NULL, NULL),
(1253, 103, 3, 18, 29, 4, NULL, NULL),
(1254, 103, 3, 18, 30, 5, NULL, NULL),
(1255, 103, 3, 18, 31, 5, NULL, NULL),
(1256, 103, 3, 18, 32, 5, NULL, NULL),
(1257, 103, 3, 18, 33, 4, NULL, NULL),
(1258, 103, 3, 18, 34, 5, NULL, NULL),
(1259, 103, 15, 18, 1, 4, NULL, NULL),
(1260, 103, 15, 18, 2, 4, NULL, NULL),
(1261, 103, 15, 18, 3, 3, NULL, NULL),
(1262, 103, 15, 18, 4, 3, NULL, NULL),
(1263, 103, 15, 18, 5, 3, NULL, NULL),
(1264, 103, 15, 18, 6, 3, NULL, NULL),
(1265, 103, 15, 18, 7, 4, NULL, NULL),
(1266, 103, 15, 18, 8, 4, NULL, NULL),
(1267, 103, 15, 18, 9, 3, NULL, NULL),
(1268, 103, 15, 18, 10, 3, NULL, NULL),
(1269, 103, 15, 18, 11, 4, NULL, NULL),
(1270, 103, 15, 18, 12, 5, NULL, NULL),
(1271, 103, 15, 18, 13, 4, NULL, NULL),
(1272, 103, 15, 18, 14, 3, NULL, NULL),
(1273, 103, 15, 18, 15, 3, NULL, NULL),
(1274, 103, 15, 18, 16, 4, NULL, NULL),
(1275, 103, 15, 18, 17, 5, NULL, NULL),
(1276, 103, 15, 18, 18, 4, NULL, NULL),
(1277, 103, 15, 18, 19, 3, NULL, NULL),
(1278, 103, 15, 18, 20, 4, NULL, NULL),
(1279, 103, 15, 18, 21, 5, NULL, NULL),
(1280, 103, 15, 18, 22, 5, NULL, NULL),
(1281, 103, 15, 18, 23, 3, NULL, NULL),
(1282, 103, 15, 18, 24, 4, NULL, NULL),
(1283, 103, 15, 18, 25, 3, NULL, NULL),
(1284, 103, 15, 18, 26, 4, NULL, NULL),
(1285, 103, 15, 18, 27, 5, NULL, NULL),
(1286, 103, 15, 18, 28, 4, NULL, NULL),
(1287, 103, 15, 18, 29, 3, NULL, NULL),
(1288, 103, 15, 18, 30, 4, NULL, NULL),
(1289, 103, 15, 18, 31, 5, NULL, NULL),
(1290, 103, 15, 18, 32, 4, NULL, NULL),
(1291, 103, 15, 18, 33, 3, NULL, NULL),
(1292, 103, 15, 18, 34, 4, NULL, NULL),
(1293, 103, 16, 18, 1, 1, NULL, NULL),
(1294, 103, 16, 18, 2, 2, NULL, NULL),
(1295, 103, 16, 18, 3, 3, NULL, NULL),
(1296, 103, 16, 18, 4, 4, NULL, NULL),
(1297, 103, 16, 18, 5, 4, NULL, NULL),
(1298, 103, 16, 18, 6, 3, NULL, NULL),
(1299, 103, 16, 18, 7, 2, NULL, NULL),
(1300, 103, 16, 18, 8, 1, NULL, NULL),
(1301, 103, 16, 18, 9, 2, NULL, NULL),
(1302, 103, 16, 18, 10, 3, NULL, NULL),
(1303, 103, 16, 18, 11, 4, NULL, NULL),
(1304, 103, 16, 18, 12, 4, NULL, NULL),
(1305, 103, 16, 18, 13, 4, NULL, NULL),
(1306, 103, 16, 18, 14, 3, NULL, NULL),
(1307, 103, 16, 18, 15, 4, NULL, NULL),
(1308, 103, 16, 18, 16, 4, NULL, NULL),
(1309, 103, 16, 18, 17, 5, NULL, NULL),
(1310, 103, 16, 18, 18, 4, NULL, NULL),
(1311, 103, 16, 18, 19, 3, NULL, NULL),
(1312, 103, 16, 18, 20, 4, NULL, NULL),
(1313, 103, 16, 18, 21, 5, NULL, NULL),
(1314, 103, 16, 18, 22, 5, NULL, NULL),
(1315, 103, 16, 18, 23, 4, NULL, NULL),
(1316, 103, 16, 18, 24, 3, NULL, NULL),
(1317, 103, 16, 18, 25, 3, NULL, NULL),
(1318, 103, 16, 18, 26, 4, NULL, NULL),
(1319, 103, 16, 18, 27, 5, NULL, NULL),
(1320, 103, 16, 18, 28, 5, NULL, NULL),
(1321, 103, 16, 18, 29, 4, NULL, NULL),
(1322, 103, 16, 18, 30, 3, NULL, NULL),
(1323, 103, 16, 18, 31, 4, NULL, NULL),
(1324, 103, 16, 18, 32, 5, NULL, NULL),
(1325, 103, 16, 18, 33, 5, NULL, NULL),
(1326, 103, 16, 18, 34, 5, NULL, NULL),
(1327, 103, 3, 19, 1, 4, NULL, NULL),
(1328, 103, 3, 19, 2, 4, NULL, NULL),
(1329, 103, 3, 19, 3, 5, NULL, NULL),
(1330, 103, 3, 19, 4, 5, NULL, NULL),
(1331, 103, 3, 19, 5, 5, NULL, NULL),
(1332, 103, 3, 19, 6, 5, NULL, NULL),
(1333, 103, 3, 19, 7, 5, NULL, NULL),
(1334, 103, 3, 19, 8, 4, NULL, NULL),
(1335, 103, 3, 19, 9, 5, NULL, NULL),
(1336, 103, 3, 19, 10, 5, NULL, NULL),
(1337, 103, 3, 19, 11, 5, NULL, NULL),
(1338, 103, 3, 19, 12, 5, NULL, NULL),
(1339, 103, 3, 19, 13, 5, NULL, NULL),
(1340, 103, 3, 19, 14, 5, NULL, NULL),
(1341, 103, 3, 19, 15, 5, NULL, NULL),
(1342, 103, 3, 19, 16, 5, NULL, NULL),
(1343, 103, 3, 19, 17, 5, NULL, NULL),
(1344, 103, 3, 19, 18, 5, NULL, NULL),
(1345, 103, 3, 19, 19, 5, NULL, NULL),
(1346, 103, 3, 19, 20, 5, NULL, NULL),
(1347, 103, 3, 19, 21, 5, NULL, NULL),
(1348, 103, 3, 19, 22, 5, NULL, NULL),
(1349, 103, 3, 19, 23, 4, NULL, NULL),
(1350, 103, 3, 19, 24, 5, NULL, NULL),
(1351, 103, 3, 19, 25, 5, NULL, NULL),
(1352, 103, 3, 19, 26, 5, NULL, NULL),
(1353, 103, 3, 19, 27, 5, NULL, NULL),
(1354, 103, 3, 19, 28, 5, NULL, NULL),
(1355, 103, 3, 19, 29, 5, NULL, NULL),
(1356, 103, 3, 19, 30, 5, NULL, NULL),
(1357, 103, 3, 19, 31, 5, NULL, NULL),
(1358, 103, 3, 19, 32, 5, NULL, NULL),
(1359, 103, 3, 19, 33, 5, NULL, NULL),
(1360, 103, 3, 19, 34, 5, NULL, NULL),
(1361, 103, 15, 19, 1, 3, NULL, NULL),
(1362, 103, 15, 19, 2, 3, NULL, NULL),
(1363, 103, 15, 19, 3, 3, NULL, NULL),
(1364, 103, 15, 19, 4, 3, NULL, NULL),
(1365, 103, 15, 19, 5, 3, NULL, NULL),
(1366, 103, 15, 19, 6, 3, NULL, NULL),
(1367, 103, 15, 19, 7, 3, NULL, NULL),
(1368, 103, 15, 19, 8, 4, NULL, NULL),
(1369, 103, 15, 19, 9, 4, NULL, NULL),
(1370, 103, 15, 19, 10, 4, NULL, NULL),
(1371, 103, 15, 19, 11, 4, NULL, NULL),
(1372, 103, 15, 19, 12, 4, NULL, NULL),
(1373, 103, 15, 19, 13, 4, NULL, NULL),
(1374, 103, 15, 19, 14, 3, NULL, NULL),
(1375, 103, 15, 19, 15, 3, NULL, NULL),
(1376, 103, 15, 19, 16, 3, NULL, NULL),
(1377, 103, 15, 19, 17, 3, NULL, NULL),
(1378, 103, 15, 19, 18, 3, NULL, NULL),
(1379, 103, 15, 19, 19, 3, NULL, NULL),
(1380, 103, 15, 19, 20, 4, NULL, NULL),
(1381, 103, 15, 19, 21, 4, NULL, NULL),
(1382, 103, 15, 19, 22, 5, NULL, NULL),
(1383, 103, 15, 19, 23, 5, NULL, NULL),
(1384, 103, 15, 19, 24, 5, NULL, NULL),
(1385, 103, 15, 19, 25, 5, NULL, NULL),
(1386, 103, 15, 19, 26, 5, NULL, NULL),
(1387, 103, 15, 19, 27, 4, NULL, NULL),
(1388, 103, 15, 19, 28, 3, NULL, NULL),
(1389, 103, 15, 19, 29, 3, NULL, NULL),
(1390, 103, 15, 19, 30, 4, NULL, NULL),
(1391, 103, 15, 19, 31, 5, NULL, NULL),
(1392, 103, 15, 19, 32, 5, NULL, NULL),
(1393, 103, 15, 19, 33, 5, NULL, NULL),
(1394, 103, 15, 19, 34, 5, NULL, NULL),
(1395, 103, 16, 19, 1, 3, NULL, NULL),
(1396, 103, 16, 19, 2, 4, NULL, NULL),
(1397, 103, 16, 19, 3, 4, NULL, NULL),
(1398, 103, 16, 19, 4, 4, NULL, NULL),
(1399, 103, 16, 19, 5, 5, NULL, NULL),
(1400, 103, 16, 19, 6, 5, NULL, NULL),
(1401, 103, 16, 19, 7, 5, NULL, NULL),
(1402, 103, 16, 19, 8, 5, NULL, NULL),
(1403, 103, 16, 19, 9, 4, NULL, NULL),
(1404, 103, 16, 19, 10, 4, NULL, NULL),
(1405, 103, 16, 19, 11, 4, NULL, NULL),
(1406, 103, 16, 19, 12, 5, NULL, NULL),
(1407, 103, 16, 19, 13, 5, NULL, NULL),
(1408, 103, 16, 19, 14, 4, NULL, NULL),
(1409, 103, 16, 19, 15, 4, NULL, NULL),
(1410, 103, 16, 19, 16, 4, NULL, NULL),
(1411, 103, 16, 19, 17, 5, NULL, NULL),
(1412, 103, 16, 19, 18, 5, NULL, NULL),
(1413, 103, 16, 19, 19, 4, NULL, NULL),
(1414, 103, 16, 19, 20, 4, NULL, NULL),
(1415, 103, 16, 19, 21, 5, NULL, NULL),
(1416, 103, 16, 19, 22, 5, NULL, NULL),
(1417, 103, 16, 19, 23, 4, NULL, NULL),
(1418, 103, 16, 19, 24, 4, NULL, NULL),
(1419, 103, 16, 19, 25, 5, NULL, NULL),
(1420, 103, 16, 19, 26, 5, NULL, NULL),
(1421, 103, 16, 19, 27, 4, NULL, NULL),
(1422, 103, 16, 19, 28, 4, NULL, NULL),
(1423, 103, 16, 19, 29, 5, NULL, NULL),
(1424, 103, 16, 19, 30, 5, NULL, NULL),
(1425, 103, 16, 19, 31, 4, NULL, NULL),
(1426, 103, 16, 19, 32, 4, NULL, NULL),
(1427, 103, 16, 19, 33, 5, NULL, NULL),
(1428, 103, 16, 19, 34, 5, NULL, NULL),
(1429, 103, 19, 18, 1, 3, NULL, NULL),
(1430, 103, 19, 18, 2, 4, NULL, NULL),
(1431, 103, 19, 18, 3, 4, NULL, NULL),
(1432, 103, 19, 18, 4, 4, NULL, NULL),
(1433, 103, 19, 18, 5, 5, NULL, NULL),
(1434, 103, 19, 18, 6, 4, NULL, NULL),
(1435, 103, 19, 18, 7, 4, NULL, NULL),
(1436, 103, 19, 18, 8, 5, NULL, NULL),
(1437, 103, 19, 18, 9, 5, NULL, NULL),
(1438, 103, 19, 18, 10, 5, NULL, NULL),
(1439, 103, 19, 18, 11, 4, NULL, NULL),
(1440, 103, 19, 18, 12, 5, NULL, NULL),
(1441, 103, 19, 18, 13, 4, NULL, NULL),
(1442, 103, 19, 18, 14, 5, NULL, NULL),
(1443, 103, 19, 18, 15, 5, NULL, NULL),
(1444, 103, 19, 18, 16, 4, NULL, NULL),
(1445, 103, 19, 18, 17, 4, NULL, NULL),
(1446, 103, 19, 18, 18, 4, NULL, NULL),
(1447, 103, 19, 18, 19, 5, NULL, NULL),
(1448, 103, 19, 18, 20, 5, NULL, NULL),
(1449, 103, 19, 18, 21, 4, NULL, NULL),
(1450, 103, 19, 18, 22, 4, NULL, NULL),
(1451, 103, 19, 18, 23, 4, NULL, NULL),
(1452, 103, 19, 18, 24, 5, NULL, NULL),
(1453, 103, 19, 18, 25, 5, NULL, NULL),
(1454, 103, 19, 18, 26, 4, NULL, NULL),
(1455, 103, 19, 18, 27, 4, NULL, NULL),
(1456, 103, 19, 18, 28, 5, NULL, NULL),
(1457, 103, 19, 18, 29, 5, NULL, NULL),
(1458, 103, 19, 18, 30, 4, NULL, NULL),
(1459, 103, 19, 18, 31, 4, NULL, NULL),
(1460, 103, 19, 18, 32, 4, NULL, NULL),
(1461, 103, 19, 18, 33, 4, NULL, NULL),
(1462, 103, 19, 18, 34, 5, NULL, NULL),
(1463, 103, 19, 17, 1, 3, NULL, NULL),
(1464, 103, 19, 17, 2, 4, NULL, NULL),
(1465, 103, 19, 17, 3, 4, NULL, NULL),
(1466, 103, 19, 17, 4, 4, NULL, NULL),
(1467, 103, 19, 17, 5, 5, NULL, NULL),
(1468, 103, 19, 17, 6, 5, NULL, NULL);
INSERT INTO `peer_results` (`id`, `peer_survey_id`, `user_id`, `peer_id`, `indicator_id`, `answer`, `created_at`, `updated_at`) VALUES
(1469, 103, 19, 17, 7, 5, NULL, NULL),
(1470, 103, 19, 17, 8, 4, NULL, NULL),
(1471, 103, 19, 17, 9, 4, NULL, NULL),
(1472, 103, 19, 17, 10, 5, NULL, NULL),
(1473, 103, 19, 17, 11, 4, NULL, NULL),
(1474, 103, 19, 17, 12, 3, NULL, NULL),
(1475, 103, 19, 17, 13, 4, NULL, NULL),
(1476, 103, 19, 17, 14, 5, NULL, NULL),
(1477, 103, 19, 17, 15, 5, NULL, NULL),
(1478, 103, 19, 17, 16, 4, NULL, NULL),
(1479, 103, 19, 17, 17, 3, NULL, NULL),
(1480, 103, 19, 17, 18, 3, NULL, NULL),
(1481, 103, 19, 17, 19, 3, NULL, NULL),
(1482, 103, 19, 17, 20, 4, NULL, NULL),
(1483, 103, 19, 17, 21, 5, NULL, NULL),
(1484, 103, 19, 17, 22, 5, NULL, NULL),
(1485, 103, 19, 17, 23, 4, NULL, NULL),
(1486, 103, 19, 17, 24, 3, NULL, NULL),
(1487, 103, 19, 17, 25, 3, NULL, NULL),
(1488, 103, 19, 17, 26, 4, NULL, NULL),
(1489, 103, 19, 17, 27, 5, NULL, NULL),
(1490, 103, 19, 17, 28, 4, NULL, NULL),
(1491, 103, 19, 17, 29, 3, NULL, NULL),
(1492, 103, 19, 17, 30, 4, NULL, NULL),
(1493, 103, 19, 17, 31, 5, NULL, NULL),
(1494, 103, 19, 17, 32, 5, NULL, NULL),
(1495, 103, 19, 17, 33, 4, NULL, NULL),
(1496, 103, 19, 17, 34, 3, NULL, NULL),
(1497, 103, 17, 18, 1, 3, NULL, NULL),
(1498, 103, 17, 18, 2, 3, NULL, NULL),
(1499, 103, 17, 18, 3, 4, NULL, NULL),
(1500, 103, 17, 18, 4, 4, NULL, NULL),
(1501, 103, 17, 18, 5, 3, NULL, NULL),
(1502, 103, 17, 18, 6, 3, NULL, NULL),
(1503, 103, 17, 18, 7, 4, NULL, NULL),
(1504, 103, 17, 18, 8, 4, NULL, NULL),
(1505, 103, 17, 18, 9, 3, NULL, NULL),
(1506, 103, 17, 18, 10, 3, NULL, NULL),
(1507, 103, 17, 18, 11, 4, NULL, NULL),
(1508, 103, 17, 18, 12, 4, NULL, NULL),
(1509, 103, 17, 18, 13, 3, NULL, NULL),
(1510, 103, 17, 18, 14, 3, NULL, NULL),
(1511, 103, 17, 18, 15, 4, NULL, NULL),
(1512, 103, 17, 18, 16, 5, NULL, NULL),
(1513, 103, 17, 18, 17, 4, NULL, NULL),
(1514, 103, 17, 18, 18, 3, NULL, NULL),
(1515, 103, 17, 18, 19, 4, NULL, NULL),
(1516, 103, 17, 18, 20, 5, NULL, NULL),
(1517, 103, 17, 18, 21, 4, NULL, NULL),
(1518, 103, 17, 18, 22, 3, NULL, NULL),
(1519, 103, 17, 18, 23, 4, NULL, NULL),
(1520, 103, 17, 18, 24, 4, NULL, NULL),
(1521, 103, 17, 18, 25, 4, NULL, NULL),
(1522, 103, 17, 18, 26, 3, NULL, NULL),
(1523, 103, 17, 18, 27, 4, NULL, NULL),
(1524, 103, 17, 18, 28, 5, NULL, NULL),
(1525, 103, 17, 18, 29, 4, NULL, NULL),
(1526, 103, 17, 18, 30, 3, NULL, NULL),
(1527, 103, 17, 18, 31, 3, NULL, NULL),
(1528, 103, 17, 18, 32, 4, NULL, NULL),
(1529, 103, 17, 18, 33, 5, NULL, NULL),
(1530, 103, 17, 18, 34, 5, NULL, NULL),
(1531, 103, 17, 19, 1, 3, NULL, NULL),
(1532, 103, 17, 19, 2, 4, NULL, NULL),
(1533, 103, 17, 19, 3, 4, NULL, NULL),
(1534, 103, 17, 19, 4, 4, NULL, NULL),
(1535, 103, 17, 19, 5, 4, NULL, NULL),
(1536, 103, 17, 19, 6, 3, NULL, NULL),
(1537, 103, 17, 19, 7, 3, NULL, NULL),
(1538, 103, 17, 19, 8, 4, NULL, NULL),
(1539, 103, 17, 19, 9, 4, NULL, NULL),
(1540, 103, 17, 19, 10, 4, NULL, NULL),
(1541, 103, 17, 19, 11, 3, NULL, NULL),
(1542, 103, 17, 19, 12, 3, NULL, NULL),
(1543, 103, 17, 19, 13, 4, NULL, NULL),
(1544, 103, 17, 19, 14, 4, NULL, NULL),
(1545, 103, 17, 19, 15, 4, NULL, NULL),
(1546, 103, 17, 19, 16, 5, NULL, NULL),
(1547, 103, 17, 19, 17, 5, NULL, NULL),
(1548, 103, 17, 19, 18, 5, NULL, NULL),
(1549, 103, 17, 19, 19, 5, NULL, NULL),
(1550, 103, 17, 19, 20, 4, NULL, NULL),
(1551, 103, 17, 19, 21, 4, NULL, NULL),
(1552, 103, 17, 19, 22, 4, NULL, NULL),
(1553, 103, 17, 19, 23, 3, NULL, NULL),
(1554, 103, 17, 19, 24, 4, NULL, NULL),
(1555, 103, 17, 19, 25, 5, NULL, NULL),
(1556, 103, 17, 19, 26, 5, NULL, NULL),
(1557, 103, 17, 19, 27, 4, NULL, NULL),
(1558, 103, 17, 19, 28, 3, NULL, NULL),
(1559, 103, 17, 19, 29, 4, NULL, NULL),
(1560, 103, 17, 19, 30, 4, NULL, NULL),
(1561, 103, 17, 19, 31, 5, NULL, NULL),
(1562, 103, 17, 19, 32, 5, NULL, NULL),
(1563, 103, 17, 19, 33, 5, NULL, NULL),
(1564, 103, 17, 19, 34, 5, NULL, NULL),
(1565, 103, 18, 19, 1, 3, NULL, NULL),
(1566, 103, 18, 19, 2, 4, NULL, NULL),
(1567, 103, 18, 19, 3, 4, NULL, NULL),
(1568, 103, 18, 19, 4, 4, NULL, NULL),
(1569, 103, 18, 19, 5, 4, NULL, NULL),
(1570, 103, 18, 19, 6, 4, NULL, NULL),
(1571, 103, 18, 19, 7, 4, NULL, NULL),
(1572, 103, 18, 19, 8, 4, NULL, NULL),
(1573, 103, 18, 19, 9, 4, NULL, NULL),
(1574, 103, 18, 19, 10, 3, NULL, NULL),
(1575, 103, 18, 19, 11, 4, NULL, NULL),
(1576, 103, 18, 19, 12, 5, NULL, NULL),
(1577, 103, 18, 19, 13, 5, NULL, NULL),
(1578, 103, 18, 19, 14, 4, NULL, NULL),
(1579, 103, 18, 19, 15, 3, NULL, NULL),
(1580, 103, 18, 19, 16, 4, NULL, NULL),
(1581, 103, 18, 19, 17, 5, NULL, NULL),
(1582, 103, 18, 19, 18, 4, NULL, NULL),
(1583, 103, 18, 19, 19, 4, NULL, NULL),
(1584, 103, 18, 19, 20, 5, NULL, NULL),
(1585, 103, 18, 19, 21, 5, NULL, NULL),
(1586, 103, 18, 19, 22, 4, NULL, NULL),
(1587, 103, 18, 19, 23, 5, NULL, NULL),
(1588, 103, 18, 19, 24, 4, NULL, NULL),
(1589, 103, 18, 19, 25, 5, NULL, NULL),
(1590, 103, 18, 19, 26, 4, NULL, NULL),
(1591, 103, 18, 19, 27, 4, NULL, NULL),
(1592, 103, 18, 19, 28, 5, NULL, NULL),
(1593, 103, 18, 19, 29, 5, NULL, NULL),
(1594, 103, 18, 19, 30, 4, NULL, NULL),
(1595, 103, 18, 19, 31, 5, NULL, NULL),
(1596, 103, 18, 19, 32, 5, NULL, NULL),
(1597, 103, 18, 19, 33, 4, NULL, NULL),
(1598, 103, 18, 19, 34, 5, NULL, NULL),
(1599, 103, 18, 17, 1, 3, NULL, NULL),
(1600, 103, 18, 17, 2, 3, NULL, NULL),
(1601, 103, 18, 17, 3, 3, NULL, NULL),
(1602, 103, 18, 17, 4, 3, NULL, NULL),
(1603, 103, 18, 17, 5, 4, NULL, NULL),
(1604, 103, 18, 17, 6, 4, NULL, NULL),
(1605, 103, 18, 17, 7, 4, NULL, NULL),
(1606, 103, 18, 17, 8, 4, NULL, NULL),
(1607, 103, 18, 17, 9, 4, NULL, NULL),
(1608, 103, 18, 17, 10, 4, NULL, NULL),
(1609, 103, 18, 17, 11, 5, NULL, NULL),
(1610, 103, 18, 17, 12, 5, NULL, NULL),
(1611, 103, 18, 17, 13, 5, NULL, NULL),
(1612, 103, 18, 17, 14, 5, NULL, NULL),
(1613, 103, 18, 17, 15, 5, NULL, NULL),
(1614, 103, 18, 17, 16, 4, NULL, NULL),
(1615, 103, 18, 17, 17, 4, NULL, NULL),
(1616, 103, 18, 17, 18, 4, NULL, NULL),
(1617, 103, 18, 17, 19, 4, NULL, NULL),
(1618, 103, 18, 17, 20, 4, NULL, NULL),
(1619, 103, 18, 17, 21, 4, NULL, NULL),
(1620, 103, 18, 17, 22, 4, NULL, NULL),
(1621, 103, 18, 17, 23, 4, NULL, NULL),
(1622, 103, 18, 17, 24, 5, NULL, NULL),
(1623, 103, 18, 17, 25, 5, NULL, NULL),
(1624, 103, 18, 17, 26, 4, NULL, NULL),
(1625, 103, 18, 17, 27, 4, NULL, NULL),
(1626, 103, 18, 17, 28, 4, NULL, NULL),
(1627, 103, 18, 17, 29, 5, NULL, NULL),
(1628, 103, 18, 17, 30, 5, NULL, NULL),
(1629, 103, 18, 17, 31, 5, NULL, NULL),
(1630, 103, 18, 17, 32, 4, NULL, NULL),
(1631, 103, 18, 17, 33, 4, NULL, NULL),
(1632, 103, 18, 17, 34, 4, NULL, NULL),
(1633, 103, 17, 16, 1, 3, NULL, NULL),
(1634, 103, 17, 16, 2, 3, NULL, NULL),
(1635, 103, 17, 16, 3, 3, NULL, NULL),
(1636, 103, 17, 16, 4, 4, NULL, NULL),
(1637, 103, 17, 16, 5, 4, NULL, NULL),
(1638, 103, 17, 16, 6, 4, NULL, NULL),
(1639, 103, 17, 16, 7, 4, NULL, NULL),
(1640, 103, 17, 16, 8, 4, NULL, NULL),
(1641, 103, 17, 16, 9, 3, NULL, NULL),
(1642, 103, 17, 16, 10, 4, NULL, NULL),
(1643, 103, 17, 16, 11, 3, NULL, NULL),
(1644, 103, 17, 16, 12, 3, NULL, NULL),
(1645, 103, 17, 16, 13, 4, NULL, NULL),
(1646, 103, 17, 16, 14, 4, NULL, NULL),
(1647, 103, 17, 16, 15, 4, NULL, NULL),
(1648, 103, 17, 16, 16, 3, NULL, NULL),
(1649, 103, 17, 16, 17, 4, NULL, NULL),
(1650, 103, 17, 16, 18, 4, NULL, NULL),
(1651, 103, 17, 16, 19, 5, NULL, NULL),
(1652, 103, 17, 16, 20, 4, NULL, NULL),
(1653, 103, 17, 16, 21, 4, NULL, NULL),
(1654, 103, 17, 16, 22, 3, NULL, NULL),
(1655, 103, 17, 16, 23, 4, NULL, NULL),
(1656, 103, 17, 16, 24, 4, NULL, NULL),
(1657, 103, 17, 16, 25, 5, NULL, NULL),
(1658, 103, 17, 16, 26, 4, NULL, NULL),
(1659, 103, 17, 16, 27, 3, NULL, NULL),
(1660, 103, 17, 16, 28, 4, NULL, NULL),
(1661, 103, 17, 16, 29, 5, NULL, NULL),
(1662, 103, 17, 16, 30, 5, NULL, NULL),
(1663, 103, 17, 16, 31, 5, NULL, NULL),
(1664, 103, 17, 16, 32, 5, NULL, NULL),
(1665, 103, 17, 16, 33, 5, NULL, NULL),
(1666, 103, 17, 16, 34, 4, NULL, NULL),
(1667, 103, 18, 16, 1, 3, NULL, NULL),
(1668, 103, 18, 16, 2, 3, NULL, NULL),
(1669, 103, 18, 16, 3, 4, NULL, NULL),
(1670, 103, 18, 16, 4, 3, NULL, NULL),
(1671, 103, 18, 16, 5, 4, NULL, NULL),
(1672, 103, 18, 16, 6, 4, NULL, NULL),
(1673, 103, 18, 16, 7, 3, NULL, NULL),
(1674, 103, 18, 16, 8, 4, NULL, NULL),
(1675, 103, 18, 16, 9, 4, NULL, NULL),
(1676, 103, 18, 16, 10, 3, NULL, NULL),
(1677, 103, 18, 16, 11, 4, NULL, NULL),
(1678, 103, 18, 16, 12, 4, NULL, NULL),
(1679, 103, 18, 16, 13, 5, NULL, NULL),
(1680, 103, 18, 16, 14, 4, NULL, NULL),
(1681, 103, 18, 16, 15, 3, NULL, NULL),
(1682, 103, 18, 16, 16, 4, NULL, NULL),
(1683, 103, 18, 16, 17, 4, NULL, NULL),
(1684, 103, 18, 16, 18, 5, NULL, NULL),
(1685, 103, 18, 16, 19, 4, NULL, NULL),
(1686, 103, 18, 16, 20, 3, NULL, NULL),
(1687, 103, 18, 16, 21, 4, NULL, NULL),
(1688, 103, 18, 16, 22, 5, NULL, NULL),
(1689, 103, 18, 16, 23, 5, NULL, NULL),
(1690, 103, 18, 16, 24, 4, NULL, NULL),
(1691, 103, 18, 16, 25, 4, NULL, NULL),
(1692, 103, 18, 16, 26, 3, NULL, NULL),
(1693, 103, 18, 16, 27, 4, NULL, NULL),
(1694, 103, 18, 16, 28, 5, NULL, NULL),
(1695, 103, 18, 16, 29, 5, NULL, NULL),
(1696, 103, 18, 16, 30, 5, NULL, NULL),
(1697, 103, 18, 16, 31, 4, NULL, NULL),
(1698, 103, 18, 16, 32, 4, NULL, NULL),
(1699, 103, 18, 16, 33, 5, NULL, NULL),
(1700, 103, 18, 16, 34, 5, NULL, NULL),
(1701, 103, 19, 16, 1, 2, NULL, NULL),
(1702, 103, 19, 16, 2, 3, NULL, NULL),
(1703, 103, 19, 16, 3, 4, NULL, NULL),
(1704, 103, 19, 16, 4, 4, NULL, NULL),
(1705, 103, 19, 16, 5, 4, NULL, NULL),
(1706, 103, 19, 16, 6, 3, NULL, NULL),
(1707, 103, 19, 16, 7, 3, NULL, NULL),
(1708, 103, 19, 16, 8, 4, NULL, NULL),
(1709, 103, 19, 16, 9, 5, NULL, NULL),
(1710, 103, 19, 16, 10, 4, NULL, NULL),
(1711, 103, 19, 16, 11, 4, NULL, NULL),
(1712, 103, 19, 16, 12, 3, NULL, NULL),
(1713, 103, 19, 16, 13, 4, NULL, NULL),
(1714, 103, 19, 16, 14, 5, NULL, NULL),
(1715, 103, 19, 16, 15, 4, NULL, NULL),
(1716, 103, 19, 16, 16, 3, NULL, NULL),
(1717, 103, 19, 16, 17, 3, NULL, NULL),
(1718, 103, 19, 16, 18, 4, NULL, NULL),
(1719, 103, 19, 16, 19, 5, NULL, NULL),
(1720, 103, 19, 16, 20, 4, NULL, NULL),
(1721, 103, 19, 16, 21, 4, NULL, NULL),
(1722, 103, 19, 16, 22, 3, NULL, NULL),
(1723, 103, 19, 16, 23, 3, NULL, NULL),
(1724, 103, 19, 16, 24, 4, NULL, NULL),
(1725, 103, 19, 16, 25, 5, NULL, NULL),
(1726, 103, 19, 16, 26, 4, NULL, NULL),
(1727, 103, 19, 16, 27, 3, NULL, NULL),
(1728, 103, 19, 16, 28, 4, NULL, NULL),
(1729, 103, 19, 16, 29, 4, NULL, NULL),
(1730, 103, 19, 16, 30, 5, NULL, NULL),
(1731, 103, 19, 16, 31, 4, NULL, NULL),
(1732, 103, 19, 16, 32, 4, NULL, NULL),
(1733, 103, 19, 16, 33, 5, NULL, NULL),
(1734, 103, 19, 16, 34, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peer_surveys`
--

CREATE TABLE `peer_surveys` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL,
  `peer_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `peer_surveys`
--

INSERT INTO `peer_surveys` (`id`, `survey_id`, `peer_id`, `user_id`, `created_at`, `updated_at`) VALUES
(7, 101, 15, 2, '2016-11-15 10:22:52', '2016-11-15 10:22:52'),
(8, 101, 16, 2, '2016-11-15 10:22:53', '2016-11-15 10:22:53'),
(9, 101, 17, 2, '2016-11-15 10:22:55', '2016-11-15 10:22:55'),
(10, 101, 18, 2, '2016-11-15 10:22:56', '2016-11-15 10:22:56'),
(11, 101, 19, 2, '2016-11-15 10:22:57', '2016-11-15 10:22:57'),
(12, 101, 15, 3, '2016-11-15 10:31:38', '2016-11-15 10:31:38'),
(13, 101, 16, 3, '2016-11-15 10:31:39', '2016-11-15 10:31:39'),
(14, 101, 17, 3, '2016-11-15 10:31:41', '2016-11-15 10:31:41'),
(15, 101, 18, 3, '2016-11-15 10:31:42', '2016-11-15 10:31:42'),
(16, 101, 19, 3, '2016-11-15 10:31:43', '2016-11-15 10:31:43'),
(17, 101, 16, 15, '2016-11-15 10:34:00', '2016-11-15 10:34:00'),
(18, 101, 17, 15, '2016-11-15 10:34:01', '2016-11-15 10:34:01'),
(19, 101, 18, 15, '2016-11-15 10:34:02', '2016-11-15 10:34:02'),
(20, 101, 19, 15, '2016-11-15 10:34:03', '2016-11-15 10:34:03'),
(21, 101, 2, 15, '2016-11-15 10:34:05', '2016-11-15 10:34:05'),
(22, 101, 15, 16, '2016-11-15 10:37:27', '2016-11-15 10:37:27'),
(23, 101, 17, 16, '2016-11-15 10:37:28', '2016-11-15 10:37:28'),
(24, 101, 18, 16, '2016-11-15 10:37:29', '2016-11-15 10:37:29'),
(25, 101, 19, 16, '2016-11-15 10:37:31', '2016-11-15 10:37:31'),
(26, 101, 2, 16, '2016-11-15 10:37:32', '2016-11-15 10:37:32'),
(27, 101, 15, 17, '2016-11-15 10:41:18', '2016-11-15 10:41:18'),
(28, 101, 16, 17, '2016-11-15 10:41:19', '2016-11-15 10:41:19'),
(29, 101, 18, 17, '2016-11-15 10:41:21', '2016-11-15 10:41:21'),
(30, 101, 19, 17, '2016-11-15 10:41:22', '2016-11-15 10:41:22'),
(31, 101, 2, 17, '2016-11-15 10:41:23', '2016-11-15 10:41:23'),
(32, 101, 15, 19, '2016-11-15 10:46:17', '2016-11-15 10:46:17'),
(33, 101, 16, 19, '2016-11-15 10:46:19', '2016-11-15 10:46:19'),
(34, 101, 17, 19, '2016-11-15 10:46:20', '2016-11-15 10:46:20'),
(35, 101, 18, 19, '2016-11-15 10:46:21', '2016-11-15 10:46:21'),
(36, 101, 2, 19, '2016-11-15 10:46:23', '2016-11-15 10:46:23'),
(37, 101, 15, 18, '2016-11-15 10:56:40', '2016-11-15 10:56:40'),
(38, 101, 16, 18, '2016-11-15 10:56:42', '2016-11-15 10:56:42'),
(39, 101, 17, 18, '2016-11-15 10:56:43', '2016-11-15 10:56:43'),
(40, 101, 19, 18, '2016-11-15 10:56:44', '2016-11-15 10:56:44'),
(41, 101, 2, 18, '2016-11-15 10:56:46', '2016-11-15 10:56:46'),
(42, 103, 15, 3, '2016-11-15 12:45:37', '2016-11-15 12:45:37'),
(43, 103, 16, 3, '2016-11-15 12:45:39', '2016-11-15 12:45:39'),
(44, 103, 17, 3, '2016-11-15 12:45:40', '2016-11-15 12:45:40'),
(45, 103, 18, 3, '2016-11-15 12:45:41', '2016-11-15 12:45:41'),
(46, 103, 19, 3, '2016-11-15 12:45:43', '2016-11-15 12:45:43'),
(47, 103, 16, 15, '2016-11-15 12:47:59', '2016-11-15 12:47:59'),
(48, 103, 17, 15, '2016-11-15 12:48:00', '2016-11-15 12:48:00'),
(49, 103, 18, 15, '2016-11-15 12:48:02', '2016-11-15 12:48:02'),
(50, 103, 19, 15, '2016-11-15 12:48:03', '2016-11-15 12:48:03'),
(51, 103, 3, 15, '2016-11-15 12:48:04', '2016-11-15 12:48:04'),
(52, 103, 15, 16, '2016-11-15 12:51:22', '2016-11-15 12:51:22'),
(53, 103, 17, 16, '2016-11-15 12:51:24', '2016-11-15 12:51:24'),
(54, 103, 18, 16, '2016-11-15 12:51:25', '2016-11-15 12:51:25'),
(55, 103, 19, 16, '2016-11-15 12:51:27', '2016-11-15 12:51:27'),
(56, 103, 3, 16, '2016-11-15 12:51:28', '2016-11-15 12:51:28'),
(57, 103, 15, 19, '2016-11-15 13:04:55', '2016-11-15 13:04:55'),
(58, 103, 16, 19, '2016-11-15 13:04:57', '2016-11-15 13:04:57'),
(59, 103, 17, 19, '2016-11-15 13:04:58', '2016-11-15 13:04:58'),
(60, 103, 18, 19, '2016-11-15 13:04:59', '2016-11-15 13:04:59'),
(61, 103, 3, 19, '2016-11-15 13:05:00', '2016-11-15 13:05:00'),
(62, 103, 15, 17, '2016-11-15 13:07:56', '2016-11-15 13:07:56'),
(63, 103, 16, 17, '2016-11-15 13:07:58', '2016-11-15 13:07:58'),
(64, 103, 18, 17, '2016-11-15 13:07:59', '2016-11-15 13:07:59'),
(65, 103, 19, 17, '2016-11-15 13:08:00', '2016-11-15 13:08:00'),
(66, 103, 3, 17, '2016-11-15 13:08:01', '2016-11-15 13:08:01'),
(67, 103, 15, 18, '2016-11-15 13:09:29', '2016-11-15 13:09:29'),
(68, 103, 16, 18, '2016-11-15 13:09:30', '2016-11-15 13:09:30'),
(69, 103, 17, 18, '2016-11-15 13:09:31', '2016-11-15 13:09:31'),
(70, 103, 19, 18, '2016-11-15 13:09:32', '2016-11-15 13:09:32'),
(71, 103, 3, 18, '2016-11-15 13:09:34', '2016-11-15 13:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `answer` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `survey_id`, `user_id`, `indicator_id`, `answer`, `created_at`, `updated_at`) VALUES
(1021, 100, 2, 1, 5, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1022, 100, 2, 2, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1023, 100, 2, 3, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1024, 100, 2, 4, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1025, 100, 2, 5, 5, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1026, 100, 2, 6, 5, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1027, 100, 2, 7, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1028, 100, 2, 8, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1029, 100, 2, 9, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1030, 100, 2, 10, 5, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1031, 100, 2, 11, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1032, 100, 2, 12, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1033, 100, 2, 13, 3, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1034, 100, 2, 14, 3, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1035, 100, 2, 15, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1036, 100, 2, 16, 5, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1037, 100, 2, 17, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1038, 100, 2, 18, 3, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1039, 100, 2, 19, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1040, 100, 2, 20, 5, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1041, 100, 2, 21, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1042, 100, 2, 22, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1043, 100, 2, 23, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1044, 100, 2, 24, 5, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1045, 100, 2, 25, 5, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1046, 100, 2, 26, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1047, 100, 2, 27, 3, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1048, 100, 2, 28, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1049, 100, 2, 29, 5, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1050, 100, 2, 30, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1051, 100, 2, 31, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1052, 100, 2, 32, 4, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1053, 100, 2, 33, 5, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1054, 100, 2, 34, 5, '2016-11-15 10:01:05', '2016-11-15 10:01:05'),
(1055, 100, 15, 1, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1056, 100, 15, 2, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1057, 100, 15, 3, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1058, 100, 15, 4, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1059, 100, 15, 5, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1060, 100, 15, 6, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1061, 100, 15, 7, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1062, 100, 15, 8, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1063, 100, 15, 9, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1064, 100, 15, 10, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1065, 100, 15, 11, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1066, 100, 15, 12, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1067, 100, 15, 13, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1068, 100, 15, 14, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1069, 100, 15, 15, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1070, 100, 15, 16, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1071, 100, 15, 17, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1072, 100, 15, 18, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1073, 100, 15, 19, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1074, 100, 15, 20, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1075, 100, 15, 21, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1076, 100, 15, 22, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1077, 100, 15, 23, 3, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1078, 100, 15, 24, 3, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1079, 100, 15, 25, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1080, 100, 15, 26, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1081, 100, 15, 27, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1082, 100, 15, 28, 3, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1083, 100, 15, 29, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1084, 100, 15, 30, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1085, 100, 15, 31, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1086, 100, 15, 32, 3, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1087, 100, 15, 33, 4, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1088, 100, 15, 34, 5, '2016-11-15 10:02:29', '2016-11-15 10:02:29'),
(1089, 100, 3, 1, 3, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1090, 100, 3, 2, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1091, 100, 3, 3, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1092, 100, 3, 4, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1093, 100, 3, 5, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1094, 100, 3, 6, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1095, 100, 3, 7, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1096, 100, 3, 8, 3, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1097, 100, 3, 9, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1098, 100, 3, 10, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1099, 100, 3, 11, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1100, 100, 3, 12, 3, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1101, 100, 3, 13, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1102, 100, 3, 14, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1103, 100, 3, 15, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1104, 100, 3, 16, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1105, 100, 3, 17, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1106, 100, 3, 18, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1107, 100, 3, 19, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1108, 100, 3, 20, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1109, 100, 3, 21, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1110, 100, 3, 22, 3, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1111, 100, 3, 23, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1112, 100, 3, 24, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1113, 100, 3, 25, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1114, 100, 3, 26, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1115, 100, 3, 27, 3, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1116, 100, 3, 28, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1117, 100, 3, 29, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1118, 100, 3, 30, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1119, 100, 3, 31, 3, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1120, 100, 3, 32, 4, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1121, 100, 3, 33, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1122, 100, 3, 34, 5, '2016-11-15 10:03:43', '2016-11-15 10:03:43'),
(1123, 100, 16, 1, 3, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1124, 100, 16, 2, 3, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1125, 100, 16, 3, 3, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1126, 100, 16, 4, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1127, 100, 16, 5, 5, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1128, 100, 16, 6, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1129, 100, 16, 7, 3, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1130, 100, 16, 8, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1131, 100, 16, 9, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1132, 100, 16, 10, 5, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1133, 100, 16, 11, 5, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1134, 100, 16, 12, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1135, 100, 16, 13, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1136, 100, 16, 14, 3, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1137, 100, 16, 15, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1138, 100, 16, 16, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1139, 100, 16, 17, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1140, 100, 16, 18, 5, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1141, 100, 16, 19, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1142, 100, 16, 20, 3, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1143, 100, 16, 21, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1144, 100, 16, 22, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1145, 100, 16, 23, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1146, 100, 16, 24, 5, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1147, 100, 16, 25, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1148, 100, 16, 26, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1149, 100, 16, 27, 5, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1150, 100, 16, 28, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1151, 100, 16, 29, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1152, 100, 16, 30, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1153, 100, 16, 31, 4, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1154, 100, 16, 32, 5, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1155, 100, 16, 33, 5, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1156, 100, 16, 34, 5, '2016-11-15 10:05:04', '2016-11-15 10:05:04'),
(1157, 100, 17, 1, 3, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1158, 100, 17, 2, 3, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1159, 100, 17, 3, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1160, 100, 17, 4, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1161, 100, 17, 5, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1162, 100, 17, 6, 3, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1163, 100, 17, 7, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1164, 100, 17, 8, 5, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1165, 100, 17, 9, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1166, 100, 17, 10, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1167, 100, 17, 11, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1168, 100, 17, 12, 5, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1169, 100, 17, 13, 5, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1170, 100, 17, 14, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1171, 100, 17, 15, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1172, 100, 17, 16, 5, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1173, 100, 17, 17, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1174, 100, 17, 18, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1175, 100, 17, 19, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1176, 100, 17, 20, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1177, 100, 17, 21, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1178, 100, 17, 22, 5, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1179, 100, 17, 23, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1180, 100, 17, 24, 3, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1181, 100, 17, 25, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1182, 100, 17, 26, 5, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1183, 100, 17, 27, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1184, 100, 17, 28, 3, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1185, 100, 17, 29, 4, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1186, 100, 17, 30, 5, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1187, 100, 17, 31, 5, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1188, 100, 17, 32, 5, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1189, 100, 17, 33, 5, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1190, 100, 17, 34, 5, '2016-11-15 10:06:18', '2016-11-15 10:06:18'),
(1191, 100, 18, 1, 1, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1192, 100, 18, 2, 2, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1193, 100, 18, 3, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1194, 100, 18, 4, 4, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1195, 100, 18, 5, 5, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1196, 100, 18, 6, 4, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1197, 100, 18, 7, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1198, 100, 18, 8, 2, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1199, 100, 18, 9, 1, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1200, 100, 18, 10, 2, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1201, 100, 18, 11, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1202, 100, 18, 12, 4, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1203, 100, 18, 13, 5, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1204, 100, 18, 14, 4, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1205, 100, 18, 15, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1206, 100, 18, 16, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1207, 100, 18, 17, 4, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1208, 100, 18, 18, 5, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1209, 100, 18, 19, 4, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1210, 100, 18, 20, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1211, 100, 18, 21, 2, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1212, 100, 18, 22, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1213, 100, 18, 23, 4, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1214, 100, 18, 24, 5, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1215, 100, 18, 25, 4, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1216, 100, 18, 26, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1217, 100, 18, 27, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1218, 100, 18, 28, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1219, 100, 18, 29, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1220, 100, 18, 30, 4, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1221, 100, 18, 31, 5, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1222, 100, 18, 32, 4, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1223, 100, 18, 33, 3, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1224, 100, 18, 34, 4, '2016-11-15 10:07:41', '2016-11-15 10:07:41'),
(1225, 100, 19, 1, 1, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1226, 100, 19, 2, 2, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1227, 100, 19, 3, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1228, 100, 19, 4, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1229, 100, 19, 5, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1230, 100, 19, 6, 4, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1231, 100, 19, 7, 4, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1232, 100, 19, 8, 4, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1233, 100, 19, 9, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1234, 100, 19, 10, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1235, 100, 19, 11, 2, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1236, 100, 19, 12, 2, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1237, 100, 19, 13, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1238, 100, 19, 14, 4, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1239, 100, 19, 15, 4, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1240, 100, 19, 16, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1241, 100, 19, 17, 4, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1242, 100, 19, 18, 5, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1243, 100, 19, 19, 4, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1244, 100, 19, 20, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1245, 100, 19, 21, 2, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1246, 100, 19, 22, 1, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1247, 100, 19, 23, 2, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1248, 100, 19, 24, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1249, 100, 19, 25, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1250, 100, 19, 26, 4, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1251, 100, 19, 27, 4, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1252, 100, 19, 28, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1253, 100, 19, 29, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1254, 100, 19, 30, 4, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1255, 100, 19, 31, 4, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1256, 100, 19, 32, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1257, 100, 19, 33, 3, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1258, 100, 19, 34, 5, '2016-11-15 10:09:14', '2016-11-15 10:09:14'),
(1259, 100, 20, 1, 2, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1260, 100, 20, 2, 3, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1261, 100, 20, 3, 3, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1262, 100, 20, 4, 4, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1263, 100, 20, 5, 4, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1264, 100, 20, 6, 4, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1265, 100, 20, 7, 4, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1266, 100, 20, 8, 3, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1267, 100, 20, 9, 3, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1268, 100, 20, 10, 2, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1269, 100, 20, 11, 3, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1270, 100, 20, 12, 4, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1271, 100, 20, 13, 4, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1272, 100, 20, 14, 3, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1273, 100, 20, 15, 2, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1274, 100, 20, 16, 3, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1275, 100, 20, 17, 4, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1276, 100, 20, 18, 4, '2016-11-15 10:10:28', '2016-11-15 10:10:28'),
(1277, 100, 20, 19, 4, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1278, 100, 20, 20, 3, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1279, 100, 20, 21, 2, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1280, 100, 20, 22, 3, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1281, 100, 20, 23, 4, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1282, 100, 20, 24, 5, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1283, 100, 20, 25, 4, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1284, 100, 20, 26, 3, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1285, 100, 20, 27, 3, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1286, 100, 20, 28, 4, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1287, 100, 20, 29, 5, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1288, 100, 20, 30, 4, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1289, 100, 20, 31, 3, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1290, 100, 20, 32, 4, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1291, 100, 20, 33, 4, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1292, 100, 20, 34, 5, '2016-11-15 10:10:29', '2016-11-15 10:10:29'),
(1293, 100, 21, 1, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1294, 100, 21, 2, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1295, 100, 21, 3, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1296, 100, 21, 4, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1297, 100, 21, 5, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1298, 100, 21, 6, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1299, 100, 21, 7, 2, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1300, 100, 21, 8, 2, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1301, 100, 21, 9, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1302, 100, 21, 10, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1303, 100, 21, 11, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1304, 100, 21, 12, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1305, 100, 21, 13, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1306, 100, 21, 14, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1307, 100, 21, 15, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1308, 100, 21, 16, 2, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1309, 100, 21, 17, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1310, 100, 21, 18, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1311, 100, 21, 19, 5, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1312, 100, 21, 20, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1313, 100, 21, 21, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1314, 100, 21, 22, 2, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1315, 100, 21, 23, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1316, 100, 21, 24, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1317, 100, 21, 25, 5, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1318, 100, 21, 26, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1319, 100, 21, 27, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1320, 100, 21, 28, 2, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1321, 100, 21, 29, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1322, 100, 21, 30, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1323, 100, 21, 31, 3, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1324, 100, 21, 32, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1325, 100, 21, 33, 5, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1326, 100, 21, 34, 4, '2016-11-15 10:11:51', '2016-11-15 10:11:51'),
(1327, 100, 22, 1, 1, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1328, 100, 22, 2, 2, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1329, 100, 22, 3, 3, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1330, 100, 22, 4, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1331, 100, 22, 5, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1332, 100, 22, 6, 3, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1333, 100, 22, 7, 3, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1334, 100, 22, 8, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1335, 100, 22, 9, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1336, 100, 22, 10, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1337, 100, 22, 11, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1338, 100, 22, 12, 5, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1339, 100, 22, 13, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1340, 100, 22, 14, 3, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1341, 100, 22, 15, 2, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1342, 100, 22, 16, 3, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1343, 100, 22, 17, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1344, 100, 22, 18, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1345, 100, 22, 19, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1346, 100, 22, 20, 3, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1347, 100, 22, 21, 3, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1348, 100, 22, 22, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1349, 100, 22, 23, 5, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1350, 100, 22, 24, 5, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1351, 100, 22, 25, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1352, 100, 22, 26, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1353, 100, 22, 27, 3, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1354, 100, 22, 28, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1355, 100, 22, 29, 5, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1356, 100, 22, 30, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1357, 100, 22, 31, 3, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1358, 100, 22, 32, 4, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1359, 100, 22, 33, 5, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1360, 100, 22, 34, 5, '2016-11-15 10:13:04', '2016-11-15 10:13:04'),
(1361, 102, 3, 1, 3, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1362, 102, 3, 2, 3, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1363, 102, 3, 3, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1364, 102, 3, 4, 5, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1365, 102, 3, 5, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1366, 102, 3, 6, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1367, 102, 3, 7, 5, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1368, 102, 3, 8, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1369, 102, 3, 9, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1370, 102, 3, 10, 5, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1371, 102, 3, 11, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1372, 102, 3, 12, 3, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1373, 102, 3, 13, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1374, 102, 3, 14, 5, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1375, 102, 3, 15, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1376, 102, 3, 16, 3, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1377, 102, 3, 17, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1378, 102, 3, 18, 5, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1379, 102, 3, 19, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1380, 102, 3, 20, 3, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1381, 102, 3, 21, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1382, 102, 3, 22, 5, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1383, 102, 3, 23, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1384, 102, 3, 24, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1385, 102, 3, 25, 5, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1386, 102, 3, 26, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1387, 102, 3, 27, 3, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1388, 102, 3, 28, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1389, 102, 3, 29, 5, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1390, 102, 3, 30, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1391, 102, 3, 31, 4, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1392, 102, 3, 32, 5, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1393, 102, 3, 33, 5, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1394, 102, 3, 34, 5, '2016-11-15 12:44:49', '2016-11-15 12:44:49'),
(1395, 102, 15, 1, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1396, 102, 15, 2, 3, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1397, 102, 15, 3, 2, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1398, 102, 15, 4, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1399, 102, 15, 5, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1400, 102, 15, 6, 2, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1401, 102, 15, 7, 2, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1402, 102, 15, 8, 2, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1403, 102, 15, 9, 2, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1404, 102, 15, 10, 3, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1405, 102, 15, 11, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1406, 102, 15, 12, 5, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1407, 102, 15, 13, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1408, 102, 15, 14, 3, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1409, 102, 15, 15, 3, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1410, 102, 15, 16, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1411, 102, 15, 17, 5, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1412, 102, 15, 18, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1413, 102, 15, 19, 3, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1414, 102, 15, 20, 3, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1415, 102, 15, 21, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1416, 102, 15, 22, 5, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1417, 102, 15, 23, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1418, 102, 15, 24, 3, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1419, 102, 15, 25, 3, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1420, 102, 15, 26, 3, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1421, 102, 15, 27, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1422, 102, 15, 28, 5, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1423, 102, 15, 29, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1424, 102, 15, 30, 3, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1425, 102, 15, 31, 3, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1426, 102, 15, 32, 4, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1427, 102, 15, 33, 5, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1428, 102, 15, 34, 5, '2016-11-15 12:46:55', '2016-11-15 12:46:55'),
(1429, 102, 16, 1, 3, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1430, 102, 16, 2, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1431, 102, 16, 3, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1432, 102, 16, 4, 3, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1433, 102, 16, 5, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1434, 102, 16, 6, 3, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1435, 102, 16, 7, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1436, 102, 16, 8, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1437, 102, 16, 9, 5, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1438, 102, 16, 10, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1439, 102, 16, 11, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1440, 102, 16, 12, 3, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1441, 102, 16, 13, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1442, 102, 16, 14, 5, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1443, 102, 16, 15, 5, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1444, 102, 16, 16, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1445, 102, 16, 17, 3, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1446, 102, 16, 18, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1447, 102, 16, 19, 5, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1448, 102, 16, 20, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1449, 102, 16, 21, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1450, 102, 16, 22, 5, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1451, 102, 16, 23, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1452, 102, 16, 24, 3, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1453, 102, 16, 25, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1454, 102, 16, 26, 5, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1455, 102, 16, 27, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1456, 102, 16, 28, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1457, 102, 16, 29, 3, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1458, 102, 16, 30, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1459, 102, 16, 31, 5, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1460, 102, 16, 32, 5, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1461, 102, 16, 33, 4, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1462, 102, 16, 34, 5, '2016-11-15 12:49:24', '2016-11-15 12:49:24'),
(1463, 102, 17, 1, 2, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1464, 102, 17, 2, 3, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1465, 102, 17, 3, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1466, 102, 17, 4, 5, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1467, 102, 17, 5, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1468, 102, 17, 6, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1469, 102, 17, 7, 3, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1470, 102, 17, 8, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1471, 102, 17, 9, 5, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1472, 102, 17, 10, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1473, 102, 17, 11, 3, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1474, 102, 17, 12, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1475, 102, 17, 13, 5, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1476, 102, 17, 14, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1477, 102, 17, 15, 3, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1478, 102, 17, 16, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1479, 102, 17, 17, 5, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1480, 102, 17, 18, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1481, 102, 17, 19, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1482, 102, 17, 20, 5, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1483, 102, 17, 21, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1484, 102, 17, 22, 3, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1485, 102, 17, 23, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1486, 102, 17, 24, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1487, 102, 17, 25, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1488, 102, 17, 26, 5, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1489, 102, 17, 27, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1490, 102, 17, 28, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1491, 102, 17, 29, 3, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1492, 102, 17, 30, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1493, 102, 17, 31, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1494, 102, 17, 32, 5, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1495, 102, 17, 33, 4, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1496, 102, 17, 34, 5, '2016-11-15 12:52:35', '2016-11-15 12:52:35'),
(1497, 102, 18, 1, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1498, 102, 18, 2, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1499, 102, 18, 3, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1500, 102, 18, 4, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1501, 102, 18, 5, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1502, 102, 18, 6, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1503, 102, 18, 7, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1504, 102, 18, 8, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1505, 102, 18, 9, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1506, 102, 18, 10, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1507, 102, 18, 11, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1508, 102, 18, 12, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1509, 102, 18, 13, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1510, 102, 18, 14, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1511, 102, 18, 15, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1512, 102, 18, 16, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1513, 102, 18, 17, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1514, 102, 18, 18, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1515, 102, 18, 19, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1516, 102, 18, 20, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1517, 102, 18, 21, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1518, 102, 18, 22, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1519, 102, 18, 23, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1520, 102, 18, 24, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1521, 102, 18, 25, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1522, 102, 18, 26, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1523, 102, 18, 27, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1524, 102, 18, 28, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1525, 102, 18, 29, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1526, 102, 18, 30, 4, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1527, 102, 18, 31, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1528, 102, 18, 32, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1529, 102, 18, 33, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1530, 102, 18, 34, 5, '2016-11-15 12:58:26', '2016-11-15 12:58:26'),
(1531, 102, 19, 1, 3, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1532, 102, 19, 2, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1533, 102, 19, 3, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1534, 102, 19, 4, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1535, 102, 19, 5, 5, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1536, 102, 19, 6, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1537, 102, 19, 7, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1538, 102, 19, 8, 3, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1539, 102, 19, 9, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1540, 102, 19, 10, 5, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1541, 102, 19, 11, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1542, 102, 19, 12, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1543, 102, 19, 13, 3, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1544, 102, 19, 14, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1545, 102, 19, 15, 5, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1546, 102, 19, 16, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1547, 102, 19, 17, 3, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1548, 102, 19, 18, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1549, 102, 19, 19, 5, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1550, 102, 19, 20, 5, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1551, 102, 19, 21, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1552, 102, 19, 22, 3, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1553, 102, 19, 23, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1554, 102, 19, 24, 5, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1555, 102, 19, 25, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1556, 102, 19, 26, 3, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1557, 102, 19, 27, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1558, 102, 19, 28, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1559, 102, 19, 29, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1560, 102, 19, 30, 5, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1561, 102, 19, 31, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1562, 102, 19, 32, 3, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1563, 102, 19, 33, 4, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1564, 102, 19, 34, 5, '2016-11-15 13:02:18', '2016-11-15 13:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`) VALUES
(1, 'admin', 'admin', 'An Admin role.'),
(2, 'special', 'special', 'Special user role.'),
(3, 'basic', 'basic', 'basic user role.');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3);

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_group_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `end_message` text COLLATE utf8_unicode_ci NOT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `user_id`, `type_id`, `company_id`, `category_id`, `user_group_id`, `title`, `description`, `end_message`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(100, 1, 1, 1, 1, NULL, 'self survey company scoped test 1', '<p>self survey</p>\r\n', '<p>thank you</p>\r\n', '2016-11-15 12:00:00', '2016-11-25 18:59:00', '2016-11-15 09:55:05', '2016-11-15 09:55:05'),
(101, 1, 2, 1, 1, NULL, 'peer survey company scoped test 1', '<p>peer survey</p>\r\n', '<p>thank you</p>\r\n', '2016-11-15 12:00:00', '2016-11-25 18:59:00', '2016-11-15 09:55:59', '2016-11-15 09:56:54'),
(102, 2, 1, 1, 2, 19, 'self survey group scoped test 1', '<p>self survey</p>\r\n', '<p>thank you</p>\r\n', '2016-11-15 14:00:00', '2016-11-25 18:59:00', '2016-11-15 12:38:46', '2016-11-15 12:38:46'),
(103, 2, 2, 1, 2, 19, 'peer survey group scoped test 1', '<p>peer survey</p>\r\n', '<p>thank you</p>\r\n', '2016-11-15 14:00:00', '2016-11-25 18:59:00', '2016-11-15 12:40:59', '2016-11-15 12:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `survey_categories`
--

CREATE TABLE `survey_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `survey_categories`
--

INSERT INTO `survey_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Company Survey', '2016-09-04 18:27:04', '2016-09-04 18:27:04'),
(2, 'Group Survey', '2016-09-04 18:27:04', '2016-09-04 18:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `survey_types`
--

CREATE TABLE `survey_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `survey_types`
--

INSERT INTO `survey_types` (`id`, `name`) VALUES
(2, 'peer survey'),
(1, 'self survey');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `company_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@fincoda.com', 1, '$2y$10$aDPsBeCSx/hcyUEa82kXOeBJj6kR.H.6jougBIdWwuGXUIBzcbSw.', 'eciqjxSX9Y1rhH6XFexNXSrugNPMvJCiDN7Pi1KChl363D9pCyiKyi0Swfpx', '2016-09-04 18:24:58', '2016-11-16 13:28:18'),
(2, 'special', 'special@fincoda.com', 1, '$2y$10$XEkBB9aQOSUsnZnbvtIU/eFpxWuzc3g.xN/Va5QGt5FWbJSh7P0vW', '5RjtYNERxMRh3OSSQigXrejbhU5cwxldehVoOu6bnqAfQdGjjZS5hYcFCEUt', '2016-09-04 18:24:59', '2016-11-16 13:28:02'),
(3, 'basic', 'basic@fincoda.com', 1, '$2y$10$VJ1.j0X2Ns2gXUHhBs5Ob.orTIrsug85qCSQd36tvzfababDw9OdS', '1eGHJZ8MfiQpBDnZTqfyfByvRBlvvaHyBaITxo9hmzExqAAn3VRoILxckoWP', '2016-09-04 18:24:59', '2016-11-16 10:26:20'),
(15, 'dav', 'dav1@yahoo.com', 1, '$2y$10$c8oZ.5Hw3vrz4Rj/2DlcXOtOEzbKseMrNGNZyezlztWUpEXQx4F3m', 'meENIAHuoMBVypeGrpIYOnsmY5DkiTQ2UKoFokzddn8H4KzaocfMy9eaZEQh', '2016-11-15 09:31:48', '2016-11-15 12:48:25'),
(16, 'dav', 'dav2@yahoo.coms', 1, '$2y$10$8ssO4p4nWZN/zkog31bWt.5gkarkW6XQrXiCuVuSXkiW08ngC2M1W', 'S5fUBq4gO4L4TJ2FMM3kpEecVnzVHTjrIFqUtSreOFZx7GITLVgdic2GBpUF', '2016-11-15 09:32:40', '2016-11-15 13:26:12'),
(17, 'dav', 'dav3@yahoo.coms', 1, '$2y$10$PBZPCwtbEUqXmQeeyKWQ8.AzVrAZuEocNPfaaSJl504ySykwRy1dq', 'n4haYWEwdmgYkBBZrRWFjKiUEIDRPrSH7rXb6SPYF5DNayfMq9JoRYRo7SHf', '2016-11-15 09:33:15', '2016-11-15 22:09:01'),
(18, 'dav', 'dav4@yahoo.coms', 1, '$2y$10$XEdiSkvjJFYlFFhCMv7tYOtBKkuhDauIPKfcDHIBcui9g29JYqiJO', 'LvtYkmarpNUyKNwFJEZl9j8OouGcsiyBM8L3IB8ixlomlRCIE11olU2k0WJk', '2016-11-15 09:33:44', '2016-11-15 13:23:10'),
(19, 'dav', 'dav5@yahoo.coms', 1, '$2y$10$.zHdXynhWlde9hSDKHiJjegBUNnJCKwOMTV1PEVrXQaM3gg82owTm', '367yslYw9x1lMU3tCyrkqWn8aJiloG6VwuIYL0JShLhYpLyMcVMqwETrHx2H', '2016-11-15 09:34:04', '2016-11-15 13:20:41'),
(20, 'dav', 'dav6@yahoo.coms', 1, '$2y$10$KWrb57lTkGO1zmGXIVLOneRGTZX5QJgClcOkJ35dvWjt.ENhUAHOK', 'FKgKu2xtjJpeYipnpyHLqkNJdQTvXmd4v7WLgE6TWfdRSwHPdTTUlO5ZonWR', '2016-11-15 09:34:33', '2016-11-15 10:10:49'),
(21, 'dav', 'dav7@yahoo.coms', 1, '$2y$10$hoDB8JLvKK23bGfWsJNY.eK.bfee3fcfBQan0RaQp.Jc8KTkzRwvC', 'Jw5a4Ng5gaBv1N38QTfOav9tXguU18unnqqhJi8LhWoFAde13EM80aAVo6y3', '2016-11-15 09:35:04', '2016-11-15 10:12:08'),
(22, 'dav', 'dav8@yahoo.coms', 1, '$2y$10$RhAv.7VBId8UMVguzTqGQ.KzMEhcBwICHGDekC/NYpvBTGE5yx8x.', '9cwXpaGYiLBcc8Esj9dgZ18LT8JJP7KkztlmJIlltBdkv1BC4XXnFOXvQHz0', '2016-11-15 09:35:39', '2016-11-15 10:13:50'),
(23, 'dav', 'dav9@yahoo.coms', 1, '$2y$10$jocVMuYLutwmoBjttRYYCOifIQGhOT0wTPtsgBuy.h5gDe4DUtSAm', '2VpuVfBEwGKf1gX7fBn5ijTm4jRz5M5q64FpnwLrM8Bkp2j4uMfo1tloD7Vg', '2016-11-15 09:36:08', '2016-11-15 12:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `administrator` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `description`, `company_id`, `created_by`, `administrator`, `created_at`, `updated_at`) VALUES
(19, 'special', '<p>special</p>\r\n', 1, 1, 2, '2016-11-15 12:37:46', '2016-11-15 12:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_in_groups`
--

CREATE TABLE `user_in_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_group_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_in_groups`
--

INSERT INTO `user_in_groups` (`id`, `user_id`, `user_group_id`, `created_at`, `updated_at`) VALUES
(79, 15, 19, '2016-11-15 12:37:46', '2016-11-15 12:37:46'),
(80, 16, 19, '2016-11-15 12:37:46', '2016-11-15 12:37:46'),
(81, 17, 19, '2016-11-15 12:37:46', '2016-11-15 12:37:46'),
(82, 18, 19, '2016-11-15 12:37:46', '2016-11-15 12:37:46'),
(83, 19, 19, '2016-11-15 12:37:46', '2016-11-15 12:37:46'),
(84, 3, 19, '2016-11-15 12:37:46', '2016-11-15 12:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `hired_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `gender`, `dob`, `country`, `city`, `street`, `phone`, `hired_date`, `created_at`, `updated_at`) VALUES
(15, 15, 'male', '0000-00-00', 'Ascension Island', '', '', 0, '0000-00-00', '2016-11-15 09:31:48', '2016-11-15 09:38:18'),
(16, 16, '', '0000-00-00', '', '', '', 0, '0000-00-00', '2016-11-15 09:32:40', '2016-11-15 09:32:40'),
(17, 17, '', '0000-00-00', '', '', '', 0, '0000-00-00', '2016-11-15 09:33:15', '2016-11-15 09:33:15'),
(18, 18, '', '0000-00-00', '', '', '', 0, '0000-00-00', '2016-11-15 09:33:44', '2016-11-15 09:33:44'),
(19, 19, '', '0000-00-00', '', '', '', 0, '0000-00-00', '2016-11-15 09:34:04', '2016-11-15 09:34:04'),
(20, 20, '', '0000-00-00', '', '', '', 0, '0000-00-00', '2016-11-15 09:34:33', '2016-11-15 09:34:33'),
(21, 21, '', '0000-00-00', '', '', '', 0, '0000-00-00', '2016-11-15 09:35:04', '2016-11-15 09:35:04'),
(22, 22, '', '0000-00-00', '', '', '', 0, '0000-00-00', '2016-11-15 09:35:39', '2016-11-15 09:35:39'),
(23, 23, '', '0000-00-00', '', '', '', 0, '0000-00-00', '2016-11-15 09:36:09', '2016-11-15 09:36:09'),
(25, 1, 'male', '0000-00-00', 'Ascension Island', '', '', 0, '0000-00-00', '2016-11-15 09:31:48', '2016-11-15 09:38:18'),
(26, 2, 'male', '0000-00-00', 'Ascension Island', '', '', 0, '0000-00-00', '2016-11-15 09:31:48', '2016-11-15 09:38:18'),
(27, 3, 'male', '0000-00-00', 'Ascension Island', '', '', 0, '0000-00-00', '2016-11-15 09:31:48', '2016-11-15 09:38:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_company_code_unique` (`company_code`),
  ADD UNIQUE KEY `companies_slug_unique` (`slug`);

--
-- Indexes for table `company_profiles`
--
ALTER TABLE `company_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_profiles_company_id_foreign` (`company_id`);

--
-- Indexes for table `indicators`
--
ALTER TABLE `indicators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indicators_indicator_unique` (`indicator`),
  ADD KEY `indicators_group_id_foreign` (`group_id`);

--
-- Indexes for table `indicator_groups`
--
ALTER TABLE `indicator_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participants_survey_id_index` (`survey_id`),
  ADD KEY `participants_user_id_index` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `peer_results`
--
ALTER TABLE `peer_results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peer_survey_id` (`peer_survey_id`,`user_id`,`peer_id`,`indicator_id`),
  ADD KEY `peer_results_peer_survey_id_foreign` (`peer_survey_id`),
  ADD KEY `peer_results_indicator_id_foreign` (`indicator_id`),
  ADD KEY `peer_results_user_id_fk` (`user_id`),
  ADD KEY `peer_results_peer_id_fk` (`peer_id`);

--
-- Indexes for table `peer_surveys`
--
ALTER TABLE `peer_surveys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `survey_id` (`survey_id`,`peer_id`,`user_id`),
  ADD KEY `peer_surveys_survey_id_foreign` (`survey_id`),
  ADD KEY `peer_surveys_peer_id_foreign` (`peer_id`),
  ADD KEY `peer_surveys_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `results_survey_id_foreign` (`survey_id`),
  ADD KEY `results_indicator_id_foreign` (`indicator_id`),
  ADD KEY `results_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surveys_user_id_foreign` (`user_id`),
  ADD KEY `surveys_type_id_foreign` (`type_id`),
  ADD KEY `surveys_company_id_foreign` (`company_id`),
  ADD KEY `surveys_category_id_foreign` (`category_id`),
  ADD KEY `surveys_user_groups_fk` (`user_group_id`);

--
-- Indexes for table `survey_categories`
--
ALTER TABLE `survey_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_types`
--
ALTER TABLE `survey_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `survey_types_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_groups_company_id_foreign` (`company_id`),
  ADD KEY `user_groups_created_by_foreign` (`created_by`),
  ADD KEY `user_groups_administrator_foreign` (`administrator`);

--
-- Indexes for table `user_in_groups`
--
ALTER TABLE `user_in_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_group_id` (`user_id`,`user_group_id`),
  ADD KEY `user_in_groups_user_id_foreign` (`user_id`),
  ADD KEY `user_in_groups_user_group_id_foreign` (`user_group_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `company_profiles`
--
ALTER TABLE `company_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `indicators`
--
ALTER TABLE `indicators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `indicator_groups`
--
ALTER TABLE `indicator_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `peer_results`
--
ALTER TABLE `peer_results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1735;
--
-- AUTO_INCREMENT for table `peer_surveys`
--
ALTER TABLE `peer_surveys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1565;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `survey_categories`
--
ALTER TABLE `survey_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `survey_types`
--
ALTER TABLE `survey_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user_in_groups`
--
ALTER TABLE `user_in_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_profiles`
--
ALTER TABLE `company_profiles`
  ADD CONSTRAINT `company_profiles_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `indicators`
--
ALTER TABLE `indicators`
  ADD CONSTRAINT `indicators_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `indicator_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peer_results`
--
ALTER TABLE `peer_results`
  ADD CONSTRAINT `peer_results_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peer_results_peer_id_fk` FOREIGN KEY (`peer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `peer_results_survey_id_fk` FOREIGN KEY (`peer_survey_id`) REFERENCES `surveys` (`id`),
  ADD CONSTRAINT `peer_results_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `peer_surveys`
--
ALTER TABLE `peer_surveys`
  ADD CONSTRAINT `peer_surveys_peer_id_foreign` FOREIGN KEY (`peer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peer_surveys_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peer_surveys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `survey_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surveys_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `surveys_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `survey_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surveys_user_groups_fk` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`),
  ADD CONSTRAINT `surveys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD CONSTRAINT `user_groups_administrator_foreign` FOREIGN KEY (`administrator`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_groups_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `user_groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_in_groups`
--
ALTER TABLE `user_in_groups`
  ADD CONSTRAINT `user_in_groups_user_group_id_foreign` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`),
  ADD CONSTRAINT `user_in_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
