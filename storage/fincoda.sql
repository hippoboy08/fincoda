-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2017 at 10:12 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fincoda_db`
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
  `id` int(10) NOT NULL,
  `invited_by_user_id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL,
  `email` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `registered_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `external_evaluators`
--

INSERT INTO `external_evaluators` (`id`, `invited_by_user_id`, `survey_id`, `email`, `company_id`, `registered_email`, `confirmed`, `created_at`, `updated_at`) VALUES
(69, 1, 164, 'davis4.kawalya@edu.turkuamk.fi', 1, 'davis4.kawalya@edu.turkuamk.fi', 1, '2017-05-12 15:21:35', '2017-05-12 15:22:42'),
(70, 1, 166, 'davis.kawalya@edu.turkuamk.fi', 1, 'davis.kawalya@edu.turkuamk.fi', 1, '2017-05-12 15:45:59', '2017-05-12 15:47:29'),
(71, 3, 162, 'davis2.kawalya@edu.turkuamk.fi', 1, '1.davis2.kawalya@edu.turkuamk.fi', 1, '2017-05-12 16:06:29', '2017-05-12 16:07:33'),
(72, 16, 162, 'davis3.kawalya@edu.turkuamk.fi', 1, '', 0, '2017-05-12 16:16:26', '2017-05-12 16:16:26'),
(73, 2, 166, 'davis5.kawalya@edu.turkuamk.fi', 1, 'davis5.kawalya@edu.turkuamk.fi', 1, '2017-05-12 17:09:09', '2017-05-12 17:10:07'),
(74, 2, 162, 'davis6.kawalya@edu.turkuamk.fi', 1, 'davis6.kawalya@edu.turkuamk.fi', 1, '2017-05-12 17:25:06', '2017-05-12 17:26:04');

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
(715, 162, 15, 0, 3, '2017-05-12 15:45:45', '2017-05-12 18:15:52'),
(716, 162, 16, 0, 3, '2017-05-12 15:45:47', '2017-05-12 18:16:38'),
(717, 162, 17, 0, 0, '2017-05-12 15:45:49', '2017-05-12 15:45:49'),
(718, 162, 18, 0, 0, '2017-05-12 15:45:50', '2017-05-12 15:45:50'),
(719, 162, 19, 0, 0, '2017-05-12 15:45:51', '2017-05-12 15:45:51'),
(720, 162, 3, 0, 3, '2017-05-12 15:45:52', '2017-05-12 18:15:12'),
(721, 162, 20, 0, 0, '2017-05-12 15:45:54', '2017-05-12 15:45:54'),
(722, 162, 21, 0, 0, '2017-05-12 15:45:55', '2017-05-12 15:45:55'),
(723, 162, 2, 0, 3, '2017-05-12 15:45:57', '2017-05-12 17:33:37'),
(724, 163, 15, 0, 1, '2017-05-12 15:46:56', '2017-05-12 16:19:55'),
(725, 163, 16, 0, 1, '2017-05-12 15:46:57', '2017-05-12 16:14:17'),
(726, 163, 17, 0, 0, '2017-05-12 15:46:59', '2017-05-12 15:46:59'),
(727, 163, 18, 0, 0, '2017-05-12 15:47:00', '2017-05-12 15:47:00'),
(728, 163, 19, 0, 0, '2017-05-12 15:47:01', '2017-05-12 15:47:01'),
(729, 163, 3, 0, 1, '2017-05-12 15:47:02', '2017-05-12 16:04:44'),
(730, 163, 20, 0, 0, '2017-05-12 15:47:04', '2017-05-12 15:47:04'),
(731, 163, 21, 0, 0, '2017-05-12 15:47:05', '2017-05-12 15:47:05'),
(732, 163, 2, 0, 1, '2017-05-12 15:47:06', '2017-05-12 15:02:58'),
(749, 165, 1, 0, 1, '2017-05-12 15:37:32', '2017-05-12 15:40:40'),
(750, 165, 2, 0, 1, '2017-05-12 15:37:33', '2017-05-12 16:45:06'),
(751, 165, 3, 0, 1, '2017-05-12 15:37:35', '2017-05-12 16:05:46'),
(752, 165, 15, 0, 1, '2017-05-12 15:37:36', '2017-05-12 16:20:54'),
(753, 165, 16, 0, 1, '2017-05-12 15:37:37', '2017-05-12 16:15:30'),
(754, 165, 17, 0, 0, '2017-05-12 15:37:39', '2017-05-12 15:37:39'),
(755, 165, 19, 0, 0, '2017-05-12 15:37:40', '2017-05-12 15:37:40'),
(756, 165, 20, 0, 0, '2017-05-12 15:37:42', '2017-05-12 15:37:42'),
(757, 165, 21, 0, 0, '2017-05-12 15:37:43', '2017-05-12 15:37:43'),
(758, 165, 22, 0, 0, '2017-05-12 15:37:44', '2017-05-12 15:37:44'),
(759, 165, 23, 0, 0, '2017-05-12 15:37:45', '2017-05-12 15:37:45'),
(760, 165, 49, 0, 0, '2017-05-12 15:37:47', '2017-05-12 15:37:47'),
(761, 166, 1, 0, 3, '2017-05-12 15:41:21', '2017-05-12 16:24:51'),
(762, 166, 2, 0, 3, '2017-05-12 15:41:23', '2017-05-12 17:38:14'),
(763, 166, 3, 0, 3, '2017-05-12 15:41:24', '2017-05-12 17:58:14'),
(764, 166, 15, 0, 3, '2017-05-12 15:41:25', '2017-05-12 17:58:59'),
(765, 166, 16, 0, 0, '2017-05-12 15:41:26', '2017-05-12 15:41:26'),
(766, 166, 17, 0, 0, '2017-05-12 15:41:28', '2017-05-12 15:41:28'),
(767, 166, 18, 0, 0, '2017-05-12 15:41:29', '2017-05-12 15:41:29'),
(768, 166, 19, 0, 0, '2017-05-12 15:41:31', '2017-05-12 15:41:31'),
(769, 166, 20, 0, 0, '2017-05-12 15:41:32', '2017-05-12 15:41:32'),
(770, 166, 21, 0, 0, '2017-05-12 15:41:33', '2017-05-12 15:41:33'),
(771, 166, 22, 0, 0, '2017-05-12 15:41:34', '2017-05-12 15:41:34'),
(772, 166, 23, 0, 0, '2017-05-12 15:41:36', '2017-05-12 15:41:36'),
(773, 166, 49, 0, 0, '2017-05-12 15:41:37', '2017-05-12 15:41:37'),
(776, 166, 82, 0, 0, NULL, '2017-05-12 15:47:29'),
(777, 162, 83, 0, 0, NULL, '2017-05-12 16:07:34'),
(778, 166, 84, 0, 0, NULL, '2017-05-12 17:10:07'),
(779, 162, 85, 0, 0, NULL, '2017-05-12 17:26:04');

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
(5272, 166, 1, 82, 1, 4, NULL, NULL),
(5273, 166, 1, 82, 2, 5, NULL, NULL),
(5274, 166, 1, 82, 3, 5, NULL, NULL),
(5275, 166, 1, 82, 4, 4, NULL, NULL),
(5276, 166, 1, 82, 5, 5, NULL, NULL),
(5277, 166, 1, 82, 6, 5, NULL, NULL),
(5278, 166, 1, 82, 7, 4, NULL, NULL),
(5279, 166, 1, 82, 8, 5, NULL, NULL),
(5280, 166, 1, 82, 9, 5, NULL, NULL),
(5281, 166, 1, 82, 10, 5, NULL, NULL),
(5282, 166, 1, 82, 11, 4, NULL, NULL),
(5283, 166, 1, 82, 12, 4, NULL, NULL),
(5284, 166, 1, 82, 13, 5, NULL, NULL),
(5285, 166, 1, 82, 14, 4, NULL, NULL),
(5286, 166, 1, 82, 15, 4, NULL, NULL),
(5287, 166, 1, 82, 16, 5, NULL, NULL),
(5288, 166, 1, 82, 17, 4, NULL, NULL),
(5289, 166, 1, 82, 18, 5, NULL, NULL),
(5290, 166, 1, 82, 19, 4, NULL, NULL),
(5291, 166, 1, 82, 20, 4, NULL, NULL),
(5292, 166, 1, 82, 21, 5, NULL, NULL),
(5293, 166, 1, 82, 22, 4, NULL, NULL),
(5294, 166, 1, 82, 23, 5, NULL, NULL),
(5295, 166, 1, 82, 24, 4, NULL, NULL),
(5296, 166, 1, 82, 25, 4, NULL, NULL),
(5297, 166, 1, 82, 26, 4, NULL, NULL),
(5298, 166, 1, 82, 27, 4, NULL, NULL),
(5299, 166, 1, 82, 28, 5, NULL, NULL),
(5300, 166, 1, 82, 29, 4, NULL, NULL),
(5301, 166, 1, 82, 30, 4, NULL, NULL),
(5302, 166, 1, 82, 31, 4, NULL, NULL),
(5303, 166, 1, 82, 32, 4, NULL, NULL),
(5304, 166, 1, 82, 33, 4, NULL, NULL),
(5305, 166, 1, 82, 34, 5, NULL, NULL),
(5306, 162, 3, 83, 1, 4, NULL, NULL),
(5307, 162, 3, 83, 2, 4, NULL, NULL),
(5308, 162, 3, 83, 3, 4, NULL, NULL),
(5309, 162, 3, 83, 4, 5, NULL, NULL),
(5310, 162, 3, 83, 5, 4, NULL, NULL),
(5311, 162, 3, 83, 6, 4, NULL, NULL),
(5312, 162, 3, 83, 7, 5, NULL, NULL),
(5313, 162, 3, 83, 8, 4, NULL, NULL),
(5314, 162, 3, 83, 9, 4, NULL, NULL),
(5315, 162, 3, 83, 10, 4, NULL, NULL),
(5316, 162, 3, 83, 11, 4, NULL, NULL),
(5317, 162, 3, 83, 12, 5, NULL, NULL),
(5318, 162, 3, 83, 13, 4, NULL, NULL),
(5319, 162, 3, 83, 14, 5, NULL, NULL),
(5320, 162, 3, 83, 15, 4, NULL, NULL),
(5321, 162, 3, 83, 16, 4, NULL, NULL),
(5322, 162, 3, 83, 17, 5, NULL, NULL),
(5323, 162, 3, 83, 18, 4, NULL, NULL),
(5324, 162, 3, 83, 19, 4, NULL, NULL),
(5325, 162, 3, 83, 20, 4, NULL, NULL),
(5326, 162, 3, 83, 21, 4, NULL, NULL),
(5327, 162, 3, 83, 22, 4, NULL, NULL),
(5328, 162, 3, 83, 23, 4, NULL, NULL),
(5329, 162, 3, 83, 24, 4, NULL, NULL),
(5330, 162, 3, 83, 25, 5, NULL, NULL),
(5331, 162, 3, 83, 26, 4, NULL, NULL),
(5332, 162, 3, 83, 27, 4, NULL, NULL),
(5333, 162, 3, 83, 28, 5, NULL, NULL),
(5334, 162, 3, 83, 29, 5, NULL, NULL),
(5335, 162, 3, 83, 30, 4, NULL, NULL),
(5336, 162, 3, 83, 31, 4, NULL, NULL),
(5337, 162, 3, 83, 32, 5, NULL, NULL),
(5338, 162, 3, 83, 33, 4, NULL, NULL),
(5339, 162, 3, 83, 34, 5, NULL, NULL),
(5340, 166, 1, 3, 1, 4, NULL, NULL),
(5341, 166, 1, 3, 2, 4, NULL, NULL),
(5342, 166, 1, 3, 3, 5, NULL, NULL),
(5343, 166, 1, 3, 4, 5, NULL, NULL),
(5344, 166, 1, 3, 5, 4, NULL, NULL),
(5345, 166, 1, 3, 6, 5, NULL, NULL),
(5346, 166, 1, 3, 7, 4, NULL, NULL),
(5347, 166, 1, 3, 8, 4, NULL, NULL),
(5348, 166, 1, 3, 9, 4, NULL, NULL),
(5349, 166, 1, 3, 10, 5, NULL, NULL),
(5350, 166, 1, 3, 11, 5, NULL, NULL),
(5351, 166, 1, 3, 12, 4, NULL, NULL),
(5352, 166, 1, 3, 13, 4, NULL, NULL),
(5353, 166, 1, 3, 14, 4, NULL, NULL),
(5354, 166, 1, 3, 15, 4, NULL, NULL),
(5355, 166, 1, 3, 16, 4, NULL, NULL),
(5356, 166, 1, 3, 17, 4, NULL, NULL),
(5357, 166, 1, 3, 18, 5, NULL, NULL),
(5358, 166, 1, 3, 19, 4, NULL, NULL),
(5359, 166, 1, 3, 20, 4, NULL, NULL),
(5360, 166, 1, 3, 21, 4, NULL, NULL),
(5361, 166, 1, 3, 22, 4, NULL, NULL),
(5362, 166, 1, 3, 23, 4, NULL, NULL),
(5363, 166, 1, 3, 24, 4, NULL, NULL),
(5364, 166, 1, 3, 25, 4, NULL, NULL),
(5365, 166, 1, 3, 26, 5, NULL, NULL),
(5366, 166, 1, 3, 27, 4, NULL, NULL),
(5367, 166, 1, 3, 28, 5, NULL, NULL),
(5368, 166, 1, 3, 29, 4, NULL, NULL),
(5369, 166, 1, 3, 30, 5, NULL, NULL),
(5370, 166, 1, 3, 31, 5, NULL, NULL),
(5371, 166, 1, 3, 32, 4, NULL, NULL),
(5372, 166, 1, 3, 33, 5, NULL, NULL),
(5373, 166, 1, 3, 34, 4, NULL, NULL),
(5374, 162, 3, 16, 1, 5, NULL, NULL),
(5375, 162, 3, 16, 2, 5, NULL, NULL),
(5376, 162, 3, 16, 3, 4, NULL, NULL),
(5377, 162, 3, 16, 4, 5, NULL, NULL),
(5378, 162, 3, 16, 5, 4, NULL, NULL),
(5379, 162, 3, 16, 6, 4, NULL, NULL),
(5380, 162, 3, 16, 7, 4, NULL, NULL),
(5381, 162, 3, 16, 8, 4, NULL, NULL),
(5382, 162, 3, 16, 9, 4, NULL, NULL),
(5383, 162, 3, 16, 10, 5, NULL, NULL),
(5384, 162, 3, 16, 11, 4, NULL, NULL),
(5385, 162, 3, 16, 12, 4, NULL, NULL),
(5386, 162, 3, 16, 13, 4, NULL, NULL),
(5387, 162, 3, 16, 14, 4, NULL, NULL),
(5388, 162, 3, 16, 15, 4, NULL, NULL),
(5389, 162, 3, 16, 16, 5, NULL, NULL),
(5390, 162, 3, 16, 17, 4, NULL, NULL),
(5391, 162, 3, 16, 18, 4, NULL, NULL),
(5392, 162, 3, 16, 19, 4, NULL, NULL),
(5393, 162, 3, 16, 20, 5, NULL, NULL),
(5394, 162, 3, 16, 21, 4, NULL, NULL),
(5395, 162, 3, 16, 22, 4, NULL, NULL),
(5396, 162, 3, 16, 23, 5, NULL, NULL),
(5397, 162, 3, 16, 24, 4, NULL, NULL),
(5398, 162, 3, 16, 25, 5, NULL, NULL),
(5399, 162, 3, 16, 26, 4, NULL, NULL),
(5400, 162, 3, 16, 27, 5, NULL, NULL),
(5401, 162, 3, 16, 28, 4, NULL, NULL),
(5402, 162, 3, 16, 29, 5, NULL, NULL),
(5403, 162, 3, 16, 30, 5, NULL, NULL),
(5404, 162, 3, 16, 31, 4, NULL, NULL),
(5405, 162, 3, 16, 32, 5, NULL, NULL),
(5406, 162, 3, 16, 33, 4, NULL, NULL),
(5407, 162, 3, 16, 34, 4, NULL, NULL),
(5408, 162, 3, 15, 1, 5, NULL, NULL),
(5409, 162, 3, 15, 2, 4, NULL, NULL),
(5410, 162, 3, 15, 3, 4, NULL, NULL),
(5411, 162, 3, 15, 4, 4, NULL, NULL),
(5412, 162, 3, 15, 5, 5, NULL, NULL),
(5413, 162, 3, 15, 6, 4, NULL, NULL),
(5414, 162, 3, 15, 7, 5, NULL, NULL),
(5415, 162, 3, 15, 8, 5, NULL, NULL),
(5416, 162, 3, 15, 9, 4, NULL, NULL),
(5417, 162, 3, 15, 10, 5, NULL, NULL),
(5418, 162, 3, 15, 11, 5, NULL, NULL),
(5419, 162, 3, 15, 12, 4, NULL, NULL),
(5420, 162, 3, 15, 13, 5, NULL, NULL),
(5421, 162, 3, 15, 14, 4, NULL, NULL),
(5422, 162, 3, 15, 15, 5, NULL, NULL),
(5423, 162, 3, 15, 16, 4, NULL, NULL),
(5424, 162, 3, 15, 17, 4, NULL, NULL),
(5425, 162, 3, 15, 18, 4, NULL, NULL),
(5426, 162, 3, 15, 19, 4, NULL, NULL),
(5427, 162, 3, 15, 20, 5, NULL, NULL),
(5428, 162, 3, 15, 21, 5, NULL, NULL),
(5429, 162, 3, 15, 22, 4, NULL, NULL),
(5430, 162, 3, 15, 23, 5, NULL, NULL),
(5431, 162, 3, 15, 24, 5, NULL, NULL),
(5432, 162, 3, 15, 25, 4, NULL, NULL),
(5433, 162, 3, 15, 26, 4, NULL, NULL),
(5434, 162, 3, 15, 27, 5, NULL, NULL),
(5435, 162, 3, 15, 28, 4, NULL, NULL),
(5436, 162, 3, 15, 29, 5, NULL, NULL),
(5437, 162, 3, 15, 30, 4, NULL, NULL),
(5438, 162, 3, 15, 31, 5, NULL, NULL),
(5439, 162, 3, 15, 32, 4, NULL, NULL),
(5440, 162, 3, 15, 33, 4, NULL, NULL),
(5441, 162, 3, 15, 34, 5, NULL, NULL),
(5442, 162, 16, 15, 1, 4, NULL, NULL),
(5443, 162, 16, 15, 2, 5, NULL, NULL),
(5444, 162, 16, 15, 3, 4, NULL, NULL),
(5445, 162, 16, 15, 4, 5, NULL, NULL),
(5446, 162, 16, 15, 5, 4, NULL, NULL),
(5447, 162, 16, 15, 6, 5, NULL, NULL),
(5448, 162, 16, 15, 7, 5, NULL, NULL),
(5449, 162, 16, 15, 8, 5, NULL, NULL),
(5450, 162, 16, 15, 9, 5, NULL, NULL),
(5451, 162, 16, 15, 10, 5, NULL, NULL),
(5452, 162, 16, 15, 11, 5, NULL, NULL),
(5453, 162, 16, 15, 12, 4, NULL, NULL),
(5454, 162, 16, 15, 13, 5, NULL, NULL),
(5455, 162, 16, 15, 14, 4, NULL, NULL),
(5456, 162, 16, 15, 15, 4, NULL, NULL),
(5457, 162, 16, 15, 16, 5, NULL, NULL),
(5458, 162, 16, 15, 17, 4, NULL, NULL),
(5459, 162, 16, 15, 18, 5, NULL, NULL),
(5460, 162, 16, 15, 19, 4, NULL, NULL),
(5461, 162, 16, 15, 20, 5, NULL, NULL),
(5462, 162, 16, 15, 21, 5, NULL, NULL),
(5463, 162, 16, 15, 22, 5, NULL, NULL),
(5464, 162, 16, 15, 23, 4, NULL, NULL),
(5465, 162, 16, 15, 24, 5, NULL, NULL),
(5466, 162, 16, 15, 25, 4, NULL, NULL),
(5467, 162, 16, 15, 26, 4, NULL, NULL),
(5468, 162, 16, 15, 27, 4, NULL, NULL),
(5469, 162, 16, 15, 28, 5, NULL, NULL),
(5470, 162, 16, 15, 29, 4, NULL, NULL),
(5471, 162, 16, 15, 30, 4, NULL, NULL),
(5472, 162, 16, 15, 31, 5, NULL, NULL),
(5473, 162, 16, 15, 32, 4, NULL, NULL),
(5474, 162, 16, 15, 33, 5, NULL, NULL),
(5475, 162, 16, 15, 34, 4, NULL, NULL),
(5476, 166, 1, 15, 1, 4, NULL, NULL),
(5477, 166, 1, 15, 2, 5, NULL, NULL),
(5478, 166, 1, 15, 3, 5, NULL, NULL),
(5479, 166, 1, 15, 4, 4, NULL, NULL),
(5480, 166, 1, 15, 5, 4, NULL, NULL),
(5481, 166, 1, 15, 6, 4, NULL, NULL),
(5482, 166, 1, 15, 7, 4, NULL, NULL),
(5483, 166, 1, 15, 8, 4, NULL, NULL),
(5484, 166, 1, 15, 9, 4, NULL, NULL),
(5485, 166, 1, 15, 10, 4, NULL, NULL),
(5486, 166, 1, 15, 11, 4, NULL, NULL),
(5487, 166, 1, 15, 12, 4, NULL, NULL),
(5488, 166, 1, 15, 13, 4, NULL, NULL),
(5489, 166, 1, 15, 14, 4, NULL, NULL),
(5490, 166, 1, 15, 15, 4, NULL, NULL),
(5491, 166, 1, 15, 16, 4, NULL, NULL),
(5492, 166, 1, 15, 17, 5, NULL, NULL),
(5493, 166, 1, 15, 18, 4, NULL, NULL),
(5494, 166, 1, 15, 19, 4, NULL, NULL),
(5495, 166, 1, 15, 20, 5, NULL, NULL),
(5496, 166, 1, 15, 21, 4, NULL, NULL),
(5497, 166, 1, 15, 22, 4, NULL, NULL),
(5498, 166, 1, 15, 23, 4, NULL, NULL),
(5499, 166, 1, 15, 24, 4, NULL, NULL),
(5500, 166, 1, 15, 25, 5, NULL, NULL),
(5501, 166, 1, 15, 26, 5, NULL, NULL),
(5502, 166, 1, 15, 27, 4, NULL, NULL),
(5503, 166, 1, 15, 28, 4, NULL, NULL),
(5504, 166, 1, 15, 29, 4, NULL, NULL),
(5505, 166, 1, 15, 30, 4, NULL, NULL),
(5506, 166, 1, 15, 31, 4, NULL, NULL),
(5507, 166, 1, 15, 32, 4, NULL, NULL),
(5508, 166, 1, 15, 33, 4, NULL, NULL),
(5509, 166, 1, 15, 34, 4, NULL, NULL),
(5510, 166, 3, 15, 1, 4, NULL, NULL),
(5511, 166, 3, 15, 2, 4, NULL, NULL),
(5512, 166, 3, 15, 3, 4, NULL, NULL),
(5513, 166, 3, 15, 4, 5, NULL, NULL),
(5514, 166, 3, 15, 5, 4, NULL, NULL),
(5515, 166, 3, 15, 6, 5, NULL, NULL),
(5516, 166, 3, 15, 7, 4, NULL, NULL),
(5517, 166, 3, 15, 8, 4, NULL, NULL),
(5518, 166, 3, 15, 9, 5, NULL, NULL),
(5519, 166, 3, 15, 10, 4, NULL, NULL),
(5520, 166, 3, 15, 11, 4, NULL, NULL),
(5521, 166, 3, 15, 12, 4, NULL, NULL),
(5522, 166, 3, 15, 13, 4, NULL, NULL),
(5523, 166, 3, 15, 14, 5, NULL, NULL),
(5524, 166, 3, 15, 15, 4, NULL, NULL),
(5525, 166, 3, 15, 16, 4, NULL, NULL),
(5526, 166, 3, 15, 17, 4, NULL, NULL),
(5527, 166, 3, 15, 18, 4, NULL, NULL),
(5528, 166, 3, 15, 19, 5, NULL, NULL),
(5529, 166, 3, 15, 20, 5, NULL, NULL),
(5530, 166, 3, 15, 21, 5, NULL, NULL),
(5531, 166, 3, 15, 22, 4, NULL, NULL),
(5532, 166, 3, 15, 23, 4, NULL, NULL),
(5533, 166, 3, 15, 24, 4, NULL, NULL),
(5534, 166, 3, 15, 25, 5, NULL, NULL),
(5535, 166, 3, 15, 26, 4, NULL, NULL),
(5536, 166, 3, 15, 27, 5, NULL, NULL),
(5537, 166, 3, 15, 28, 4, NULL, NULL),
(5538, 166, 3, 15, 29, 4, NULL, NULL),
(5539, 166, 3, 15, 30, 5, NULL, NULL),
(5540, 166, 3, 15, 31, 5, NULL, NULL),
(5541, 166, 3, 15, 32, 5, NULL, NULL),
(5542, 166, 3, 15, 33, 4, NULL, NULL),
(5543, 166, 3, 15, 34, 4, NULL, NULL),
(5544, 166, 15, 82, 1, 5, NULL, NULL),
(5545, 166, 15, 82, 2, 5, NULL, NULL),
(5546, 166, 15, 82, 3, 5, NULL, NULL),
(5547, 166, 15, 82, 4, 5, NULL, NULL),
(5548, 166, 15, 82, 5, 5, NULL, NULL),
(5549, 166, 15, 82, 6, 5, NULL, NULL),
(5550, 166, 15, 82, 7, 4, NULL, NULL),
(5551, 166, 15, 82, 8, 4, NULL, NULL),
(5552, 166, 15, 82, 9, 4, NULL, NULL),
(5553, 166, 15, 82, 10, 4, NULL, NULL),
(5554, 166, 15, 82, 11, 4, NULL, NULL),
(5555, 166, 15, 82, 12, 4, NULL, NULL),
(5556, 166, 15, 82, 13, 5, NULL, NULL),
(5557, 166, 15, 82, 14, 5, NULL, NULL),
(5558, 166, 15, 82, 15, 5, NULL, NULL),
(5559, 166, 15, 82, 16, 4, NULL, NULL),
(5560, 166, 15, 82, 17, 5, NULL, NULL),
(5561, 166, 15, 82, 18, 4, NULL, NULL),
(5562, 166, 15, 82, 19, 4, NULL, NULL),
(5563, 166, 15, 82, 20, 5, NULL, NULL),
(5564, 166, 15, 82, 21, 5, NULL, NULL),
(5565, 166, 15, 82, 22, 4, NULL, NULL),
(5566, 166, 15, 82, 23, 4, NULL, NULL),
(5567, 166, 15, 82, 24, 4, NULL, NULL),
(5568, 166, 15, 82, 25, 4, NULL, NULL),
(5569, 166, 15, 82, 26, 5, NULL, NULL),
(5570, 166, 15, 82, 27, 5, NULL, NULL),
(5571, 166, 15, 82, 28, 4, NULL, NULL),
(5572, 166, 15, 82, 29, 4, NULL, NULL),
(5573, 166, 15, 82, 30, 5, NULL, NULL),
(5574, 166, 15, 82, 31, 4, NULL, NULL),
(5575, 166, 15, 82, 32, 5, NULL, NULL),
(5576, 166, 15, 82, 33, 4, NULL, NULL),
(5577, 166, 15, 82, 34, 4, NULL, NULL),
(5578, 162, 15, 3, 1, 4, NULL, NULL),
(5579, 162, 15, 3, 2, 4, NULL, NULL),
(5580, 162, 15, 3, 3, 5, NULL, NULL),
(5581, 162, 15, 3, 4, 4, NULL, NULL),
(5582, 162, 15, 3, 5, 5, NULL, NULL),
(5583, 162, 15, 3, 6, 5, NULL, NULL),
(5584, 162, 15, 3, 7, 4, NULL, NULL),
(5585, 162, 15, 3, 8, 5, NULL, NULL),
(5586, 162, 15, 3, 9, 5, NULL, NULL),
(5587, 162, 15, 3, 10, 5, NULL, NULL),
(5588, 162, 15, 3, 11, 4, NULL, NULL),
(5589, 162, 15, 3, 12, 5, NULL, NULL),
(5590, 162, 15, 3, 13, 4, NULL, NULL),
(5591, 162, 15, 3, 14, 5, NULL, NULL),
(5592, 162, 15, 3, 15, 5, NULL, NULL),
(5593, 162, 15, 3, 16, 4, NULL, NULL),
(5594, 162, 15, 3, 17, 5, NULL, NULL),
(5595, 162, 15, 3, 18, 5, NULL, NULL),
(5596, 162, 15, 3, 19, 5, NULL, NULL),
(5597, 162, 15, 3, 20, 5, NULL, NULL),
(5598, 162, 15, 3, 21, 4, NULL, NULL),
(5599, 162, 15, 3, 22, 4, NULL, NULL),
(5600, 162, 15, 3, 23, 5, NULL, NULL),
(5601, 162, 15, 3, 24, 5, NULL, NULL),
(5602, 162, 15, 3, 25, 4, NULL, NULL),
(5603, 162, 15, 3, 26, 4, NULL, NULL),
(5604, 162, 15, 3, 27, 5, NULL, NULL),
(5605, 162, 15, 3, 28, 4, NULL, NULL),
(5606, 162, 15, 3, 29, 5, NULL, NULL),
(5607, 162, 15, 3, 30, 4, NULL, NULL),
(5608, 162, 15, 3, 31, 4, NULL, NULL),
(5609, 162, 15, 3, 32, 5, NULL, NULL),
(5610, 162, 15, 3, 33, 5, NULL, NULL),
(5611, 162, 15, 3, 34, 4, NULL, NULL),
(5612, 162, 16, 3, 1, 4, NULL, NULL),
(5613, 162, 16, 3, 2, 4, NULL, NULL),
(5614, 162, 16, 3, 3, 5, NULL, NULL),
(5615, 162, 16, 3, 4, 4, NULL, NULL),
(5616, 162, 16, 3, 5, 5, NULL, NULL),
(5617, 162, 16, 3, 6, 5, NULL, NULL),
(5618, 162, 16, 3, 7, 4, NULL, NULL),
(5619, 162, 16, 3, 8, 5, NULL, NULL),
(5620, 162, 16, 3, 9, 4, NULL, NULL),
(5621, 162, 16, 3, 10, 5, NULL, NULL),
(5622, 162, 16, 3, 11, 5, NULL, NULL),
(5623, 162, 16, 3, 12, 4, NULL, NULL),
(5624, 162, 16, 3, 13, 5, NULL, NULL),
(5625, 162, 16, 3, 14, 5, NULL, NULL),
(5626, 162, 16, 3, 15, 4, NULL, NULL),
(5627, 162, 16, 3, 16, 4, NULL, NULL),
(5628, 162, 16, 3, 17, 5, NULL, NULL),
(5629, 162, 16, 3, 18, 4, NULL, NULL),
(5630, 162, 16, 3, 19, 5, NULL, NULL),
(5631, 162, 16, 3, 20, 4, NULL, NULL),
(5632, 162, 16, 3, 21, 4, NULL, NULL),
(5633, 162, 16, 3, 22, 4, NULL, NULL),
(5634, 162, 16, 3, 23, 4, NULL, NULL),
(5635, 162, 16, 3, 24, 4, NULL, NULL),
(5636, 162, 16, 3, 25, 4, NULL, NULL),
(5637, 162, 16, 3, 26, 4, NULL, NULL),
(5638, 162, 16, 3, 27, 4, NULL, NULL),
(5639, 162, 16, 3, 28, 4, NULL, NULL),
(5640, 162, 16, 3, 29, 4, NULL, NULL),
(5641, 162, 16, 3, 30, 4, NULL, NULL),
(5642, 162, 16, 3, 31, 4, NULL, NULL),
(5643, 162, 16, 3, 32, 4, NULL, NULL),
(5644, 162, 16, 3, 33, 5, NULL, NULL),
(5645, 162, 16, 3, 34, 4, NULL, NULL),
(5646, 166, 3, 1, 1, 4, NULL, NULL),
(5647, 166, 3, 1, 2, 5, NULL, NULL),
(5648, 166, 3, 1, 3, 4, NULL, NULL),
(5649, 166, 3, 1, 4, 4, NULL, NULL),
(5650, 166, 3, 1, 5, 4, NULL, NULL),
(5651, 166, 3, 1, 6, 5, NULL, NULL),
(5652, 166, 3, 1, 7, 4, NULL, NULL),
(5653, 166, 3, 1, 8, 4, NULL, NULL),
(5654, 166, 3, 1, 9, 4, NULL, NULL),
(5655, 166, 3, 1, 10, 4, NULL, NULL),
(5656, 166, 3, 1, 11, 4, NULL, NULL),
(5657, 166, 3, 1, 12, 5, NULL, NULL),
(5658, 166, 3, 1, 13, 4, NULL, NULL),
(5659, 166, 3, 1, 14, 5, NULL, NULL),
(5660, 166, 3, 1, 15, 4, NULL, NULL),
(5661, 166, 3, 1, 16, 5, NULL, NULL),
(5662, 166, 3, 1, 17, 5, NULL, NULL),
(5663, 166, 3, 1, 18, 4, NULL, NULL),
(5664, 166, 3, 1, 19, 5, NULL, NULL),
(5665, 166, 3, 1, 20, 5, NULL, NULL),
(5666, 166, 3, 1, 21, 4, NULL, NULL),
(5667, 166, 3, 1, 22, 4, NULL, NULL),
(5668, 166, 3, 1, 23, 4, NULL, NULL),
(5669, 166, 3, 1, 24, 4, NULL, NULL),
(5670, 166, 3, 1, 25, 4, NULL, NULL),
(5671, 166, 3, 1, 26, 5, NULL, NULL),
(5672, 166, 3, 1, 27, 5, NULL, NULL),
(5673, 166, 3, 1, 28, 5, NULL, NULL),
(5674, 166, 3, 1, 29, 5, NULL, NULL),
(5675, 166, 3, 1, 30, 4, NULL, NULL),
(5676, 166, 3, 1, 31, 5, NULL, NULL),
(5677, 166, 3, 1, 32, 5, NULL, NULL),
(5678, 166, 3, 1, 33, 4, NULL, NULL),
(5679, 166, 3, 1, 34, 4, NULL, NULL),
(5680, 166, 15, 1, 1, 5, NULL, NULL),
(5681, 166, 15, 1, 2, 5, NULL, NULL),
(5682, 166, 15, 1, 3, 5, NULL, NULL),
(5683, 166, 15, 1, 4, 4, NULL, NULL),
(5684, 166, 15, 1, 5, 4, NULL, NULL),
(5685, 166, 15, 1, 6, 4, NULL, NULL),
(5686, 166, 15, 1, 7, 5, NULL, NULL),
(5687, 166, 15, 1, 8, 4, NULL, NULL),
(5688, 166, 15, 1, 9, 5, NULL, NULL),
(5689, 166, 15, 1, 10, 5, NULL, NULL),
(5690, 166, 15, 1, 11, 5, NULL, NULL),
(5691, 166, 15, 1, 12, 5, NULL, NULL),
(5692, 166, 15, 1, 13, 4, NULL, NULL),
(5693, 166, 15, 1, 14, 4, NULL, NULL),
(5694, 166, 15, 1, 15, 4, NULL, NULL),
(5695, 166, 15, 1, 16, 4, NULL, NULL),
(5696, 166, 15, 1, 17, 5, NULL, NULL),
(5697, 166, 15, 1, 18, 4, NULL, NULL),
(5698, 166, 15, 1, 19, 4, NULL, NULL),
(5699, 166, 15, 1, 20, 5, NULL, NULL),
(5700, 166, 15, 1, 21, 5, NULL, NULL),
(5701, 166, 15, 1, 22, 4, NULL, NULL),
(5702, 166, 15, 1, 23, 4, NULL, NULL),
(5703, 166, 15, 1, 24, 4, NULL, NULL),
(5704, 166, 15, 1, 25, 5, NULL, NULL),
(5705, 166, 15, 1, 26, 5, NULL, NULL),
(5706, 166, 15, 1, 27, 4, NULL, NULL),
(5707, 166, 15, 1, 28, 4, NULL, NULL),
(5708, 166, 15, 1, 29, 4, NULL, NULL),
(5709, 166, 15, 1, 30, 5, NULL, NULL),
(5710, 166, 15, 1, 31, 5, NULL, NULL),
(5711, 166, 15, 1, 32, 4, NULL, NULL),
(5712, 166, 15, 1, 33, 5, NULL, NULL),
(5713, 166, 15, 1, 34, 4, NULL, NULL),
(5714, 166, 3, 2, 1, 5, NULL, NULL),
(5715, 166, 3, 2, 2, 4, NULL, NULL),
(5716, 166, 3, 2, 3, 4, NULL, NULL),
(5717, 166, 3, 2, 4, 4, NULL, NULL),
(5718, 166, 3, 2, 5, 4, NULL, NULL),
(5719, 166, 3, 2, 6, 5, NULL, NULL),
(5720, 166, 3, 2, 7, 4, NULL, NULL),
(5721, 166, 3, 2, 8, 4, NULL, NULL),
(5722, 166, 3, 2, 9, 5, NULL, NULL),
(5723, 166, 3, 2, 10, 5, NULL, NULL),
(5724, 166, 3, 2, 11, 4, NULL, NULL),
(5725, 166, 3, 2, 12, 5, NULL, NULL),
(5726, 166, 3, 2, 13, 4, NULL, NULL),
(5727, 166, 3, 2, 14, 4, NULL, NULL),
(5728, 166, 3, 2, 15, 5, NULL, NULL),
(5729, 166, 3, 2, 16, 4, NULL, NULL),
(5730, 166, 3, 2, 17, 5, NULL, NULL),
(5731, 166, 3, 2, 18, 4, NULL, NULL),
(5732, 166, 3, 2, 19, 4, NULL, NULL),
(5733, 166, 3, 2, 20, 5, NULL, NULL),
(5734, 166, 3, 2, 21, 4, NULL, NULL),
(5735, 166, 3, 2, 22, 4, NULL, NULL),
(5736, 166, 3, 2, 23, 5, NULL, NULL),
(5737, 166, 3, 2, 24, 4, NULL, NULL),
(5738, 166, 3, 2, 25, 5, NULL, NULL),
(5739, 166, 3, 2, 26, 5, NULL, NULL),
(5740, 166, 3, 2, 27, 5, NULL, NULL),
(5741, 166, 3, 2, 28, 4, NULL, NULL),
(5742, 166, 3, 2, 29, 4, NULL, NULL),
(5743, 166, 3, 2, 30, 4, NULL, NULL),
(5744, 166, 3, 2, 31, 5, NULL, NULL),
(5745, 166, 3, 2, 32, 4, NULL, NULL),
(5746, 166, 3, 2, 33, 5, NULL, NULL),
(5747, 166, 3, 2, 34, 4, NULL, NULL),
(5748, 166, 15, 2, 1, 5, NULL, NULL),
(5749, 166, 15, 2, 2, 5, NULL, NULL),
(5750, 166, 15, 2, 3, 4, NULL, NULL),
(5751, 166, 15, 2, 4, 4, NULL, NULL),
(5752, 166, 15, 2, 5, 5, NULL, NULL),
(5753, 166, 15, 2, 6, 4, NULL, NULL),
(5754, 166, 15, 2, 7, 5, NULL, NULL),
(5755, 166, 15, 2, 8, 5, NULL, NULL),
(5756, 166, 15, 2, 9, 5, NULL, NULL),
(5757, 166, 15, 2, 10, 5, NULL, NULL),
(5758, 166, 15, 2, 11, 5, NULL, NULL),
(5759, 166, 15, 2, 12, 4, NULL, NULL),
(5760, 166, 15, 2, 13, 4, NULL, NULL),
(5761, 166, 15, 2, 14, 5, NULL, NULL),
(5762, 166, 15, 2, 15, 4, NULL, NULL),
(5763, 166, 15, 2, 16, 5, NULL, NULL),
(5764, 166, 15, 2, 17, 5, NULL, NULL),
(5765, 166, 15, 2, 18, 5, NULL, NULL),
(5766, 166, 15, 2, 19, 5, NULL, NULL),
(5767, 166, 15, 2, 20, 5, NULL, NULL),
(5768, 166, 15, 2, 21, 5, NULL, NULL),
(5769, 166, 15, 2, 22, 4, NULL, NULL),
(5770, 166, 15, 2, 23, 4, NULL, NULL),
(5771, 166, 15, 2, 24, 4, NULL, NULL),
(5772, 166, 15, 2, 25, 4, NULL, NULL),
(5773, 166, 15, 2, 26, 5, NULL, NULL),
(5774, 166, 15, 2, 27, 5, NULL, NULL),
(5775, 166, 15, 2, 28, 4, NULL, NULL),
(5776, 166, 15, 2, 29, 5, NULL, NULL),
(5777, 166, 15, 2, 30, 4, NULL, NULL),
(5778, 166, 15, 2, 31, 5, NULL, NULL),
(5779, 166, 15, 2, 32, 4, NULL, NULL),
(5780, 166, 15, 2, 33, 5, NULL, NULL),
(5781, 166, 15, 2, 34, 4, NULL, NULL),
(5782, 166, 2, 84, 1, 4, NULL, NULL),
(5783, 166, 2, 84, 2, 4, NULL, NULL),
(5784, 166, 2, 84, 3, 4, NULL, NULL),
(5785, 166, 2, 84, 4, 5, NULL, NULL),
(5786, 166, 2, 84, 5, 5, NULL, NULL),
(5787, 166, 2, 84, 6, 5, NULL, NULL),
(5788, 166, 2, 84, 7, 4, NULL, NULL),
(5789, 166, 2, 84, 8, 5, NULL, NULL),
(5790, 166, 2, 84, 9, 4, NULL, NULL),
(5791, 166, 2, 84, 10, 4, NULL, NULL),
(5792, 166, 2, 84, 11, 4, NULL, NULL),
(5793, 166, 2, 84, 12, 4, NULL, NULL),
(5794, 166, 2, 84, 13, 4, NULL, NULL),
(5795, 166, 2, 84, 14, 4, NULL, NULL),
(5796, 166, 2, 84, 15, 4, NULL, NULL),
(5797, 166, 2, 84, 16, 5, NULL, NULL),
(5798, 166, 2, 84, 17, 5, NULL, NULL),
(5799, 166, 2, 84, 18, 5, NULL, NULL),
(5800, 166, 2, 84, 19, 4, NULL, NULL),
(5801, 166, 2, 84, 20, 5, NULL, NULL),
(5802, 166, 2, 84, 21, 4, NULL, NULL),
(5803, 166, 2, 84, 22, 5, NULL, NULL),
(5804, 166, 2, 84, 23, 4, NULL, NULL),
(5805, 166, 2, 84, 24, 4, NULL, NULL),
(5806, 166, 2, 84, 25, 5, NULL, NULL),
(5807, 166, 2, 84, 26, 4, NULL, NULL),
(5808, 166, 2, 84, 27, 4, NULL, NULL),
(5809, 166, 2, 84, 28, 4, NULL, NULL),
(5810, 166, 2, 84, 29, 5, NULL, NULL),
(5811, 166, 2, 84, 30, 5, NULL, NULL),
(5812, 166, 2, 84, 31, 4, NULL, NULL),
(5813, 166, 2, 84, 32, 5, NULL, NULL),
(5814, 166, 2, 84, 33, 5, NULL, NULL),
(5815, 166, 2, 84, 34, 4, NULL, NULL),
(5816, 162, 3, 2, 1, 5, NULL, NULL),
(5817, 162, 3, 2, 2, 5, NULL, NULL),
(5818, 162, 3, 2, 3, 5, NULL, NULL),
(5819, 162, 3, 2, 4, 4, NULL, NULL),
(5820, 162, 3, 2, 5, 4, NULL, NULL),
(5821, 162, 3, 2, 6, 5, NULL, NULL),
(5822, 162, 3, 2, 7, 4, NULL, NULL),
(5823, 162, 3, 2, 8, 4, NULL, NULL),
(5824, 162, 3, 2, 9, 4, NULL, NULL),
(5825, 162, 3, 2, 10, 5, NULL, NULL),
(5826, 162, 3, 2, 11, 4, NULL, NULL),
(5827, 162, 3, 2, 12, 4, NULL, NULL),
(5828, 162, 3, 2, 13, 4, NULL, NULL),
(5829, 162, 3, 2, 14, 5, NULL, NULL),
(5830, 162, 3, 2, 15, 4, NULL, NULL),
(5831, 162, 3, 2, 16, 5, NULL, NULL),
(5832, 162, 3, 2, 17, 5, NULL, NULL),
(5833, 162, 3, 2, 18, 5, NULL, NULL),
(5834, 162, 3, 2, 19, 5, NULL, NULL),
(5835, 162, 3, 2, 20, 4, NULL, NULL),
(5836, 162, 3, 2, 21, 5, NULL, NULL),
(5837, 162, 3, 2, 22, 4, NULL, NULL),
(5838, 162, 3, 2, 23, 5, NULL, NULL),
(5839, 162, 3, 2, 24, 5, NULL, NULL),
(5840, 162, 3, 2, 25, 4, NULL, NULL),
(5841, 162, 3, 2, 26, 4, NULL, NULL),
(5842, 162, 3, 2, 27, 4, NULL, NULL),
(5843, 162, 3, 2, 28, 5, NULL, NULL),
(5844, 162, 3, 2, 29, 4, NULL, NULL),
(5845, 162, 3, 2, 30, 5, NULL, NULL),
(5846, 162, 3, 2, 31, 5, NULL, NULL),
(5847, 162, 3, 2, 32, 4, NULL, NULL),
(5848, 162, 3, 2, 33, 5, NULL, NULL),
(5849, 162, 3, 2, 34, 5, NULL, NULL),
(5850, 162, 15, 2, 1, 4, NULL, NULL),
(5851, 162, 15, 2, 2, 4, NULL, NULL),
(5852, 162, 15, 2, 3, 5, NULL, NULL),
(5853, 162, 15, 2, 4, 5, NULL, NULL),
(5854, 162, 15, 2, 5, 4, NULL, NULL),
(5855, 162, 15, 2, 6, 4, NULL, NULL),
(5856, 162, 15, 2, 7, 5, NULL, NULL),
(5857, 162, 15, 2, 8, 4, NULL, NULL),
(5858, 162, 15, 2, 9, 5, NULL, NULL),
(5859, 162, 15, 2, 10, 5, NULL, NULL),
(5860, 162, 15, 2, 11, 5, NULL, NULL),
(5861, 162, 15, 2, 12, 4, NULL, NULL),
(5862, 162, 15, 2, 13, 4, NULL, NULL),
(5863, 162, 15, 2, 14, 5, NULL, NULL),
(5864, 162, 15, 2, 15, 4, NULL, NULL),
(5865, 162, 15, 2, 16, 4, NULL, NULL),
(5866, 162, 15, 2, 17, 4, NULL, NULL),
(5867, 162, 15, 2, 18, 5, NULL, NULL),
(5868, 162, 15, 2, 19, 5, NULL, NULL),
(5869, 162, 15, 2, 20, 5, NULL, NULL),
(5870, 162, 15, 2, 21, 4, NULL, NULL),
(5871, 162, 15, 2, 22, 4, NULL, NULL),
(5872, 162, 15, 2, 23, 4, NULL, NULL),
(5873, 162, 15, 2, 24, 5, NULL, NULL),
(5874, 162, 15, 2, 25, 5, NULL, NULL),
(5875, 162, 15, 2, 26, 4, NULL, NULL),
(5876, 162, 15, 2, 27, 4, NULL, NULL),
(5877, 162, 15, 2, 28, 5, NULL, NULL),
(5878, 162, 15, 2, 29, 5, NULL, NULL),
(5879, 162, 15, 2, 30, 4, NULL, NULL),
(5880, 162, 15, 2, 31, 4, NULL, NULL),
(5881, 162, 15, 2, 32, 4, NULL, NULL),
(5882, 162, 15, 2, 33, 5, NULL, NULL),
(5883, 162, 15, 2, 34, 4, NULL, NULL),
(5884, 162, 16, 2, 1, 5, NULL, NULL),
(5885, 162, 16, 2, 2, 4, NULL, NULL),
(5886, 162, 16, 2, 3, 5, NULL, NULL),
(5887, 162, 16, 2, 4, 5, NULL, NULL),
(5888, 162, 16, 2, 5, 4, NULL, NULL),
(5889, 162, 16, 2, 6, 4, NULL, NULL),
(5890, 162, 16, 2, 7, 5, NULL, NULL),
(5891, 162, 16, 2, 8, 4, NULL, NULL),
(5892, 162, 16, 2, 9, 4, NULL, NULL),
(5893, 162, 16, 2, 10, 4, NULL, NULL),
(5894, 162, 16, 2, 11, 4, NULL, NULL),
(5895, 162, 16, 2, 12, 5, NULL, NULL),
(5896, 162, 16, 2, 13, 5, NULL, NULL),
(5897, 162, 16, 2, 14, 4, NULL, NULL),
(5898, 162, 16, 2, 15, 5, NULL, NULL),
(5899, 162, 16, 2, 16, 4, NULL, NULL),
(5900, 162, 16, 2, 17, 4, NULL, NULL),
(5901, 162, 16, 2, 18, 5, NULL, NULL),
(5902, 162, 16, 2, 19, 4, NULL, NULL),
(5903, 162, 16, 2, 20, 5, NULL, NULL),
(5904, 162, 16, 2, 21, 5, NULL, NULL),
(5905, 162, 16, 2, 22, 4, NULL, NULL),
(5906, 162, 16, 2, 23, 5, NULL, NULL),
(5907, 162, 16, 2, 24, 4, NULL, NULL),
(5908, 162, 16, 2, 25, 4, NULL, NULL),
(5909, 162, 16, 2, 26, 4, NULL, NULL),
(5910, 162, 16, 2, 27, 5, NULL, NULL),
(5911, 162, 16, 2, 28, 5, NULL, NULL),
(5912, 162, 16, 2, 29, 4, NULL, NULL),
(5913, 162, 16, 2, 30, 4, NULL, NULL),
(5914, 162, 16, 2, 31, 5, NULL, NULL),
(5915, 162, 16, 2, 32, 4, NULL, NULL),
(5916, 162, 16, 2, 33, 4, NULL, NULL),
(5917, 162, 16, 2, 34, 4, NULL, NULL),
(5918, 162, 2, 85, 1, 4, NULL, NULL),
(5919, 162, 2, 85, 2, 4, NULL, NULL),
(5920, 162, 2, 85, 3, 4, NULL, NULL),
(5921, 162, 2, 85, 4, 5, NULL, NULL),
(5922, 162, 2, 85, 5, 4, NULL, NULL),
(5923, 162, 2, 85, 6, 4, NULL, NULL),
(5924, 162, 2, 85, 7, 4, NULL, NULL),
(5925, 162, 2, 85, 8, 4, NULL, NULL),
(5926, 162, 2, 85, 9, 4, NULL, NULL),
(5927, 162, 2, 85, 10, 5, NULL, NULL),
(5928, 162, 2, 85, 11, 4, NULL, NULL),
(5929, 162, 2, 85, 12, 4, NULL, NULL),
(5930, 162, 2, 85, 13, 4, NULL, NULL),
(5931, 162, 2, 85, 14, 5, NULL, NULL),
(5932, 162, 2, 85, 15, 4, NULL, NULL),
(5933, 162, 2, 85, 16, 4, NULL, NULL),
(5934, 162, 2, 85, 17, 4, NULL, NULL),
(5935, 162, 2, 85, 18, 5, NULL, NULL),
(5936, 162, 2, 85, 19, 5, NULL, NULL),
(5937, 162, 2, 85, 20, 5, NULL, NULL),
(5938, 162, 2, 85, 21, 5, NULL, NULL),
(5939, 162, 2, 85, 22, 4, NULL, NULL),
(5940, 162, 2, 85, 23, 4, NULL, NULL),
(5941, 162, 2, 85, 24, 5, NULL, NULL),
(5942, 162, 2, 85, 25, 5, NULL, NULL),
(5943, 162, 2, 85, 26, 4, NULL, NULL),
(5944, 162, 2, 85, 27, 4, NULL, NULL),
(5945, 162, 2, 85, 28, 4, NULL, NULL),
(5946, 162, 2, 85, 29, 5, NULL, NULL),
(5947, 162, 2, 85, 30, 4, NULL, NULL),
(5948, 162, 2, 85, 31, 5, NULL, NULL),
(5949, 162, 2, 85, 32, 4, NULL, NULL),
(5950, 162, 2, 85, 33, 4, NULL, NULL),
(5951, 162, 2, 85, 34, 4, NULL, NULL),
(5952, 162, 2, 17, 1, 4, NULL, NULL),
(5953, 162, 2, 17, 2, 4, NULL, NULL),
(5954, 162, 2, 17, 3, 5, NULL, NULL),
(5955, 162, 2, 17, 4, 4, NULL, NULL),
(5956, 162, 2, 17, 5, 4, NULL, NULL),
(5957, 162, 2, 17, 6, 4, NULL, NULL),
(5958, 162, 2, 17, 7, 4, NULL, NULL),
(5959, 162, 2, 17, 8, 5, NULL, NULL),
(5960, 162, 2, 17, 9, 4, NULL, NULL),
(5961, 162, 2, 17, 10, 4, NULL, NULL),
(5962, 162, 2, 17, 11, 4, NULL, NULL),
(5963, 162, 2, 17, 12, 5, NULL, NULL),
(5964, 162, 2, 17, 13, 4, NULL, NULL),
(5965, 162, 2, 17, 14, 5, NULL, NULL),
(5966, 162, 2, 17, 15, 4, NULL, NULL),
(5967, 162, 2, 17, 16, 5, NULL, NULL),
(5968, 162, 2, 17, 17, 4, NULL, NULL),
(5969, 162, 2, 17, 18, 4, NULL, NULL),
(5970, 162, 2, 17, 19, 4, NULL, NULL),
(5971, 162, 2, 17, 20, 5, NULL, NULL),
(5972, 162, 2, 17, 21, 4, NULL, NULL),
(5973, 162, 2, 17, 22, 4, NULL, NULL),
(5974, 162, 2, 17, 23, 4, NULL, NULL),
(5975, 162, 2, 17, 24, 5, NULL, NULL),
(5976, 162, 2, 17, 25, 4, NULL, NULL),
(5977, 162, 2, 17, 26, 5, NULL, NULL),
(5978, 162, 2, 17, 27, 4, NULL, NULL),
(5979, 162, 2, 17, 28, 5, NULL, NULL),
(5980, 162, 2, 17, 29, 4, NULL, NULL),
(5981, 162, 2, 17, 30, 4, NULL, NULL),
(5982, 162, 2, 17, 31, 5, NULL, NULL),
(5983, 162, 2, 17, 32, 4, NULL, NULL),
(5984, 162, 2, 17, 33, 4, NULL, NULL),
(5985, 162, 2, 17, 34, 5, NULL, NULL),
(5986, 162, 2, 83, 1, 4, NULL, NULL),
(5987, 162, 2, 83, 2, 4, NULL, NULL),
(5988, 162, 2, 83, 3, 4, NULL, NULL),
(5989, 162, 2, 83, 4, 4, NULL, NULL),
(5990, 162, 2, 83, 5, 5, NULL, NULL),
(5991, 162, 2, 83, 6, 4, NULL, NULL),
(5992, 162, 2, 83, 7, 5, NULL, NULL),
(5993, 162, 2, 83, 8, 5, NULL, NULL),
(5994, 162, 2, 83, 9, 5, NULL, NULL),
(5995, 162, 2, 83, 10, 4, NULL, NULL),
(5996, 162, 2, 83, 11, 4, NULL, NULL),
(5997, 162, 2, 83, 12, 4, NULL, NULL),
(5998, 162, 2, 83, 13, 4, NULL, NULL),
(5999, 162, 2, 83, 14, 5, NULL, NULL),
(6000, 162, 2, 83, 15, 4, NULL, NULL),
(6001, 162, 2, 83, 16, 4, NULL, NULL),
(6002, 162, 2, 83, 17, 4, NULL, NULL),
(6003, 162, 2, 83, 18, 4, NULL, NULL),
(6004, 162, 2, 83, 19, 5, NULL, NULL),
(6005, 162, 2, 83, 20, 5, NULL, NULL),
(6006, 162, 2, 83, 21, 5, NULL, NULL),
(6007, 162, 2, 83, 22, 5, NULL, NULL),
(6008, 162, 2, 83, 23, 4, NULL, NULL),
(6009, 162, 2, 83, 24, 4, NULL, NULL),
(6010, 162, 2, 83, 25, 4, NULL, NULL),
(6011, 162, 2, 83, 26, 5, NULL, NULL),
(6012, 162, 2, 83, 27, 5, NULL, NULL),
(6013, 162, 2, 83, 28, 5, NULL, NULL),
(6014, 162, 2, 83, 29, 4, NULL, NULL),
(6015, 162, 2, 83, 30, 4, NULL, NULL),
(6016, 162, 2, 83, 31, 5, NULL, NULL),
(6017, 162, 2, 83, 32, 4, NULL, NULL),
(6018, 162, 2, 83, 33, 5, NULL, NULL),
(6019, 162, 2, 83, 34, 4, NULL, NULL),
(6020, 162, 2, 16, 1, 4, NULL, NULL),
(6021, 162, 2, 16, 2, 5, NULL, NULL),
(6022, 162, 2, 16, 3, 5, NULL, NULL),
(6023, 162, 2, 16, 4, 4, NULL, NULL),
(6024, 162, 2, 16, 5, 4, NULL, NULL),
(6025, 162, 2, 16, 6, 4, NULL, NULL),
(6026, 162, 2, 16, 7, 5, NULL, NULL),
(6027, 162, 2, 16, 8, 4, NULL, NULL),
(6028, 162, 2, 16, 9, 5, NULL, NULL),
(6029, 162, 2, 16, 10, 4, NULL, NULL),
(6030, 162, 2, 16, 11, 5, NULL, NULL),
(6031, 162, 2, 16, 12, 4, NULL, NULL),
(6032, 162, 2, 16, 13, 5, NULL, NULL),
(6033, 162, 2, 16, 14, 4, NULL, NULL),
(6034, 162, 2, 16, 15, 5, NULL, NULL),
(6035, 162, 2, 16, 16, 5, NULL, NULL),
(6036, 162, 2, 16, 17, 4, NULL, NULL),
(6037, 162, 2, 16, 18, 4, NULL, NULL),
(6038, 162, 2, 16, 19, 4, NULL, NULL),
(6039, 162, 2, 16, 20, 5, NULL, NULL),
(6040, 162, 2, 16, 21, 5, NULL, NULL),
(6041, 162, 2, 16, 22, 4, NULL, NULL),
(6042, 162, 2, 16, 23, 4, NULL, NULL),
(6043, 162, 2, 16, 24, 4, NULL, NULL),
(6044, 162, 2, 16, 25, 5, NULL, NULL),
(6045, 162, 2, 16, 26, 4, NULL, NULL),
(6046, 162, 2, 16, 27, 5, NULL, NULL),
(6047, 162, 2, 16, 28, 4, NULL, NULL),
(6048, 162, 2, 16, 29, 4, NULL, NULL),
(6049, 162, 2, 16, 30, 4, NULL, NULL),
(6050, 162, 2, 16, 31, 4, NULL, NULL),
(6051, 162, 2, 16, 32, 5, NULL, NULL),
(6052, 162, 2, 16, 33, 4, NULL, NULL),
(6053, 162, 2, 16, 34, 4, NULL, NULL),
(6054, 166, 2, 1, 1, 4, NULL, NULL),
(6055, 166, 2, 1, 2, 4, NULL, NULL),
(6056, 166, 2, 1, 3, 5, NULL, NULL),
(6057, 166, 2, 1, 4, 5, NULL, NULL),
(6058, 166, 2, 1, 5, 4, NULL, NULL),
(6059, 166, 2, 1, 6, 4, NULL, NULL),
(6060, 166, 2, 1, 7, 5, NULL, NULL),
(6061, 166, 2, 1, 8, 5, NULL, NULL),
(6062, 166, 2, 1, 9, 4, NULL, NULL),
(6063, 166, 2, 1, 10, 5, NULL, NULL),
(6064, 166, 2, 1, 11, 5, NULL, NULL),
(6065, 166, 2, 1, 12, 4, NULL, NULL),
(6066, 166, 2, 1, 13, 4, NULL, NULL),
(6067, 166, 2, 1, 14, 4, NULL, NULL),
(6068, 166, 2, 1, 15, 4, NULL, NULL),
(6069, 166, 2, 1, 16, 5, NULL, NULL),
(6070, 166, 2, 1, 17, 4, NULL, NULL),
(6071, 166, 2, 1, 18, 4, NULL, NULL),
(6072, 166, 2, 1, 19, 4, NULL, NULL),
(6073, 166, 2, 1, 20, 4, NULL, NULL),
(6074, 166, 2, 1, 21, 5, NULL, NULL),
(6075, 166, 2, 1, 22, 4, NULL, NULL),
(6076, 166, 2, 1, 23, 4, NULL, NULL),
(6077, 166, 2, 1, 24, 4, NULL, NULL),
(6078, 166, 2, 1, 25, 4, NULL, NULL),
(6079, 166, 2, 1, 26, 4, NULL, NULL),
(6080, 166, 2, 1, 27, 4, NULL, NULL),
(6081, 166, 2, 1, 28, 4, NULL, NULL),
(6082, 166, 2, 1, 29, 5, NULL, NULL),
(6083, 166, 2, 1, 30, 4, NULL, NULL),
(6084, 166, 2, 1, 31, 5, NULL, NULL),
(6085, 166, 2, 1, 32, 5, NULL, NULL),
(6086, 166, 2, 1, 33, 4, NULL, NULL),
(6087, 166, 2, 1, 34, 4, NULL, NULL),
(6088, 166, 2, 15, 1, 5, NULL, NULL),
(6089, 166, 2, 15, 2, 5, NULL, NULL),
(6090, 166, 2, 15, 3, 4, NULL, NULL),
(6091, 166, 2, 15, 4, 5, NULL, NULL),
(6092, 166, 2, 15, 5, 4, NULL, NULL),
(6093, 166, 2, 15, 6, 5, NULL, NULL),
(6094, 166, 2, 15, 7, 5, NULL, NULL),
(6095, 166, 2, 15, 8, 5, NULL, NULL),
(6096, 166, 2, 15, 9, 5, NULL, NULL),
(6097, 166, 2, 15, 10, 5, NULL, NULL),
(6098, 166, 2, 15, 11, 4, NULL, NULL),
(6099, 166, 2, 15, 12, 5, NULL, NULL),
(6100, 166, 2, 15, 13, 3, NULL, NULL),
(6101, 166, 2, 15, 14, 5, NULL, NULL),
(6102, 166, 2, 15, 15, 5, NULL, NULL),
(6103, 166, 2, 15, 16, 4, NULL, NULL),
(6104, 166, 2, 15, 17, 4, NULL, NULL),
(6105, 166, 2, 15, 18, 5, NULL, NULL),
(6106, 166, 2, 15, 19, 4, NULL, NULL),
(6107, 166, 2, 15, 20, 5, NULL, NULL),
(6108, 166, 2, 15, 21, 5, NULL, NULL),
(6109, 166, 2, 15, 22, 4, NULL, NULL),
(6110, 166, 2, 15, 23, 4, NULL, NULL),
(6111, 166, 2, 15, 24, 4, NULL, NULL),
(6112, 166, 2, 15, 25, 4, NULL, NULL),
(6113, 166, 2, 15, 26, 4, NULL, NULL),
(6114, 166, 2, 15, 27, 4, NULL, NULL),
(6115, 166, 2, 15, 28, 5, NULL, NULL),
(6116, 166, 2, 15, 29, 4, NULL, NULL),
(6117, 166, 2, 15, 30, 4, NULL, NULL),
(6118, 166, 2, 15, 31, 4, NULL, NULL),
(6119, 166, 2, 15, 32, 4, NULL, NULL),
(6120, 166, 2, 15, 33, 4, NULL, NULL),
(6121, 166, 2, 15, 34, 4, NULL, NULL),
(6122, 166, 2, 3, 1, 4, NULL, NULL),
(6123, 166, 2, 3, 2, 4, NULL, NULL),
(6124, 166, 2, 3, 3, 4, NULL, NULL),
(6125, 166, 2, 3, 4, 5, NULL, NULL),
(6126, 166, 2, 3, 5, 5, NULL, NULL),
(6127, 166, 2, 3, 6, 5, NULL, NULL),
(6128, 166, 2, 3, 7, 4, NULL, NULL),
(6129, 166, 2, 3, 8, 4, NULL, NULL),
(6130, 166, 2, 3, 9, 5, NULL, NULL),
(6131, 166, 2, 3, 10, 4, NULL, NULL),
(6132, 166, 2, 3, 11, 4, NULL, NULL),
(6133, 166, 2, 3, 12, 4, NULL, NULL),
(6134, 166, 2, 3, 13, 5, NULL, NULL),
(6135, 166, 2, 3, 14, 5, NULL, NULL),
(6136, 166, 2, 3, 15, 5, NULL, NULL),
(6137, 166, 2, 3, 16, 4, NULL, NULL),
(6138, 166, 2, 3, 17, 4, NULL, NULL),
(6139, 166, 2, 3, 18, 4, NULL, NULL),
(6140, 166, 2, 3, 19, 4, NULL, NULL),
(6141, 166, 2, 3, 20, 5, NULL, NULL),
(6142, 166, 2, 3, 21, 4, NULL, NULL),
(6143, 166, 2, 3, 22, 5, NULL, NULL),
(6144, 166, 2, 3, 23, 4, NULL, NULL),
(6145, 166, 2, 3, 24, 4, NULL, NULL),
(6146, 166, 2, 3, 25, 4, NULL, NULL),
(6147, 166, 2, 3, 26, 4, NULL, NULL),
(6148, 166, 2, 3, 27, 4, NULL, NULL),
(6149, 166, 2, 3, 28, 5, NULL, NULL),
(6150, 166, 2, 3, 29, 5, NULL, NULL),
(6151, 166, 2, 3, 30, 4, NULL, NULL),
(6152, 166, 2, 3, 31, 4, NULL, NULL),
(6153, 166, 2, 3, 32, 5, NULL, NULL),
(6154, 166, 2, 3, 33, 4, NULL, NULL),
(6155, 166, 2, 3, 34, 5, NULL, NULL);

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
(327, 166, 82, 1, 1, '2017-05-12 15:47:29', '2017-05-12 15:49:02'),
(328, 166, 3, 1, 1, '2017-05-12 17:01:19', '2017-05-12 16:11:53'),
(329, 166, 15, 1, 1, '2017-05-12 17:01:21', '2017-05-12 16:24:51'),
(330, 166, 16, 0, 1, '2017-05-12 17:01:22', '2017-05-12 17:01:22'),
(331, 162, 83, 1, 3, '2017-05-12 16:07:34', '2017-05-12 16:09:03'),
(332, 162, 15, 1, 3, '2017-05-12 16:09:59', '2017-05-12 16:22:21'),
(333, 162, 16, 1, 3, '2017-05-12 16:10:00', '2017-05-12 16:17:30'),
(334, 162, 2, 1, 3, '2017-05-12 16:10:01', '2017-05-12 18:15:12'),
(335, 166, 1, 1, 3, '2017-05-12 16:10:57', '2017-05-12 17:34:23'),
(336, 166, 15, 1, 3, '2017-05-12 16:10:58', '2017-05-12 16:25:34'),
(337, 166, 16, 0, 3, '2017-05-12 16:10:59', '2017-05-12 16:10:59'),
(338, 166, 2, 1, 3, '2017-05-12 16:11:01', '2017-05-12 17:58:14'),
(339, 162, 3, 1, 16, '2017-05-12 16:16:01', '2017-05-12 16:31:14'),
(340, 162, 15, 1, 16, '2017-05-12 16:16:03', '2017-05-12 16:23:18'),
(341, 162, 2, 1, 16, '2017-05-12 16:16:04', '2017-05-12 18:16:38'),
(342, 162, 3, 1, 15, '2017-05-12 16:21:22', '2017-05-12 16:29:50'),
(343, 162, 83, 0, 15, '2017-05-12 16:21:23', '2017-05-12 16:21:23'),
(344, 162, 2, 1, 15, '2017-05-12 16:21:25', '2017-05-12 18:15:52'),
(345, 166, 1, 1, 15, '2017-05-12 16:26:41', '2017-05-12 17:35:10'),
(346, 166, 82, 1, 15, '2017-05-12 16:26:43', '2017-05-12 16:28:11'),
(347, 166, 2, 1, 15, '2017-05-12 16:26:44', '2017-05-12 17:58:59'),
(348, 166, 1, 1, 2, '2017-05-12 18:08:14', '2017-05-12 18:36:03'),
(349, 166, 3, 1, 2, '2017-05-12 18:08:16', '2017-05-12 17:38:14'),
(350, 166, 15, 1, 2, '2017-05-12 18:08:17', '2017-05-12 17:37:13'),
(351, 166, 84, 1, 2, '2017-05-12 17:10:07', '2017-05-12 17:11:38'),
(354, 162, 16, 1, 2, '2017-05-12 18:24:39', '2017-05-12 17:33:37'),
(355, 162, 17, 1, 2, '2017-05-12 18:24:40', '2017-05-12 17:31:00'),
(356, 162, 83, 1, 2, '2017-05-12 18:24:42', '2017-05-12 17:32:25'),
(357, 162, 85, 1, 2, '2017-05-12 17:26:04', '2017-05-12 17:27:11');

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
(2551, 163, 2, 1, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2552, 163, 2, 2, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2553, 163, 2, 3, 5, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2554, 163, 2, 4, 5, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2555, 163, 2, 5, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2556, 163, 2, 6, 5, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2557, 163, 2, 7, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2558, 163, 2, 8, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2559, 163, 2, 9, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2560, 163, 2, 10, 5, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2561, 163, 2, 11, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2562, 163, 2, 12, 5, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2563, 163, 2, 13, 5, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2564, 163, 2, 14, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2565, 163, 2, 15, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2566, 163, 2, 16, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2567, 163, 2, 17, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2568, 163, 2, 18, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2569, 163, 2, 19, 5, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2570, 163, 2, 20, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2571, 163, 2, 21, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2572, 163, 2, 22, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2573, 163, 2, 23, 5, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2574, 163, 2, 24, 5, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2575, 163, 2, 25, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2576, 163, 2, 26, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2577, 163, 2, 27, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2578, 163, 2, 28, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2579, 163, 2, 29, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2580, 163, 2, 30, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2581, 163, 2, 31, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2582, 163, 2, 32, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2583, 163, 2, 33, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2584, 163, 2, 34, 4, '2017-05-12 15:02:58', '2017-05-12 15:02:58'),
(2585, 165, 1, 1, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2586, 165, 1, 2, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2587, 165, 1, 3, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2588, 165, 1, 4, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2589, 165, 1, 5, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2590, 165, 1, 6, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2591, 165, 1, 7, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2592, 165, 1, 8, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2593, 165, 1, 9, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2594, 165, 1, 10, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2595, 165, 1, 11, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2596, 165, 1, 12, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2597, 165, 1, 13, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2598, 165, 1, 14, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2599, 165, 1, 15, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2600, 165, 1, 16, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2601, 165, 1, 17, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2602, 165, 1, 18, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2603, 165, 1, 19, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2604, 165, 1, 20, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2605, 165, 1, 21, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2606, 165, 1, 22, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2607, 165, 1, 23, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2608, 165, 1, 24, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2609, 165, 1, 25, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2610, 165, 1, 26, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2611, 165, 1, 27, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2612, 165, 1, 28, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2613, 165, 1, 29, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2614, 165, 1, 30, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2615, 165, 1, 31, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2616, 165, 1, 32, 5, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2617, 165, 1, 33, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2618, 165, 1, 34, 4, '2017-05-12 15:40:40', '2017-05-12 15:40:40'),
(2619, 163, 3, 1, 4, '2017-05-12 16:04:43', '2017-05-12 16:04:43'),
(2620, 163, 3, 2, 4, '2017-05-12 16:04:43', '2017-05-12 16:04:43'),
(2621, 163, 3, 3, 4, '2017-05-12 16:04:43', '2017-05-12 16:04:43'),
(2622, 163, 3, 4, 4, '2017-05-12 16:04:43', '2017-05-12 16:04:43'),
(2623, 163, 3, 5, 4, '2017-05-12 16:04:43', '2017-05-12 16:04:43'),
(2624, 163, 3, 6, 5, '2017-05-12 16:04:43', '2017-05-12 16:04:43'),
(2625, 163, 3, 7, 4, '2017-05-12 16:04:43', '2017-05-12 16:04:43'),
(2626, 163, 3, 8, 4, '2017-05-12 16:04:43', '2017-05-12 16:04:43'),
(2627, 163, 3, 9, 5, '2017-05-12 16:04:43', '2017-05-12 16:04:43'),
(2628, 163, 3, 10, 4, '2017-05-12 16:04:43', '2017-05-12 16:04:43'),
(2629, 163, 3, 11, 4, '2017-05-12 16:04:43', '2017-05-12 16:04:43'),
(2630, 163, 3, 12, 5, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2631, 163, 3, 13, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2632, 163, 3, 14, 5, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2633, 163, 3, 15, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2634, 163, 3, 16, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2635, 163, 3, 17, 5, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2636, 163, 3, 18, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2637, 163, 3, 19, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2638, 163, 3, 20, 5, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2639, 163, 3, 21, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2640, 163, 3, 22, 5, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2641, 163, 3, 23, 5, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2642, 163, 3, 24, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2643, 163, 3, 25, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2644, 163, 3, 26, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2645, 163, 3, 27, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2646, 163, 3, 28, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2647, 163, 3, 29, 5, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2648, 163, 3, 30, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2649, 163, 3, 31, 5, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2650, 163, 3, 32, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2651, 163, 3, 33, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2652, 163, 3, 34, 4, '2017-05-12 16:04:44', '2017-05-12 16:04:44'),
(2653, 165, 3, 1, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2654, 165, 3, 2, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2655, 165, 3, 3, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2656, 165, 3, 4, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2657, 165, 3, 5, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2658, 165, 3, 6, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2659, 165, 3, 7, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2660, 165, 3, 8, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2661, 165, 3, 9, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2662, 165, 3, 10, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2663, 165, 3, 11, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2664, 165, 3, 12, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2665, 165, 3, 13, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2666, 165, 3, 14, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2667, 165, 3, 15, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2668, 165, 3, 16, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2669, 165, 3, 17, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2670, 165, 3, 18, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2671, 165, 3, 19, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2672, 165, 3, 20, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2673, 165, 3, 21, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2674, 165, 3, 22, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2675, 165, 3, 23, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2676, 165, 3, 24, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2677, 165, 3, 25, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2678, 165, 3, 26, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2679, 165, 3, 27, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2680, 165, 3, 28, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2681, 165, 3, 29, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2682, 165, 3, 30, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2683, 165, 3, 31, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2684, 165, 3, 32, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2685, 165, 3, 33, 4, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2686, 165, 3, 34, 5, '2017-05-12 16:05:46', '2017-05-12 16:05:46'),
(2687, 163, 16, 1, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2688, 163, 16, 2, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2689, 163, 16, 3, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2690, 163, 16, 4, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2691, 163, 16, 5, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2692, 163, 16, 6, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2693, 163, 16, 7, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2694, 163, 16, 8, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2695, 163, 16, 9, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2696, 163, 16, 10, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2697, 163, 16, 11, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2698, 163, 16, 12, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2699, 163, 16, 13, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2700, 163, 16, 14, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2701, 163, 16, 15, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2702, 163, 16, 16, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2703, 163, 16, 17, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2704, 163, 16, 18, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2705, 163, 16, 19, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2706, 163, 16, 20, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2707, 163, 16, 21, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2708, 163, 16, 22, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2709, 163, 16, 23, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2710, 163, 16, 24, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2711, 163, 16, 25, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2712, 163, 16, 26, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2713, 163, 16, 27, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2714, 163, 16, 28, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2715, 163, 16, 29, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2716, 163, 16, 30, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2717, 163, 16, 31, 4, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2718, 163, 16, 32, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2719, 163, 16, 33, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2720, 163, 16, 34, 5, '2017-05-12 16:14:17', '2017-05-12 16:14:17'),
(2721, 165, 16, 1, 5, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2722, 165, 16, 2, 5, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2723, 165, 16, 3, 5, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2724, 165, 16, 4, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2725, 165, 16, 5, 5, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2726, 165, 16, 6, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2727, 165, 16, 7, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2728, 165, 16, 8, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2729, 165, 16, 9, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2730, 165, 16, 10, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2731, 165, 16, 11, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2732, 165, 16, 12, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2733, 165, 16, 13, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2734, 165, 16, 14, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2735, 165, 16, 15, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2736, 165, 16, 16, 5, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2737, 165, 16, 17, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2738, 165, 16, 18, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2739, 165, 16, 19, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2740, 165, 16, 20, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2741, 165, 16, 21, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2742, 165, 16, 22, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2743, 165, 16, 23, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2744, 165, 16, 24, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2745, 165, 16, 25, 5, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2746, 165, 16, 26, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2747, 165, 16, 27, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2748, 165, 16, 28, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2749, 165, 16, 29, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2750, 165, 16, 30, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2751, 165, 16, 31, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2752, 165, 16, 32, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2753, 165, 16, 33, 4, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2754, 165, 16, 34, 5, '2017-05-12 16:15:30', '2017-05-12 16:15:30'),
(2755, 163, 15, 1, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2756, 163, 15, 2, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2757, 163, 15, 3, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2758, 163, 15, 4, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2759, 163, 15, 5, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2760, 163, 15, 6, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2761, 163, 15, 7, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2762, 163, 15, 8, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2763, 163, 15, 9, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2764, 163, 15, 10, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2765, 163, 15, 11, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2766, 163, 15, 12, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2767, 163, 15, 13, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2768, 163, 15, 14, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2769, 163, 15, 15, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2770, 163, 15, 16, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2771, 163, 15, 17, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2772, 163, 15, 18, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2773, 163, 15, 19, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2774, 163, 15, 20, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2775, 163, 15, 21, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2776, 163, 15, 22, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2777, 163, 15, 23, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2778, 163, 15, 24, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2779, 163, 15, 25, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2780, 163, 15, 26, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2781, 163, 15, 27, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2782, 163, 15, 28, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2783, 163, 15, 29, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2784, 163, 15, 30, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2785, 163, 15, 31, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2786, 163, 15, 32, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2787, 163, 15, 33, 5, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2788, 163, 15, 34, 4, '2017-05-12 16:19:55', '2017-05-12 16:19:55'),
(2789, 165, 15, 1, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2790, 165, 15, 2, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2791, 165, 15, 3, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2792, 165, 15, 4, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2793, 165, 15, 5, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2794, 165, 15, 6, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2795, 165, 15, 7, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2796, 165, 15, 8, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2797, 165, 15, 9, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2798, 165, 15, 10, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2799, 165, 15, 11, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2800, 165, 15, 12, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2801, 165, 15, 13, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2802, 165, 15, 14, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2803, 165, 15, 15, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2804, 165, 15, 16, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2805, 165, 15, 17, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2806, 165, 15, 18, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2807, 165, 15, 19, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2808, 165, 15, 20, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2809, 165, 15, 21, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2810, 165, 15, 22, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2811, 165, 15, 23, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2812, 165, 15, 24, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2813, 165, 15, 25, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2814, 165, 15, 26, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2815, 165, 15, 27, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2816, 165, 15, 28, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2817, 165, 15, 29, 4, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2818, 165, 15, 30, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2819, 165, 15, 31, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2820, 165, 15, 32, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2821, 165, 15, 33, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2822, 165, 15, 34, 5, '2017-05-12 16:20:54', '2017-05-12 16:20:54'),
(2823, 165, 2, 1, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2824, 165, 2, 2, 5, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2825, 165, 2, 3, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2826, 165, 2, 4, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2827, 165, 2, 5, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2828, 165, 2, 6, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2829, 165, 2, 7, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2830, 165, 2, 8, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2831, 165, 2, 9, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2832, 165, 2, 10, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2833, 165, 2, 11, 5, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2834, 165, 2, 12, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2835, 165, 2, 13, 5, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2836, 165, 2, 14, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2837, 165, 2, 15, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2838, 165, 2, 16, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2839, 165, 2, 17, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2840, 165, 2, 18, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2841, 165, 2, 19, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2842, 165, 2, 20, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2843, 165, 2, 21, 5, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2844, 165, 2, 22, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2845, 165, 2, 23, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2846, 165, 2, 24, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2847, 165, 2, 25, 5, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2848, 165, 2, 26, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2849, 165, 2, 27, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2850, 165, 2, 28, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2851, 165, 2, 29, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2852, 165, 2, 30, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2853, 165, 2, 31, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2854, 165, 2, 32, 5, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2855, 165, 2, 33, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06'),
(2856, 165, 2, 34, 4, '2017-05-12 16:45:06', '2017-05-12 16:45:06');

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
(3, 'basic', 'basic', 'basic user role.'),
(4, 'external', 'external', 'An external evaluator');

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
(18, 4),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(27, 1),
(28, 1),
(49, 3),
(82, 4),
(83, 4),
(84, 4),
(85, 4);

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
(162, 2, 2, 1, 2, 19, 'peer survey group scoped include group test 24', '<p>Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person&#39;s level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br />\r\nInnovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.</p>\r\n', 5, '<p>thank you</p>\r\n', '2017-05-12 18:44:00', '2017-06-10 00:00:00', '2017-05-12 14:45:45', '2017-05-12 14:45:45'),
(163, 2, 1, 1, 2, 19, 'self survey group scoped include special test 24', '<p>Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person&#39;s level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br />\r\nInnovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.</p>\r\n', 5, '<p>thank you</p>\r\n', '2017-05-12 18:46:00', '2017-06-10 00:00:00', '2017-05-12 14:46:56', '2017-05-12 14:46:56'),
(165, 1, 1, 1, 1, NULL, 'self survey company scoped include admin test 28', '<p>Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person&#39;s level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br />\r\nInnovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.</p>\r\n', 0, '<p>thank you</p>\r\n', '2017-05-12 19:36:00', '2017-06-10 00:00:00', '2017-05-12 15:37:32', '2017-05-12 15:42:03'),
(166, 1, 2, 1, 1, NULL, 'peer survey company scoped include admin test 28', '<p>Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person&#39;s level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br />\r\nInnovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.</p>\r\n', 5, '<p>thank you</p>\r\n', '2017-05-12 19:40:00', '2017-06-10 00:00:00', '2017-05-12 15:41:21', '2017-05-12 15:41:21');

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
  `external` tinyint(2) NOT NULL DEFAULT '0',
  `external_modified_email` tinyint(2) NOT NULL DEFAULT '0',
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

INSERT INTO `users` (`id`, `name`, `external`, `external_modified_email`, `email`, `company_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 0, 0, 'admin@fincoda.com', 1, '$2y$10$aDPsBeCSx/hcyUEa82kXOeBJj6kR.H.6jougBIdWwuGXUIBzcbSw.', 'mK64Fzj9gIM5J5TG6BlXJp7i19bIe6VVnhMV6TBCUf4HtAULQ7oE9W6029ZM', '2016-09-04 18:24:58', '2017-05-12 17:59:54'),
(2, 'special', 0, 0, 'special@fincoda.com', 1, '$2y$10$XEkBB9aQOSUsnZnbvtIU/eFpxWuzc3g.xN/Va5QGt5FWbJSh7P0vW', 'uKIIznCM4iQL23ecJF17Ly5OKwe3c8sbOQ5Ar2hCoWpkdPV5oJnzEOXUA8dx', '2016-09-04 18:24:59', '2017-05-12 17:54:56'),
(3, 'basic', 0, 0, 'basic@fincoda.com', 1, '$2y$10$VJ1.j0X2Ns2gXUHhBs5Ob.orTIrsug85qCSQd36tvzfababDw9OdS', 'He5patJ3rqtPe0vRLgTnrG3cevBwMudahdFyb5KzJLn8PRKQpqpIwCQGV67r', '2016-09-04 18:24:59', '2017-05-12 17:47:32'),
(15, 'dav', 0, 0, 'davis2.kawalya@edu.turkuamk.fi', 1, '$2y$10$PWJmx4dIVIQkOn9yQ7/2e.RrOuMni5K/0knmxD1bPdxFbGKFo98VK', 'C1RAx24qkGokx4BEaEBIvOw37lEKLwTN4BdpiY378ByzaojfSfp62U1yzq6C', '2016-11-15 09:31:48', '2017-05-12 17:37:20'),
(16, 'dav', 0, 0, 'balsam2.almurrani@gmail.com', 1, '$2y$10$8ssO4p4nWZN/zkog31bWt.5gkarkW6XQrXiCuVuSXkiW08ngC2M1W', 'ONiHJ0xNUG4xgjojAVDy1PrNNNoXKaUoIU459ssig4qHM6ZlvbveC8wNGKJN', '2016-11-15 09:32:40', '2017-05-12 17:33:47'),
(17, 'dav', 0, 0, 'duy2.lenguyen@edu.turkuamk.fi', 1, '$2y$10$PBZPCwtbEUqXmQeeyKWQ8.AzVrAZuEocNPfaaSJl504ySykwRy1dq', 'tgVErJkUCIKxFrVEEgEVUYgXLwDLGKentT2gZg5KzQqHmXS6vSNlPfHZvs33', '2016-11-15 09:33:15', '2017-05-12 17:31:24'),
(18, 'dav', 0, 0, 'dav4@yahoo.coms', 1, '$2y$10$XEdiSkvjJFYlFFhCMv7tYOtBKkuhDauIPKfcDHIBcui9g29JYqiJO', 'Z5GFd1JqwWxvRdIOUA0XUjxquLL20dAKKQYApb8in5eqDfWDeVMNWeGUWrQP', '2016-11-15 09:33:44', '2017-03-31 19:45:46'),
(19, 'dav', 0, 0, 'dav5@yahoo.coms', 1, '$2y$10$.zHdXynhWlde9hSDKHiJjegBUNnJCKwOMTV1PEVrXQaM3gg82owTm', '0qM2euIpBeZKuhsU4bAP69Q4BoFOiHGLSMD0xudPQj8BOIaz0QTnNQdSj1LW', '2016-11-15 09:34:04', '2017-03-31 21:51:47'),
(20, 'dav', 0, 0, 'dav6@yahoo.coms', 1, '$2y$10$KWrb57lTkGO1zmGXIVLOneRGTZX5QJgClcOkJ35dvWjt.ENhUAHOK', 'IdAm1Y1U3PYT8IWkSjoD1qDpJ7QjtsgFKSrX1ehRhh4Ihma19dTHvysZ3nAu', '2016-11-15 09:34:33', '2017-04-02 11:43:15'),
(21, 'dav', 0, 0, 'dav7@yahoo.coms', 1, '$2y$10$hoDB8JLvKK23bGfWsJNY.eK.bfee3fcfBQan0RaQp.Jc8KTkzRwvC', '0eVJ3M8Qqnwnbe8aPTMITFKRHbulF3tYPMNewyRddXprYgrcaCfbWlAlXg5m', '2016-11-15 09:35:04', '2016-11-30 22:17:06'),
(22, 'dav', 0, 0, 'dav8@yahoo.coms', 1, '$2y$10$RhAv.7VBId8UMVguzTqGQ.KzMEhcBwICHGDekC/NYpvBTGE5yx8x.', '5p0aM0B5peelXHXf69x2XuVZQ4Wu6CgbwZnm2kmgaWsinrDJ7d62ondPeuPW', '2016-11-15 09:35:39', '2017-03-31 21:50:58'),
(23, 'dav', 0, 0, 'dav9@yahoo.coms', 1, '$2y$10$jocVMuYLutwmoBjttRYYCOifIQGhOT0wTPtsgBuy.h5gDe4DUtSAm', '2VpuVfBEwGKf1gX7fBn5ijTm4jRz5M5q64FpnwLrM8Bkp2j4uMfo1tloD7Vg', '2016-11-15 09:36:08', '2016-11-15 12:43:20'),
(27, 'kawalya', 0, 0, 'davis.kawalya@edu.turkuamk.fis', 5, '$2y$10$T8xlkKpfTyRN4qkmpppGh.USduGyVeY5LWv.1j8HzgWIxQ2MvmOQK', NULL, '2016-12-01 18:19:25', '2016-12-01 18:19:25'),
(28, 'd', 0, 0, 'davis.kawalya@edu.turkuamk.fiss', 7, '$2y$10$9rZIH0bWj.gDebgd5ILJwuxkXctat4a3nC59moxidev057RzL4at2', NULL, '2016-12-01 18:48:11', '2016-12-01 18:48:11'),
(49, 'davi', 0, 0, 'dav11@yahoo.coms', 1, '$2y$10$7/X2ujlNHxs2t.3fLJnZjem8idItYonwlq/PAfUImLF77BS7BPo6K', 'AP9fT8qI2P80MAIPdvpHSos4OkJnkyMy7i8KhTbQ8hio37DiOuS10gOb3E3B', '2017-04-02 16:33:32', '2017-04-02 16:33:55'),
(82, 'dav', 1, 0, 'davis.kawalya@edu.turkuamk.fi', 1, '$2y$10$itRD3meN1NWm5ycIGiTVL.YKNWIVlkAanvAQ0FLtsb.AldTUyb5U6', 'nBxRnqkxfYhU1SKQcnJQ94fkTw43z0YhnzsPU18Hd7bKI5SnOym6eNqDrDe5', '2017-05-12 15:47:29', '2017-05-12 16:28:21'),
(83, 'dav', 1, 1, '1.davis2.kawalya@edu.turkuamk.fi', 1, '$2y$10$pUN9oJStefLyNrrjri6WyOeUovzFrs5xHhJ4LdL06CXf1hMgLtp4K', 'kGs03t49cN82kzMQAmO7KceNlu7umPxx6ewbA4PsAbFHEIvKhMxiXKZAzp7o', '2017-05-12 16:07:33', '2017-05-12 17:32:29'),
(84, 'dav', 1, 0, 'davis5.kawalya@edu.turkuamk.fi', 1, '$2y$10$YFVqkhV0j32Qrh9nPpWVM.eGYMEX.qyDpOpbE2Vtnitr8fknqI6pS', 'zZUFZ0GS1If4jVRquVJkksCDBxAEuIFXXdbEa3hekPEX0aALOlROvApz9GUd', '2017-05-12 17:10:07', '2017-05-12 17:12:58'),
(85, 'dav', 1, 0, 'davis6.kawalya@edu.turkuamk.fi', 1, '$2y$10$JwrZy6Iwi625zkJL5wGH9evERPJEe9/3sK7pSL5X/6Ysej/wmWLJW', '4grIeidQyJxr76jOE7eDtswE3Umcg9efqP5flv7CraO8hhl4EtzcFMQQg37V', '2017-05-12 17:26:04', '2017-05-12 17:27:25');

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
(16, 16, 'male', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', '23', '23', 'ICT', 'Partner', '990909', 'Ascension Island', 'jjkkk', 'jkk', 990909, '0000-00-00', 1, '2016-11-15 09:32:40', '2016-11-15 09:32:40'),
(17, 17, 'male', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', '23', '23', 'ICT', 'Partner', '990909', 'Ascension Island', 'jjkkk', 'jkk', 990909, '0000-00-00', 1, '2016-11-15 09:33:15', '2016-11-15 09:33:15'),
(18, 18, 'male', '0000-00-00', 'Phd Level', 'Professional', '', '', '', '', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', 'Ascension Island', 'hjhj', 'fghfg', 0, '0000-00-00', 1, '2016-11-15 09:33:44', '2016-11-15 09:33:44'),
(19, 19, 'male', '0000-00-00', 'Phd Level', 'Professional', '', '', '', '', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', 'Ascension Island', 'jlkl', 'jkjjk', 0, '0000-00-00', 1, '2016-11-15 09:34:04', '2016-11-15 09:34:04'),
(20, 20, 'male', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', 'Ascension Island', 'jjkkk', 'jkk', 990909, '0000-00-00', 1, '2016-11-15 09:34:33', '2016-11-15 09:34:33'),
(21, 21, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-11-15 09:35:04', '2016-11-15 09:35:04'),
(22, 22, 'male', '0000-00-00', 'Phd Level', 'Student', 'ghg', 'jklklkds', 'jkjdfksj', 'kjöajkjk', '', '', '', '', '', 'Ascension Island', 'jlkl', 'jjkkkj', 0, '0000-00-00', 1, '2016-11-15 09:35:39', '2016-11-15 09:35:39'),
(23, 23, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-11-15 09:36:09', '2016-11-15 09:36:09'),
(25, 1, 'male', '0000-00-00', 'phd level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more sssd', 'Healthcareddssss', 'Five to ten years', 'engineering', 'Partnerssssd', 'Less than 50 employees', 'Ascension Island', 'klask', 'klkasddddd', 902390232, '0000-00-00', 1, '2016-11-15 09:31:48', '2016-11-15 09:38:18'),
(26, 2, 'male', '0000-00-00', 'Phd Level', 'Professional', '', '', '', '', 'Healthcare', 'Five to ten years', 'engineering', 'Partner', 'Less than 50 employees', 'Ascension Island', 'jksd', 'kiöejds', 0, '0000-00-00', 1, '2016-11-15 09:31:48', '2016-11-15 09:38:18'),
(27, 3, 'male', '0000-00-00', 'phd level', 'Professional', 'ghg', '', '', '', 'ghgg', 'Five to ten years', 'engineering', 'Partnerklll', 'Less than 50 employees', 'Ascension Island', 'jlklkl', 'hljui', 4556, '0000-00-00', 1, '2016-11-15 09:31:48', '2016-11-15 09:38:18'),
(31, 27, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-12-01 18:19:25', '2016-12-01 18:19:25'),
(32, 28, '', '0000-00-00', 'Phd Level', 'Professional', 'Phd', 'ICT', '', 'Fourth year or more', 'Healthcare', 'Five to ten years', 'ICT', 'Partner', 'Less than 50 employees', '', '', '', 0, '0000-00-00', 0, '2016-12-01 18:48:11', '2016-12-01 18:48:11'),
(49, 49, '', '2016-09-04', 'Phd Level', 'Professional', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 0, '0000-00-00', 0, '2017-04-02 16:33:32', '2017-04-02 16:33:32'),
(75, 82, 'male', '2016-09-04', 'Phd Level', 'Professional', '', '', '', '', 'Healthcareddssss', '23', 'engineering', 'Partner', '990909', 'Ascension Island', 'jjkkk', 'jkk', 990909, '0000-00-00', 1, NULL, NULL),
(76, 83, 'male', '2016-09-04', 'Phd Level', 'Professional', '', '', '', '', 'Healthcareddssss', '23', 'engineering', 'Partner', '990909', 'Ascension Island', 'jjkkk', 'jkk', 990909, '0000-00-00', 1, NULL, NULL),
(77, 84, 'male', '2016-09-04', 'Phd Level', 'Professional', '', '', '', '', 'Healthcareddssss', '23', 'engineering', 'Partner', '990909', 'Ascension Island', 'jjkkk', 'jkk', 990909, '0000-00-00', 1, NULL, NULL),
(78, 85, 'male', '2016-09-04', 'Phd Level', 'Professional', '', '', '', '', 'Healthcareddssss', '23', 'engineering', 'Partner', '990909', 'Ascension Island', 'jjkkk', 'jkk', 990909, '0000-00-00', 1, NULL, NULL);

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
  ADD UNIQUE KEY `invited_by_user_id` (`invited_by_user_id`,`survey_id`,`email`),
  ADD UNIQUE KEY `email` (`email`,`company_id`),
  ADD KEY `external_evaluators_invited_by_fk` (`invited_by_user_id`),
  ADD KEY `external_evaluators_invited_on_survey_id_fk` (`survey_id`),
  ADD KEY `external_evaluators_company_id_foreign` (`company_id`);

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
-- AUTO_INCREMENT for table `external_evaluators`
--
ALTER TABLE `external_evaluators`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=780;
--
-- AUTO_INCREMENT for table `peer_results`
--
ALTER TABLE `peer_results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6156;
--
-- AUTO_INCREMENT for table `peer_surveys`
--
ALTER TABLE `peer_surveys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2857;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `scheduled_tasks`
--
ALTER TABLE `scheduled_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
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
  ADD CONSTRAINT `external_evaluators_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `external_evaluators_invited_by_fk` FOREIGN KEY (`invited_by_user_id`) REFERENCES `users` (`id`);

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
