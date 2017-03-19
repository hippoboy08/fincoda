-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2017 at 05:23 AM
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
  `name` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `company_code` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `slug` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `company_code`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Fincoda Corporation', 'FINCODA_skdjfksjd123', 'fincoda_corporation', '2016-09-04 18:23:54', '2016-10-05 17:57:01'),
(5, 'test company', 'TEST_esR75vvwyqE7', 'test_company', '2016-12-01 18:19:25', '2016-12-01 18:19:25'),
(7, 'test companys', 'TEST_GkBaXtIa6rDJ', 'test_companys', '2016-12-01 18:48:11', '2016-12-01 18:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `company_profiles`
--

CREATE TABLE `company_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `type` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `street` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `postcode` int(11) NOT NULL,
  `time_zone` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_profiles`
--

INSERT INTO `company_profiles` (`id`, `company_id`, `type`, `country`, `city`, `street`, `email`, `phone`, `postcode`, `time_zone`, `created_at`, `updated_at`) VALUES
(1, 1, 'education', 'Ascension Island', 'Turku', 'joukahaisenkatu', 'fincoda@corporation.com', 234556678, 20567, 'Europe/Helsinki', '2016-09-04 18:24:33', '2016-11-14 10:59:10'),
(5, 5, 'education', 'Finland', 'ny', '20 safe drive', '', 2147483647, 0, 'America/St_Thomas', '2016-12-01 18:19:25', '2016-12-01 18:19:25'),
(6, 7, 'education', 'Finland', 'ny', '20 safe drive', '', 2147483647, 0, 'Europe/Helsinki', '2016-12-01 18:48:11', '2016-12-01 18:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `external_evaluators`
--

CREATE TABLE `external_evaluators` (
  `id` int(10) UNSIGNED NOT NULL,
  `invited_by_user_id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL,
  `email` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `name` char(30) COLLATE utf8_unicode_ci NOT NULL
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
(38, 102, 17, 0, 1, '2016-11-15 12:38:49', '2016-11-15 12:52:35'),
(39, 102, 18, 0, 1, '2016-11-15 12:38:50', '2016-11-15 12:58:26'),
(40, 102, 19, 0, 1, '2016-11-15 12:38:51', '2016-11-15 13:02:18'),
(41, 102, 3, 0, 1, '2016-11-15 12:38:52', '2016-11-15 12:44:49'),
(42, 102, 15, 0, 1, NULL, '2016-11-15 12:46:55'),
(43, 102, 16, 0, 1, NULL, '2016-11-15 12:49:24'),
(71, 106, 2, 0, 0, '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(72, 106, 3, 0, 0, '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(73, 106, 15, 0, 0, '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(74, 106, 16, 0, 0, '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(75, 106, 17, 0, 0, '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(76, 106, 18, 0, 0, '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(77, 106, 19, 0, 0, '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(78, 106, 20, 0, 0, '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(79, 106, 21, 0, 0, '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(80, 106, 22, 0, 0, '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(81, 106, 23, 0, 0, '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(96, 109, 2, 0, 1, '2016-12-01 10:06:29', '2016-12-01 10:10:35'),
(97, 109, 3, 0, 1, '2016-12-01 10:06:29', '2016-12-01 10:09:04'),
(98, 109, 15, 0, 0, '2016-12-01 10:06:29', '2016-12-01 10:06:29'),
(99, 109, 16, 0, 0, '2016-12-01 10:06:29', '2016-12-01 10:06:29'),
(100, 109, 17, 0, 1, '2016-12-01 10:06:29', '2016-12-01 10:13:00'),
(101, 109, 18, 0, 0, '2016-12-01 10:06:29', '2016-12-01 10:06:29'),
(102, 109, 19, 0, 0, '2016-12-01 10:06:29', '2016-12-01 10:06:29'),
(103, 109, 20, 0, 0, '2016-12-01 10:06:29', '2016-12-01 10:06:29'),
(104, 109, 21, 0, 0, '2016-12-01 10:06:29', '2016-12-01 10:06:29'),
(105, 109, 22, 0, 0, '2016-12-01 10:06:29', '2016-12-01 10:06:29'),
(106, 109, 23, 0, 0, '2016-12-01 10:06:29', '2016-12-01 10:06:29'),
(118, 111, 15, 0, 0, '2016-12-01 12:43:42', '2016-12-01 12:43:42'),
(119, 111, 16, 0, 0, '2016-12-01 12:43:46', '2016-12-01 12:43:46'),
(120, 111, 17, 0, 1, '2016-12-01 12:43:47', '2016-12-01 12:48:28'),
(121, 111, 18, 0, 1, '2016-12-01 12:43:48', '2016-12-01 12:49:49'),
(122, 111, 19, 0, 0, '2016-12-01 12:43:49', '2016-12-01 12:43:49'),
(123, 111, 3, 0, 1, '2016-12-01 12:43:51', '2016-12-01 12:47:00'),
(124, 111, 20, 0, 0, '2016-12-01 12:43:52', '2016-12-01 12:43:52'),
(125, 111, 21, 0, 0, '2016-12-01 12:43:53', '2016-12-01 12:43:53'),
(197, 119, 2, 0, 5, '2017-01-21 10:13:22', '2017-01-21 10:48:43'),
(198, 119, 3, 0, 5, '2017-01-21 10:13:22', '2017-01-21 10:45:14'),
(199, 119, 15, 0, 0, '2017-01-21 10:13:22', '2017-01-21 10:13:22'),
(200, 119, 16, 0, 5, '2017-01-21 10:13:22', '2017-01-21 10:51:37'),
(201, 119, 17, 0, 0, '2017-01-21 10:13:22', '2017-01-21 10:13:22'),
(202, 119, 18, 0, 0, '2017-01-21 10:13:22', '2017-01-21 10:13:22'),
(203, 119, 19, 0, 3, '2017-01-21 10:13:22', '2017-01-21 10:53:25'),
(204, 119, 20, 0, 0, '2017-01-21 10:13:22', '2017-01-21 10:13:22'),
(205, 119, 21, 0, 0, '2017-01-21 10:13:22', '2017-01-21 10:13:22'),
(206, 119, 22, 0, 0, '2017-01-21 10:13:22', '2017-01-21 10:13:22'),
(207, 119, 23, 0, 0, '2017-01-21 10:13:22', '2017-01-21 10:13:22'),
(211, 123, 15, 0, 5, '2017-01-21 11:27:35', '2017-01-21 11:54:05'),
(212, 123, 16, 0, 5, '2017-01-21 11:27:37', '2017-01-21 11:54:56'),
(213, 123, 17, 0, 0, '2017-01-21 11:27:38', '2017-01-21 11:27:38'),
(214, 123, 18, 0, 5, '2017-01-21 11:27:39', '2017-01-21 11:55:56'),
(215, 123, 19, 0, 0, '2017-01-21 11:27:40', '2017-01-21 11:27:40'),
(216, 123, 3, 0, 5, '2017-01-21 11:27:42', '2017-01-21 11:53:13'),
(217, 123, 20, 0, 0, '2017-01-21 11:27:43', '2017-01-21 11:27:43'),
(218, 123, 21, 0, 0, '2017-01-21 11:27:44', '2017-01-21 11:27:44'),
(309, 131, 1, 0, 1, '2017-03-19 01:29:16', '2017-03-19 01:40:11'),
(310, 131, 2, 0, 1, '2017-03-19 01:29:22', '2017-03-19 01:53:09'),
(311, 131, 3, 0, 1, '2017-03-19 01:29:23', '2017-03-19 01:48:22'),
(312, 131, 15, 0, 1, '2017-03-19 01:29:24', '2017-03-19 02:01:57'),
(313, 131, 16, 0, 0, '2017-03-19 01:29:26', '2017-03-19 01:29:26'),
(314, 131, 17, 0, 0, '2017-03-19 01:29:27', '2017-03-19 01:29:27'),
(315, 131, 18, 0, 0, '2017-03-19 01:29:28', '2017-03-19 01:29:28'),
(316, 131, 19, 0, 0, '2017-03-19 01:29:30', '2017-03-19 01:29:30'),
(317, 131, 20, 0, 0, '2017-03-19 01:29:31', '2017-03-19 01:29:31'),
(318, 131, 21, 0, 0, '2017-03-19 01:29:32', '2017-03-19 01:29:32'),
(319, 131, 22, 0, 0, '2017-03-19 01:29:34', '2017-03-19 01:29:34'),
(320, 131, 23, 0, 0, '2017-03-19 01:29:35', '2017-03-19 01:29:35'),
(321, 132, 1, 0, 5, '2017-03-19 01:31:17', '2017-03-19 02:03:06'),
(322, 132, 2, 0, 3, '2017-03-19 01:31:19', '2017-03-19 02:09:23'),
(323, 132, 3, 0, 0, '2017-03-19 01:31:20', '2017-03-19 01:31:20'),
(324, 132, 15, 0, 3, '2017-03-19 01:31:21', '2017-03-19 02:10:44'),
(325, 132, 16, 0, 0, '2017-03-19 01:31:22', '2017-03-19 01:31:22'),
(326, 132, 17, 0, 0, '2017-03-19 01:31:24', '2017-03-19 01:31:24'),
(327, 132, 18, 0, 0, '2017-03-19 01:31:25', '2017-03-19 01:31:25'),
(328, 132, 19, 0, 0, '2017-03-19 01:31:27', '2017-03-19 01:31:27'),
(329, 132, 20, 0, 0, '2017-03-19 01:31:28', '2017-03-19 01:31:28'),
(330, 132, 21, 0, 0, '2017-03-19 01:31:30', '2017-03-19 01:31:30'),
(331, 132, 22, 0, 0, '2017-03-19 01:31:31', '2017-03-19 01:31:31'),
(332, 132, 23, 0, 0, '2017-03-19 01:31:33', '2017-03-19 01:31:33'),
(349, 135, 15, 0, 1, '2017-03-19 03:20:21', '2017-03-19 03:51:38'),
(350, 135, 16, 0, 0, '2017-03-19 03:20:24', '2017-03-19 03:20:24'),
(351, 135, 17, 0, 0, '2017-03-19 03:20:25', '2017-03-19 03:20:25'),
(352, 135, 18, 0, 1, '2017-03-19 03:20:27', '2017-03-19 03:58:06'),
(353, 135, 19, 0, 0, '2017-03-19 03:20:28', '2017-03-19 03:20:28'),
(354, 135, 3, 0, 1, '2017-03-19 03:20:29', '2017-03-19 03:48:27'),
(355, 135, 20, 0, 0, '2017-03-19 03:20:30', '2017-03-19 03:20:30'),
(356, 135, 21, 0, 0, '2017-03-19 03:20:32', '2017-03-19 03:20:32'),
(357, 135, 2, 0, 1, '2017-03-19 03:20:33', '2017-03-19 03:25:47'),
(358, 136, 15, 0, 3, '2017-03-19 03:21:44', '2017-03-19 04:05:01'),
(359, 136, 16, 0, 0, '2017-03-19 03:21:46', '2017-03-19 03:21:46'),
(360, 136, 17, 0, 0, '2017-03-19 03:21:47', '2017-03-19 03:21:47'),
(361, 136, 18, 0, 0, '2017-03-19 03:21:48', '2017-03-19 03:21:48'),
(362, 136, 19, 0, 0, '2017-03-19 03:21:50', '2017-03-19 03:21:50'),
(363, 136, 3, 0, 3, '2017-03-19 03:21:52', '2017-03-19 04:04:04'),
(364, 136, 20, 0, 0, '2017-03-19 03:21:53', '2017-03-19 03:21:53'),
(365, 136, 21, 0, 0, '2017-03-19 03:21:54', '2017-03-19 03:21:54'),
(366, 136, 2, 0, 3, '2017-03-19 03:21:56', '2017-03-19 04:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@fincoda.com', '2aee07dcdc360918663e8a4803acd237d362c237f742f923fe940e4b8fecd1e1', '2016-10-06 11:33:32'),
('duy.lenguyen@edu.turkuamk.fi', '8fb00b2519c2c997bafbe1d3b5a68df7f8776fd5270862c181426cf652157831', '2017-01-12 18:35:46'),
('davis.kawalya@edu.turkuamk.fi', '9325e1cd97b8297dfc80b8d9feafc6156b08ab0ab8f1688be02e125562082079', '2017-01-12 18:43:23');

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
  `answer` int(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `peer_results`
--

INSERT INTO `peer_results` (`id`, `peer_survey_id`, `user_id`, `peer_id`, `indicator_id`, `answer`, `created_at`, `updated_at`) VALUES
(3231, 119, 2, 3, 1, 4, NULL, NULL),
(3232, 119, 2, 3, 2, 5, NULL, NULL),
(3233, 119, 2, 3, 3, 4, NULL, NULL),
(3234, 119, 2, 3, 4, 4, NULL, NULL),
(3235, 119, 2, 3, 5, 4, NULL, NULL),
(3236, 119, 2, 3, 6, 5, NULL, NULL),
(3237, 119, 2, 3, 7, 4, NULL, NULL),
(3238, 119, 2, 3, 8, 5, NULL, NULL),
(3239, 119, 2, 3, 9, 4, NULL, NULL),
(3240, 119, 2, 3, 10, 5, NULL, NULL),
(3241, 119, 2, 3, 11, 5, NULL, NULL),
(3242, 119, 2, 3, 12, 5, NULL, NULL),
(3243, 119, 2, 3, 13, 5, NULL, NULL),
(3244, 119, 2, 3, 14, 4, NULL, NULL),
(3245, 119, 2, 3, 15, 4, NULL, NULL),
(3246, 119, 2, 3, 16, 4, NULL, NULL),
(3247, 119, 2, 3, 17, 4, NULL, NULL),
(3248, 119, 2, 3, 18, 4, NULL, NULL),
(3249, 119, 2, 3, 19, 4, NULL, NULL),
(3250, 119, 2, 3, 20, 4, NULL, NULL),
(3251, 119, 2, 3, 21, 5, NULL, NULL),
(3252, 119, 2, 3, 22, 5, NULL, NULL),
(3253, 119, 2, 3, 23, 4, NULL, NULL),
(3254, 119, 2, 3, 24, 4, NULL, NULL),
(3255, 119, 2, 3, 25, 5, NULL, NULL),
(3256, 119, 2, 3, 26, 4, NULL, NULL),
(3257, 119, 2, 3, 27, 4, NULL, NULL),
(3258, 119, 2, 3, 28, 5, NULL, NULL),
(3259, 119, 2, 3, 29, 4, NULL, NULL),
(3260, 119, 2, 3, 30, 5, NULL, NULL),
(3261, 119, 2, 3, 31, 5, NULL, NULL),
(3262, 119, 2, 3, 32, 4, NULL, NULL),
(3263, 119, 2, 3, 33, 4, NULL, NULL),
(3264, 119, 2, 3, 34, 5, NULL, NULL),
(3265, 119, 3, 16, 1, 4, NULL, NULL),
(3266, 119, 3, 16, 2, 4, NULL, NULL),
(3267, 119, 3, 16, 3, 4, NULL, NULL),
(3268, 119, 3, 16, 4, 4, NULL, NULL),
(3269, 119, 3, 16, 5, 4, NULL, NULL),
(3270, 119, 3, 16, 6, 5, NULL, NULL),
(3271, 119, 3, 16, 7, 5, NULL, NULL),
(3272, 119, 3, 16, 8, 5, NULL, NULL),
(3273, 119, 3, 16, 9, 4, NULL, NULL),
(3274, 119, 3, 16, 10, 4, NULL, NULL),
(3275, 119, 3, 16, 11, 5, NULL, NULL),
(3276, 119, 3, 16, 12, 5, NULL, NULL),
(3277, 119, 3, 16, 13, 4, NULL, NULL),
(3278, 119, 3, 16, 14, 4, NULL, NULL),
(3279, 119, 3, 16, 15, 4, NULL, NULL),
(3280, 119, 3, 16, 16, 5, NULL, NULL),
(3281, 119, 3, 16, 17, 4, NULL, NULL),
(3282, 119, 3, 16, 18, 4, NULL, NULL),
(3283, 119, 3, 16, 19, 5, NULL, NULL),
(3284, 119, 3, 16, 20, 4, NULL, NULL),
(3285, 119, 3, 16, 21, 4, NULL, NULL),
(3286, 119, 3, 16, 22, 4, NULL, NULL),
(3287, 119, 3, 16, 23, 4, NULL, NULL),
(3288, 119, 3, 16, 24, 4, NULL, NULL),
(3289, 119, 3, 16, 25, 5, NULL, NULL),
(3290, 119, 3, 16, 26, 4, NULL, NULL),
(3291, 119, 3, 16, 27, 4, NULL, NULL),
(3292, 119, 3, 16, 28, 5, NULL, NULL),
(3293, 119, 3, 16, 29, 4, NULL, NULL),
(3294, 119, 3, 16, 30, 5, NULL, NULL),
(3295, 119, 3, 16, 31, 5, NULL, NULL),
(3296, 119, 3, 16, 32, 4, NULL, NULL),
(3297, 119, 3, 16, 33, 5, NULL, NULL),
(3298, 119, 3, 16, 34, 4, NULL, NULL),
(3299, 119, 2, 16, 1, 4, NULL, NULL),
(3300, 119, 2, 16, 2, 4, NULL, NULL),
(3301, 119, 2, 16, 3, 4, NULL, NULL),
(3302, 119, 2, 16, 4, 4, NULL, NULL),
(3303, 119, 2, 16, 5, 4, NULL, NULL),
(3304, 119, 2, 16, 6, 4, NULL, NULL),
(3305, 119, 2, 16, 7, 4, NULL, NULL),
(3306, 119, 2, 16, 8, 4, NULL, NULL),
(3307, 119, 2, 16, 9, 4, NULL, NULL),
(3308, 119, 2, 16, 10, 4, NULL, NULL),
(3309, 119, 2, 16, 11, 5, NULL, NULL),
(3310, 119, 2, 16, 12, 4, NULL, NULL),
(3311, 119, 2, 16, 13, 4, NULL, NULL),
(3312, 119, 2, 16, 14, 5, NULL, NULL),
(3313, 119, 2, 16, 15, 4, NULL, NULL),
(3314, 119, 2, 16, 16, 5, NULL, NULL),
(3315, 119, 2, 16, 17, 4, NULL, NULL),
(3316, 119, 2, 16, 18, 4, NULL, NULL),
(3317, 119, 2, 16, 19, 5, NULL, NULL),
(3318, 119, 2, 16, 20, 4, NULL, NULL),
(3319, 119, 2, 16, 21, 5, NULL, NULL),
(3320, 119, 2, 16, 22, 4, NULL, NULL),
(3321, 119, 2, 16, 23, 5, NULL, NULL),
(3322, 119, 2, 16, 24, 4, NULL, NULL),
(3323, 119, 2, 16, 25, 5, NULL, NULL),
(3324, 119, 2, 16, 26, 4, NULL, NULL),
(3325, 119, 2, 16, 27, 4, NULL, NULL),
(3326, 119, 2, 16, 28, 4, NULL, NULL),
(3327, 119, 2, 16, 29, 4, NULL, NULL),
(3328, 119, 2, 16, 30, 4, NULL, NULL),
(3329, 119, 2, 16, 31, 4, NULL, NULL),
(3330, 119, 2, 16, 32, 4, NULL, NULL),
(3331, 119, 2, 16, 33, 5, NULL, NULL),
(3332, 119, 2, 16, 34, 4, NULL, NULL),
(3333, 119, 3, 18, 1, 4, NULL, NULL),
(3334, 119, 3, 18, 2, 4, NULL, NULL),
(3335, 119, 3, 18, 3, 3, NULL, NULL),
(3336, 119, 3, 18, 4, 4, NULL, NULL),
(3337, 119, 3, 18, 5, 5, NULL, NULL),
(3338, 119, 3, 18, 6, 5, NULL, NULL),
(3339, 119, 3, 18, 7, 4, NULL, NULL),
(3340, 119, 3, 18, 8, 5, NULL, NULL),
(3341, 119, 3, 18, 9, 5, NULL, NULL),
(3342, 119, 3, 18, 10, 4, NULL, NULL),
(3343, 119, 3, 18, 11, 5, NULL, NULL),
(3344, 119, 3, 18, 12, 4, NULL, NULL),
(3345, 119, 3, 18, 13, 5, NULL, NULL),
(3346, 119, 3, 18, 14, 4, NULL, NULL),
(3347, 119, 3, 18, 15, 5, NULL, NULL),
(3348, 119, 3, 18, 16, 4, NULL, NULL),
(3349, 119, 3, 18, 17, 5, NULL, NULL),
(3350, 119, 3, 18, 18, 4, NULL, NULL),
(3351, 119, 3, 18, 19, 4, NULL, NULL),
(3352, 119, 3, 18, 20, 4, NULL, NULL),
(3353, 119, 3, 18, 21, 5, NULL, NULL),
(3354, 119, 3, 18, 22, 5, NULL, NULL),
(3355, 119, 3, 18, 23, 4, NULL, NULL),
(3356, 119, 3, 18, 24, 4, NULL, NULL),
(3357, 119, 3, 18, 25, 5, NULL, NULL),
(3358, 119, 3, 18, 26, 4, NULL, NULL),
(3359, 119, 3, 18, 27, 5, NULL, NULL),
(3360, 119, 3, 18, 28, 4, NULL, NULL),
(3361, 119, 3, 18, 29, 4, NULL, NULL),
(3362, 119, 3, 18, 30, 4, NULL, NULL),
(3363, 119, 3, 18, 31, 4, NULL, NULL),
(3364, 119, 3, 18, 32, 4, NULL, NULL),
(3365, 119, 3, 18, 33, 4, NULL, NULL),
(3366, 119, 3, 18, 34, 4, NULL, NULL),
(3367, 119, 16, 18, 1, 5, NULL, NULL),
(3368, 119, 16, 18, 2, 4, NULL, NULL),
(3369, 119, 16, 18, 3, 5, NULL, NULL),
(3370, 119, 16, 18, 4, 4, NULL, NULL),
(3371, 119, 16, 18, 5, 5, NULL, NULL),
(3372, 119, 16, 18, 6, 5, NULL, NULL),
(3373, 119, 16, 18, 7, 4, NULL, NULL),
(3374, 119, 16, 18, 8, 4, NULL, NULL),
(3375, 119, 16, 18, 9, 5, NULL, NULL),
(3376, 119, 16, 18, 10, 4, NULL, NULL),
(3377, 119, 16, 18, 11, 5, NULL, NULL),
(3378, 119, 16, 18, 12, 5, NULL, NULL),
(3379, 119, 16, 18, 13, 4, NULL, NULL),
(3380, 119, 16, 18, 14, 4, NULL, NULL),
(3381, 119, 16, 18, 15, 4, NULL, NULL),
(3382, 119, 16, 18, 16, 4, NULL, NULL),
(3383, 119, 16, 18, 17, 5, NULL, NULL),
(3384, 119, 16, 18, 18, 4, NULL, NULL),
(3385, 119, 16, 18, 19, 5, NULL, NULL),
(3386, 119, 16, 18, 20, 4, NULL, NULL),
(3387, 119, 16, 18, 21, 4, NULL, NULL),
(3388, 119, 16, 18, 22, 4, NULL, NULL),
(3389, 119, 16, 18, 23, 4, NULL, NULL),
(3390, 119, 16, 18, 24, 4, NULL, NULL),
(3391, 119, 16, 18, 25, 4, NULL, NULL),
(3392, 119, 16, 18, 26, 4, NULL, NULL),
(3393, 119, 16, 18, 27, 4, NULL, NULL),
(3394, 119, 16, 18, 28, 5, NULL, NULL),
(3395, 119, 16, 18, 29, 4, NULL, NULL),
(3396, 119, 16, 18, 30, 5, NULL, NULL),
(3397, 119, 16, 18, 31, 5, NULL, NULL),
(3398, 119, 16, 18, 32, 4, NULL, NULL),
(3399, 119, 16, 18, 33, 4, NULL, NULL),
(3400, 119, 16, 18, 34, 5, NULL, NULL),
(3401, 119, 2, 18, 1, 5, NULL, NULL),
(3402, 119, 2, 18, 2, 5, NULL, NULL),
(3403, 119, 2, 18, 3, 4, NULL, NULL),
(3404, 119, 2, 18, 4, 4, NULL, NULL),
(3405, 119, 2, 18, 5, 4, NULL, NULL),
(3406, 119, 2, 18, 6, 5, NULL, NULL),
(3407, 119, 2, 18, 7, 4, NULL, NULL),
(3408, 119, 2, 18, 8, 5, NULL, NULL),
(3409, 119, 2, 18, 9, 4, NULL, NULL),
(3410, 119, 2, 18, 10, 3, NULL, NULL),
(3411, 119, 2, 18, 11, 5, NULL, NULL),
(3412, 119, 2, 18, 12, 4, NULL, NULL),
(3413, 119, 2, 18, 13, 4, NULL, NULL),
(3414, 119, 2, 18, 14, 4, NULL, NULL),
(3415, 119, 2, 18, 15, 4, NULL, NULL),
(3416, 119, 2, 18, 16, 3, NULL, NULL),
(3417, 119, 2, 18, 17, 4, NULL, NULL),
(3418, 119, 2, 18, 18, 5, NULL, NULL),
(3419, 119, 2, 18, 19, 4, NULL, NULL),
(3420, 119, 2, 18, 20, 4, NULL, NULL),
(3421, 119, 2, 18, 21, 4, NULL, NULL),
(3422, 119, 2, 18, 22, 4, NULL, NULL),
(3423, 119, 2, 18, 23, 5, NULL, NULL),
(3424, 119, 2, 18, 24, 3, NULL, NULL),
(3425, 119, 2, 18, 25, 4, NULL, NULL),
(3426, 119, 2, 18, 26, 5, NULL, NULL),
(3427, 119, 2, 18, 27, 3, NULL, NULL),
(3428, 119, 2, 18, 28, 3, NULL, NULL),
(3429, 119, 2, 18, 29, 5, NULL, NULL),
(3430, 119, 2, 18, 30, 4, NULL, NULL),
(3431, 119, 2, 18, 31, 3, NULL, NULL),
(3432, 119, 2, 18, 32, 3, NULL, NULL),
(3433, 119, 2, 18, 33, 4, NULL, NULL),
(3434, 119, 2, 18, 34, 4, NULL, NULL),
(3435, 119, 3, 19, 1, 4, NULL, NULL),
(3436, 119, 3, 19, 2, 5, NULL, NULL),
(3437, 119, 3, 19, 3, 5, NULL, NULL),
(3438, 119, 3, 19, 4, 5, NULL, NULL),
(3439, 119, 3, 19, 5, 4, NULL, NULL),
(3440, 119, 3, 19, 6, 4, NULL, NULL),
(3441, 119, 3, 19, 7, 4, NULL, NULL),
(3442, 119, 3, 19, 8, 4, NULL, NULL),
(3443, 119, 3, 19, 9, 5, NULL, NULL),
(3444, 119, 3, 19, 10, 5, NULL, NULL),
(3445, 119, 3, 19, 11, 5, NULL, NULL),
(3446, 119, 3, 19, 12, 4, NULL, NULL),
(3447, 119, 3, 19, 13, 5, NULL, NULL),
(3448, 119, 3, 19, 14, 5, NULL, NULL),
(3449, 119, 3, 19, 15, 4, NULL, NULL),
(3450, 119, 3, 19, 16, 4, NULL, NULL),
(3451, 119, 3, 19, 17, 5, NULL, NULL),
(3452, 119, 3, 19, 18, 4, NULL, NULL),
(3453, 119, 3, 19, 19, 5, NULL, NULL),
(3454, 119, 3, 19, 20, 5, NULL, NULL),
(3455, 119, 3, 19, 21, 4, NULL, NULL),
(3456, 119, 3, 19, 22, 4, NULL, NULL),
(3457, 119, 3, 19, 23, 4, NULL, NULL),
(3458, 119, 3, 19, 24, 5, NULL, NULL),
(3459, 119, 3, 19, 25, 5, NULL, NULL),
(3460, 119, 3, 19, 26, 4, NULL, NULL),
(3461, 119, 3, 19, 27, 5, NULL, NULL),
(3462, 119, 3, 19, 28, 4, NULL, NULL),
(3463, 119, 3, 19, 29, 5, NULL, NULL),
(3464, 119, 3, 19, 30, 5, NULL, NULL),
(3465, 119, 3, 19, 31, 4, NULL, NULL),
(3466, 119, 3, 19, 32, 5, NULL, NULL),
(3467, 119, 3, 19, 33, 4, NULL, NULL),
(3468, 119, 3, 19, 34, 4, NULL, NULL),
(3469, 119, 16, 19, 1, 4, NULL, NULL),
(3470, 119, 16, 19, 2, 5, NULL, NULL),
(3471, 119, 16, 19, 3, 5, NULL, NULL),
(3472, 119, 16, 19, 4, 4, NULL, NULL),
(3473, 119, 16, 19, 5, 4, NULL, NULL),
(3474, 119, 16, 19, 6, 4, NULL, NULL),
(3475, 119, 16, 19, 7, 4, NULL, NULL),
(3476, 119, 16, 19, 8, 4, NULL, NULL),
(3477, 119, 16, 19, 9, 4, NULL, NULL),
(3478, 119, 16, 19, 10, 4, NULL, NULL),
(3479, 119, 16, 19, 11, 4, NULL, NULL),
(3480, 119, 16, 19, 12, 4, NULL, NULL),
(3481, 119, 16, 19, 13, 4, NULL, NULL),
(3482, 119, 16, 19, 14, 4, NULL, NULL),
(3483, 119, 16, 19, 15, 5, NULL, NULL),
(3484, 119, 16, 19, 16, 5, NULL, NULL),
(3485, 119, 16, 19, 17, 5, NULL, NULL),
(3486, 119, 16, 19, 18, 4, NULL, NULL),
(3487, 119, 16, 19, 19, 4, NULL, NULL),
(3488, 119, 16, 19, 20, 4, NULL, NULL),
(3489, 119, 16, 19, 21, 4, NULL, NULL),
(3490, 119, 16, 19, 22, 4, NULL, NULL),
(3491, 119, 16, 19, 23, 4, NULL, NULL),
(3492, 119, 16, 19, 24, 4, NULL, NULL),
(3493, 119, 16, 19, 25, 5, NULL, NULL),
(3494, 119, 16, 19, 26, 4, NULL, NULL),
(3495, 119, 16, 19, 27, 4, NULL, NULL),
(3496, 119, 16, 19, 28, 5, NULL, NULL),
(3497, 119, 16, 19, 29, 4, NULL, NULL),
(3498, 119, 16, 19, 30, 4, NULL, NULL),
(3499, 119, 16, 19, 31, 5, NULL, NULL),
(3500, 119, 16, 19, 32, 4, NULL, NULL),
(3501, 119, 16, 19, 33, 4, NULL, NULL),
(3502, 119, 16, 19, 34, 5, NULL, NULL),
(3503, 119, 3, 15, 1, 5, NULL, NULL),
(3504, 119, 3, 15, 2, 4, NULL, NULL),
(3505, 119, 3, 15, 3, 4, NULL, NULL),
(3506, 119, 3, 15, 4, 5, NULL, NULL),
(3507, 119, 3, 15, 5, 5, NULL, NULL),
(3508, 119, 3, 15, 6, 5, NULL, NULL),
(3509, 119, 3, 15, 7, 5, NULL, NULL),
(3510, 119, 3, 15, 8, 5, NULL, NULL),
(3511, 119, 3, 15, 9, 4, NULL, NULL),
(3512, 119, 3, 15, 10, 4, NULL, NULL),
(3513, 119, 3, 15, 11, 4, NULL, NULL),
(3514, 119, 3, 15, 12, 5, NULL, NULL),
(3515, 119, 3, 15, 13, 5, NULL, NULL),
(3516, 119, 3, 15, 14, 4, NULL, NULL),
(3517, 119, 3, 15, 15, 5, NULL, NULL),
(3518, 119, 3, 15, 16, 5, NULL, NULL),
(3519, 119, 3, 15, 17, 4, NULL, NULL),
(3520, 119, 3, 15, 18, 4, NULL, NULL),
(3521, 119, 3, 15, 19, 4, NULL, NULL),
(3522, 119, 3, 15, 20, 5, NULL, NULL),
(3523, 119, 3, 15, 21, 4, NULL, NULL),
(3524, 119, 3, 15, 22, 5, NULL, NULL),
(3525, 119, 3, 15, 23, 5, NULL, NULL),
(3526, 119, 3, 15, 24, 4, NULL, NULL),
(3527, 119, 3, 15, 25, 4, NULL, NULL),
(3528, 119, 3, 15, 26, 4, NULL, NULL),
(3529, 119, 3, 15, 27, 5, NULL, NULL),
(3530, 119, 3, 15, 28, 5, NULL, NULL),
(3531, 119, 3, 15, 29, 5, NULL, NULL),
(3532, 119, 3, 15, 30, 4, NULL, NULL),
(3533, 119, 3, 15, 31, 4, NULL, NULL),
(3534, 119, 3, 15, 32, 4, NULL, NULL),
(3535, 119, 3, 15, 33, 4, NULL, NULL),
(3536, 119, 3, 15, 34, 4, NULL, NULL),
(3537, 119, 16, 15, 1, 4, NULL, NULL),
(3538, 119, 16, 15, 2, 4, NULL, NULL),
(3539, 119, 16, 15, 3, 4, NULL, NULL),
(3540, 119, 16, 15, 4, 3, NULL, NULL),
(3541, 119, 16, 15, 5, 5, NULL, NULL),
(3542, 119, 16, 15, 6, 3, NULL, NULL),
(3543, 119, 16, 15, 7, 4, NULL, NULL),
(3544, 119, 16, 15, 8, 3, NULL, NULL),
(3545, 119, 16, 15, 9, 5, NULL, NULL),
(3546, 119, 16, 15, 10, 5, NULL, NULL),
(3547, 119, 16, 15, 11, 4, NULL, NULL),
(3548, 119, 16, 15, 12, 4, NULL, NULL),
(3549, 119, 16, 15, 13, 4, NULL, NULL),
(3550, 119, 16, 15, 14, 4, NULL, NULL),
(3551, 119, 16, 15, 15, 5, NULL, NULL),
(3552, 119, 16, 15, 16, 4, NULL, NULL),
(3553, 119, 16, 15, 17, 4, NULL, NULL),
(3554, 119, 16, 15, 18, 4, NULL, NULL),
(3555, 119, 16, 15, 19, 5, NULL, NULL),
(3556, 119, 16, 15, 20, 4, NULL, NULL),
(3557, 119, 16, 15, 21, 3, NULL, NULL),
(3558, 119, 16, 15, 22, 5, NULL, NULL),
(3559, 119, 16, 15, 23, 4, NULL, NULL),
(3560, 119, 16, 15, 24, 5, NULL, NULL),
(3561, 119, 16, 15, 25, 4, NULL, NULL),
(3562, 119, 16, 15, 26, 3, NULL, NULL),
(3563, 119, 16, 15, 27, 3, NULL, NULL),
(3564, 119, 16, 15, 28, 4, NULL, NULL),
(3565, 119, 16, 15, 29, 4, NULL, NULL),
(3566, 119, 16, 15, 30, 4, NULL, NULL),
(3567, 119, 16, 15, 31, 5, NULL, NULL),
(3568, 119, 16, 15, 32, 4, NULL, NULL),
(3569, 119, 16, 15, 33, 4, NULL, NULL),
(3570, 119, 16, 15, 34, 5, NULL, NULL),
(3571, 119, 19, 15, 1, 5, NULL, NULL),
(3572, 119, 19, 15, 2, 4, NULL, NULL),
(3573, 119, 19, 15, 3, 5, NULL, NULL),
(3574, 119, 19, 15, 4, 4, NULL, NULL),
(3575, 119, 19, 15, 5, 4, NULL, NULL),
(3576, 119, 19, 15, 6, 5, NULL, NULL),
(3577, 119, 19, 15, 7, 5, NULL, NULL),
(3578, 119, 19, 15, 8, 5, NULL, NULL),
(3579, 119, 19, 15, 9, 4, NULL, NULL),
(3580, 119, 19, 15, 10, 5, NULL, NULL),
(3581, 119, 19, 15, 11, 4, NULL, NULL),
(3582, 119, 19, 15, 12, 5, NULL, NULL),
(3583, 119, 19, 15, 13, 4, NULL, NULL),
(3584, 119, 19, 15, 14, 4, NULL, NULL),
(3585, 119, 19, 15, 15, 5, NULL, NULL),
(3586, 119, 19, 15, 16, 5, NULL, NULL),
(3587, 119, 19, 15, 17, 4, NULL, NULL),
(3588, 119, 19, 15, 18, 5, NULL, NULL),
(3589, 119, 19, 15, 19, 5, NULL, NULL),
(3590, 119, 19, 15, 20, 4, NULL, NULL),
(3591, 119, 19, 15, 21, 4, NULL, NULL),
(3592, 119, 19, 15, 22, 4, NULL, NULL),
(3593, 119, 19, 15, 23, 4, NULL, NULL),
(3594, 119, 19, 15, 24, 4, NULL, NULL),
(3595, 119, 19, 15, 25, 4, NULL, NULL),
(3596, 119, 19, 15, 26, 4, NULL, NULL),
(3597, 119, 19, 15, 27, 5, NULL, NULL),
(3598, 119, 19, 15, 28, 4, NULL, NULL),
(3599, 119, 19, 15, 29, 4, NULL, NULL),
(3600, 119, 19, 15, 30, 4, NULL, NULL),
(3601, 119, 19, 15, 31, 4, NULL, NULL),
(3602, 119, 19, 15, 32, 4, NULL, NULL),
(3603, 119, 19, 15, 33, 5, NULL, NULL),
(3604, 119, 19, 15, 34, 4, NULL, NULL),
(3605, 119, 2, 15, 1, 4, NULL, NULL),
(3606, 119, 2, 15, 2, 4, NULL, NULL),
(3607, 119, 2, 15, 3, 4, NULL, NULL),
(3608, 119, 2, 15, 4, 4, NULL, NULL),
(3609, 119, 2, 15, 5, 5, NULL, NULL),
(3610, 119, 2, 15, 6, 4, NULL, NULL),
(3611, 119, 2, 15, 7, 4, NULL, NULL),
(3612, 119, 2, 15, 8, 5, NULL, NULL),
(3613, 119, 2, 15, 9, 4, NULL, NULL),
(3614, 119, 2, 15, 10, 5, NULL, NULL),
(3615, 119, 2, 15, 11, 4, NULL, NULL),
(3616, 119, 2, 15, 12, 4, NULL, NULL),
(3617, 119, 2, 15, 13, 4, NULL, NULL),
(3618, 119, 2, 15, 14, 5, NULL, NULL),
(3619, 119, 2, 15, 15, 5, NULL, NULL),
(3620, 119, 2, 15, 16, 5, NULL, NULL),
(3621, 119, 2, 15, 17, 5, NULL, NULL),
(3622, 119, 2, 15, 18, 5, NULL, NULL),
(3623, 119, 2, 15, 19, 4, NULL, NULL),
(3624, 119, 2, 15, 20, 5, NULL, NULL),
(3625, 119, 2, 15, 21, 5, NULL, NULL),
(3626, 119, 2, 15, 22, 4, NULL, NULL),
(3627, 119, 2, 15, 23, 5, NULL, NULL),
(3628, 119, 2, 15, 24, 4, NULL, NULL),
(3629, 119, 2, 15, 25, 5, NULL, NULL),
(3630, 119, 2, 15, 26, 5, NULL, NULL),
(3631, 119, 2, 15, 27, 5, NULL, NULL),
(3632, 119, 2, 15, 28, 4, NULL, NULL),
(3633, 119, 2, 15, 29, 4, NULL, NULL),
(3634, 119, 2, 15, 30, 5, NULL, NULL),
(3635, 119, 2, 15, 31, 4, NULL, NULL),
(3636, 119, 2, 15, 32, 4, NULL, NULL),
(3637, 119, 2, 15, 33, 4, NULL, NULL),
(3638, 119, 2, 15, 34, 4, NULL, NULL),
(3639, 119, 15, 3, 1, 4, NULL, NULL),
(3640, 119, 15, 3, 2, 4, NULL, NULL),
(3641, 119, 15, 3, 3, 5, NULL, NULL),
(3642, 119, 15, 3, 4, 4, NULL, NULL),
(3643, 119, 15, 3, 5, 4, NULL, NULL),
(3644, 119, 15, 3, 6, 4, NULL, NULL),
(3645, 119, 15, 3, 7, 4, NULL, NULL),
(3646, 119, 15, 3, 8, 4, NULL, NULL),
(3647, 119, 15, 3, 9, 4, NULL, NULL),
(3648, 119, 15, 3, 10, 4, NULL, NULL),
(3649, 119, 15, 3, 11, 4, NULL, NULL),
(3650, 119, 15, 3, 12, 4, NULL, NULL),
(3651, 119, 15, 3, 13, 4, NULL, NULL),
(3652, 119, 15, 3, 14, 4, NULL, NULL),
(3653, 119, 15, 3, 15, 5, NULL, NULL),
(3654, 119, 15, 3, 16, 5, NULL, NULL),
(3655, 119, 15, 3, 17, 5, NULL, NULL),
(3656, 119, 15, 3, 18, 4, NULL, NULL),
(3657, 119, 15, 3, 19, 4, NULL, NULL),
(3658, 119, 15, 3, 20, 5, NULL, NULL),
(3659, 119, 15, 3, 21, 5, NULL, NULL),
(3660, 119, 15, 3, 22, 4, NULL, NULL),
(3661, 119, 15, 3, 23, 4, NULL, NULL),
(3662, 119, 15, 3, 24, 4, NULL, NULL),
(3663, 119, 15, 3, 25, 5, NULL, NULL),
(3664, 119, 15, 3, 26, 5, NULL, NULL),
(3665, 119, 15, 3, 27, 4, NULL, NULL),
(3666, 119, 15, 3, 28, 4, NULL, NULL),
(3667, 119, 15, 3, 29, 4, NULL, NULL),
(3668, 119, 15, 3, 30, 4, NULL, NULL),
(3669, 119, 15, 3, 31, 4, NULL, NULL),
(3670, 119, 15, 3, 32, 4, NULL, NULL),
(3671, 119, 15, 3, 33, 5, NULL, NULL),
(3672, 119, 15, 3, 34, 4, NULL, NULL),
(3673, 119, 16, 3, 1, 5, NULL, NULL),
(3674, 119, 16, 3, 2, 4, NULL, NULL),
(3675, 119, 16, 3, 3, 4, NULL, NULL),
(3676, 119, 16, 3, 4, 5, NULL, NULL),
(3677, 119, 16, 3, 5, 5, NULL, NULL),
(3678, 119, 16, 3, 6, 4, NULL, NULL),
(3679, 119, 16, 3, 7, 4, NULL, NULL),
(3680, 119, 16, 3, 8, 5, NULL, NULL),
(3681, 119, 16, 3, 9, 3, NULL, NULL),
(3682, 119, 16, 3, 10, 5, NULL, NULL),
(3683, 119, 16, 3, 11, 5, NULL, NULL),
(3684, 119, 16, 3, 12, 4, NULL, NULL),
(3685, 119, 16, 3, 13, 5, NULL, NULL),
(3686, 119, 16, 3, 14, 4, NULL, NULL),
(3687, 119, 16, 3, 15, 4, NULL, NULL),
(3688, 119, 16, 3, 16, 5, NULL, NULL),
(3689, 119, 16, 3, 17, 4, NULL, NULL),
(3690, 119, 16, 3, 18, 3, NULL, NULL),
(3691, 119, 16, 3, 19, 4, NULL, NULL),
(3692, 119, 16, 3, 20, 5, NULL, NULL),
(3693, 119, 16, 3, 21, 4, NULL, NULL),
(3694, 119, 16, 3, 22, 5, NULL, NULL),
(3695, 119, 16, 3, 23, 3, NULL, NULL),
(3696, 119, 16, 3, 24, 5, NULL, NULL),
(3697, 119, 16, 3, 25, 5, NULL, NULL),
(3698, 119, 16, 3, 26, 5, NULL, NULL),
(3699, 119, 16, 3, 27, 3, NULL, NULL),
(3700, 119, 16, 3, 28, 4, NULL, NULL),
(3701, 119, 16, 3, 29, 4, NULL, NULL),
(3702, 119, 16, 3, 30, 3, NULL, NULL),
(3703, 119, 16, 3, 31, 5, NULL, NULL),
(3704, 119, 16, 3, 32, 5, NULL, NULL),
(3705, 119, 16, 3, 33, 4, NULL, NULL),
(3706, 119, 16, 3, 34, 5, NULL, NULL),
(3707, 119, 19, 3, 1, 4, NULL, NULL),
(3708, 119, 19, 3, 2, 4, NULL, NULL),
(3709, 119, 19, 3, 3, 5, NULL, NULL),
(3710, 119, 19, 3, 4, 4, NULL, NULL),
(3711, 119, 19, 3, 5, 5, NULL, NULL),
(3712, 119, 19, 3, 6, 4, NULL, NULL),
(3713, 119, 19, 3, 7, 5, NULL, NULL),
(3714, 119, 19, 3, 8, 5, NULL, NULL),
(3715, 119, 19, 3, 9, 4, NULL, NULL),
(3716, 119, 19, 3, 10, 5, NULL, NULL),
(3717, 119, 19, 3, 11, 4, NULL, NULL),
(3718, 119, 19, 3, 12, 4, NULL, NULL),
(3719, 119, 19, 3, 13, 5, NULL, NULL),
(3720, 119, 19, 3, 14, 5, NULL, NULL),
(3721, 119, 19, 3, 15, 4, NULL, NULL),
(3722, 119, 19, 3, 16, 5, NULL, NULL),
(3723, 119, 19, 3, 17, 4, NULL, NULL),
(3724, 119, 19, 3, 18, 3, NULL, NULL),
(3725, 119, 19, 3, 19, 4, NULL, NULL),
(3726, 119, 19, 3, 20, 4, NULL, NULL),
(3727, 119, 19, 3, 21, 3, NULL, NULL),
(3728, 119, 19, 3, 22, 4, NULL, NULL),
(3729, 119, 19, 3, 23, 5, NULL, NULL),
(3730, 119, 19, 3, 24, 5, NULL, NULL),
(3731, 119, 19, 3, 25, 5, NULL, NULL),
(3732, 119, 19, 3, 26, 4, NULL, NULL),
(3733, 119, 19, 3, 27, 5, NULL, NULL),
(3734, 119, 19, 3, 28, 5, NULL, NULL),
(3735, 119, 19, 3, 29, 5, NULL, NULL),
(3736, 119, 19, 3, 30, 4, NULL, NULL),
(3737, 119, 19, 3, 31, 4, NULL, NULL),
(3738, 119, 19, 3, 32, 4, NULL, NULL),
(3739, 119, 19, 3, 33, 5, NULL, NULL),
(3740, 119, 19, 3, 34, 4, NULL, NULL),
(3741, 123, 3, 15, 1, 4, NULL, NULL),
(3742, 123, 3, 15, 2, 5, NULL, NULL),
(3743, 123, 3, 15, 3, 4, NULL, NULL),
(3744, 123, 3, 15, 4, 4, NULL, NULL),
(3745, 123, 3, 15, 5, 4, NULL, NULL),
(3746, 123, 3, 15, 6, 4, NULL, NULL),
(3747, 123, 3, 15, 7, 4, NULL, NULL),
(3748, 123, 3, 15, 8, 5, NULL, NULL),
(3749, 123, 3, 15, 9, 4, NULL, NULL),
(3750, 123, 3, 15, 10, 4, NULL, NULL),
(3751, 123, 3, 15, 11, 4, NULL, NULL),
(3752, 123, 3, 15, 12, 4, NULL, NULL),
(3753, 123, 3, 15, 13, 4, NULL, NULL),
(3754, 123, 3, 15, 14, 4, NULL, NULL),
(3755, 123, 3, 15, 15, 5, NULL, NULL),
(3756, 123, 3, 15, 16, 5, NULL, NULL),
(3757, 123, 3, 15, 17, 5, NULL, NULL),
(3758, 123, 3, 15, 18, 4, NULL, NULL),
(3759, 123, 3, 15, 19, 4, NULL, NULL),
(3760, 123, 3, 15, 20, 5, NULL, NULL),
(3761, 123, 3, 15, 21, 4, NULL, NULL),
(3762, 123, 3, 15, 22, 5, NULL, NULL),
(3763, 123, 3, 15, 23, 5, NULL, NULL),
(3764, 123, 3, 15, 24, 5, NULL, NULL),
(3765, 123, 3, 15, 25, 5, NULL, NULL),
(3766, 123, 3, 15, 26, 5, NULL, NULL),
(3767, 123, 3, 15, 27, 5, NULL, NULL),
(3768, 123, 3, 15, 28, 4, NULL, NULL),
(3769, 123, 3, 15, 29, 4, NULL, NULL),
(3770, 123, 3, 15, 30, 5, NULL, NULL),
(3771, 123, 3, 15, 31, 5, NULL, NULL),
(3772, 123, 3, 15, 32, 4, NULL, NULL),
(3773, 123, 3, 15, 33, 4, NULL, NULL),
(3774, 123, 3, 15, 34, 4, NULL, NULL),
(3775, 123, 3, 16, 1, 5, NULL, NULL),
(3776, 123, 3, 16, 2, 5, NULL, NULL),
(3777, 123, 3, 16, 3, 4, NULL, NULL),
(3778, 123, 3, 16, 4, 3, NULL, NULL),
(3779, 123, 3, 16, 5, 4, NULL, NULL),
(3780, 123, 3, 16, 6, 5, NULL, NULL),
(3781, 123, 3, 16, 7, 5, NULL, NULL),
(3782, 123, 3, 16, 8, 4, NULL, NULL),
(3783, 123, 3, 16, 9, 4, NULL, NULL),
(3784, 123, 3, 16, 10, 4, NULL, NULL),
(3785, 123, 3, 16, 11, 4, NULL, NULL),
(3786, 123, 3, 16, 12, 5, NULL, NULL),
(3787, 123, 3, 16, 13, 3, NULL, NULL),
(3788, 123, 3, 16, 14, 4, NULL, NULL),
(3789, 123, 3, 16, 15, 4, NULL, NULL),
(3790, 123, 3, 16, 16, 5, NULL, NULL),
(3791, 123, 3, 16, 17, 4, NULL, NULL),
(3792, 123, 3, 16, 18, 5, NULL, NULL),
(3793, 123, 3, 16, 19, 5, NULL, NULL),
(3794, 123, 3, 16, 20, 4, NULL, NULL),
(3795, 123, 3, 16, 21, 5, NULL, NULL),
(3796, 123, 3, 16, 22, 4, NULL, NULL),
(3797, 123, 3, 16, 23, 5, NULL, NULL),
(3798, 123, 3, 16, 24, 5, NULL, NULL),
(3799, 123, 3, 16, 25, 5, NULL, NULL),
(3800, 123, 3, 16, 26, 4, NULL, NULL),
(3801, 123, 3, 16, 27, 4, NULL, NULL),
(3802, 123, 3, 16, 28, 4, NULL, NULL),
(3803, 123, 3, 16, 29, 4, NULL, NULL),
(3804, 123, 3, 16, 30, 5, NULL, NULL),
(3805, 123, 3, 16, 31, 5, NULL, NULL),
(3806, 123, 3, 16, 32, 4, NULL, NULL),
(3807, 123, 3, 16, 33, 5, NULL, NULL),
(3808, 123, 3, 16, 34, 4, NULL, NULL),
(3809, 123, 15, 16, 1, 4, NULL, NULL),
(3810, 123, 15, 16, 2, 4, NULL, NULL),
(3811, 123, 15, 16, 3, 5, NULL, NULL),
(3812, 123, 15, 16, 4, 4, NULL, NULL),
(3813, 123, 15, 16, 5, 5, NULL, NULL),
(3814, 123, 15, 16, 6, 5, NULL, NULL),
(3815, 123, 15, 16, 7, 4, NULL, NULL),
(3816, 123, 15, 16, 8, 5, NULL, NULL),
(3817, 123, 15, 16, 9, 5, NULL, NULL),
(3818, 123, 15, 16, 10, 5, NULL, NULL),
(3819, 123, 15, 16, 11, 5, NULL, NULL),
(3820, 123, 15, 16, 12, 4, NULL, NULL),
(3821, 123, 15, 16, 13, 4, NULL, NULL),
(3822, 123, 15, 16, 14, 4, NULL, NULL),
(3823, 123, 15, 16, 15, 4, NULL, NULL),
(3824, 123, 15, 16, 16, 4, NULL, NULL),
(3825, 123, 15, 16, 17, 4, NULL, NULL),
(3826, 123, 15, 16, 18, 5, NULL, NULL),
(3827, 123, 15, 16, 19, 5, NULL, NULL),
(3828, 123, 15, 16, 20, 4, NULL, NULL),
(3829, 123, 15, 16, 21, 4, NULL, NULL),
(3830, 123, 15, 16, 22, 4, NULL, NULL),
(3831, 123, 15, 16, 23, 4, NULL, NULL),
(3832, 123, 15, 16, 24, 4, NULL, NULL),
(3833, 123, 15, 16, 25, 5, NULL, NULL),
(3834, 123, 15, 16, 26, 4, NULL, NULL),
(3835, 123, 15, 16, 27, 5, NULL, NULL),
(3836, 123, 15, 16, 28, 5, NULL, NULL),
(3837, 123, 15, 16, 29, 4, NULL, NULL),
(3838, 123, 15, 16, 30, 4, NULL, NULL),
(3839, 123, 15, 16, 31, 4, NULL, NULL),
(3840, 123, 15, 16, 32, 5, NULL, NULL),
(3841, 123, 15, 16, 33, 4, NULL, NULL),
(3842, 123, 15, 16, 34, 5, NULL, NULL),
(3843, 123, 3, 18, 1, 4, NULL, NULL),
(3844, 123, 3, 18, 2, 4, NULL, NULL),
(3845, 123, 3, 18, 3, 4, NULL, NULL),
(3846, 123, 3, 18, 4, 4, NULL, NULL),
(3847, 123, 3, 18, 5, 5, NULL, NULL),
(3848, 123, 3, 18, 6, 4, NULL, NULL),
(3849, 123, 3, 18, 7, 4, NULL, NULL),
(3850, 123, 3, 18, 8, 5, NULL, NULL),
(3851, 123, 3, 18, 9, 5, NULL, NULL),
(3852, 123, 3, 18, 10, 4, NULL, NULL),
(3853, 123, 3, 18, 11, 4, NULL, NULL),
(3854, 123, 3, 18, 12, 5, NULL, NULL),
(3855, 123, 3, 18, 13, 4, NULL, NULL),
(3856, 123, 3, 18, 14, 4, NULL, NULL),
(3857, 123, 3, 18, 15, 5, NULL, NULL),
(3858, 123, 3, 18, 16, 4, NULL, NULL),
(3859, 123, 3, 18, 17, 5, NULL, NULL),
(3860, 123, 3, 18, 18, 4, NULL, NULL),
(3861, 123, 3, 18, 19, 4, NULL, NULL),
(3862, 123, 3, 18, 20, 5, NULL, NULL),
(3863, 123, 3, 18, 21, 5, NULL, NULL),
(3864, 123, 3, 18, 22, 4, NULL, NULL),
(3865, 123, 3, 18, 23, 4, NULL, NULL),
(3866, 123, 3, 18, 24, 4, NULL, NULL),
(3867, 123, 3, 18, 25, 5, NULL, NULL),
(3868, 123, 3, 18, 26, 4, NULL, NULL),
(3869, 123, 3, 18, 27, 4, NULL, NULL),
(3870, 123, 3, 18, 28, 5, NULL, NULL),
(3871, 123, 3, 18, 29, 5, NULL, NULL),
(3872, 123, 3, 18, 30, 4, NULL, NULL),
(3873, 123, 3, 18, 31, 4, NULL, NULL),
(3874, 123, 3, 18, 32, 4, NULL, NULL),
(3875, 123, 3, 18, 33, 4, NULL, NULL),
(3876, 123, 3, 18, 34, 5, NULL, NULL),
(3877, 123, 15, 18, 1, 4, NULL, NULL),
(3878, 123, 15, 18, 2, 4, NULL, NULL),
(3879, 123, 15, 18, 3, 5, NULL, NULL),
(3880, 123, 15, 18, 4, 4, NULL, NULL),
(3881, 123, 15, 18, 5, 5, NULL, NULL),
(3882, 123, 15, 18, 6, 4, NULL, NULL),
(3883, 123, 15, 18, 7, 4, NULL, NULL),
(3884, 123, 15, 18, 8, 5, NULL, NULL),
(3885, 123, 15, 18, 9, 4, NULL, NULL),
(3886, 123, 15, 18, 10, 4, NULL, NULL),
(3887, 123, 15, 18, 11, 4, NULL, NULL),
(3888, 123, 15, 18, 12, 5, NULL, NULL),
(3889, 123, 15, 18, 13, 5, NULL, NULL),
(3890, 123, 15, 18, 14, 4, NULL, NULL),
(3891, 123, 15, 18, 15, 4, NULL, NULL),
(3892, 123, 15, 18, 16, 4, NULL, NULL),
(3893, 123, 15, 18, 17, 4, NULL, NULL),
(3894, 123, 15, 18, 18, 5, NULL, NULL),
(3895, 123, 15, 18, 19, 5, NULL, NULL),
(3896, 123, 15, 18, 20, 5, NULL, NULL),
(3897, 123, 15, 18, 21, 4, NULL, NULL),
(3898, 123, 15, 18, 22, 4, NULL, NULL),
(3899, 123, 15, 18, 23, 5, NULL, NULL),
(3900, 123, 15, 18, 24, 5, NULL, NULL),
(3901, 123, 15, 18, 25, 4, NULL, NULL),
(3902, 123, 15, 18, 26, 5, NULL, NULL),
(3903, 123, 15, 18, 27, 5, NULL, NULL),
(3904, 123, 15, 18, 28, 4, NULL, NULL),
(3905, 123, 15, 18, 29, 5, NULL, NULL),
(3906, 123, 15, 18, 30, 4, NULL, NULL),
(3907, 123, 15, 18, 31, 4, NULL, NULL),
(3908, 123, 15, 18, 32, 4, NULL, NULL),
(3909, 123, 15, 18, 33, 5, NULL, NULL),
(3910, 123, 15, 18, 34, 4, NULL, NULL),
(3911, 123, 16, 18, 1, 4, NULL, NULL),
(3912, 123, 16, 18, 2, 4, NULL, NULL),
(3913, 123, 16, 18, 3, 5, NULL, NULL),
(3914, 123, 16, 18, 4, 4, NULL, NULL),
(3915, 123, 16, 18, 5, 5, NULL, NULL),
(3916, 123, 16, 18, 6, 4, NULL, NULL),
(3917, 123, 16, 18, 7, 5, NULL, NULL),
(3918, 123, 16, 18, 8, 5, NULL, NULL),
(3919, 123, 16, 18, 9, 5, NULL, NULL),
(3920, 123, 16, 18, 10, 4, NULL, NULL),
(3921, 123, 16, 18, 11, 4, NULL, NULL),
(3922, 123, 16, 18, 12, 5, NULL, NULL),
(3923, 123, 16, 18, 13, 4, NULL, NULL),
(3924, 123, 16, 18, 14, 5, NULL, NULL),
(3925, 123, 16, 18, 15, 4, NULL, NULL),
(3926, 123, 16, 18, 16, 4, NULL, NULL),
(3927, 123, 16, 18, 17, 4, NULL, NULL),
(3928, 123, 16, 18, 18, 4, NULL, NULL),
(3929, 123, 16, 18, 19, 5, NULL, NULL),
(3930, 123, 16, 18, 20, 5, NULL, NULL),
(3931, 123, 16, 18, 21, 4, NULL, NULL),
(3932, 123, 16, 18, 22, 5, NULL, NULL),
(3933, 123, 16, 18, 23, 4, NULL, NULL),
(3934, 123, 16, 18, 24, 4, NULL, NULL),
(3935, 123, 16, 18, 25, 5, NULL, NULL),
(3936, 123, 16, 18, 26, 4, NULL, NULL),
(3937, 123, 16, 18, 27, 4, NULL, NULL),
(3938, 123, 16, 18, 28, 5, NULL, NULL),
(3939, 123, 16, 18, 29, 4, NULL, NULL),
(3940, 123, 16, 18, 30, 4, NULL, NULL),
(3941, 123, 16, 18, 31, 5, NULL, NULL),
(3942, 123, 16, 18, 32, 5, NULL, NULL),
(3943, 123, 16, 18, 33, 4, NULL, NULL),
(3944, 123, 16, 18, 34, 5, NULL, NULL),
(3945, 123, 15, 3, 1, 5, NULL, NULL),
(3946, 123, 15, 3, 2, 4, NULL, NULL),
(3947, 123, 15, 3, 3, 4, NULL, NULL),
(3948, 123, 15, 3, 4, 4, NULL, NULL),
(3949, 123, 15, 3, 5, 5, NULL, NULL),
(3950, 123, 15, 3, 6, 4, NULL, NULL),
(3951, 123, 15, 3, 7, 4, NULL, NULL),
(3952, 123, 15, 3, 8, 5, NULL, NULL),
(3953, 123, 15, 3, 9, 4, NULL, NULL),
(3954, 123, 15, 3, 10, 4, NULL, NULL),
(3955, 123, 15, 3, 11, 4, NULL, NULL),
(3956, 123, 15, 3, 12, 4, NULL, NULL),
(3957, 123, 15, 3, 13, 4, NULL, NULL),
(3958, 123, 15, 3, 14, 4, NULL, NULL),
(3959, 123, 15, 3, 15, 5, NULL, NULL),
(3960, 123, 15, 3, 16, 5, NULL, NULL),
(3961, 123, 15, 3, 17, 5, NULL, NULL),
(3962, 123, 15, 3, 18, 5, NULL, NULL),
(3963, 123, 15, 3, 19, 4, NULL, NULL),
(3964, 123, 15, 3, 20, 4, NULL, NULL),
(3965, 123, 15, 3, 21, 5, NULL, NULL),
(3966, 123, 15, 3, 22, 4, NULL, NULL),
(3967, 123, 15, 3, 23, 5, NULL, NULL),
(3968, 123, 15, 3, 24, 4, NULL, NULL),
(3969, 123, 15, 3, 25, 4, NULL, NULL),
(3970, 123, 15, 3, 26, 4, NULL, NULL),
(3971, 123, 15, 3, 27, 5, NULL, NULL),
(3972, 123, 15, 3, 28, 5, NULL, NULL),
(3973, 123, 15, 3, 29, 5, NULL, NULL),
(3974, 123, 15, 3, 30, 5, NULL, NULL),
(3975, 123, 15, 3, 31, 4, NULL, NULL),
(3976, 123, 15, 3, 32, 4, NULL, NULL),
(3977, 123, 15, 3, 33, 4, NULL, NULL),
(3978, 123, 15, 3, 34, 4, NULL, NULL),
(3979, 123, 16, 3, 1, 4, NULL, NULL),
(3980, 123, 16, 3, 2, 4, NULL, NULL),
(3981, 123, 16, 3, 3, 3, NULL, NULL),
(3982, 123, 16, 3, 4, 5, NULL, NULL),
(3983, 123, 16, 3, 5, 3, NULL, NULL),
(3984, 123, 16, 3, 6, 5, NULL, NULL),
(3985, 123, 16, 3, 7, 4, NULL, NULL),
(3986, 123, 16, 3, 8, 4, NULL, NULL),
(3987, 123, 16, 3, 9, 4, NULL, NULL),
(3988, 123, 16, 3, 10, 4, NULL, NULL),
(3989, 123, 16, 3, 11, 4, NULL, NULL),
(3990, 123, 16, 3, 12, 4, NULL, NULL),
(3991, 123, 16, 3, 13, 4, NULL, NULL),
(3992, 123, 16, 3, 14, 4, NULL, NULL),
(3993, 123, 16, 3, 15, 4, NULL, NULL),
(3994, 123, 16, 3, 16, 5, NULL, NULL),
(3995, 123, 16, 3, 17, 4, NULL, NULL),
(3996, 123, 16, 3, 18, 5, NULL, NULL),
(3997, 123, 16, 3, 19, 4, NULL, NULL),
(3998, 123, 16, 3, 20, 5, NULL, NULL),
(3999, 123, 16, 3, 21, 3, NULL, NULL),
(4000, 123, 16, 3, 22, 4, NULL, NULL),
(4001, 123, 16, 3, 23, 5, NULL, NULL),
(4002, 123, 16, 3, 24, 5, NULL, NULL),
(4003, 123, 16, 3, 25, 5, NULL, NULL),
(4004, 123, 16, 3, 26, 4, NULL, NULL),
(4005, 123, 16, 3, 27, 4, NULL, NULL),
(4006, 123, 16, 3, 28, 4, NULL, NULL),
(4007, 123, 16, 3, 29, 4, NULL, NULL),
(4008, 123, 16, 3, 30, 4, NULL, NULL),
(4009, 123, 16, 3, 31, 3, NULL, NULL),
(4010, 123, 16, 3, 32, 4, NULL, NULL),
(4011, 123, 16, 3, 33, 5, NULL, NULL),
(4012, 123, 16, 3, 34, 3, NULL, NULL),
(4013, 123, 18, 3, 1, 5, NULL, NULL),
(4014, 123, 18, 3, 2, 5, NULL, NULL),
(4015, 123, 18, 3, 3, 4, NULL, NULL),
(4016, 123, 18, 3, 4, 5, NULL, NULL),
(4017, 123, 18, 3, 5, 5, NULL, NULL),
(4018, 123, 18, 3, 6, 5, NULL, NULL),
(4019, 123, 18, 3, 7, 4, NULL, NULL),
(4020, 123, 18, 3, 8, 4, NULL, NULL),
(4021, 123, 18, 3, 9, 4, NULL, NULL),
(4022, 123, 18, 3, 10, 5, NULL, NULL),
(4023, 123, 18, 3, 11, 5, NULL, NULL),
(4024, 123, 18, 3, 12, 4, NULL, NULL),
(4025, 123, 18, 3, 13, 5, NULL, NULL),
(4026, 123, 18, 3, 14, 4, NULL, NULL),
(4027, 123, 18, 3, 15, 4, NULL, NULL),
(4028, 123, 18, 3, 16, 4, NULL, NULL),
(4029, 123, 18, 3, 17, 5, NULL, NULL),
(4030, 123, 18, 3, 18, 4, NULL, NULL),
(4031, 123, 18, 3, 19, 4, NULL, NULL),
(4032, 123, 18, 3, 20, 5, NULL, NULL),
(4033, 123, 18, 3, 21, 4, NULL, NULL),
(4034, 123, 18, 3, 22, 5, NULL, NULL),
(4035, 123, 18, 3, 23, 5, NULL, NULL),
(4036, 123, 18, 3, 24, 4, NULL, NULL),
(4037, 123, 18, 3, 25, 4, NULL, NULL),
(4038, 123, 18, 3, 26, 4, NULL, NULL),
(4039, 123, 18, 3, 27, 4, NULL, NULL),
(4040, 123, 18, 3, 28, 4, NULL, NULL),
(4041, 123, 18, 3, 29, 4, NULL, NULL),
(4042, 123, 18, 3, 30, 5, NULL, NULL),
(4043, 123, 18, 3, 31, 4, NULL, NULL),
(4044, 123, 18, 3, 32, 4, NULL, NULL),
(4045, 123, 18, 3, 33, 5, NULL, NULL),
(4046, 123, 18, 3, 34, 4, NULL, NULL),
(4047, 123, 16, 15, 1, 4, NULL, NULL),
(4048, 123, 16, 15, 2, 4, NULL, NULL),
(4049, 123, 16, 15, 3, 3, NULL, NULL),
(4050, 123, 16, 15, 4, 3, NULL, NULL),
(4051, 123, 16, 15, 5, 3, NULL, NULL),
(4052, 123, 16, 15, 6, 5, NULL, NULL),
(4053, 123, 16, 15, 7, 4, NULL, NULL),
(4054, 123, 16, 15, 8, 3, NULL, NULL),
(4055, 123, 16, 15, 9, 3, NULL, NULL),
(4056, 123, 16, 15, 10, 4, NULL, NULL),
(4057, 123, 16, 15, 11, 3, NULL, NULL),
(4058, 123, 16, 15, 12, 3, NULL, NULL),
(4059, 123, 16, 15, 13, 3, NULL, NULL),
(4060, 123, 16, 15, 14, 4, NULL, NULL),
(4061, 123, 16, 15, 15, 4, NULL, NULL),
(4062, 123, 16, 15, 16, 4, NULL, NULL),
(4063, 123, 16, 15, 17, 5, NULL, NULL),
(4064, 123, 16, 15, 18, 4, NULL, NULL),
(4065, 123, 16, 15, 19, 3, NULL, NULL),
(4066, 123, 16, 15, 20, 4, NULL, NULL),
(4067, 123, 16, 15, 21, 4, NULL, NULL),
(4068, 123, 16, 15, 22, 3, NULL, NULL),
(4069, 123, 16, 15, 23, 3, NULL, NULL),
(4070, 123, 16, 15, 24, 3, NULL, NULL),
(4071, 123, 16, 15, 25, 4, NULL, NULL),
(4072, 123, 16, 15, 26, 4, NULL, NULL),
(4073, 123, 16, 15, 27, 3, NULL, NULL),
(4074, 123, 16, 15, 28, 4, NULL, NULL),
(4075, 123, 16, 15, 29, 4, NULL, NULL),
(4076, 123, 16, 15, 30, 3, NULL, NULL),
(4077, 123, 16, 15, 31, 4, NULL, NULL),
(4078, 123, 16, 15, 32, 3, NULL, NULL),
(4079, 123, 16, 15, 33, 4, NULL, NULL),
(4080, 123, 16, 15, 34, 4, NULL, NULL),
(4081, 123, 18, 15, 1, 5, NULL, NULL),
(4082, 123, 18, 15, 2, 5, NULL, NULL),
(4083, 123, 18, 15, 3, 5, NULL, NULL),
(4084, 123, 18, 15, 4, 4, NULL, NULL),
(4085, 123, 18, 15, 5, 3, NULL, NULL),
(4086, 123, 18, 15, 6, 4, NULL, NULL),
(4087, 123, 18, 15, 7, 4, NULL, NULL),
(4088, 123, 18, 15, 8, 4, NULL, NULL),
(4089, 123, 18, 15, 9, 4, NULL, NULL),
(4090, 123, 18, 15, 10, 4, NULL, NULL),
(4091, 123, 18, 15, 11, 3, NULL, NULL),
(4092, 123, 18, 15, 12, 4, NULL, NULL),
(4093, 123, 18, 15, 13, 3, NULL, NULL),
(4094, 123, 18, 15, 14, 4, NULL, NULL),
(4095, 123, 18, 15, 15, 4, NULL, NULL),
(4096, 123, 18, 15, 16, 4, NULL, NULL),
(4097, 123, 18, 15, 17, 4, NULL, NULL),
(4098, 123, 18, 15, 18, 4, NULL, NULL),
(4099, 123, 18, 15, 19, 4, NULL, NULL),
(4100, 123, 18, 15, 20, 4, NULL, NULL),
(4101, 123, 18, 15, 21, 4, NULL, NULL),
(4102, 123, 18, 15, 22, 5, NULL, NULL),
(4103, 123, 18, 15, 23, 4, NULL, NULL),
(4104, 123, 18, 15, 24, 4, NULL, NULL),
(4105, 123, 18, 15, 25, 3, NULL, NULL),
(4106, 123, 18, 15, 26, 3, NULL, NULL),
(4107, 123, 18, 15, 27, 4, NULL, NULL),
(4108, 123, 18, 15, 28, 5, NULL, NULL),
(4109, 123, 18, 15, 29, 3, NULL, NULL),
(4110, 123, 18, 15, 30, 3, NULL, NULL),
(4111, 123, 18, 15, 31, 5, NULL, NULL),
(4112, 123, 18, 15, 32, 4, NULL, NULL),
(4113, 123, 18, 15, 33, 3, NULL, NULL),
(4114, 123, 18, 15, 34, 4, NULL, NULL),
(4115, 123, 18, 16, 1, 4, NULL, NULL),
(4116, 123, 18, 16, 2, 4, NULL, NULL),
(4117, 123, 18, 16, 3, 4, NULL, NULL),
(4118, 123, 18, 16, 4, 3, NULL, NULL),
(4119, 123, 18, 16, 5, 3, NULL, NULL),
(4120, 123, 18, 16, 6, 3, NULL, NULL),
(4121, 123, 18, 16, 7, 4, NULL, NULL),
(4122, 123, 18, 16, 8, 3, NULL, NULL),
(4123, 123, 18, 16, 9, 4, NULL, NULL),
(4124, 123, 18, 16, 10, 3, NULL, NULL),
(4125, 123, 18, 16, 11, 4, NULL, NULL),
(4126, 123, 18, 16, 12, 4, NULL, NULL),
(4127, 123, 18, 16, 13, 4, NULL, NULL),
(4128, 123, 18, 16, 14, 5, NULL, NULL),
(4129, 123, 18, 16, 15, 5, NULL, NULL),
(4130, 123, 18, 16, 16, 5, NULL, NULL),
(4131, 123, 18, 16, 17, 5, NULL, NULL),
(4132, 123, 18, 16, 18, 5, NULL, NULL),
(4133, 123, 18, 16, 19, 4, NULL, NULL),
(4134, 123, 18, 16, 20, 5, NULL, NULL),
(4135, 123, 18, 16, 21, 4, NULL, NULL),
(4136, 123, 18, 16, 22, 5, NULL, NULL),
(4137, 123, 18, 16, 23, 4, NULL, NULL),
(4138, 123, 18, 16, 24, 4, NULL, NULL),
(4139, 123, 18, 16, 25, 4, NULL, NULL),
(4140, 123, 18, 16, 26, 5, NULL, NULL),
(4141, 123, 18, 16, 27, 4, NULL, NULL),
(4142, 123, 18, 16, 28, 3, NULL, NULL),
(4143, 123, 18, 16, 29, 5, NULL, NULL),
(4144, 123, 18, 16, 30, 4, NULL, NULL),
(4145, 123, 18, 16, 31, 4, NULL, NULL),
(4146, 123, 18, 16, 32, 5, NULL, NULL),
(4147, 123, 18, 16, 33, 4, NULL, NULL),
(4148, 123, 18, 16, 34, 4, NULL, NULL),
(4149, 123, 3, 19, 1, 3, NULL, NULL),
(4150, 123, 3, 19, 2, 3, NULL, NULL),
(4151, 123, 3, 19, 3, 4, NULL, NULL),
(4152, 123, 3, 19, 4, 3, NULL, NULL),
(4153, 123, 3, 19, 5, 4, NULL, NULL),
(4154, 123, 3, 19, 6, 3, NULL, NULL),
(4155, 123, 3, 19, 7, 4, NULL, NULL),
(4156, 123, 3, 19, 8, 4, NULL, NULL),
(4157, 123, 3, 19, 9, 3, NULL, NULL),
(4158, 123, 3, 19, 10, 4, NULL, NULL),
(4159, 123, 3, 19, 11, 4, NULL, NULL),
(4160, 123, 3, 19, 12, 3, NULL, NULL),
(4161, 123, 3, 19, 13, 4, NULL, NULL),
(4162, 123, 3, 19, 14, 4, NULL, NULL),
(4163, 123, 3, 19, 15, 4, NULL, NULL),
(4164, 123, 3, 19, 16, 5, NULL, NULL),
(4165, 123, 3, 19, 17, 4, NULL, NULL),
(4166, 123, 3, 19, 18, 5, NULL, NULL),
(4167, 123, 3, 19, 19, 4, NULL, NULL),
(4168, 123, 3, 19, 20, 4, NULL, NULL),
(4169, 123, 3, 19, 21, 4, NULL, NULL),
(4170, 123, 3, 19, 22, 3, NULL, NULL),
(4171, 123, 3, 19, 23, 4, NULL, NULL),
(4172, 123, 3, 19, 24, 5, NULL, NULL),
(4173, 123, 3, 19, 25, 3, NULL, NULL),
(4174, 123, 3, 19, 26, 3, NULL, NULL),
(4175, 123, 3, 19, 27, 4, NULL, NULL),
(4176, 123, 3, 19, 28, 3, NULL, NULL),
(4177, 123, 3, 19, 29, 4, NULL, NULL),
(4178, 123, 3, 19, 30, 3, NULL, NULL),
(4179, 123, 3, 19, 31, 5, NULL, NULL),
(4180, 123, 3, 19, 32, 4, NULL, NULL),
(4181, 123, 3, 19, 33, 5, NULL, NULL),
(4182, 123, 3, 19, 34, 5, NULL, NULL),
(4183, 123, 15, 19, 1, 5, NULL, NULL),
(4184, 123, 15, 19, 2, 3, NULL, NULL),
(4185, 123, 15, 19, 3, 5, NULL, NULL),
(4186, 123, 15, 19, 4, 4, NULL, NULL),
(4187, 123, 15, 19, 5, 5, NULL, NULL),
(4188, 123, 15, 19, 6, 4, NULL, NULL),
(4189, 123, 15, 19, 7, 5, NULL, NULL),
(4190, 123, 15, 19, 8, 3, NULL, NULL),
(4191, 123, 15, 19, 9, 3, NULL, NULL),
(4192, 123, 15, 19, 10, 3, NULL, NULL),
(4193, 123, 15, 19, 11, 4, NULL, NULL),
(4194, 123, 15, 19, 12, 3, NULL, NULL),
(4195, 123, 15, 19, 13, 5, NULL, NULL),
(4196, 123, 15, 19, 14, 5, NULL, NULL),
(4197, 123, 15, 19, 15, 4, NULL, NULL),
(4198, 123, 15, 19, 16, 3, NULL, NULL),
(4199, 123, 15, 19, 17, 5, NULL, NULL),
(4200, 123, 15, 19, 18, 4, NULL, NULL),
(4201, 123, 15, 19, 19, 3, NULL, NULL),
(4202, 123, 15, 19, 20, 3, NULL, NULL),
(4203, 123, 15, 19, 21, 5, NULL, NULL),
(4204, 123, 15, 19, 22, 3, NULL, NULL),
(4205, 123, 15, 19, 23, 4, NULL, NULL),
(4206, 123, 15, 19, 24, 5, NULL, NULL),
(4207, 123, 15, 19, 25, 5, NULL, NULL),
(4208, 123, 15, 19, 26, 4, NULL, NULL),
(4209, 123, 15, 19, 27, 3, NULL, NULL),
(4210, 123, 15, 19, 28, 4, NULL, NULL),
(4211, 123, 15, 19, 29, 3, NULL, NULL),
(4212, 123, 15, 19, 30, 3, NULL, NULL),
(4213, 123, 15, 19, 31, 4, NULL, NULL),
(4214, 123, 15, 19, 32, 4, NULL, NULL),
(4215, 123, 15, 19, 33, 3, NULL, NULL),
(4216, 123, 15, 19, 34, 3, NULL, NULL),
(4217, 123, 16, 19, 1, 4, NULL, NULL),
(4218, 123, 16, 19, 2, 5, NULL, NULL),
(4219, 123, 16, 19, 3, 4, NULL, NULL),
(4220, 123, 16, 19, 4, 5, NULL, NULL),
(4221, 123, 16, 19, 5, 4, NULL, NULL),
(4222, 123, 16, 19, 6, 5, NULL, NULL),
(4223, 123, 16, 19, 7, 4, NULL, NULL),
(4224, 123, 16, 19, 8, 5, NULL, NULL),
(4225, 123, 16, 19, 9, 4, NULL, NULL),
(4226, 123, 16, 19, 10, 4, NULL, NULL),
(4227, 123, 16, 19, 11, 5, NULL, NULL),
(4228, 123, 16, 19, 12, 4, NULL, NULL),
(4229, 123, 16, 19, 13, 5, NULL, NULL),
(4230, 123, 16, 19, 14, 5, NULL, NULL),
(4231, 123, 16, 19, 15, 4, NULL, NULL),
(4232, 123, 16, 19, 16, 4, NULL, NULL),
(4233, 123, 16, 19, 17, 4, NULL, NULL),
(4234, 123, 16, 19, 18, 4, NULL, NULL),
(4235, 123, 16, 19, 19, 5, NULL, NULL),
(4236, 123, 16, 19, 20, 4, NULL, NULL),
(4237, 123, 16, 19, 21, 4, NULL, NULL),
(4238, 123, 16, 19, 22, 5, NULL, NULL),
(4239, 123, 16, 19, 23, 4, NULL, NULL),
(4240, 123, 16, 19, 24, 4, NULL, NULL),
(4241, 123, 16, 19, 25, 4, NULL, NULL),
(4242, 123, 16, 19, 26, 4, NULL, NULL),
(4243, 123, 16, 19, 27, 4, NULL, NULL),
(4244, 123, 16, 19, 28, 5, NULL, NULL),
(4245, 123, 16, 19, 29, 5, NULL, NULL),
(4246, 123, 16, 19, 30, 4, NULL, NULL),
(4247, 123, 16, 19, 31, 4, NULL, NULL),
(4248, 123, 16, 19, 32, 5, NULL, NULL),
(4249, 123, 16, 19, 33, 5, NULL, NULL),
(4250, 123, 16, 19, 34, 4, NULL, NULL),
(4251, 123, 18, 19, 1, 3, NULL, NULL),
(4252, 123, 18, 19, 2, 4, NULL, NULL),
(4253, 123, 18, 19, 3, 4, NULL, NULL),
(4254, 123, 18, 19, 4, 4, NULL, NULL),
(4255, 123, 18, 19, 5, 3, NULL, NULL),
(4256, 123, 18, 19, 6, 3, NULL, NULL),
(4257, 123, 18, 19, 7, 5, NULL, NULL),
(4258, 123, 18, 19, 8, 5, NULL, NULL),
(4259, 123, 18, 19, 9, 4, NULL, NULL),
(4260, 123, 18, 19, 10, 4, NULL, NULL),
(4261, 123, 18, 19, 11, 4, NULL, NULL),
(4262, 123, 18, 19, 12, 4, NULL, NULL),
(4263, 123, 18, 19, 13, 5, NULL, NULL),
(4264, 123, 18, 19, 14, 4, NULL, NULL),
(4265, 123, 18, 19, 15, 4, NULL, NULL),
(4266, 123, 18, 19, 16, 5, NULL, NULL),
(4267, 123, 18, 19, 17, 3, NULL, NULL),
(4268, 123, 18, 19, 18, 4, NULL, NULL),
(4269, 123, 18, 19, 19, 4, NULL, NULL),
(4270, 123, 18, 19, 20, 4, NULL, NULL),
(4271, 123, 18, 19, 21, 5, NULL, NULL),
(4272, 123, 18, 19, 22, 3, NULL, NULL),
(4273, 123, 18, 19, 23, 5, NULL, NULL),
(4274, 123, 18, 19, 24, 4, NULL, NULL),
(4275, 123, 18, 19, 25, 5, NULL, NULL),
(4276, 123, 18, 19, 26, 4, NULL, NULL),
(4277, 123, 18, 19, 27, 4, NULL, NULL),
(4278, 123, 18, 19, 28, 4, NULL, NULL),
(4279, 123, 18, 19, 29, 4, NULL, NULL),
(4280, 123, 18, 19, 30, 4, NULL, NULL),
(4281, 123, 18, 19, 31, 5, NULL, NULL),
(4282, 123, 18, 19, 32, 3, NULL, NULL),
(4283, 123, 18, 19, 33, 5, NULL, NULL),
(4284, 123, 18, 19, 34, 4, NULL, NULL),
(4285, 132, 1, 3, 1, 4, NULL, NULL),
(4286, 132, 1, 3, 2, 5, NULL, NULL),
(4287, 132, 1, 3, 3, 4, NULL, NULL),
(4288, 132, 1, 3, 4, 4, NULL, NULL),
(4289, 132, 1, 3, 5, 4, NULL, NULL),
(4290, 132, 1, 3, 6, 4, NULL, NULL),
(4291, 132, 1, 3, 7, 4, NULL, NULL),
(4292, 132, 1, 3, 8, 4, NULL, NULL),
(4293, 132, 1, 3, 9, 4, NULL, NULL),
(4294, 132, 1, 3, 10, 4, NULL, NULL),
(4295, 132, 1, 3, 11, 3, NULL, NULL),
(4296, 132, 1, 3, 12, 4, NULL, NULL),
(4297, 132, 1, 3, 13, 4, NULL, NULL),
(4298, 132, 1, 3, 14, 4, NULL, NULL),
(4299, 132, 1, 3, 15, 4, NULL, NULL),
(4300, 132, 1, 3, 16, 5, NULL, NULL),
(4301, 132, 1, 3, 17, 5, NULL, NULL),
(4302, 132, 1, 3, 18, 5, NULL, NULL),
(4303, 132, 1, 3, 19, 5, NULL, NULL),
(4304, 132, 1, 3, 20, 4, NULL, NULL),
(4305, 132, 1, 3, 21, 4, NULL, NULL),
(4306, 132, 1, 3, 22, 4, NULL, NULL),
(4307, 132, 1, 3, 23, 5, NULL, NULL),
(4308, 132, 1, 3, 24, 4, NULL, NULL),
(4309, 132, 1, 3, 25, 4, NULL, NULL),
(4310, 132, 1, 3, 26, 5, NULL, NULL),
(4311, 132, 1, 3, 27, 4, NULL, NULL),
(4312, 132, 1, 3, 28, 4, NULL, NULL),
(4313, 132, 1, 3, 29, 4, NULL, NULL),
(4314, 132, 1, 3, 30, 4, NULL, NULL),
(4315, 132, 1, 3, 31, 5, NULL, NULL),
(4316, 132, 1, 3, 32, 4, NULL, NULL),
(4317, 132, 1, 3, 33, 4, NULL, NULL),
(4318, 132, 1, 3, 34, 4, NULL, NULL),
(4319, 132, 1, 2, 1, 4, NULL, NULL),
(4320, 132, 1, 2, 2, 5, NULL, NULL),
(4321, 132, 1, 2, 3, 3, NULL, NULL),
(4322, 132, 1, 2, 4, 4, NULL, NULL),
(4323, 132, 1, 2, 5, 4, NULL, NULL),
(4324, 132, 1, 2, 6, 5, NULL, NULL),
(4325, 132, 1, 2, 7, 5, NULL, NULL),
(4326, 132, 1, 2, 8, 5, NULL, NULL),
(4327, 132, 1, 2, 9, 4, NULL, NULL),
(4328, 132, 1, 2, 10, 5, NULL, NULL),
(4329, 132, 1, 2, 11, 4, NULL, NULL),
(4330, 132, 1, 2, 12, 5, NULL, NULL),
(4331, 132, 1, 2, 13, 4, NULL, NULL),
(4332, 132, 1, 2, 14, 4, NULL, NULL),
(4333, 132, 1, 2, 15, 3, NULL, NULL),
(4334, 132, 1, 2, 16, 5, NULL, NULL),
(4335, 132, 1, 2, 17, 5, NULL, NULL),
(4336, 132, 1, 2, 18, 4, NULL, NULL),
(4337, 132, 1, 2, 19, 4, NULL, NULL),
(4338, 132, 1, 2, 20, 5, NULL, NULL),
(4339, 132, 1, 2, 21, 5, NULL, NULL),
(4340, 132, 1, 2, 22, 3, NULL, NULL),
(4341, 132, 1, 2, 23, 4, NULL, NULL),
(4342, 132, 1, 2, 24, 4, NULL, NULL),
(4343, 132, 1, 2, 25, 5, NULL, NULL),
(4344, 132, 1, 2, 26, 4, NULL, NULL),
(4345, 132, 1, 2, 27, 5, NULL, NULL),
(4346, 132, 1, 2, 28, 5, NULL, NULL),
(4347, 132, 1, 2, 29, 4, NULL, NULL),
(4348, 132, 1, 2, 30, 5, NULL, NULL),
(4349, 132, 1, 2, 31, 4, NULL, NULL),
(4350, 132, 1, 2, 32, 5, NULL, NULL),
(4351, 132, 1, 2, 33, 4, NULL, NULL),
(4352, 132, 1, 2, 34, 5, NULL, NULL),
(4353, 132, 3, 2, 1, 5, NULL, NULL),
(4354, 132, 3, 2, 2, 5, NULL, NULL),
(4355, 132, 3, 2, 3, 5, NULL, NULL),
(4356, 132, 3, 2, 4, 4, NULL, NULL),
(4357, 132, 3, 2, 5, 4, NULL, NULL),
(4358, 132, 3, 2, 6, 4, NULL, NULL),
(4359, 132, 3, 2, 7, 5, NULL, NULL),
(4360, 132, 3, 2, 8, 4, NULL, NULL),
(4361, 132, 3, 2, 9, 4, NULL, NULL),
(4362, 132, 3, 2, 10, 4, NULL, NULL),
(4363, 132, 3, 2, 11, 5, NULL, NULL),
(4364, 132, 3, 2, 12, 5, NULL, NULL),
(4365, 132, 3, 2, 13, 4, NULL, NULL),
(4366, 132, 3, 2, 14, 4, NULL, NULL),
(4367, 132, 3, 2, 15, 4, NULL, NULL),
(4368, 132, 3, 2, 16, 4, NULL, NULL),
(4369, 132, 3, 2, 17, 4, NULL, NULL),
(4370, 132, 3, 2, 18, 4, NULL, NULL),
(4371, 132, 3, 2, 19, 4, NULL, NULL),
(4372, 132, 3, 2, 20, 5, NULL, NULL),
(4373, 132, 3, 2, 21, 4, NULL, NULL),
(4374, 132, 3, 2, 22, 4, NULL, NULL),
(4375, 132, 3, 2, 23, 4, NULL, NULL),
(4376, 132, 3, 2, 24, 5, NULL, NULL),
(4377, 132, 3, 2, 25, 5, NULL, NULL),
(4378, 132, 3, 2, 26, 4, NULL, NULL),
(4379, 132, 3, 2, 27, 4, NULL, NULL),
(4380, 132, 3, 2, 28, 4, NULL, NULL),
(4381, 132, 3, 2, 29, 5, NULL, NULL),
(4382, 132, 3, 2, 30, 4, NULL, NULL),
(4383, 132, 3, 2, 31, 4, NULL, NULL),
(4384, 132, 3, 2, 32, 4, NULL, NULL),
(4385, 132, 3, 2, 33, 5, NULL, NULL),
(4386, 132, 3, 2, 34, 4, NULL, NULL),
(4387, 132, 1, 15, 1, 5, NULL, NULL),
(4388, 132, 1, 15, 2, 4, NULL, NULL),
(4389, 132, 1, 15, 3, 4, NULL, NULL),
(4390, 132, 1, 15, 4, 5, NULL, NULL),
(4391, 132, 1, 15, 5, 4, NULL, NULL),
(4392, 132, 1, 15, 6, 4, NULL, NULL),
(4393, 132, 1, 15, 7, 5, NULL, NULL),
(4394, 132, 1, 15, 8, 5, NULL, NULL),
(4395, 132, 1, 15, 9, 4, NULL, NULL),
(4396, 132, 1, 15, 10, 5, NULL, NULL),
(4397, 132, 1, 15, 11, 4, NULL, NULL),
(4398, 132, 1, 15, 12, 5, NULL, NULL),
(4399, 132, 1, 15, 13, 4, NULL, NULL),
(4400, 132, 1, 15, 14, 4, NULL, NULL),
(4401, 132, 1, 15, 15, 4, NULL, NULL),
(4402, 132, 1, 15, 16, 4, NULL, NULL),
(4403, 132, 1, 15, 17, 5, NULL, NULL),
(4404, 132, 1, 15, 18, 5, NULL, NULL),
(4405, 132, 1, 15, 19, 4, NULL, NULL),
(4406, 132, 1, 15, 20, 5, NULL, NULL),
(4407, 132, 1, 15, 21, 5, NULL, NULL),
(4408, 132, 1, 15, 22, 4, NULL, NULL),
(4409, 132, 1, 15, 23, 4, NULL, NULL),
(4410, 132, 1, 15, 24, 4, NULL, NULL),
(4411, 132, 1, 15, 25, 4, NULL, NULL),
(4412, 132, 1, 15, 26, 4, NULL, NULL),
(4413, 132, 1, 15, 27, 4, NULL, NULL),
(4414, 132, 1, 15, 28, 4, NULL, NULL),
(4415, 132, 1, 15, 29, 4, NULL, NULL),
(4416, 132, 1, 15, 30, 4, NULL, NULL),
(4417, 132, 1, 15, 31, 4, NULL, NULL),
(4418, 132, 1, 15, 32, 5, NULL, NULL),
(4419, 132, 1, 15, 33, 4, NULL, NULL),
(4420, 132, 1, 15, 34, 5, NULL, NULL),
(4421, 132, 2, 15, 1, 5, NULL, NULL),
(4422, 132, 2, 15, 2, 4, NULL, NULL),
(4423, 132, 2, 15, 3, 4, NULL, NULL),
(4424, 132, 2, 15, 4, 5, NULL, NULL),
(4425, 132, 2, 15, 5, 4, NULL, NULL),
(4426, 132, 2, 15, 6, 5, NULL, NULL),
(4427, 132, 2, 15, 7, 4, NULL, NULL),
(4428, 132, 2, 15, 8, 5, NULL, NULL),
(4429, 132, 2, 15, 9, 5, NULL, NULL),
(4430, 132, 2, 15, 10, 5, NULL, NULL),
(4431, 132, 2, 15, 11, 5, NULL, NULL),
(4432, 132, 2, 15, 12, 4, NULL, NULL),
(4433, 132, 2, 15, 13, 4, NULL, NULL),
(4434, 132, 2, 15, 14, 5, NULL, NULL),
(4435, 132, 2, 15, 15, 5, NULL, NULL),
(4436, 132, 2, 15, 16, 5, NULL, NULL),
(4437, 132, 2, 15, 17, 4, NULL, NULL),
(4438, 132, 2, 15, 18, 4, NULL, NULL),
(4439, 132, 2, 15, 19, 4, NULL, NULL),
(4440, 132, 2, 15, 20, 4, NULL, NULL),
(4441, 132, 2, 15, 21, 5, NULL, NULL),
(4442, 132, 2, 15, 22, 5, NULL, NULL),
(4443, 132, 2, 15, 23, 4, NULL, NULL),
(4444, 132, 2, 15, 24, 5, NULL, NULL),
(4445, 132, 2, 15, 25, 4, NULL, NULL),
(4446, 132, 2, 15, 26, 4, NULL, NULL),
(4447, 132, 2, 15, 27, 4, NULL, NULL),
(4448, 132, 2, 15, 28, 5, NULL, NULL),
(4449, 132, 2, 15, 29, 4, NULL, NULL),
(4450, 132, 2, 15, 30, 5, NULL, NULL),
(4451, 132, 2, 15, 31, 4, NULL, NULL),
(4452, 132, 2, 15, 32, 5, NULL, NULL),
(4453, 132, 2, 15, 33, 5, NULL, NULL),
(4454, 132, 2, 15, 34, 5, NULL, NULL),
(4455, 132, 15, 3, 1, 4, NULL, NULL),
(4456, 132, 15, 3, 2, 5, NULL, NULL),
(4457, 132, 15, 3, 3, 4, NULL, NULL),
(4458, 132, 15, 3, 4, 5, NULL, NULL),
(4459, 132, 15, 3, 5, 4, NULL, NULL),
(4460, 132, 15, 3, 6, 4, NULL, NULL),
(4461, 132, 15, 3, 7, 4, NULL, NULL),
(4462, 132, 15, 3, 8, 4, NULL, NULL),
(4463, 132, 15, 3, 9, 4, NULL, NULL),
(4464, 132, 15, 3, 10, 4, NULL, NULL),
(4465, 132, 15, 3, 11, 5, NULL, NULL),
(4466, 132, 15, 3, 12, 4, NULL, NULL),
(4467, 132, 15, 3, 13, 5, NULL, NULL),
(4468, 132, 15, 3, 14, 4, NULL, NULL),
(4469, 132, 15, 3, 15, 5, NULL, NULL),
(4470, 132, 15, 3, 16, 4, NULL, NULL),
(4471, 132, 15, 3, 17, 4, NULL, NULL),
(4472, 132, 15, 3, 18, 4, NULL, NULL),
(4473, 132, 15, 3, 19, 5, NULL, NULL),
(4474, 132, 15, 3, 20, 5, NULL, NULL),
(4475, 132, 15, 3, 21, 4, NULL, NULL),
(4476, 132, 15, 3, 22, 5, NULL, NULL),
(4477, 132, 15, 3, 23, 4, NULL, NULL),
(4478, 132, 15, 3, 24, 5, NULL, NULL),
(4479, 132, 15, 3, 25, 4, NULL, NULL),
(4480, 132, 15, 3, 26, 5, NULL, NULL),
(4481, 132, 15, 3, 27, 4, NULL, NULL),
(4482, 132, 15, 3, 28, 4, NULL, NULL),
(4483, 132, 15, 3, 29, 4, NULL, NULL),
(4484, 132, 15, 3, 30, 4, NULL, NULL),
(4485, 132, 15, 3, 31, 5, NULL, NULL),
(4486, 132, 15, 3, 32, 4, NULL, NULL),
(4487, 132, 15, 3, 33, 5, NULL, NULL),
(4488, 132, 15, 3, 34, 4, NULL, NULL),
(4489, 132, 2, 3, 1, 4, NULL, NULL),
(4490, 132, 2, 3, 2, 5, NULL, NULL),
(4491, 132, 2, 3, 3, 4, NULL, NULL),
(4492, 132, 2, 3, 4, 4, NULL, NULL),
(4493, 132, 2, 3, 5, 4, NULL, NULL),
(4494, 132, 2, 3, 6, 4, NULL, NULL),
(4495, 132, 2, 3, 7, 4, NULL, NULL),
(4496, 132, 2, 3, 8, 4, NULL, NULL),
(4497, 132, 2, 3, 9, 4, NULL, NULL),
(4498, 132, 2, 3, 10, 4, NULL, NULL),
(4499, 132, 2, 3, 11, 4, NULL, NULL),
(4500, 132, 2, 3, 12, 4, NULL, NULL),
(4501, 132, 2, 3, 13, 4, NULL, NULL),
(4502, 132, 2, 3, 14, 5, NULL, NULL),
(4503, 132, 2, 3, 15, 4, NULL, NULL),
(4504, 132, 2, 3, 16, 4, NULL, NULL),
(4505, 132, 2, 3, 17, 4, NULL, NULL),
(4506, 132, 2, 3, 18, 5, NULL, NULL),
(4507, 132, 2, 3, 19, 4, NULL, NULL),
(4508, 132, 2, 3, 20, 5, NULL, NULL),
(4509, 132, 2, 3, 21, 4, NULL, NULL),
(4510, 132, 2, 3, 22, 4, NULL, NULL),
(4511, 132, 2, 3, 23, 5, NULL, NULL),
(4512, 132, 2, 3, 24, 5, NULL, NULL),
(4513, 132, 2, 3, 25, 4, NULL, NULL),
(4514, 132, 2, 3, 26, 4, NULL, NULL),
(4515, 132, 2, 3, 27, 4, NULL, NULL),
(4516, 132, 2, 3, 28, 4, NULL, NULL),
(4517, 132, 2, 3, 29, 4, NULL, NULL),
(4518, 132, 2, 3, 30, 5, NULL, NULL),
(4519, 132, 2, 3, 31, 4, NULL, NULL),
(4520, 132, 2, 3, 32, 5, NULL, NULL),
(4521, 132, 2, 3, 33, 4, NULL, NULL),
(4522, 132, 2, 3, 34, 4, NULL, NULL),
(4523, 132, 15, 2, 1, 4, NULL, NULL),
(4524, 132, 15, 2, 2, 4, NULL, NULL),
(4525, 132, 15, 2, 3, 5, NULL, NULL),
(4526, 132, 15, 2, 4, 5, NULL, NULL),
(4527, 132, 15, 2, 5, 4, NULL, NULL),
(4528, 132, 15, 2, 6, 4, NULL, NULL),
(4529, 132, 15, 2, 7, 5, NULL, NULL),
(4530, 132, 15, 2, 8, 4, NULL, NULL),
(4531, 132, 15, 2, 9, 5, NULL, NULL),
(4532, 132, 15, 2, 10, 4, NULL, NULL),
(4533, 132, 15, 2, 11, 5, NULL, NULL),
(4534, 132, 15, 2, 12, 5, NULL, NULL),
(4535, 132, 15, 2, 13, 4, NULL, NULL),
(4536, 132, 15, 2, 14, 4, NULL, NULL),
(4537, 132, 15, 2, 15, 4, NULL, NULL),
(4538, 132, 15, 2, 16, 4, NULL, NULL),
(4539, 132, 15, 2, 17, 5, NULL, NULL),
(4540, 132, 15, 2, 18, 4, NULL, NULL),
(4541, 132, 15, 2, 19, 4, NULL, NULL),
(4542, 132, 15, 2, 20, 4, NULL, NULL),
(4543, 132, 15, 2, 21, 4, NULL, NULL),
(4544, 132, 15, 2, 22, 4, NULL, NULL),
(4545, 132, 15, 2, 23, 4, NULL, NULL),
(4546, 132, 15, 2, 24, 4, NULL, NULL),
(4547, 132, 15, 2, 25, 4, NULL, NULL),
(4548, 132, 15, 2, 26, 4, NULL, NULL),
(4549, 132, 15, 2, 27, 5, NULL, NULL),
(4550, 132, 15, 2, 28, 4, NULL, NULL),
(4551, 132, 15, 2, 29, 4, NULL, NULL),
(4552, 132, 15, 2, 30, 4, NULL, NULL),
(4553, 132, 15, 2, 31, 4, NULL, NULL),
(4554, 132, 15, 2, 32, 4, NULL, NULL),
(4555, 132, 15, 2, 33, 4, NULL, NULL),
(4556, 132, 15, 2, 34, 5, NULL, NULL),
(4557, 136, 2, 3, 1, 5, NULL, NULL),
(4558, 136, 2, 3, 2, 5, NULL, NULL),
(4559, 136, 2, 3, 3, 4, NULL, NULL),
(4560, 136, 2, 3, 4, 5, NULL, NULL),
(4561, 136, 2, 3, 5, 5, NULL, NULL),
(4562, 136, 2, 3, 6, 5, NULL, NULL),
(4563, 136, 2, 3, 7, 5, NULL, NULL),
(4564, 136, 2, 3, 8, 4, NULL, NULL),
(4565, 136, 2, 3, 9, 5, NULL, NULL),
(4566, 136, 2, 3, 10, 4, NULL, NULL),
(4567, 136, 2, 3, 11, 4, NULL, NULL),
(4568, 136, 2, 3, 12, 4, NULL, NULL),
(4569, 136, 2, 3, 13, 5, NULL, NULL),
(4570, 136, 2, 3, 14, 4, NULL, NULL),
(4571, 136, 2, 3, 15, 4, NULL, NULL),
(4572, 136, 2, 3, 16, 4, NULL, NULL),
(4573, 136, 2, 3, 17, 3, NULL, NULL),
(4574, 136, 2, 3, 18, 5, NULL, NULL),
(4575, 136, 2, 3, 19, 4, NULL, NULL),
(4576, 136, 2, 3, 20, 4, NULL, NULL),
(4577, 136, 2, 3, 21, 4, NULL, NULL),
(4578, 136, 2, 3, 22, 5, NULL, NULL),
(4579, 136, 2, 3, 23, 4, NULL, NULL),
(4580, 136, 2, 3, 24, 4, NULL, NULL);
INSERT INTO `peer_results` (`id`, `peer_survey_id`, `user_id`, `peer_id`, `indicator_id`, `answer`, `created_at`, `updated_at`) VALUES
(4581, 136, 2, 3, 25, 4, NULL, NULL),
(4582, 136, 2, 3, 26, 4, NULL, NULL),
(4583, 136, 2, 3, 27, 4, NULL, NULL),
(4584, 136, 2, 3, 28, 5, NULL, NULL),
(4585, 136, 2, 3, 29, 4, NULL, NULL),
(4586, 136, 2, 3, 30, 4, NULL, NULL),
(4587, 136, 2, 3, 31, 4, NULL, NULL),
(4588, 136, 2, 3, 32, 5, NULL, NULL),
(4589, 136, 2, 3, 33, 5, NULL, NULL),
(4590, 136, 2, 3, 34, 5, NULL, NULL),
(4591, 136, 3, 15, 1, 4, NULL, NULL),
(4592, 136, 3, 15, 2, 4, NULL, NULL),
(4593, 136, 3, 15, 3, 5, NULL, NULL),
(4594, 136, 3, 15, 4, 4, NULL, NULL),
(4595, 136, 3, 15, 5, 5, NULL, NULL),
(4596, 136, 3, 15, 6, 4, NULL, NULL),
(4597, 136, 3, 15, 7, 4, NULL, NULL),
(4598, 136, 3, 15, 8, 4, NULL, NULL),
(4599, 136, 3, 15, 9, 4, NULL, NULL),
(4600, 136, 3, 15, 10, 5, NULL, NULL),
(4601, 136, 3, 15, 11, 5, NULL, NULL),
(4602, 136, 3, 15, 12, 4, NULL, NULL),
(4603, 136, 3, 15, 13, 5, NULL, NULL),
(4604, 136, 3, 15, 14, 4, NULL, NULL),
(4605, 136, 3, 15, 15, 5, NULL, NULL),
(4606, 136, 3, 15, 16, 4, NULL, NULL),
(4607, 136, 3, 15, 17, 4, NULL, NULL),
(4608, 136, 3, 15, 18, 5, NULL, NULL),
(4609, 136, 3, 15, 19, 4, NULL, NULL),
(4610, 136, 3, 15, 20, 4, NULL, NULL),
(4611, 136, 3, 15, 21, 4, NULL, NULL),
(4612, 136, 3, 15, 22, 5, NULL, NULL),
(4613, 136, 3, 15, 23, 4, NULL, NULL),
(4614, 136, 3, 15, 24, 5, NULL, NULL),
(4615, 136, 3, 15, 25, 4, NULL, NULL),
(4616, 136, 3, 15, 26, 4, NULL, NULL),
(4617, 136, 3, 15, 27, 4, NULL, NULL),
(4618, 136, 3, 15, 28, 5, NULL, NULL),
(4619, 136, 3, 15, 29, 5, NULL, NULL),
(4620, 136, 3, 15, 30, 5, NULL, NULL),
(4621, 136, 3, 15, 31, 5, NULL, NULL),
(4622, 136, 3, 15, 32, 4, NULL, NULL),
(4623, 136, 3, 15, 33, 4, NULL, NULL),
(4624, 136, 3, 15, 34, 5, NULL, NULL),
(4625, 136, 2, 15, 1, 4, NULL, NULL),
(4626, 136, 2, 15, 2, 5, NULL, NULL),
(4627, 136, 2, 15, 3, 4, NULL, NULL),
(4628, 136, 2, 15, 4, 5, NULL, NULL),
(4629, 136, 2, 15, 5, 5, NULL, NULL),
(4630, 136, 2, 15, 6, 5, NULL, NULL),
(4631, 136, 2, 15, 7, 4, NULL, NULL),
(4632, 136, 2, 15, 8, 4, NULL, NULL),
(4633, 136, 2, 15, 9, 4, NULL, NULL),
(4634, 136, 2, 15, 10, 4, NULL, NULL),
(4635, 136, 2, 15, 11, 4, NULL, NULL),
(4636, 136, 2, 15, 12, 5, NULL, NULL),
(4637, 136, 2, 15, 13, 4, NULL, NULL),
(4638, 136, 2, 15, 14, 4, NULL, NULL),
(4639, 136, 2, 15, 15, 4, NULL, NULL),
(4640, 136, 2, 15, 16, 5, NULL, NULL),
(4641, 136, 2, 15, 17, 4, NULL, NULL),
(4642, 136, 2, 15, 18, 4, NULL, NULL),
(4643, 136, 2, 15, 19, 5, NULL, NULL),
(4644, 136, 2, 15, 20, 5, NULL, NULL),
(4645, 136, 2, 15, 21, 5, NULL, NULL),
(4646, 136, 2, 15, 22, 5, NULL, NULL),
(4647, 136, 2, 15, 23, 5, NULL, NULL),
(4648, 136, 2, 15, 24, 5, NULL, NULL),
(4649, 136, 2, 15, 25, 5, NULL, NULL),
(4650, 136, 2, 15, 26, 5, NULL, NULL),
(4651, 136, 2, 15, 27, 4, NULL, NULL),
(4652, 136, 2, 15, 28, 4, NULL, NULL),
(4653, 136, 2, 15, 29, 4, NULL, NULL),
(4654, 136, 2, 15, 30, 4, NULL, NULL),
(4655, 136, 2, 15, 31, 4, NULL, NULL),
(4656, 136, 2, 15, 32, 5, NULL, NULL),
(4657, 136, 2, 15, 33, 4, NULL, NULL),
(4658, 136, 2, 15, 34, 4, NULL, NULL),
(4659, 136, 3, 18, 1, 5, NULL, NULL),
(4660, 136, 3, 18, 2, 5, NULL, NULL),
(4661, 136, 3, 18, 3, 4, NULL, NULL),
(4662, 136, 3, 18, 4, 4, NULL, NULL),
(4663, 136, 3, 18, 5, 4, NULL, NULL),
(4664, 136, 3, 18, 6, 4, NULL, NULL),
(4665, 136, 3, 18, 7, 5, NULL, NULL),
(4666, 136, 3, 18, 8, 4, NULL, NULL),
(4667, 136, 3, 18, 9, 5, NULL, NULL),
(4668, 136, 3, 18, 10, 5, NULL, NULL),
(4669, 136, 3, 18, 11, 5, NULL, NULL),
(4670, 136, 3, 18, 12, 4, NULL, NULL),
(4671, 136, 3, 18, 13, 5, NULL, NULL),
(4672, 136, 3, 18, 14, 4, NULL, NULL),
(4673, 136, 3, 18, 15, 5, NULL, NULL),
(4674, 136, 3, 18, 16, 4, NULL, NULL),
(4675, 136, 3, 18, 17, 4, NULL, NULL),
(4676, 136, 3, 18, 18, 5, NULL, NULL),
(4677, 136, 3, 18, 19, 4, NULL, NULL),
(4678, 136, 3, 18, 20, 5, NULL, NULL),
(4679, 136, 3, 18, 21, 4, NULL, NULL),
(4680, 136, 3, 18, 22, 4, NULL, NULL),
(4681, 136, 3, 18, 23, 4, NULL, NULL),
(4682, 136, 3, 18, 24, 5, NULL, NULL),
(4683, 136, 3, 18, 25, 4, NULL, NULL),
(4684, 136, 3, 18, 26, 5, NULL, NULL),
(4685, 136, 3, 18, 27, 4, NULL, NULL),
(4686, 136, 3, 18, 28, 5, NULL, NULL),
(4687, 136, 3, 18, 29, 5, NULL, NULL),
(4688, 136, 3, 18, 30, 5, NULL, NULL),
(4689, 136, 3, 18, 31, 4, NULL, NULL),
(4690, 136, 3, 18, 32, 4, NULL, NULL),
(4691, 136, 3, 18, 33, 4, NULL, NULL),
(4692, 136, 3, 18, 34, 4, NULL, NULL),
(4693, 136, 15, 18, 1, 4, NULL, NULL),
(4694, 136, 15, 18, 2, 4, NULL, NULL),
(4695, 136, 15, 18, 3, 5, NULL, NULL),
(4696, 136, 15, 18, 4, 4, NULL, NULL),
(4697, 136, 15, 18, 5, 4, NULL, NULL),
(4698, 136, 15, 18, 6, 5, NULL, NULL),
(4699, 136, 15, 18, 7, 4, NULL, NULL),
(4700, 136, 15, 18, 8, 4, NULL, NULL),
(4701, 136, 15, 18, 9, 4, NULL, NULL),
(4702, 136, 15, 18, 10, 5, NULL, NULL),
(4703, 136, 15, 18, 11, 4, NULL, NULL),
(4704, 136, 15, 18, 12, 4, NULL, NULL),
(4705, 136, 15, 18, 13, 5, NULL, NULL),
(4706, 136, 15, 18, 14, 4, NULL, NULL),
(4707, 136, 15, 18, 15, 4, NULL, NULL),
(4708, 136, 15, 18, 16, 5, NULL, NULL),
(4709, 136, 15, 18, 17, 5, NULL, NULL),
(4710, 136, 15, 18, 18, 4, NULL, NULL),
(4711, 136, 15, 18, 19, 5, NULL, NULL),
(4712, 136, 15, 18, 20, 5, NULL, NULL),
(4713, 136, 15, 18, 21, 5, NULL, NULL),
(4714, 136, 15, 18, 22, 4, NULL, NULL),
(4715, 136, 15, 18, 23, 5, NULL, NULL),
(4716, 136, 15, 18, 24, 4, NULL, NULL),
(4717, 136, 15, 18, 25, 4, NULL, NULL),
(4718, 136, 15, 18, 26, 5, NULL, NULL),
(4719, 136, 15, 18, 27, 4, NULL, NULL),
(4720, 136, 15, 18, 28, 4, NULL, NULL),
(4721, 136, 15, 18, 29, 4, NULL, NULL),
(4722, 136, 15, 18, 30, 4, NULL, NULL),
(4723, 136, 15, 18, 31, 5, NULL, NULL),
(4724, 136, 15, 18, 32, 4, NULL, NULL),
(4725, 136, 15, 18, 33, 4, NULL, NULL),
(4726, 136, 15, 18, 34, 5, NULL, NULL),
(4727, 136, 2, 18, 1, 4, NULL, NULL),
(4728, 136, 2, 18, 2, 4, NULL, NULL),
(4729, 136, 2, 18, 3, 4, NULL, NULL),
(4730, 136, 2, 18, 4, 5, NULL, NULL),
(4731, 136, 2, 18, 5, 4, NULL, NULL),
(4732, 136, 2, 18, 6, 4, NULL, NULL),
(4733, 136, 2, 18, 7, 4, NULL, NULL),
(4734, 136, 2, 18, 8, 4, NULL, NULL),
(4735, 136, 2, 18, 9, 4, NULL, NULL),
(4736, 136, 2, 18, 10, 4, NULL, NULL),
(4737, 136, 2, 18, 11, 4, NULL, NULL),
(4738, 136, 2, 18, 12, 4, NULL, NULL),
(4739, 136, 2, 18, 13, 4, NULL, NULL),
(4740, 136, 2, 18, 14, 4, NULL, NULL),
(4741, 136, 2, 18, 15, 4, NULL, NULL),
(4742, 136, 2, 18, 16, 4, NULL, NULL),
(4743, 136, 2, 18, 17, 5, NULL, NULL),
(4744, 136, 2, 18, 18, 4, NULL, NULL),
(4745, 136, 2, 18, 19, 4, NULL, NULL),
(4746, 136, 2, 18, 20, 4, NULL, NULL),
(4747, 136, 2, 18, 21, 5, NULL, NULL),
(4748, 136, 2, 18, 22, 5, NULL, NULL),
(4749, 136, 2, 18, 23, 5, NULL, NULL),
(4750, 136, 2, 18, 24, 5, NULL, NULL),
(4751, 136, 2, 18, 25, 4, NULL, NULL),
(4752, 136, 2, 18, 26, 4, NULL, NULL),
(4753, 136, 2, 18, 27, 4, NULL, NULL),
(4754, 136, 2, 18, 28, 4, NULL, NULL),
(4755, 136, 2, 18, 29, 4, NULL, NULL),
(4756, 136, 2, 18, 30, 4, NULL, NULL),
(4757, 136, 2, 18, 31, 5, NULL, NULL),
(4758, 136, 2, 18, 32, 4, NULL, NULL),
(4759, 136, 2, 18, 33, 4, NULL, NULL),
(4760, 136, 2, 18, 34, 5, NULL, NULL),
(4761, 136, 3, 2, 1, 4, NULL, NULL),
(4762, 136, 3, 2, 2, 5, NULL, NULL),
(4763, 136, 3, 2, 3, 5, NULL, NULL),
(4764, 136, 3, 2, 4, 4, NULL, NULL),
(4765, 136, 3, 2, 5, 4, NULL, NULL),
(4766, 136, 3, 2, 6, 5, NULL, NULL),
(4767, 136, 3, 2, 7, 5, NULL, NULL),
(4768, 136, 3, 2, 8, 5, NULL, NULL),
(4769, 136, 3, 2, 9, 4, NULL, NULL),
(4770, 136, 3, 2, 10, 4, NULL, NULL),
(4771, 136, 3, 2, 11, 4, NULL, NULL),
(4772, 136, 3, 2, 12, 4, NULL, NULL),
(4773, 136, 3, 2, 13, 5, NULL, NULL),
(4774, 136, 3, 2, 14, 5, NULL, NULL),
(4775, 136, 3, 2, 15, 5, NULL, NULL),
(4776, 136, 3, 2, 16, 5, NULL, NULL),
(4777, 136, 3, 2, 17, 4, NULL, NULL),
(4778, 136, 3, 2, 18, 4, NULL, NULL),
(4779, 136, 3, 2, 19, 5, NULL, NULL),
(4780, 136, 3, 2, 20, 4, NULL, NULL),
(4781, 136, 3, 2, 21, 5, NULL, NULL),
(4782, 136, 3, 2, 22, 4, NULL, NULL),
(4783, 136, 3, 2, 23, 4, NULL, NULL),
(4784, 136, 3, 2, 24, 4, NULL, NULL),
(4785, 136, 3, 2, 25, 4, NULL, NULL),
(4786, 136, 3, 2, 26, 4, NULL, NULL),
(4787, 136, 3, 2, 27, 4, NULL, NULL),
(4788, 136, 3, 2, 28, 5, NULL, NULL),
(4789, 136, 3, 2, 29, 4, NULL, NULL),
(4790, 136, 3, 2, 30, 4, NULL, NULL),
(4791, 136, 3, 2, 31, 4, NULL, NULL),
(4792, 136, 3, 2, 32, 4, NULL, NULL),
(4793, 136, 3, 2, 33, 4, NULL, NULL),
(4794, 136, 3, 2, 34, 5, NULL, NULL),
(4795, 136, 15, 2, 1, 5, NULL, NULL),
(4796, 136, 15, 2, 2, 5, NULL, NULL),
(4797, 136, 15, 2, 3, 4, NULL, NULL),
(4798, 136, 15, 2, 4, 5, NULL, NULL),
(4799, 136, 15, 2, 5, 4, NULL, NULL),
(4800, 136, 15, 2, 6, 4, NULL, NULL),
(4801, 136, 15, 2, 7, 4, NULL, NULL),
(4802, 136, 15, 2, 8, 5, NULL, NULL),
(4803, 136, 15, 2, 9, 4, NULL, NULL),
(4804, 136, 15, 2, 10, 4, NULL, NULL),
(4805, 136, 15, 2, 11, 4, NULL, NULL),
(4806, 136, 15, 2, 12, 5, NULL, NULL),
(4807, 136, 15, 2, 13, 5, NULL, NULL),
(4808, 136, 15, 2, 14, 4, NULL, NULL),
(4809, 136, 15, 2, 15, 5, NULL, NULL),
(4810, 136, 15, 2, 16, 5, NULL, NULL),
(4811, 136, 15, 2, 17, 5, NULL, NULL),
(4812, 136, 15, 2, 18, 5, NULL, NULL),
(4813, 136, 15, 2, 19, 4, NULL, NULL),
(4814, 136, 15, 2, 20, 4, NULL, NULL),
(4815, 136, 15, 2, 21, 4, NULL, NULL),
(4816, 136, 15, 2, 22, 4, NULL, NULL),
(4817, 136, 15, 2, 23, 5, NULL, NULL),
(4818, 136, 15, 2, 24, 4, NULL, NULL),
(4819, 136, 15, 2, 25, 5, NULL, NULL),
(4820, 136, 15, 2, 26, 4, NULL, NULL),
(4821, 136, 15, 2, 27, 4, NULL, NULL),
(4822, 136, 15, 2, 28, 4, NULL, NULL),
(4823, 136, 15, 2, 29, 4, NULL, NULL),
(4824, 136, 15, 2, 30, 4, NULL, NULL),
(4825, 136, 15, 2, 31, 4, NULL, NULL),
(4826, 136, 15, 2, 32, 4, NULL, NULL),
(4827, 136, 15, 2, 33, 4, NULL, NULL),
(4828, 136, 15, 2, 34, 5, NULL, NULL),
(4829, 136, 18, 2, 1, 4, NULL, NULL),
(4830, 136, 18, 2, 2, 5, NULL, NULL),
(4831, 136, 18, 2, 3, 5, NULL, NULL),
(4832, 136, 18, 2, 4, 4, NULL, NULL),
(4833, 136, 18, 2, 5, 4, NULL, NULL),
(4834, 136, 18, 2, 6, 4, NULL, NULL),
(4835, 136, 18, 2, 7, 4, NULL, NULL),
(4836, 136, 18, 2, 8, 5, NULL, NULL),
(4837, 136, 18, 2, 9, 5, NULL, NULL),
(4838, 136, 18, 2, 10, 5, NULL, NULL),
(4839, 136, 18, 2, 11, 5, NULL, NULL),
(4840, 136, 18, 2, 12, 4, NULL, NULL),
(4841, 136, 18, 2, 13, 5, NULL, NULL),
(4842, 136, 18, 2, 14, 4, NULL, NULL),
(4843, 136, 18, 2, 15, 4, NULL, NULL),
(4844, 136, 18, 2, 16, 4, NULL, NULL),
(4845, 136, 18, 2, 17, 5, NULL, NULL),
(4846, 136, 18, 2, 18, 5, NULL, NULL),
(4847, 136, 18, 2, 19, 4, NULL, NULL),
(4848, 136, 18, 2, 20, 5, NULL, NULL),
(4849, 136, 18, 2, 21, 4, NULL, NULL),
(4850, 136, 18, 2, 22, 4, NULL, NULL),
(4851, 136, 18, 2, 23, 5, NULL, NULL),
(4852, 136, 18, 2, 24, 4, NULL, NULL),
(4853, 136, 18, 2, 25, 4, NULL, NULL),
(4854, 136, 18, 2, 26, 5, NULL, NULL),
(4855, 136, 18, 2, 27, 4, NULL, NULL),
(4856, 136, 18, 2, 28, 4, NULL, NULL),
(4857, 136, 18, 2, 29, 4, NULL, NULL),
(4858, 136, 18, 2, 30, 4, NULL, NULL),
(4859, 136, 18, 2, 31, 5, NULL, NULL),
(4860, 136, 18, 2, 32, 5, NULL, NULL),
(4861, 136, 18, 2, 33, 4, NULL, NULL),
(4862, 136, 18, 2, 34, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peer_surveys`
--

CREATE TABLE `peer_surveys` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL,
  `peer_id` int(10) UNSIGNED NOT NULL,
  `peer_completed` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `peer_surveys`
--

INSERT INTO `peer_surveys` (`id`, `survey_id`, `peer_id`, `peer_completed`, `user_id`, `created_at`, `updated_at`) VALUES
(175, 119, 3, 1, 2, '2017-01-21 10:27:53', '2017-01-21 10:29:54'),
(176, 119, 15, 1, 2, '2017-01-21 10:27:55', '2017-01-21 10:48:43'),
(177, 119, 16, 1, 2, '2017-01-21 10:27:56', '2017-01-21 10:33:56'),
(178, 119, 18, 1, 2, '2017-01-21 10:27:57', '2017-01-21 10:38:51'),
(179, 119, 15, 1, 3, '2017-01-21 10:30:23', '2017-01-21 10:45:14'),
(180, 119, 16, 1, 3, '2017-01-21 10:30:25', '2017-01-21 10:32:46'),
(181, 119, 18, 1, 3, '2017-01-21 10:30:26', '2017-01-21 10:36:33'),
(182, 119, 19, 1, 3, '2017-01-21 10:30:28', '2017-01-21 10:40:45'),
(183, 119, 3, 1, 16, '2017-01-21 10:34:51', '2017-01-21 10:51:37'),
(184, 119, 15, 1, 16, '2017-01-21 10:34:52', '2017-01-21 10:46:25'),
(185, 119, 18, 1, 16, '2017-01-21 10:34:53', '2017-01-21 10:37:46'),
(186, 119, 19, 1, 16, '2017-01-21 10:34:54', '2017-01-21 10:42:02'),
(187, 119, 3, 1, 19, '2017-01-21 10:43:09', '2017-01-21 10:53:25'),
(188, 119, 15, 1, 19, '2017-01-21 10:43:10', '2017-01-21 10:47:29'),
(189, 119, 16, 0, 19, '2017-01-21 10:43:12', '2017-01-21 10:43:12'),
(190, 119, 18, 0, 19, '2017-01-21 10:43:13', '2017-01-21 10:43:13'),
(191, 119, 3, 1, 15, '2017-01-21 10:43:57', '2017-01-21 10:50:35'),
(192, 119, 16, 0, 15, '2017-01-21 10:43:59', '2017-01-21 10:43:59'),
(193, 119, 18, 0, 15, '2017-01-21 10:44:00', '2017-01-21 10:44:00'),
(194, 119, 19, 0, 15, '2017-01-21 10:44:01', '2017-01-21 10:44:01'),
(195, 123, 15, 1, 3, '2017-01-21 11:31:30', '2017-01-21 11:33:45'),
(196, 123, 16, 1, 3, '2017-01-21 11:31:31', '2017-01-21 11:35:49'),
(197, 123, 18, 1, 3, '2017-01-21 11:31:33', '2017-01-21 11:39:00'),
(198, 123, 19, 1, 3, '2017-01-21 11:31:34', '2017-01-21 11:53:13'),
(199, 123, 3, 1, 15, '2017-01-21 11:32:32', '2017-01-21 11:43:44'),
(200, 123, 16, 1, 15, '2017-01-21 11:32:33', '2017-01-21 11:37:00'),
(201, 123, 18, 1, 15, '2017-01-21 11:32:34', '2017-01-21 11:40:10'),
(202, 123, 19, 1, 15, '2017-01-21 11:32:36', '2017-01-21 11:54:05'),
(203, 123, 3, 1, 16, '2017-01-21 11:34:37', '2017-01-21 11:44:39'),
(204, 123, 15, 1, 16, '2017-01-21 11:34:39', '2017-01-21 11:47:13'),
(205, 123, 18, 1, 16, '2017-01-21 11:34:40', '2017-01-21 11:41:17'),
(206, 123, 19, 1, 16, '2017-01-21 11:34:41', '2017-01-21 11:54:56'),
(207, 123, 3, 1, 18, '2017-01-21 11:37:47', '2017-01-21 11:45:34'),
(208, 123, 15, 1, 18, '2017-01-21 11:37:49', '2017-01-21 11:48:15'),
(209, 123, 16, 1, 18, '2017-01-21 11:37:50', '2017-01-21 11:50:25'),
(210, 123, 19, 1, 18, '2017-01-21 11:37:51', '2017-01-21 11:55:56'),
(211, 123, 3, 0, 19, '2017-01-21 11:52:13', '2017-01-21 11:52:13'),
(212, 123, 15, 0, 19, '2017-01-21 11:52:14', '2017-01-21 11:52:14'),
(213, 123, 16, 0, 19, '2017-01-21 11:52:16', '2017-01-21 11:52:16'),
(214, 123, 18, 0, 19, '2017-01-21 11:52:17', '2017-01-21 11:52:17'),
(217, 132, 3, 1, 1, '2017-03-19 01:44:20', '2017-03-19 01:49:42'),
(218, 132, 15, 1, 1, '2017-03-19 01:44:22', '2017-03-19 02:03:06'),
(219, 132, 2, 1, 1, '2017-03-19 01:44:23', '2017-03-19 01:57:02'),
(221, 132, 1, 0, 3, '2017-03-19 01:51:11', '2017-03-19 01:51:11'),
(222, 132, 23, 0, 3, '2017-03-19 01:51:13', '2017-03-19 01:51:13'),
(223, 132, 2, 1, 3, '2017-03-19 01:51:14', '2017-03-19 01:57:54'),
(226, 132, 1, 0, 2, '2017-03-19 01:59:55', '2017-03-19 01:59:55'),
(227, 132, 3, 1, 2, '2017-03-19 01:59:57', '2017-03-19 02:09:23'),
(228, 132, 15, 1, 2, '2017-03-19 01:59:58', '2017-03-19 02:03:57'),
(229, 132, 1, 0, 15, '2017-03-19 02:04:14', '2017-03-19 02:04:14'),
(230, 132, 3, 1, 15, '2017-03-19 02:04:16', '2017-03-19 02:08:21'),
(231, 132, 2, 1, 15, '2017-03-19 02:04:18', '2017-03-19 02:10:44'),
(232, 136, 3, 1, 2, '2017-03-19 03:42:27', '2017-03-19 03:49:40'),
(233, 136, 15, 1, 2, '2017-03-19 03:42:29', '2017-03-19 03:53:35'),
(234, 136, 16, 0, 2, '2017-03-19 03:42:31', '2017-03-19 03:42:31'),
(235, 136, 18, 1, 2, '2017-03-19 03:42:32', '2017-03-19 04:01:07'),
(236, 136, 15, 1, 3, '2017-03-19 03:50:14', '2017-03-19 03:52:43'),
(237, 136, 16, 0, 3, '2017-03-19 03:50:16', '2017-03-19 03:50:16'),
(238, 136, 18, 1, 3, '2017-03-19 03:50:17', '2017-03-19 03:59:20'),
(239, 136, 2, 1, 3, '2017-03-19 03:50:18', '2017-03-19 04:04:04'),
(240, 136, 3, 0, 15, '2017-03-19 03:54:03', '2017-03-19 03:54:03'),
(241, 136, 16, 0, 15, '2017-03-19 03:54:05', '2017-03-19 03:54:05'),
(242, 136, 18, 1, 15, '2017-03-19 03:54:06', '2017-03-19 04:00:12'),
(243, 136, 2, 1, 15, '2017-03-19 03:54:07', '2017-03-19 04:05:01'),
(244, 136, 3, 0, 18, '2017-03-19 04:01:33', '2017-03-19 04:01:33'),
(245, 136, 15, 0, 18, '2017-03-19 04:01:35', '2017-03-19 04:01:35'),
(246, 136, 16, 0, 18, '2017-03-19 04:01:36', '2017-03-19 04:01:36'),
(247, 136, 2, 1, 18, '2017-03-19 04:01:38', '2017-03-19 04:05:53');

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
  `answer` int(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `survey_id`, `user_id`, `indicator_id`, `answer`, `created_at`, `updated_at`) VALUES
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
(1564, 102, 19, 34, 5, '2016-11-15 13:02:18', '2016-11-15 13:02:18'),
(1565, 109, 3, 1, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1566, 109, 3, 2, 5, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1567, 109, 3, 3, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1568, 109, 3, 4, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1569, 109, 3, 5, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1570, 109, 3, 6, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1571, 109, 3, 7, 5, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1572, 109, 3, 8, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1573, 109, 3, 9, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1574, 109, 3, 10, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1575, 109, 3, 11, 5, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1576, 109, 3, 12, 5, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1577, 109, 3, 13, 5, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1578, 109, 3, 14, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1579, 109, 3, 15, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1580, 109, 3, 16, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1581, 109, 3, 17, 5, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1582, 109, 3, 18, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1583, 109, 3, 19, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1584, 109, 3, 20, 5, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1585, 109, 3, 21, 5, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1586, 109, 3, 22, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1587, 109, 3, 23, 5, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1588, 109, 3, 24, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1589, 109, 3, 25, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1590, 109, 3, 26, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1591, 109, 3, 27, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1592, 109, 3, 28, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1593, 109, 3, 29, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1594, 109, 3, 30, 5, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1595, 109, 3, 31, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1596, 109, 3, 32, 5, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1597, 109, 3, 33, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1598, 109, 3, 34, 4, '2016-12-01 10:09:04', '2016-12-01 10:09:04'),
(1599, 109, 2, 1, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1600, 109, 2, 2, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1601, 109, 2, 3, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1602, 109, 2, 4, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1603, 109, 2, 5, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1604, 109, 2, 6, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1605, 109, 2, 7, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1606, 109, 2, 8, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1607, 109, 2, 9, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1608, 109, 2, 10, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1609, 109, 2, 11, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1610, 109, 2, 12, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1611, 109, 2, 13, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1612, 109, 2, 14, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1613, 109, 2, 15, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1614, 109, 2, 16, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1615, 109, 2, 17, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1616, 109, 2, 18, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1617, 109, 2, 19, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1618, 109, 2, 20, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1619, 109, 2, 21, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1620, 109, 2, 22, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1621, 109, 2, 23, 3, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1622, 109, 2, 24, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1623, 109, 2, 25, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1624, 109, 2, 26, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1625, 109, 2, 27, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1626, 109, 2, 28, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1627, 109, 2, 29, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1628, 109, 2, 30, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1629, 109, 2, 31, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1630, 109, 2, 32, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1631, 109, 2, 33, 5, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1632, 109, 2, 34, 4, '2016-12-01 10:10:35', '2016-12-01 10:10:35'),
(1633, 109, 17, 1, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1634, 109, 17, 2, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1635, 109, 17, 3, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1636, 109, 17, 4, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1637, 109, 17, 5, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1638, 109, 17, 6, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1639, 109, 17, 7, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1640, 109, 17, 8, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1641, 109, 17, 9, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1642, 109, 17, 10, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1643, 109, 17, 11, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1644, 109, 17, 12, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1645, 109, 17, 13, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1646, 109, 17, 14, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1647, 109, 17, 15, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1648, 109, 17, 16, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1649, 109, 17, 17, 3, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1650, 109, 17, 18, 2, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1651, 109, 17, 19, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1652, 109, 17, 20, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1653, 109, 17, 21, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1654, 109, 17, 22, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1655, 109, 17, 23, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1656, 109, 17, 24, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1657, 109, 17, 25, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1658, 109, 17, 26, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1659, 109, 17, 27, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1660, 109, 17, 28, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1661, 109, 17, 29, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1662, 109, 17, 30, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1663, 109, 17, 31, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1664, 109, 17, 32, 4, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1665, 109, 17, 33, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1666, 109, 17, 34, 5, '2016-12-01 10:13:00', '2016-12-01 10:13:00'),
(1667, 111, 3, 1, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1668, 111, 3, 2, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1669, 111, 3, 3, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1670, 111, 3, 4, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1671, 111, 3, 5, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1672, 111, 3, 6, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1673, 111, 3, 7, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1674, 111, 3, 8, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1675, 111, 3, 9, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1676, 111, 3, 10, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1677, 111, 3, 11, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1678, 111, 3, 12, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1679, 111, 3, 13, 2, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1680, 111, 3, 14, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1681, 111, 3, 15, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1682, 111, 3, 16, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1683, 111, 3, 17, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1684, 111, 3, 18, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1685, 111, 3, 19, 3, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1686, 111, 3, 20, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1687, 111, 3, 21, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1688, 111, 3, 22, 3, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1689, 111, 3, 23, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1690, 111, 3, 24, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1691, 111, 3, 25, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1692, 111, 3, 26, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1693, 111, 3, 27, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1694, 111, 3, 28, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1695, 111, 3, 29, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1696, 111, 3, 30, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1697, 111, 3, 31, 5, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1698, 111, 3, 32, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1699, 111, 3, 33, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1700, 111, 3, 34, 4, '2016-12-01 12:47:00', '2016-12-01 12:47:00'),
(1701, 111, 17, 1, 5, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1702, 111, 17, 2, 3, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1703, 111, 17, 3, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1704, 111, 17, 4, 5, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1705, 111, 17, 5, 3, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1706, 111, 17, 6, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1707, 111, 17, 7, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1708, 111, 17, 8, 5, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1709, 111, 17, 9, 5, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1710, 111, 17, 10, 5, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1711, 111, 17, 11, 5, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1712, 111, 17, 12, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1713, 111, 17, 13, 5, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1714, 111, 17, 14, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1715, 111, 17, 15, 5, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1716, 111, 17, 16, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1717, 111, 17, 17, 3, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1718, 111, 17, 18, 5, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1719, 111, 17, 19, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1720, 111, 17, 20, 3, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1721, 111, 17, 21, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1722, 111, 17, 22, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1723, 111, 17, 23, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1724, 111, 17, 24, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1725, 111, 17, 25, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1726, 111, 17, 26, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1727, 111, 17, 27, 3, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1728, 111, 17, 28, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1729, 111, 17, 29, 5, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1730, 111, 17, 30, 3, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1731, 111, 17, 31, 5, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1732, 111, 17, 32, 4, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1733, 111, 17, 33, 3, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1734, 111, 17, 34, 3, '2016-12-01 12:48:28', '2016-12-01 12:48:28'),
(1735, 111, 18, 1, 1, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1736, 111, 18, 2, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1737, 111, 18, 3, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1738, 111, 18, 4, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1739, 111, 18, 5, 3, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1740, 111, 18, 6, 4, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1741, 111, 18, 7, 3, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1742, 111, 18, 8, 4, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1743, 111, 18, 9, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1744, 111, 18, 10, 4, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1745, 111, 18, 11, 4, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1746, 111, 18, 12, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1747, 111, 18, 13, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1748, 111, 18, 14, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1749, 111, 18, 15, 4, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1750, 111, 18, 16, 4, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1751, 111, 18, 17, 3, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1752, 111, 18, 18, 3, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1753, 111, 18, 19, 3, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1754, 111, 18, 20, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1755, 111, 18, 21, 2, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1756, 111, 18, 22, 4, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1757, 111, 18, 23, 4, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1758, 111, 18, 24, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1759, 111, 18, 25, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1760, 111, 18, 26, 4, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1761, 111, 18, 27, 4, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1762, 111, 18, 28, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1763, 111, 18, 29, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1764, 111, 18, 30, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1765, 111, 18, 31, 3, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1766, 111, 18, 32, 3, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1767, 111, 18, 33, 5, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(1768, 111, 18, 34, 3, '2016-12-01 12:49:49', '2016-12-01 12:49:49'),
(2007, 131, 1, 1, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2008, 131, 1, 2, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2009, 131, 1, 3, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2010, 131, 1, 4, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2011, 131, 1, 5, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2012, 131, 1, 6, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2013, 131, 1, 7, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2014, 131, 1, 8, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2015, 131, 1, 9, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2016, 131, 1, 10, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2017, 131, 1, 11, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2018, 131, 1, 12, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2019, 131, 1, 13, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2020, 131, 1, 14, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2021, 131, 1, 15, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2022, 131, 1, 16, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2023, 131, 1, 17, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2024, 131, 1, 18, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2025, 131, 1, 19, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2026, 131, 1, 20, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2027, 131, 1, 21, 3, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2028, 131, 1, 22, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2029, 131, 1, 23, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2030, 131, 1, 24, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2031, 131, 1, 25, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2032, 131, 1, 26, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2033, 131, 1, 27, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2034, 131, 1, 28, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2035, 131, 1, 29, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2036, 131, 1, 30, 5, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2037, 131, 1, 31, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2038, 131, 1, 32, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2039, 131, 1, 33, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2040, 131, 1, 34, 4, '2017-03-19 01:40:11', '2017-03-19 01:40:11'),
(2041, 131, 3, 1, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2042, 131, 3, 2, 5, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2043, 131, 3, 3, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2044, 131, 3, 4, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2045, 131, 3, 5, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2046, 131, 3, 6, 5, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2047, 131, 3, 7, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2048, 131, 3, 8, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2049, 131, 3, 9, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2050, 131, 3, 10, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2051, 131, 3, 11, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2052, 131, 3, 12, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2053, 131, 3, 13, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2054, 131, 3, 14, 5, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2055, 131, 3, 15, 5, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2056, 131, 3, 16, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2057, 131, 3, 17, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2058, 131, 3, 18, 5, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2059, 131, 3, 19, 5, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2060, 131, 3, 20, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2061, 131, 3, 21, 5, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2062, 131, 3, 22, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2063, 131, 3, 23, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2064, 131, 3, 24, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2065, 131, 3, 25, 5, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2066, 131, 3, 26, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2067, 131, 3, 27, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2068, 131, 3, 28, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2069, 131, 3, 29, 5, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2070, 131, 3, 30, 5, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2071, 131, 3, 31, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2072, 131, 3, 32, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2073, 131, 3, 33, 4, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2074, 131, 3, 34, 5, '2017-03-19 01:48:22', '2017-03-19 01:48:22'),
(2075, 131, 2, 1, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2076, 131, 2, 2, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2077, 131, 2, 3, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2078, 131, 2, 4, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2079, 131, 2, 5, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2080, 131, 2, 6, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2081, 131, 2, 7, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2082, 131, 2, 8, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2083, 131, 2, 9, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2084, 131, 2, 10, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2085, 131, 2, 11, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2086, 131, 2, 12, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2087, 131, 2, 13, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2088, 131, 2, 14, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2089, 131, 2, 15, 3, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2090, 131, 2, 16, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2091, 131, 2, 17, 3, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2092, 131, 2, 18, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2093, 131, 2, 19, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2094, 131, 2, 20, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2095, 131, 2, 21, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2096, 131, 2, 22, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2097, 131, 2, 23, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2098, 131, 2, 24, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2099, 131, 2, 25, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2100, 131, 2, 26, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2101, 131, 2, 27, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2102, 131, 2, 28, 5, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2103, 131, 2, 29, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2104, 131, 2, 30, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2105, 131, 2, 31, 3, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2106, 131, 2, 32, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2107, 131, 2, 33, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2108, 131, 2, 34, 4, '2017-03-19 01:53:09', '2017-03-19 01:53:09'),
(2109, 131, 15, 1, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2110, 131, 15, 2, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2111, 131, 15, 3, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2112, 131, 15, 4, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2113, 131, 15, 5, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2114, 131, 15, 6, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2115, 131, 15, 7, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2116, 131, 15, 8, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2117, 131, 15, 9, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2118, 131, 15, 10, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2119, 131, 15, 11, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2120, 131, 15, 12, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2121, 131, 15, 13, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2122, 131, 15, 14, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2123, 131, 15, 15, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2124, 131, 15, 16, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2125, 131, 15, 17, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2126, 131, 15, 18, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2127, 131, 15, 19, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2128, 131, 15, 20, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2129, 131, 15, 21, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2130, 131, 15, 22, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2131, 131, 15, 23, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2132, 131, 15, 24, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2133, 131, 15, 25, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2134, 131, 15, 26, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2135, 131, 15, 27, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2136, 131, 15, 28, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2137, 131, 15, 29, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2138, 131, 15, 30, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2139, 131, 15, 31, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2140, 131, 15, 32, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2141, 131, 15, 33, 5, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2142, 131, 15, 34, 4, '2017-03-19 02:01:57', '2017-03-19 02:01:57'),
(2143, 135, 2, 1, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2144, 135, 2, 2, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2145, 135, 2, 3, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2146, 135, 2, 4, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2147, 135, 2, 5, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2148, 135, 2, 6, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2149, 135, 2, 7, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2150, 135, 2, 8, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2151, 135, 2, 9, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2152, 135, 2, 10, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2153, 135, 2, 11, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2154, 135, 2, 12, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2155, 135, 2, 13, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2156, 135, 2, 14, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2157, 135, 2, 15, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2158, 135, 2, 16, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2159, 135, 2, 17, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2160, 135, 2, 18, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2161, 135, 2, 19, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2162, 135, 2, 20, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2163, 135, 2, 21, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2164, 135, 2, 22, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2165, 135, 2, 23, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2166, 135, 2, 24, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2167, 135, 2, 25, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2168, 135, 2, 26, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2169, 135, 2, 27, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2170, 135, 2, 28, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2171, 135, 2, 29, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2172, 135, 2, 30, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2173, 135, 2, 31, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2174, 135, 2, 32, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2175, 135, 2, 33, 5, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2176, 135, 2, 34, 4, '2017-03-19 03:25:47', '2017-03-19 03:25:47'),
(2177, 135, 3, 1, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2178, 135, 3, 2, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2179, 135, 3, 3, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2180, 135, 3, 4, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2181, 135, 3, 5, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2182, 135, 3, 6, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2183, 135, 3, 7, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2184, 135, 3, 8, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2185, 135, 3, 9, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2186, 135, 3, 10, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2187, 135, 3, 11, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2188, 135, 3, 12, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2189, 135, 3, 13, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2190, 135, 3, 14, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2191, 135, 3, 15, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2192, 135, 3, 16, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2193, 135, 3, 17, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2194, 135, 3, 18, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2195, 135, 3, 19, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2196, 135, 3, 20, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2197, 135, 3, 21, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2198, 135, 3, 22, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2199, 135, 3, 23, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2200, 135, 3, 24, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2201, 135, 3, 25, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2202, 135, 3, 26, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2203, 135, 3, 27, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2204, 135, 3, 28, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2205, 135, 3, 29, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2206, 135, 3, 30, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2207, 135, 3, 31, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2208, 135, 3, 32, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2209, 135, 3, 33, 4, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2210, 135, 3, 34, 5, '2017-03-19 03:48:27', '2017-03-19 03:48:27'),
(2211, 135, 15, 1, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2212, 135, 15, 2, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2213, 135, 15, 3, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2214, 135, 15, 4, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2215, 135, 15, 5, 5, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2216, 135, 15, 6, 5, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2217, 135, 15, 7, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2218, 135, 15, 8, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2219, 135, 15, 9, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2220, 135, 15, 10, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2221, 135, 15, 11, 5, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2222, 135, 15, 12, 5, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2223, 135, 15, 13, 5, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2224, 135, 15, 14, 5, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2225, 135, 15, 15, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2226, 135, 15, 16, 5, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2227, 135, 15, 17, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2228, 135, 15, 18, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2229, 135, 15, 19, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2230, 135, 15, 20, 5, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2231, 135, 15, 21, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2232, 135, 15, 22, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2233, 135, 15, 23, 5, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2234, 135, 15, 24, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2235, 135, 15, 25, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2236, 135, 15, 26, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2237, 135, 15, 27, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2238, 135, 15, 28, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2239, 135, 15, 29, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2240, 135, 15, 30, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2241, 135, 15, 31, 5, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2242, 135, 15, 32, 5, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2243, 135, 15, 33, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2244, 135, 15, 34, 4, '2017-03-19 03:51:38', '2017-03-19 03:51:38'),
(2245, 135, 18, 1, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2246, 135, 18, 2, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2247, 135, 18, 3, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2248, 135, 18, 4, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2249, 135, 18, 5, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2250, 135, 18, 6, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2251, 135, 18, 7, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2252, 135, 18, 8, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2253, 135, 18, 9, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2254, 135, 18, 10, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2255, 135, 18, 11, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2256, 135, 18, 12, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2257, 135, 18, 13, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2258, 135, 18, 14, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2259, 135, 18, 15, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2260, 135, 18, 16, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2261, 135, 18, 17, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2262, 135, 18, 18, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2263, 135, 18, 19, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2264, 135, 18, 20, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2265, 135, 18, 21, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2266, 135, 18, 22, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2267, 135, 18, 23, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2268, 135, 18, 24, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2269, 135, 18, 25, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2270, 135, 18, 26, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2271, 135, 18, 27, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2272, 135, 18, 28, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2273, 135, 18, 29, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2274, 135, 18, 30, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2275, 135, 18, 31, 5, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2276, 135, 18, 32, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2277, 135, 18, 33, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06'),
(2278, 135, 18, 34, 4, '2017-03-19 03:58:06', '2017-03-19 03:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
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
(23, 3),
(27, 1),
(28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_tasks`
--

CREATE TABLE `scheduled_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `running` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scheduled_tasks`
--

INSERT INTO `scheduled_tasks` (`id`, `name`, `running`) VALUES
(1, 'emailer', 0);

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
  `number_of_evaluators` int(11) DEFAULT '0',
  `end_message` text COLLATE utf8_unicode_ci NOT NULL,
  `start_time` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `end_time` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `user_id`, `type_id`, `company_id`, `category_id`, `user_group_id`, `title`, `description`, `number_of_evaluators`, `end_message`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(102, 2, 1, 1, 2, 19, 'self survey group scoped test 1', '<p>self survey</p>\r\n', NULL, '<p>thank you</p>\r\n', '2016-11-15 14:00:00', '2016-11-25 18:59:00', '2016-11-15 12:38:46', '2016-11-15 12:38:46'),
(106, 1, 1, 1, 1, NULL, 'self survey company scoped test 2', '<p>self survey</p>\r\n', NULL, '<p>Thank you</p>\r\n', '2016-11-19 15:00:00', '2016-11-29 23:59:00', '2016-11-19 12:40:14', '2016-11-19 12:40:14'),
(109, 1, 1, 1, 1, NULL, 'self survey company scoped test 5', '<p>self survey</p>\r\n', NULL, '<p>thank you</p>\r\n', '2016-12-01 12:00:00', '2016-12-22 23:59:00', '2016-12-01 10:06:29', '2016-12-01 10:06:29'),
(111, 2, 1, 1, 2, 19, 'self survey group scoped test 5', '<p>self survey</p>\r\n', NULL, '<p>thank you</p>\r\n', '2016-12-01 14:00:00', '2016-12-28 23:59:00', '2016-12-01 12:43:42', '2016-12-01 12:43:42'),
(119, 1, 2, 1, 1, NULL, 'peer survey company scoped test 1', '<p>peer survey</p>\r\n', 4, '<p>thank you</p>\r\n', '2017-01-21 05:10:00', '2017-01-26 23:59:00', '2017-01-21 10:13:22', '2017-01-21 10:14:16'),
(123, 2, 2, 1, 2, 19, 'peer survey group scoped test 1', '<p>peer survey</p>\r\n', 4, '<p>thank you</p>\r\n', '2017-01-21 06:30:00', '2017-01-31 23:59:00', '2017-01-21 11:27:35', '2017-01-21 11:27:35'),
(131, 1, 1, 1, 1, NULL, 'self survey company scoped include admin test 4', '<p>Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person&#39;s level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br />\r\nInnovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.</p>\r\n', 4, '<p>thank you</p>\r\n', '2017-03-19 03:30:00', '2017-03-29 23:59:00', '2017-03-19 01:29:16', '2017-03-19 01:29:16'),
(132, 1, 2, 1, 1, NULL, 'peer survey company scoped include admin test 4', '<p>Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person&#39;s level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br />\r\nInnovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.</p>\r\n', 3, '<p>thank you</p>\r\n', '2017-03-19 03:00:00', '2017-03-31 23:59:00', '2017-03-19 01:31:17', '2017-03-19 01:31:17'),
(135, 2, 1, 1, 2, 19, 'self survey group scoped include admin test 4', '<p>Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person&#39;s level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br />\r\nInnovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.</p>\r\n', 3, '<p>thank you</p>\r\n', '2017-03-19 05:00:00', '2017-03-30 23:59:00', '2017-03-19 03:20:21', '2017-03-19 03:20:21'),
(136, 2, 2, 1, 2, 19, 'peer survey group scoped include admin test 4', '<p>Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person&#39;s level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br />\r\nInnovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.</p>\r\n', 4, '<p>thank you</p>\r\n', '2017-03-19 05:00:00', '2017-03-31 23:59:00', '2017-03-19 03:21:44', '2017-03-19 03:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `survey_categories`
--

CREATE TABLE `survey_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(20) COLLATE utf8_unicode_ci NOT NULL,
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
(1, 'admin', 'admin@fincoda.com', 1, '$2y$10$aDPsBeCSx/hcyUEa82kXOeBJj6kR.H.6jougBIdWwuGXUIBzcbSw.', 'nuOugAyq2NEewVW73Pf1bRNK8Q91Bg7pe13IdeVKDnbdpNWBVh9YYZfM6XEU', '2016-09-04 18:24:58', '2017-03-19 03:18:16'),
(2, 'special', 'special@fincoda.com', 1, '$2y$10$XEkBB9aQOSUsnZnbvtIU/eFpxWuzc3g.xN/Va5QGt5FWbJSh7P0vW', '01kwKH1Tk5g1HJ4IQgVzMLpt8fPaeqwQAV0eXNt9rwqEKnvZMPwE5uPOntmv', '2016-09-04 18:24:59', '2017-03-19 04:07:45'),
(3, 'basic', 'basic@fincoda.com', 1, '$2y$10$VJ1.j0X2Ns2gXUHhBs5Ob.orTIrsug85qCSQd36tvzfababDw9OdS', 'Io3oJWGggmIb552GvosNohiNDJ9miHNeJQyOSY8hrVVFPvAngJUBsGlF6Qjn', '2016-09-04 18:24:59', '2017-03-19 03:50:30'),
(15, 'dav', 'davis.kawalya@edu.turkuamk.fi', 1, '$2y$10$PWJmx4dIVIQkOn9yQ7/2e.RrOuMni5K/0knmxD1bPdxFbGKFo98VK', 'ev7RE2ibacMpuD8ZXpO50L2U2I9OIqN36CLAlxiqqVKrFrZJkb5Wt5Mdb7VE', '2016-11-15 09:31:48', '2017-03-19 03:56:12'),
(16, 'dav', 'dav2@yahoo.coms', 1, '$2y$10$8ssO4p4nWZN/zkog31bWt.5gkarkW6XQrXiCuVuSXkiW08ngC2M1W', 'AQ8Uy1XUiXx2oxn9tbJ1rvQgUxhxc1JtDPkZxsZQl4ioc5Uw4UmJaMESrqaN', '2016-11-15 09:32:40', '2017-01-21 11:50:40'),
(17, 'dav', 'duy.lenguyen@edu.turkuamk.fi', 1, '$2y$10$PBZPCwtbEUqXmQeeyKWQ8.AzVrAZuEocNPfaaSJl504ySykwRy1dq', 'T7xjJIAW6oqbXLSNvEWxvvYGCpb9VauZBJCrOn42fboBpCwLwBu0EjJjIIMe', '2016-11-15 09:33:15', '2017-01-02 22:26:52'),
(18, 'dav', 'dav4@yahoo.coms', 1, '$2y$10$XEdiSkvjJFYlFFhCMv7tYOtBKkuhDauIPKfcDHIBcui9g29JYqiJO', 'awHYb8pFZ2gX4RC4it4xqUOEpgHlkgyJWRg4h0eCsrV5YcM3Y63p5BJJtoHC', '2016-11-15 09:33:44', '2017-03-19 04:01:53'),
(19, 'dav', 'dav5@yahoo.coms', 1, '$2y$10$.zHdXynhWlde9hSDKHiJjegBUNnJCKwOMTV1PEVrXQaM3gg82owTm', '2Ju0FEDEN6AMH3P7dJzbhIUW9aLdXGtNVxRcS0ZzXbGASdSTjQxT6U4xnJNq', '2016-11-15 09:34:04', '2017-03-19 01:47:15'),
(20, 'dav', 'dav6@yahoo.coms', 1, '$2y$10$KWrb57lTkGO1zmGXIVLOneRGTZX5QJgClcOkJ35dvWjt.ENhUAHOK', 'YG1ynoaK451WHBx6MriwbGG8EuWhK4IvDm1mSoAhWQCL3PXUWEa6s2fRQHa0', '2016-11-15 09:34:33', '2017-01-21 06:15:37'),
(21, 'dav', 'dav7@yahoo.coms', 1, '$2y$10$hoDB8JLvKK23bGfWsJNY.eK.bfee3fcfBQan0RaQp.Jc8KTkzRwvC', '0eVJ3M8Qqnwnbe8aPTMITFKRHbulF3tYPMNewyRddXprYgrcaCfbWlAlXg5m', '2016-11-15 09:35:04', '2016-11-30 22:17:06'),
(22, 'dav', 'dav8@yahoo.coms', 1, '$2y$10$RhAv.7VBId8UMVguzTqGQ.KzMEhcBwICHGDekC/NYpvBTGE5yx8x.', '9cwXpaGYiLBcc8Esj9dgZ18LT8JJP7KkztlmJIlltBdkv1BC4XXnFOXvQHz0', '2016-11-15 09:35:39', '2016-11-15 10:13:50'),
(23, 'dav', 'dav9@yahoo.coms', 1, '$2y$10$jocVMuYLutwmoBjttRYYCOifIQGhOT0wTPtsgBuy.h5gDe4DUtSAm', '2VpuVfBEwGKf1gX7fBn5ijTm4jRz5M5q64FpnwLrM8Bkp2j4uMfo1tloD7Vg', '2016-11-15 09:36:08', '2016-11-15 12:43:20'),
(27, 'kawalya', 'davis.kawalya@edu.turkuamk.fis', 5, '$2y$10$T8xlkKpfTyRN4qkmpppGh.USduGyVeY5LWv.1j8HzgWIxQ2MvmOQK', NULL, '2016-12-01 18:19:25', '2016-12-01 18:19:25'),
(28, 'd', 'davis.kawalya@edu.turkuamk.fiss', 7, '$2y$10$9rZIH0bWj.gDebgd5ILJwuxkXctat4a3nC59moxidev057RzL4at2', NULL, '2016-12-01 18:48:11', '2016-12-01 18:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(50) COLLATE utf8_unicode_ci NOT NULL,
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
(19, 'special', '<p>Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person&#39;s level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br />\r\nInnovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.</p>\r\n', 1, 1, 2, '2016-11-15 12:37:46', '2016-11-15 12:37:46'),
(20, 'special2', '<p>Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person&#39;s level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br />\r\nInnovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.</p>\r\n', 1, 1, 2, '2016-12-01 12:42:04', '2016-12-01 12:42:04');

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
(84, 3, 19, '2016-11-15 12:37:46', '2016-11-15 12:37:46'),
(85, 20, 19, '2016-11-21 11:55:47', '2016-11-21 11:55:47'),
(86, 21, 19, '2016-11-21 11:55:47', '2016-11-21 11:55:47'),
(87, 15, 20, '2016-12-01 12:42:04', '2016-12-01 12:42:04'),
(88, 16, 20, '2016-12-01 12:42:04', '2016-12-01 12:42:04'),
(89, 17, 20, '2016-12-01 12:42:04', '2016-12-01 12:42:04'),
(90, 18, 20, '2016-12-01 12:42:04', '2016-12-01 12:42:04'),
(91, 19, 20, '2016-12-01 12:42:04', '2016-12-01 12:42:04'),
(92, 3, 20, '2016-12-01 12:42:05', '2016-12-01 12:42:05'),
(95, 2, 19, '2017-03-19 03:17:37', '2017-03-19 03:17:37'),
(96, 2, 20, '2017-03-19 03:17:59', '2017-03-19 03:17:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `gender` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL DEFAULT '2016-09-04',
  `What_is_your_highest_completed_education` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Phd Level',
  `Are_you_a_student_or_a_professional` char(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Professional',
  `What_level_of_study_do_you_currently_follow` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `What_type_of_study_are_you_doing` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `What_kind_of_function_do_you_aspire_after_your_graduation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `At_what_stage_or_in_which_year_of_study_indicated_above_are_you` char(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `What_industry_does_your_company_or_organization_belong_to` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `How_long_has_your_company_or_organization_been_operating` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `What_type_of_study_did_you_do` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `What_is_your_job_role` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `How_big_is_the_company_or_organization_you_work_for` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `street` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `hired_date` date NOT NULL,
  `complete` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `gender`, `dob`, `What_is_your_highest_completed_education`, `Are_you_a_student_or_a_professional`, `What_level_of_study_do_you_currently_follow`, `What_type_of_study_are_you_doing`, `What_kind_of_function_do_you_aspire_after_your_graduation`, `At_what_stage_or_in_which_year_of_study_indicated_above_are_you`, `What_industry_does_your_company_or_organization_belong_to`, `How_long_has_your_company_or_organization_been_operating`, `What_type_of_study_did_you_do`, `What_is_your_job_role`, `How_big_is_the_company_or_organization_you_work_for`, `country`, `city`, `street`, `phone`, `hired_date`, `complete`, `created_at`, `updated_at`) VALUES
(15, 15, 'male', '0000-00-00', 'Phd Level', 'Professional', '', '', '', '', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', 'Ascension Island', 'jksd', 'kiöejds', 0, '0000-00-00', 1, '2016-11-15 09:31:48', '2016-11-15 09:38:18'),
(16, 16, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-11-15 09:32:40', '2016-11-15 09:32:40'),
(17, 17, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-11-15 09:33:15', '2016-11-15 09:33:15'),
(18, 18, 'male', '0000-00-00', 'Phd Level', 'Professional', '', '', '', '', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', 'Ascension Island', 'hjhj', 'fghfg', 0, '0000-00-00', 1, '2016-11-15 09:33:44', '2016-11-15 09:33:44'),
(19, 19, 'male', '0000-00-00', 'Phd Level', 'Professional', '', '', '', '', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', 'Ascension Island', 'jlkl', 'jkjjk', 0, '0000-00-00', 1, '2016-11-15 09:34:04', '2016-11-15 09:34:04'),
(20, 20, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-11-15 09:34:33', '2016-11-15 09:34:33'),
(21, 21, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-11-15 09:35:04', '2016-11-15 09:35:04'),
(22, 22, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-11-15 09:35:39', '2016-11-15 09:35:39'),
(23, 23, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-11-15 09:36:09', '2016-11-15 09:36:09'),
(25, 1, 'male', '0000-00-00', 'phd level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more sssd', 'Healthcareddssss', 'Five to ten years', 'engineering', 'Partnerssssd', 'Less than 50 employees', 'Ascension Island', 'klask', 'klkas', 902390232, '0000-00-00', 1, '2016-11-15 09:31:48', '2016-11-15 09:38:18'),
(26, 2, 'male', '0000-00-00', 'Phd Level', 'Professional', '', '', '', '', 'Healthcare', 'Five to ten years', 'engineering', 'Partner', 'Less than 50 employees', 'Ascension Island', 'jksd', 'kiöejds', 0, '0000-00-00', 1, '2016-11-15 09:31:48', '2016-11-15 09:38:18'),
(27, 3, 'male', '0000-00-00', 'phd level', 'Professional', 'ghg', '', '', '', 'ghgg', 'Five to ten years', 'engineering', 'Partnerklll', 'Less than 50 employees', 'Ascension Island', 'jlklkl', 'hljui', 4556, '0000-00-00', 1, '2016-11-15 09:31:48', '2016-11-15 09:38:18'),
(31, 27, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-12-01 18:19:25', '2016-12-01 18:19:25'),
(32, 28, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-12-01 18:48:11', '2016-12-01 18:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `yearly_averages`
--

CREATE TABLE `yearly_averages` (
  `id` int(10) UNSIGNED NOT NULL,
  `creativity` decimal(18,4) NOT NULL,
  `critical_thinking` decimal(18,4) NOT NULL,
  `initiative` decimal(18,4) NOT NULL,
  `teamwork` decimal(18,4) NOT NULL,
  `networking` decimal(18,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indexes for table `external_evaluators`
--
ALTER TABLE `external_evaluators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `external_evaluators_invited_by_fk` (`invited_by_user_id`),
  ADD KEY `external_evaluators_invited_on_survey_id_fk` (`survey_id`);

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
-- Indexes for table `scheduled_tasks`
--
ALTER TABLE `scheduled_tasks`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `company_profiles`
--
ALTER TABLE `company_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;
--
-- AUTO_INCREMENT for table `peer_results`
--
ALTER TABLE `peer_results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4863;
--
-- AUTO_INCREMENT for table `peer_surveys`
--
ALTER TABLE `peer_surveys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2279;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `scheduled_tasks`
--
ALTER TABLE `scheduled_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user_in_groups`
--
ALTER TABLE `user_in_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_profiles`
--
ALTER TABLE `company_profiles`
  ADD CONSTRAINT `company_profiles_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `external_evaluators`
--
ALTER TABLE `external_evaluators`
  ADD CONSTRAINT `external_evaluators_invited_by_fk` FOREIGN KEY (`invited_by_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `external_evaluators_invited_on_survey_id_fk` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`);

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
