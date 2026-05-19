-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2026 at 11:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticket_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_types`
--

CREATE TABLE `access_types` (
  `access_id` int(11) NOT NULL,
  `access_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access_types`
--

INSERT INTO `access_types` (`access_id`, `access_name`, `created_at`, `updated_at`) VALUES
(1, 'user', '2026-04-29 06:30:52', '2026-04-29 06:30:52'),
(2, 'agent', '2026-04-29 06:30:52', '2026-04-29 06:30:52'),
(3, 'department admin', '2026-04-29 06:30:52', '2026-05-06 05:55:30'),
(4, 'super admin', '2026-04-29 06:30:52', '2026-05-06 05:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `audit_tickets`
--

CREATE TABLE `audit_tickets` (
  `audit_ticket_id` bigint(20) NOT NULL,
  `ticket_id` char(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `audit_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `action` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_tickets`
--

INSERT INTO `audit_tickets` (`audit_ticket_id`, `ticket_id`, `user_id`, `description`, `audit_date`, `action`) VALUES
(18, '2', 2, 'Updated the status from <b>Pending</b> to <b>On Going</b>', '2026-05-18 07:11:24', 'update'),
(21, 'TCK-000023', 2, '<b>Hilario Curtis</b> created ticket <b>TCK-000023</b>', '2026-05-18 07:16:56', 'create'),
(22, 'TCK-000022', 2, 'Ticket <b>TCK-000022</b> assigned to <b>Hilario Curtis</b>', '2026-05-18 07:37:00', 'insert'),
(23, 'TCK-000022', 2, 'Reassigned ticket <b>TCK-000022</b> from <b>Hilario Curtis</b> to <b>Shanxi Rio Renacia</b>', '2026-05-18 07:38:12', 'update'),
(24, 'TCK-000023', 2, 'User <b>Hilario Curtis</b> approved Ticket TCK-000023', '2026-05-18 08:10:00', 'update'),
(25, 'TCK-000023', 2, 'Changed the department from <b>Finance</b> to <b>Human Resource</b>', '2026-05-18 08:31:18', 'update'),
(26, 'TCK-000023', 2, 'User <b>Hilario Curtis</b> approved Ticket TCK-000023', '2026-05-18 08:31:45', 'update'),
(27, 'TCK-000023', 2, 'Ticket <b>TCK-000023</b> assigned to <b>Shanxi Rio Renacia</b>', '2026-05-18 08:32:22', 'insert'),
(28, 'TCK-000013', 2, 'Updated the status from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 09:04:17', 'update'),
(29, 'TCK-000022', 2, 'Reassigned ticket <b>TCK-000022</b> from <b>Shanxi Rio Renacia</b> to <b>Hilario Curtis</b>', '2026-05-18 09:30:31', 'update'),
(30, 'TCK-000022', 2, 'Updated the status from <b>Pending</b> to <b>On Going</b>', '2026-05-18 09:31:29', 'update'),
(31, 'TCK-000013', 2, 'User <b>Hilario Curtis</b> rejected re-opening Ticket TCK-000013', '2026-05-18 09:57:36', 'update'),
(32, 'TCK-000013', 2, 'Updated the status from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 10:00:17', 'update'),
(33, 'TCK-000013', 2, 'User <b>Hilario Curtis</b> approved Ticket TCK-000013', '2026-05-18 10:00:22', 'update'),
(34, 'TCK-000002', 2, 'Ticket TCK-000002 assigned to <b><b>Shanxi Rio Renacia</b></b>', '2026-05-18 10:05:46', 'insert'),
(35, '2', 2, 'Updated the status from <b>On Going</b> to <b>Closed</b>', '2026-05-18 10:11:02', 'update'),
(36, '2', 2, 'Updated the status from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 10:11:08', 'update'),
(37, '2', 2, '<b>Hilario Curtis</b> approved Ticket 2', '2026-05-18 10:11:28', 'update'),
(38, 'TCK-000023', 2, 'User <b>UID-00002</b> added a comment to Ticket <b>TCK-000023</b>', '2026-05-18 10:13:27', 'insert'),
(39, 'TCK-000024', 2, '<b>Hilario Curtis</b> created ticket <b>TCK-000024</b>', '2026-05-18 10:31:02', 'create'),
(40, 'TCK-000013', 2, 'Reassigned ticket TCK-000013 from <b><b>Hilario Curtis</b></b> to <b><b>Hilario Curtis</b></b>', '2026-05-18 10:31:49', 'update'),
(41, 'TCK-000013', 2, 'Updated the status from <b>Pending</b> to <b>On Going</b>', '2026-05-18 10:31:57', 'update'),
(42, 'TCK-000025', 2, '<b>Hilario Curtis</b> created ticket <b>TCK-000025</b>', '2026-05-18 10:40:52', 'create'),
(43, 'TCK-000025', 2, '<b>Hilario Curtis</b> approved Ticket TCK-000025', '2026-05-18 10:41:43', 'update'),
(44, 'TCK-000025', 2, 'Updated the status from <b>Pending</b> to <b>Closed</b>', '2026-05-18 10:41:55', 'update'),
(45, 'TCK-000025', 2, 'Updated the status from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 10:42:02', 'update'),
(46, 'TCK-000013', 2, 'Updated the status from <b>On Going</b> to <b>Closed</b>', '2026-05-18 10:42:55', 'update'),
(47, 'TCK-000013', 2, 'Updated the status from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 10:43:00', 'update'),
(48, 'TCK-000025', 2, '<b>Hilario Curtis</b> approved Ticket TCK-000025', '2026-05-18 10:45:17', 'update'),
(49, 'TCK-000024', 2, '<b>Hilario Curtis</b> approved Ticket TCK-000024', '2026-05-18 10:45:45', 'update'),
(50, 'TCK-000025', 2, 'Ticket TCK-000025 assigned to <b><b>Hilario Curtis</b></b>', '2026-05-18 10:46:50', 'insert'),
(51, 'TCK-000025', 2, 'Updated the status from <b>Pending</b> to <b>On Going</b>', '2026-05-18 10:47:13', 'update'),
(52, 'TCK-000025', 2, 'Updated the status from <b>On Going</b> to <b>Testing</b>', '2026-05-18 10:48:44', 'update'),
(53, 'TCK-000025', 2, 'Updated the status from <b>Testing</b> to <b>Closed</b>', '2026-05-18 10:49:01', 'update'),
(54, 'TCK-000025', 2, 'Updated the status from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 10:51:05', 'update'),
(55, 'TCK-000025', 2, '<b>Hilario Curtis</b> approved Ticket TCK-000025', '2026-05-18 10:51:39', 'update'),
(56, 'TCK-000025', 2, 'Reassigned ticket TCK-000025 from <b><b>Hilario Curtis</b></b> to <b><b>Hilario Curtis</b></b>', '2026-05-18 10:52:00', 'update'),
(57, 'TCK-000025', 2, 'Ticket TCK-000025 assigned to <b><b>Shanxi Rio Renacia</b></b>', '2026-05-18 10:52:14', 'insert'),
(58, 'TCK-000025', 2, 'Updated the status from <b>Pending</b> to <b>Testing</b>', '2026-05-18 11:22:41', 'update'),
(59, 'TCK-000025', 2, 'Updated the status from <b>Testing</b> to <b>On Going</b>', '2026-05-18 11:22:46', 'update'),
(60, 'TCK-000025', 2, 'Reassigned ticket TCK-000025 from <b><b>Shanxi Rio Renacia</b></b> to <b><b>Hilario Curtis</b></b>', '2026-05-18 11:32:44', 'update'),
(61, 'TCK-000022', 2, 'Updated the status from <b>On Going</b> to <b>Testing</b>', '2026-05-18 12:23:59', 'update'),
(62, 'TCK-000022', 2, 'Updated the status from <b>Testing</b> to <b>On Going</b>', '2026-05-18 12:24:13', 'update'),
(63, '', 2, '<b>Hilario Curtis</b> approved Ticket ', '2026-05-18 12:29:24', 'update'),
(64, 'TCK-000013', 2, '<b>Hilario Curtis</b> approved Ticket TCK-000013', '2026-05-18 12:30:32', 'update'),
(65, '1', 1, 'Reassigned ticket 1 from <b><b>Junard Renacia</b> and <b>Hilario Curtis</b></b> to <b><b>Junard Renacia</b></b>', '2026-05-19 03:51:41', 'update'),
(66, 'TCK-000011', 1, 'Reassigned ticket TCK-000011 from <b></b> to <b><b>Mika Taladoc</b> and <b>Junard Renacia</b></b>', '2026-05-19 03:57:45', 'update'),
(67, 'TCK-000011', 1, 'Updated the status from <b>Pending</b> to <b>On Going</b>', '2026-05-19 03:57:48', 'update'),
(68, 'TCK-000011', 1, 'Updated the status from <b>On Going</b> to <b>Testing</b>', '2026-05-19 03:57:49', 'update'),
(69, 'TCK-000011', 1, 'Updated the status from <b>Testing</b> to <b>Closed</b>', '2026-05-19 03:57:55', 'update'),
(70, 'TCK-000026', 3, '<b>Nicole Laurio</b> created ticket <b>TCK-000026</b>', '2026-05-19 03:59:11', 'create'),
(71, 'TCK-000027', 3, '<b>Nicole Laurio</b> created ticket <b>TCK-000027</b>', '2026-05-19 04:01:00', 'create'),
(72, 'TCK-000028', 1, '<b>Junard Renacia</b> created ticket <b>TCK-000028</b>', '2026-05-19 08:29:39', 'create'),
(73, 'TCK-000029', 1, '<b>Junard Renacia</b> created ticket <b>TCK-000029</b>', '2026-05-19 08:30:16', 'create'),
(74, 'TCK-000029', 1, '<b>Junard Renacia</b> approved Ticket TCK-000029', '2026-05-19 08:31:38', 'update'),
(75, 'TCK-000029', 1, 'Ticket TCK-000029 assigned to <b><b>Junard Renacia</b> and <b>Junard Renacia</b></b>', '2026-05-19 08:32:10', 'insert'),
(76, 'TCK-000029', 1, 'Updated the status from <b>Pending</b> to <b>On Going</b>', '2026-05-19 08:32:30', 'update'),
(77, 'TCK-000029', 1, 'User <b>UID-00001</b> added a comment to Ticket <b>TCK-000029</b>', '2026-05-19 08:33:29', 'insert'),
(78, 'TCK-000029', 1, 'Updated the status from <b>On Going</b> to <b>Testing</b>', '2026-05-19 08:33:38', 'update'),
(79, 'TCK-000029', 1, 'Updated the status from <b>Testing</b> to <b>Closed</b>', '2026-05-19 08:33:52', 'update'),
(80, 'TCK-000010', 1, '<b>Junard Renacia</b> rejected re-opening Ticket TCK-000010', '2026-05-19 08:34:06', 'update'),
(81, 'TCK-000029', 1, 'Updated the status from <b>Closed</b> to <b>For Approval</b>', '2026-05-19 08:34:50', 'update'),
(82, 'TCK-000029', 1, '<b>Junard Renacia</b> approved Ticket TCK-000029', '2026-05-19 08:35:11', 'update'),
(83, 'TCK-000030', 1, '<b>Junard Renacia</b> created ticket <b>TCK-000030</b>', '2026-05-19 08:42:46', 'create'),
(84, 'TCK-000030', 1, 'User <b>UID-00001</b> added a comment to Ticket <b>TCK-000030</b>', '2026-05-19 08:43:15', 'insert'),
(85, 'TCK-000029', 1, 'User <b>UID-00001</b> added a comment to Ticket <b>TCK-000029</b>', '2026-05-19 08:57:59', 'insert'),
(86, 'TCK-000029', 1, 'Updated the status from <b>Pending</b> to <b>On Going</b>', '2026-05-19 08:58:08', 'update'),
(87, 'TCK-000029', 1, 'Updated the status from <b>On Going</b> to <b>Testing</b>', '2026-05-19 09:00:31', 'update'),
(88, 'TCK-000029', 1, 'Updated the status from <b>Testing</b> to <b>On Going</b>', '2026-05-19 09:00:48', 'update');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` char(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `ticket_id`, `user_id`, `comment`, `comment_created_at`) VALUES
(1, '1', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2026-03-17 07:38:49'),
(3, '1', 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2026-03-17 07:38:49'),
(4, '1', 3, 'THIS IS MY REPLY: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ', '2026-03-17 07:38:49'),
(5, '1', 1, 'REPLY: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2026-03-17 07:38:49'),
(6, 'TCK-000014', 1, 'Sample Comment with Attachment', '2026-04-30 11:47:48'),
(7, 'TCK-000014', 1, 'Another Comment with Attachment Feature', '2026-04-30 11:59:39'),
(8, 'TCK-000014', 1, 'Testing No. 3 Comment with Attachment ', '2026-04-30 12:02:36'),
(9, 'TCK-000014', 1, 'Testing Comment with Attachment No. 4', '2026-05-04 00:51:38'),
(10, 'TCK-000014', 1, 'Sample', '2026-05-04 02:31:25'),
(11, 'TCK-000014', 1, 'Sample Comment with attachment (Modified Database)', '2026-05-04 02:40:58'),
(12, 'TCK-000014', 1, 'Comment With Attachment, using other file format', '2026-05-04 02:42:28'),
(13, 'TCK-000014', 1, 'Sample Comment', '2026-05-04 02:51:26'),
(14, 'TCK-000014', 1, 'Samp with only one image', '2026-05-04 03:34:24'),
(15, 'TCK-000014', 1, 'Comment with multiple attachment format files', '2026-05-04 03:48:00'),
(16, 'TCK-000014', 1, 'Comment Sample\r\n', '2026-05-04 03:51:23'),
(17, 'TCK-000015', 1, 'Samp', '2026-05-04 06:32:07'),
(18, 'TCK-000015', 1, 'Comment ni Becca at Mika', '2026-05-04 07:29:13'),
(19, 'TCK-000016', 1, 'Comment ni Micca', '2026-05-04 07:32:13'),
(20, 'TCK-000016', 1, 'dfsfs', '2026-05-06 06:40:56'),
(21, 'TCK-000016', 1, 'Another Comment Sample', '2026-05-08 01:25:17'),
(22, 'TCK-000013', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget ullamcorper nisl, eu lacinia libero. Nunc sodales enim quis elit gravida, id lobortis sem ultrices. Sed id nulla id lectus laoreet placerat sit amet in nunc. Nunc a vestibulum odio, in condimentum turpis. Pellentesque tincidunt massa nec placerat pharetra. Mauris quis dui at ligula gravida accumsan a ac arcu. Phasellus porttitor mollis placerat. Phasellus eget nisi nec velit molestie convallis. Curabitur venenatis nulla ullamcorper nulla bibendum, vel consectetur felis fermentum. Sed et quam ultricies, suscipit neque a, placerat erat.\r\n\r\nDuis lorem sem, ornare in tristique eget, euismod quis nisl. Nulla sed tincidunt turpis. Integer ornare dapibus turpis non aliquam. Integer tempor sed dui ac viverra. Nam vestibulum, augue ut fringilla vestibulum, diam arcu scelerisque lacus, cursus sodales dui erat non lectus. Donec viverra, nulla ac posuere porta, magna mi molestie magna, ut auctor massa mi finibus elit. Nulla ultricies congue risus sed blandit. Mauris quis nibh iaculis, consequat quam id, hendrerit magna. In at nisl a metus tristique convallis in rhoncus mi.\r\n\r\nNulla sit amet lacus id ligula sagittis ornare. Nullam eu tortor turpis. Etiam sodales leo ac velit sodales, non sagittis metus egestas. Sed rhoncus aliquam ligula ac rutrum. Vivamus sit amet augue vitae orci tempus eleifend. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vehicula orci ac commodo dignissim. Sed rutrum mauris eget velit vehicula, imperdiet aliquet nisi rutrum. Donec ante est, posuere in nunc sit amet, lobortis blandit magna.\r\n\r\nPhasellus pulvinar felis magna, a molestie turpis scelerisque id. Mauris volutpat eros eu eros aliquam, id finibus tellus pellentesque. In eu nunc id neque dapibus congue. Aliquam arcu nulla, vulputate ut malesuada nec, venenatis eget erat. Donec tempor tortor non neque blandit porta. Maecenas placerat libero ut dolor faucibus, id consectetur nulla blandit. Maecenas porta dui vitae mauris consequat, a vestibulum urna vestibulum. Pellentesque facilisis velit dui, eu iaculis lectus congue nec. Pellentesque laoreet tristique auctor. Aliquam vel neque vestibulum, dapibus lacus at, posuere dolor. Proin sagittis ultricies risus sit amet euismod. Donec et arcu nec velit pulvinar rhoncus. Phasellus ut mattis odio, sed commodo urna. Mauris in varius ipsum. Sed eget sagittis elit. Cras vitae diam aliquet quam tempor dapibus.\r\n\r\nNam id augue vel nisi condimentum sollicitudin. Vestibulum a pharetra nibh, quis fringilla nulla. Pellentesque non ex rutrum, gravida ligula in, suscipit nibh. Suspendisse at nulla imperdiet, mollis metus sed, eleifend nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus non diam nulla. Duis mi libero, vulputate ut dui vel, maximus tempus dui. Morbi arcu eros, facilisis faucibus aliquam sit amet, consectetur fermentum sapien. Nam faucibus lorem rutrum erat dictum, a aliquam nulla luctus. Aenean lacus odio, sollicitudin non neque ac, interdum pulvinar felis. Fusce rhoncus pulvinar velit, sit amet mattis dui eleifend ac. Donec non leo ut mauris blandit rhoncus quis lacinia ex. Integer non orci et nisl laoreet fringilla ut et dolor.\r\n\r\n', '2026-05-14 09:46:12'),
(23, 'TCK-000009', 1, 'Sample comment for Audit Trail', '2026-05-15 10:06:10'),
(24, 'TCK-000023', 2, 'Sample Comment\r\n', '2026-05-18 10:13:27'),
(25, 'TCK-000029', 1, 'HAHHAHA', '2026-05-19 08:33:29'),
(26, 'TCK-000030', 1, '<script>alert(\'hey\')</script>', '2026-05-19 08:43:15'),
(27, 'TCK-000029', 1, 'Testing 101', '2026-05-19 08:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `comment_attachments`
--

CREATE TABLE `comment_attachments` (
  `comment_attachment_id` int(11) NOT NULL,
  `comment_id` int(10) UNSIGNED NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `orig_name` varchar(255) NOT NULL,
  `attachment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_attachments`
--

INSERT INTO `comment_attachments` (`comment_attachment_id`, `comment_id`, `attachment`, `orig_name`, `attachment_date`) VALUES
(1, 11, 'f25a9714c726c922c05d86a22b4a1d25.jpg', 'modern-stereo-equipment-illuminates-elegant-living-room-generative-ai.jpg', '2026-05-04 02:40:58'),
(2, 11, '83c6c1f5191a7f8a2c6462a49787835f.jpg', 'pexels-rombo-1510555-3015339.jpg', '2026-05-04 02:40:58'),
(3, 11, '0e17c313900801594c7822fb4097ced2.jpg', 'wp14339384.jpg', '2026-05-04 02:40:58'),
(4, 12, '463d4cef5197506eee7df73304626420.pdf', 'COMPANY_DESCRIPTION_(Lhoopa).pdf', '2026-05-04 02:42:28'),
(5, 12, '41bd362d9c16a845deefe8b6afaa8f7a.pdf', 'COMPANY_DESCRIPTION_(In_Progress).pdf', '2026-05-04 02:42:28'),
(6, 12, '5dba63ed7e720a0e23fb4468eb7af673.pdf', 'OJT_EVALUATION_SHEET_-_Junard.pdf', '2026-05-04 02:42:28'),
(7, 12, '843e9cfd8594f620bf49e5257855fa19.pdf', 'OJT_EVALUATION_SHEET_-_Datus.pdf', '2026-05-04 02:42:28'),
(8, 12, 'd080e8464e0d79a7267797072f915c32.zip', 'hexagonal-infographic-white-background-template.zip', '2026-05-04 02:42:28'),
(9, 12, '773ca2daa68b7e813606cb2c3bcdc523.zip', 'mysql_activity.zip', '2026-05-04 02:42:28'),
(10, 12, 'edf7a413bd275feb540f286b197f070d.zip', 'gradient-geometric-monochrome-background.zip', '2026-05-04 02:42:28'),
(11, 13, '8f017b8f29143013f2ca0f6010e64c9b.pdf', 'Tickets_(3).pdf', '2026-05-04 02:51:26'),
(12, 13, '32b1fcf00fd4a4488706289158fd72b1.pdf', 'Tickets_(2).pdf', '2026-05-04 02:51:26'),
(13, 13, 'd68c8ea4af534556d5c1f5f331a2821d.png', '33496.png', '2026-05-04 02:51:26'),
(14, 13, '3aed14d4b2f8dbe1b1e4bc2484df0717.png', 'logo.png', '2026-05-04 02:51:26'),
(15, 13, '3df7027c36d962fd7b8f806edf3d956f.pdf', 'Tickets_(1).pdf', '2026-05-04 02:51:26'),
(16, 13, '383093a7241aedcd86a220ea6967252a.pdf', 'Tickets.pdf', '2026-05-04 02:51:26'),
(17, 14, '546fbf44349cb48bc45354d9f345cab1.png', 'logo.png', '2026-05-04 03:34:24'),
(18, 15, '957ec1afda3537c2e72a8e8e3e9e969e.jpg', 'modern-stereo-equipment-illuminates-elegant-living-room-generative-ai.jpg', '2026-05-04 03:48:00'),
(19, 15, '11184063f6db813203961341806af5ed.jpg', 'pexels-rombo-1510555-3015339.jpg', '2026-05-04 03:48:00'),
(20, 15, 'db60c64bd6e768e6c03bba96400204b0.jpg', 'wp14339384.jpg', '2026-05-04 03:48:00'),
(21, 15, '80d40af2be7fbe4d4134fc8d4c5ab691.pdf', 'Tickets_(3).pdf', '2026-05-04 03:48:00'),
(22, 15, 'fcc63000a8f2f81e7730bc52eaf89dfb.pdf', 'Tickets_(2).pdf', '2026-05-04 03:48:00'),
(23, 15, 'b37e641b2080b576c11248b3705bb493.pdf', 'Tickets_(1).pdf', '2026-05-04 03:48:00'),
(24, 15, 'bc803e9db1a92cb0c30858d86848b617.pdf', 'Tickets.pdf', '2026-05-04 03:48:00'),
(25, 16, '96c38cd47d57f6709d2141bfb74f5ba1.png', 'logo.png', '2026-05-04 03:51:23'),
(26, 16, '2db892f6b50c7c81d185bf9158f555e2.jpg', 'noimage.jpg', '2026-05-04 03:51:23'),
(27, 16, '355a1852154a0a9f0b4708c73c459f57.zip', 'hexagonal-infographic-white-background-template.zip', '2026-05-04 03:51:23'),
(28, 16, '881dcf8a1d86c0b19ac7b203b4bad3d9.pdf', 'ticket_db.pdf', '2026-05-04 03:51:23'),
(29, 16, 'd26c7fc6ff92709a4ab8410651fe92f1.pdf', 'OJT_EVALUATION_SHEET_-_Junard.pdf', '2026-05-04 03:51:23'),
(30, 16, 'cc8d60f2d90c47f6da74a370693c394c.pdf', 'OJT_EVALUATION_SHEET_-_Datus.pdf', '2026-05-04 03:51:23'),
(31, 16, 'd28c695bccd0ea7e815f08769f93eb02.pdf', 'Company.pdf', '2026-05-04 03:51:23'),
(32, 16, 'cc5a74fc035d398a0aeb33819d2f9d70.pdf', 'COMPANY_DESCRIPTION_(Lhoopa).pdf', '2026-05-04 03:51:23'),
(33, 16, 'ff137829e3aebcb92fd401b886c3a99f.pdf', 'COMPANY_DESCRIPTION_(In_Progress).pdf', '2026-05-04 03:51:23'),
(34, 16, '97bf3b3afce337ea7ab71b5b24997360.jpg', 'sample_pic.jpg', '2026-05-04 03:51:23'),
(35, 16, 'e8c3e7daf8885061fe6392f95df00510.jpg', 'pexels-abbykihano-431722.jpg', '2026-05-04 03:51:23'),
(36, 16, '8c35240df2fa14efdac6d7dfb7102b35.jpg', 'image.jpg', '2026-05-04 03:51:23'),
(37, 17, '9058e5321a1088b5a341dc535f8d4635.jpg', 'modern-stereo-equipment-illuminates-elegant-living-room-generative-ai.jpg', '2026-05-04 06:32:07'),
(38, 17, 'c880a2b555ba2a17457bc38b71323c5d.jpg', 'pexels-rombo-1510555-3015339.jpg', '2026-05-04 06:32:07'),
(39, 17, 'f2c07ffcdf0bcbfc920980c13ad146cd.jpg', 'wp14339384.jpg', '2026-05-04 06:32:07'),
(40, 18, 'bc248ef8a49efb7208a2df18280e8c44.zip', 'd080e8464e0d79a7267797072f915c32.zip', '2026-05-04 07:29:13'),
(41, 18, 'bbf8ae956f6d68623a98f0d276ace303.zip', '355a1852154a0a9f0b4708c73c459f57.zip', '2026-05-04 07:29:13'),
(42, 18, '4ef718d046330ba78637a12aaec995e5.png', 'logo.png', '2026-05-04 07:29:13'),
(43, 18, '81633eb6c022687b3e3898c7541583f4.pdf', 'Tickets_(3).pdf', '2026-05-04 07:29:13'),
(44, 19, '4d70ae841cbc9af6d7a59eb0a3395914.jpg', 'modern-stereo-equipment-illuminates-elegant-living-room-generative-ai.jpg', '2026-05-04 07:32:13'),
(45, 19, 'b9dc212dad9ddb352281f94bc433754a.jpg', 'pexels-rombo-1510555-3015339.jpg', '2026-05-04 07:32:13'),
(46, 19, 'c2dca4d9ab18267096d8228a7385336a.jpg', 'wp14339384.jpg', '2026-05-04 07:32:13'),
(47, 25, '137be1fad451739afb56a2a1e955fc6f.pdf', 'Week_14_Weekly_Report.pdf', '2026-05-19 08:33:29'),
(48, 25, '322bf40fa95c88442de32a7636760b7d.docx', '1201a816aec2ffca4b61c32168ff5550.docx', '2026-05-19 08:33:29'),
(49, 25, 'cfd06501c243afd58274d0ac2a6ca916.zip', 'd080e8464e0d79a7267797072f915c32.zip', '2026-05-19 08:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(10) UNSIGNED NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'active',
  `department_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `department_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `status`, `department_created_at`, `department_updated_at`) VALUES
(1, 'Information Technology', 'active', '2026-04-10 06:14:40', '2026-05-19 07:34:27'),
(2, 'Human Resource', 'active', '2026-04-10 06:14:40', '2026-05-19 07:34:27'),
(3, 'Finance', 'deactivated', '2026-04-10 06:14:40', '2026-05-19 07:52:46'),
(4, 'Acquisition', 'deactivate', '2026-05-19 06:22:53', '2026-05-19 07:39:48'),
(5, 'Accounting', 'active', '2026-05-19 06:52:24', '2026-05-19 07:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `position_id` int(11) UNSIGNED NOT NULL,
  `status` enum('Active','Deactivated','Pending') NOT NULL,
  `escalation_id` int(11) NOT NULL,
  `employee_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `gender`, `contact_number`, `department_id`, `position_id`, `status`, `escalation_id`, `employee_created_at`, `employee_updated_at`) VALUES
(5, 'Junard', 'Renacia', 'male', '09233243423', 1, 1, 'Active', 1, '2026-04-14 11:00:01', '2026-05-12 11:07:23'),
(6, 'Hilario', 'Curtis', 'male', '09238459933', 2, 3, 'Active', 1, '2026-04-16 06:48:03', '2026-05-15 04:48:14'),
(7, 'Nicole', 'Laurio', 'female', '09234235534', 3, 4, 'Active', 2, '2026-04-21 07:54:40', '2026-05-19 03:52:22'),
(9, 'Shanxi Rio', 'Renacia', 'female', '09238459933', 2, 3, 'Active', 4, '2026-05-06 08:46:12', '2026-05-08 08:25:40'),
(10, 'Junard', 'Renacia', 'male', '09123752342', 1, 1, 'Deactivated', 2, '2026-05-12 03:27:40', '2026-05-14 06:16:19'),
(11, 'Sample', 'Sample', 'male', '09123421231', 1, 1, 'Deactivated', 2, '2026-05-12 03:29:31', '2026-05-15 01:11:24'),
(12, 'Samp', 'Sample', 'female', '09235734243', 1, 2, 'Deactivated', 1, '2026-05-12 03:31:14', '2026-05-14 06:15:33'),
(13, 'example', 'none', 'female', '09238459933', 2, 3, 'Deactivated', 1, '2026-05-12 03:33:51', '2026-05-12 11:07:14'),
(15, 'sample', 'sample', 'male', '09238459933', 2, 3, 'Deactivated', 2, '2026-05-12 03:34:56', '2026-05-12 10:40:03'),
(16, 'first Name', 'last Name', 'female', '09234592300', 2, 3, 'Deactivated', 1, '2026-05-12 03:35:20', '2026-05-14 06:15:34'),
(17, 'Junard', 'Renacia', 'female', '09234235534', 3, 4, 'Deactivated', 2, '2026-05-12 03:35:46', '2026-05-18 11:18:29'),
(18, 'Becca', 'Taladoc', 'female', '09323241234', 3, 4, 'Active', 1, '2026-05-18 11:02:16', '2026-05-18 11:17:22'),
(19, 'Mika', 'Taladoc', 'female', '09232321234', 1, 1, 'Active', 4, '2026-05-18 11:18:14', '2026-05-18 11:51:12'),
(20, 'Junard', 'Renacia', 'male', '09231423424', 2, 3, 'Active', 2, '2026-05-19 05:38:34', '2026-05-19 05:38:34'),
(21, 'Mark', 'Datus', 'male', '09123142342', 1, 1, 'Deactivated', 3, '2026-05-19 05:39:57', '2026-05-19 05:42:37'),
(22, 'Junard', 'Renacia', 'male', '09345345345', 1, 2, 'Active', 2, '2026-05-19 05:42:10', '2026-05-19 05:44:00'),
(23, 'abegail', 'samp', 'female', '09234592300', 2, 3, 'Active', 2, '2026-05-19 05:43:52', '2026-05-19 05:43:52'),
(24, 'Reev', 'Baja', 'female', '09560028112', 1, 1, 'Pending', 5, '2026-05-19 09:03:35', '2026-05-19 09:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `escalations`
--

CREATE TABLE `escalations` (
  `escalation_id` int(11) NOT NULL,
  `escalation_level` int(11) NOT NULL,
  `escalation_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `escalations`
--

INSERT INTO `escalations` (`escalation_id`, `escalation_level`, `escalation_name`, `created_at`, `updated_at`) VALUES
(1, 0, 'user', '2026-04-29 07:24:04', '2026-04-29 07:24:04'),
(2, 1, 'agent', '2026-04-29 07:24:04', '2026-04-29 07:24:04'),
(3, 2, 'agent', '2026-04-29 07:24:04', '2026-04-29 07:24:04'),
(4, 3, 'team lead', '2026-04-29 07:24:04', '2026-04-29 07:24:04'),
(5, 10, 'administrator', '2026-04-29 07:24:04', '2026-04-29 07:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `history_assigned`
--

CREATE TABLE `history_assigned` (
  `history_assigned_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_tickets`
--

CREATE TABLE `history_tickets` (
  `history_ticket_id` bigint(10) UNSIGNED NOT NULL,
  `ticket_id` char(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(120) NOT NULL,
  `history_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_tickets`
--

INSERT INTO `history_tickets` (`history_ticket_id`, `ticket_id`, `user_id`, `description`, `history_date`, `action`) VALUES
(3, 'TCK-000023', 2, '<b>Hilario Curtis</b> created the Ticket', '2026-05-18 07:16:56', 'Ticket Created'),
(4, 'TCK-000022', 2, '<b>Hilario Curtis</b> created the Ticket', '2026-05-18 07:37:00', 'Ticket Assigned'),
(5, 'TCK-000022', 2, 'Reassigned from <b>Hilario Curtis</b> to <b>Shanxi Rio Renacia</b>', '2026-05-18 07:38:12', 'Re-assigned'),
(6, 'TCK-000023', 2, 'Approved the Ticket', '2026-05-18 08:10:00', 'Ticket Status'),
(7, 'TCK-000023', 2, 'Department changed from <b>Finance</b> to <b>Human Resource</b>', '2026-05-18 08:31:18', 'Re-assigned Department'),
(8, 'TCK-000023', 2, 'Approved the Ticket', '2026-05-18 08:31:45', 'Ticket Status'),
(9, 'TCK-000023', 2, 'Ticket assigned to <b>Shanxi Rio Renacia</b>', '2026-05-18 08:32:22', 'Assigned User'),
(10, 'TCK-000013', 2, 'Status Updated from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 09:04:17', 'Ticket Status'),
(11, 'TCK-000022', 2, 'Reassigned from <b>Shanxi Rio Renacia</b> to <b>Hilario Curtis</b>', '2026-05-18 09:30:31', 'Re-assigned User'),
(12, 'TCK-000022', 2, 'Status Updated from <b>Pending</b> to <b>On Going</b>', '2026-05-18 09:31:29', 'Ticket Status'),
(13, 'TCK-000013', 2, 'Rejected to re-open the Ticket', '2026-05-18 09:57:36', 'Ticket Status'),
(14, 'TCK-000013', 2, 'Status Updated from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 10:00:17', 'Ticket Status'),
(15, 'TCK-000013', 2, 'Approved to re-open the  Ticket', '2026-05-18 10:00:22', 'Ticket Status'),
(16, 'TCK-000002', 2, 'Ticket assigned to <b><b>Shanxi Rio Renacia</b></b>', '2026-05-18 10:05:46', 'Assigned User'),
(17, '2', 2, 'Status Updated from <b>On Going</b> to <b>Closed</b>', '2026-05-18 10:11:02', 'Ticket Status'),
(18, '2', 2, 'Status Updated from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 10:11:08', 'Ticket Status'),
(19, '2', 2, 'Approved to re-open the Ticket', '2026-05-18 10:11:28', 'Ticket Status'),
(20, 'TCK-000024', 2, '<b>Hilario Curtis</b> created the Ticket', '2026-05-18 10:31:02', 'Ticket Created'),
(21, 'TCK-000013', 2, 'Reassigned from <b><b>Hilario Curtis</b></b> to <b><b>Hilario Curtis</b></b>', '2026-05-18 10:31:49', 'Re-assigned User'),
(22, 'TCK-000013', 2, 'Status Updated from <b>Pending</b> to <b>On Going</b>', '2026-05-18 10:31:57', 'Ticket Status'),
(23, 'TCK-000025', 2, '<b>Hilario Curtis</b> created the Ticket', '2026-05-18 10:40:52', 'Ticket Created'),
(24, 'TCK-000025', 2, 'Approved to re-open the Ticket', '2026-05-18 10:41:43', 'Ticket Status'),
(25, 'TCK-000025', 2, 'Status Updated from <b>Pending</b> to <b>Closed</b>', '2026-05-18 10:41:55', 'Ticket Status'),
(26, 'TCK-000025', 2, 'Status Updated from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 10:42:02', 'Ticket Status'),
(27, 'TCK-000013', 2, 'Status Updated from <b>On Going</b> to <b>Closed</b>', '2026-05-18 10:42:55', 'Ticket Status'),
(28, 'TCK-000013', 2, 'Status Updated from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 10:43:00', 'Ticket Status'),
(29, 'TCK-000025', 2, 'Approved the Ticket', '2026-05-18 10:45:17', 'Ticket Status'),
(30, 'TCK-000024', 2, 'Approved the Ticket', '2026-05-18 10:45:45', 'Ticket Status'),
(31, 'TCK-000025', 2, 'Ticket assigned to <b><b>Hilario Curtis</b></b>', '2026-05-18 10:46:50', 'Assigned User'),
(32, 'TCK-000025', 2, 'Status Updated from <b>Pending</b> to <b>On Going</b>', '2026-05-18 10:47:13', 'Ticket Status'),
(33, 'TCK-000025', 2, 'Status Updated from <b>On Going</b> to <b>Testing</b>', '2026-05-18 10:48:44', 'Ticket Status'),
(34, 'TCK-000025', 2, 'Status Updated from <b>Testing</b> to <b>Closed</b>', '2026-05-18 10:49:01', 'Ticket Status'),
(35, 'TCK-000025', 2, 'Status Updated from <b>Closed</b> to <b>For Approval</b>', '2026-05-18 10:51:05', 'Ticket Status'),
(36, 'TCK-000025', 2, 'Approved to re-open the Ticket', '2026-05-18 10:51:39', 'Ticket Status'),
(37, 'TCK-000025', 2, 'Reassigned from <b><b>Hilario Curtis</b></b> to <b><b>Hilario Curtis</b></b>', '2026-05-18 10:52:00', 'Re-assigned User'),
(38, 'TCK-000025', 2, 'Ticket assigned to <b><b>Shanxi Rio Renacia</b></b>', '2026-05-18 10:52:14', 'Assigned User'),
(39, 'TCK-000025', 2, 'Status Updated from <b>Pending</b> to <b>Testing</b>', '2026-05-18 11:22:41', 'Ticket Status'),
(40, 'TCK-000025', 2, 'Status Updated from <b>Testing</b> to <b>On Going</b>', '2026-05-18 11:22:46', 'Ticket Status'),
(41, 'TCK-000025', 2, 'Reassigned from <b><b>Shanxi Rio Renacia</b></b> to <b><b>Hilario Curtis</b></b>', '2026-05-18 11:32:44', 'Re-assigned User'),
(42, 'TCK-000022', 2, 'Status Updated from <b>On Going</b> to <b>Testing</b>', '2026-05-18 12:23:59', 'Ticket Status'),
(43, 'TCK-000022', 2, 'Status Updated from <b>Testing</b> to <b>On Going</b>', '2026-05-18 12:24:13', 'Ticket Status'),
(44, '', 2, 'Approved to re-open the Ticket', '2026-05-18 12:29:24', 'Ticket Status'),
(45, 'TCK-000013', 2, 'Approved to re-open the Ticket', '2026-05-18 12:30:32', 'Ticket Status'),
(46, '1', 1, 'Reassigned from <b><b>Junard Renacia</b> and <b>Hilario Curtis</b></b> to <b><b>Junard Renacia</b></b>', '2026-05-19 03:51:41', 'Re-assigned User'),
(47, 'TCK-000011', 1, 'Reassigned from <b></b> to <b><b>Mika Taladoc</b> and <b>Junard Renacia</b></b>', '2026-05-19 03:57:45', 'Re-assigned User'),
(48, 'TCK-000011', 1, 'Status Updated from <b>Pending</b> to <b>On Going</b>', '2026-05-19 03:57:48', 'Ticket Status'),
(49, 'TCK-000011', 1, 'Status Updated from <b>On Going</b> to <b>Testing</b>', '2026-05-19 03:57:49', 'Ticket Status'),
(50, 'TCK-000011', 1, 'Status Updated from <b>Testing</b> to <b>Closed</b>', '2026-05-19 03:57:55', 'Ticket Status'),
(51, 'TCK-000026', 3, '<b>Nicole Laurio</b> created the Ticket', '2026-05-19 03:59:11', 'Ticket Created'),
(52, 'TCK-000027', 3, '<b>Nicole Laurio</b> created the Ticket', '2026-05-19 04:01:00', 'Ticket Created'),
(53, 'TCK-000028', 1, '<b>Junard Renacia</b> created the Ticket', '2026-05-19 08:29:39', 'Ticket Created'),
(54, 'TCK-000029', 1, '<b>Junard Renacia</b> created the Ticket', '2026-05-19 08:30:16', 'Ticket Created'),
(55, 'TCK-000029', 1, 'Approved the Ticket', '2026-05-19 08:31:38', 'Ticket Status'),
(56, 'TCK-000029', 1, 'Ticket assigned to <b><b>Junard Renacia</b> and <b>Junard Renacia</b></b>', '2026-05-19 08:32:10', 'Assigned User'),
(57, 'TCK-000029', 1, 'Status Updated from <b>Pending</b> to <b>On Going</b>', '2026-05-19 08:32:30', 'Ticket Status'),
(58, 'TCK-000029', 1, 'Status Updated from <b>On Going</b> to <b>Testing</b>', '2026-05-19 08:33:38', 'Ticket Status'),
(59, 'TCK-000029', 1, 'Status Updated from <b>Testing</b> to <b>Closed</b>', '2026-05-19 08:33:52', 'Ticket Status'),
(60, 'TCK-000010', 1, 'Rejected to re-open the Ticket', '2026-05-19 08:34:06', 'Ticket Status'),
(61, 'TCK-000029', 1, 'Status Updated from <b>Closed</b> to <b>For Approval</b>', '2026-05-19 08:34:50', 'Ticket Status'),
(62, 'TCK-000029', 1, 'Approved to re-open the Ticket', '2026-05-19 08:35:11', 'Ticket Status'),
(63, 'TCK-000030', 1, '<b>Junard Renacia</b> created the Ticket', '2026-05-19 08:42:46', 'Ticket Created'),
(64, 'TCK-000029', 1, 'Status Updated from <b>Pending</b> to <b>On Going</b>', '2026-05-19 08:58:08', 'Ticket Status'),
(65, 'TCK-000029', 1, 'Status Updated from <b>On Going</b> to <b>Testing</b>', '2026-05-19 09:00:31', 'Ticket Status'),
(66, 'TCK-000029', 1, 'Status Updated from <b>Testing</b> to <b>On Going</b>', '2026-05-19 09:00:48', 'Ticket Status');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int(10) UNSIGNED NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `department_id` int(11) UNSIGNED NOT NULL,
  `position_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `position_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`, `department_id`, `position_created_at`, `position_updated_at`) VALUES
(1, 'System Administrator', 1, '2026-03-17 07:38:48', '2026-04-10 06:25:45'),
(2, 'IT Support', 1, '2026-03-17 07:38:48', '2026-04-10 06:25:45'),
(3, 'HR Manager', 2, '2026-03-17 07:38:48', '2026-04-10 06:25:45'),
(4, 'Accountant', 3, '2026-03-17 07:38:48', '2026-04-10 06:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `priority_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(11) UNSIGNED NOT NULL,
  `level_of_priority` varchar(255) NOT NULL,
  `priority_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `priority_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`priority_id`, `department_id`, `level_of_priority`, `priority_created_at`, `priority_updated_at`) VALUES
(1, 1, 'Low', '2026-03-17 07:38:49', '2026-04-10 06:28:35'),
(2, 1, 'Medium', '2026-03-17 07:38:49', '2026-04-10 06:28:35'),
(3, 1, 'High', '2026-03-17 07:38:49', '2026-04-10 06:28:35'),
(4, 2, 'High', '2026-03-17 07:38:49', '2026-04-10 06:28:35'),
(5, 3, 'Medium', '2026-03-17 07:38:49', '2026-04-10 06:28:35'),
(6, 2, 'Low', '2026-04-16 01:39:43', '2026-04-16 01:39:43'),
(7, 2, 'Medium', '2026-04-16 01:39:43', '2026-04-16 01:39:43'),
(8, 1, 'Critical', '2026-04-16 01:39:43', '2026-04-16 01:39:43'),
(9, 3, 'Low', '2026-04-16 01:39:43', '2026-04-16 01:39:43'),
(10, 3, 'High', '2026-04-16 01:39:43', '2026-04-16 01:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_assigned`
--

CREATE TABLE `ticket_assigned` (
  `ticket_assigned_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` char(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `person_status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_assigned`
--

INSERT INTO `ticket_assigned` (`ticket_assigned_id`, `ticket_id`, `user_id`, `person_status`, `created_at`) VALUES
(99, '1', 1, 'Assigned', '2026-04-29 08:38:25'),
(100, '2', 1, 'Reassigned', '2026-04-29 08:38:45'),
(101, '2', 2, 'Assigned', '2026-04-29 08:38:45'),
(102, 'TCK-000006', 3, 'Assigned', '2026-04-29 08:39:03'),
(103, '1', 2, 'Reassigned', '2026-04-29 09:28:44'),
(104, 'TCK-000011', 1, 'Assigned', '2026-05-04 02:58:47'),
(111, '2', 17, 'Reassigned', '2026-05-14 08:34:51'),
(112, 'TCK-000013', 2, 'Assigned', '2026-05-15 01:08:43'),
(113, 'TCK-000010', 1, 'Assigned', '2026-05-15 03:47:38'),
(114, 'TCK-000003', 1, 'Assigned', '2026-05-15 08:46:41'),
(115, '2', 5, 'Reassigned', '2026-05-15 08:47:38'),
(116, 'TCK-000022', 5, 'Reassigned', '2026-05-18 06:48:45'),
(117, 'TCK-000022', 2, 'Assigned', '2026-05-18 07:37:00'),
(118, 'TCK-000023', 5, 'Assigned', '2026-05-18 08:32:22'),
(119, 'TCK-000002', 5, 'Assigned', '2026-05-18 10:05:46'),
(120, 'TCK-000025', 2, 'Assigned', '2026-05-18 10:46:50'),
(121, 'TCK-000025', 5, 'Reassigned', '2026-05-18 10:52:14'),
(122, 'TCK-000011', 19, 'Assigned', '2026-05-19 03:57:45'),
(123, 'TCK-000029', 22, 'Assigned', '2026-05-19 08:32:10'),
(124, 'TCK-000029', 1, 'Assigned', '2026-05-19 08:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachments`
--

CREATE TABLE `ticket_attachments` (
  `attachment_id` int(10) UNSIGNED NOT NULL,
  `attachment` text NOT NULL,
  `orig_name` varchar(255) NOT NULL,
  `ticket_id` char(10) NOT NULL,
  `attachment_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_attachments`
--

INSERT INTO `ticket_attachments` (`attachment_id`, `attachment`, `orig_name`, `ticket_id`, `attachment_date`) VALUES
(4, 'bab9f9b209f378f95103c9ab8b90d24c.jpg', 'pexels-abbykihano-431722.jpg', 'TCK-000002', '2026-04-16 10:55:53'),
(5, '85ef233cd389a28b366fec68764184c3.pdf', 'Untitled_document.pdf', 'TCK-000003', '2026-04-16 11:01:57'),
(6, '7e8527cb0b467562f0399876a5482561.zip', 'hexagonal-infographic-white-background-template.zip', 'TCK-000003', '2026-04-16 11:01:57'),
(7, 'eb90d69de48d46b2b71c918734af1c54.jpg', 'pexels-abbykihano-431722.jpg', 'TCK-000003', '2026-04-16 11:01:57'),
(8, '7d13181aaee5da0c71542e041a51ee4b.pdf', 'Week_7-8_DTR.pdf', 'TCK-000010', '2026-04-17 18:54:57'),
(9, '2e1329cd798e789d92ec74bca5f114e8.pdf', 'Untitled_document.pdf', 'TCK-000010', '2026-04-17 18:54:57'),
(10, 'e7a7374c73036e39fc5c95bc502a494e.pdf', 'ticket_db.pdf', 'TCK-000010', '2026-04-17 18:54:57'),
(11, 'e5fe7be47b6ee23cc14522e3eec68539.zip', 'futuristic-white-technology-background.zip', 'TCK-000010', '2026-04-17 18:54:57'),
(12, 'd4d9d19e6422413b8612429da94b84cd.zip', 'hexagonal-infographic-white-background-template.zip', 'TCK-000010', '2026-04-17 18:54:57'),
(13, '970f3d15d95c999b60fc10f598a75e86.zip', 'bcit-ci-CodeIgniter-3_1_13-0-gbcb17eb.zip', 'TCK-000010', '2026-04-17 18:54:57'),
(14, 'e8b1ab361ec2967d31afc2d9e7bdbfdb.pdf', 'ticket_db.pdf', 'TCK-000011', '2026-04-17 18:56:29'),
(15, 'bac60875a2860f0e0abbac3a16e7d765.zip', 'futuristic-white-technology-background.zip', 'TCK-000011', '2026-04-17 18:56:29'),
(16, '7de5a81d6a5c864e7d3e8066f4112ae3.zip', 'hexagonal-infographic-white-background-template.zip', 'TCK-000011', '2026-04-17 18:56:29'),
(17, '07c47c7a4754515aeea69f71b109a55d.zip', 'bcit-ci-CodeIgniter-3_1_13-0-gbcb17eb.zip', 'TCK-000011', '2026-04-17 18:56:29'),
(18, 'c99cbd3ae54b54795297790290156a00.jpg', 'noimage.jpg', 'TCK-000011', '2026-04-17 18:56:29'),
(19, 'cb80dce17c68892ca0a0c7304fa593e1.zip', 'mysql_activity.zip', 'TCK-000011', '2026-04-17 18:56:29'),
(20, 'dd412b02453dd3b2c96a281cfc8fee65.zip', 'gradient-geometric-monochrome-background.zip', 'TCK-000011', '2026-04-17 18:56:29'),
(21, '6a2b74bbacbff71232ef33740177d669.zip', 'abstract-realistic-technology-particle-background.zip', 'TCK-000011', '2026-04-17 18:56:29'),
(22, '53e48b115995383ae754f99be98eee96.zip', 'minimalist-gradient-background-design-template.zip', 'TCK-000011', '2026-04-17 18:56:29'),
(23, 'fafae2ccd23f6696b58aa342029305c4.pdf', 'EOD,_MCT_(3).pdf', 'TCK-000011', '2026-04-17 18:56:29'),
(24, '5d4a0fa73f867cf4c5e5d748d215f0bd.pdf', 'Tickets_(3).pdf', 'TCK-000015', '2026-04-30 19:49:29'),
(25, '8e865f204e1c0841ec9b448d56f0509d.pdf', 'Tickets_(2).pdf', 'TCK-000015', '2026-04-30 19:49:29'),
(26, '78dc7419370a3e8ceb4fbbf42a0371f8.png', '33496.png', 'TCK-000015', '2026-04-30 19:49:29'),
(27, 'b82762b4f06052a26aad2a17215b26e9.png', 'logo.png', 'TCK-000015', '2026-04-30 19:49:29'),
(28, 'ad770ae785d77f000a0988eb65f5814e.pdf', 'Tickets_(1).pdf', 'TCK-000015', '2026-04-30 19:49:29'),
(29, '106fdf61e1c6f905830b235b8a293070.jpg', 'digital-art-illustration-vintage-radio-device.jpg', 'TCK-000016', '2026-05-04 15:31:22'),
(30, '0daca19d3218e03250449c08ae01cd3e.jpg', 'modern-stereo-equipment-illuminates-elegant-living-room-generative-ai.jpg', 'TCK-000016', '2026-05-04 15:31:22'),
(31, 'aac65038e9fffcddfedc65d6d6787678.jpg', 'pexels-rombo-1510555-3015339.jpg', 'TCK-000016', '2026-05-04 15:31:22'),
(32, '88542f7c0253cfbeb0cc588d492511f1.jpg', 'retro-digital-art-illustration-radio-technology.jpg', 'TCK-000016', '2026-05-04 15:31:22'),
(33, '90bb4db0e74b1ae751cbde83d9fd9f77.jpg', 'wp14339384.jpg', 'TCK-000016', '2026-05-04 15:31:22'),
(34, '1201a816aec2ffca4b61c32168ff5550.docx', 'Week_1_Weekly_Report.docx', 'TCK-000016', '2026-05-04 15:31:22'),
(35, '7682b61f6df93a37b0240a6f2a5ee290.pdf', 'Week_1_Weekly_Report.pdf', 'TCK-000016', '2026-05-04 15:31:22'),
(36, 'ea85f57e45fb76284b90c822951cfe89.docx', 'Week_1-2_DTR.docx', 'TCK-000016', '2026-05-04 15:31:22'),
(37, 'e4a833972f31b2f3f5be3177155acc45.pdf', 'Week_1-2_DTR.pdf', 'TCK-000016', '2026-05-04 15:31:22'),
(38, 'ee13ab70e3015b55dbfa72164978f1f4.docx', 'Week_2_Weekly_Report.docx', 'TCK-000016', '2026-05-04 15:31:22'),
(39, '46f3d42332bec9d990d466940bbf340e.pdf', 'Tickets_(5).pdf', 'TCK-000017', '2026-05-14 18:43:16'),
(40, '6860130d11a76f6902a3158eb07ead13.pdf', 'Tickets_(4).pdf', 'TCK-000017', '2026-05-14 18:43:16'),
(41, '98c81f23e8a2e04f350f3fd3d37e5d40.jpg', 'modern-stereo-equipment-illuminates-elegant-living-room-generative-ai.jpg', 'TCK-000018', '2026-05-14 18:45:42'),
(42, '535acf5c1442e549515ed2cd2ce3ef73.pdf', 'Tickets_(4).pdf', 'TCK-000019', '2026-05-15 16:01:51'),
(43, '1b850e0a0feeb9afd998e95ec2b78e8b.png', 'logo.png', 'TCK-000025', '2026-05-18 18:40:52'),
(44, '1996eeb52c9d22ac3ba0eeb6874f8626.jpg', 'retro-digital-art-illustration-radio-technology.jpg', 'TCK-000028', '2026-05-19 16:29:39'),
(45, 'c090e8d84b7529d1e89bd506c5623b9c.jpg', 'wp14339384.jpg', 'TCK-000028', '2026-05-19 16:29:39'),
(46, '293796b409c733cce33e33555b096c31.jpg', 'wp14339384.jpg', 'TCK-000028', '2026-05-19 16:29:39'),
(47, '3bf93bbf410ce5899a474e6a641b4157.jpg', 'retro-digital-art-illustration-radio-technology.jpg', 'TCK-000029', '2026-05-19 16:30:16'),
(48, '8f92d01fd5308da5b343f98b2f469526.jpg', 'wp14339384.jpg', 'TCK-000029', '2026-05-19 16:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_details`
--

CREATE TABLE `ticket_details` (
  `ticket_id` char(10) NOT NULL,
  `ticket_name` varchar(255) NOT NULL,
  `ticket_description` text NOT NULL,
  `ticket_type_id` int(11) UNSIGNED NOT NULL,
  `department_id` int(11) UNSIGNED NOT NULL,
  `requester_id` int(11) NOT NULL,
  `priority` varchar(20) DEFAULT NULL,
  `ticket_created` datetime NOT NULL DEFAULT current_timestamp(),
  `expected_start_date` date DEFAULT NULL,
  `expected_resolved_date` date DEFAULT NULL,
  `actual_start_date` timestamp NULL DEFAULT NULL,
  `resolved_date` timestamp NULL DEFAULT NULL,
  `days_since_resolved` int(10) UNSIGNED DEFAULT NULL,
  `root_cause` text DEFAULT NULL,
  `step_taken` text DEFAULT NULL,
  `solution_applied` text DEFAULT NULL,
  `ticket_status` varchar(255) NOT NULL,
  `is_complete` tinyint(4) NOT NULL DEFAULT 0,
  `ticket_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_details`
--

INSERT INTO `ticket_details` (`ticket_id`, `ticket_name`, `ticket_description`, `ticket_type_id`, `department_id`, `requester_id`, `priority`, `ticket_created`, `expected_start_date`, `expected_resolved_date`, `actual_start_date`, `resolved_date`, `days_since_resolved`, `root_cause`, `step_taken`, `solution_applied`, `ticket_status`, `is_complete`, `ticket_updated`) VALUES
('1', 'Computer not turning on', 'PC does not boot', 1, 1, 1, 'High', '2026-03-17 15:38:49', '2026-04-28', '2026-05-28', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0, '2026-04-16 08:38:39'),
('2', 'Software installation', 'Need MS Office installed', 2, 2, 1, 'medium', '2026-03-17 15:38:49', '2026-05-05', '2026-06-05', '2026-05-17 19:11:00', NULL, NULL, NULL, NULL, NULL, 'pending', 0, '2026-04-16 08:38:39'),
('TCK-000001', 'This is a sample Ticket', 'This is just a sample message for sample Ticket I made', 1, 1, 1, 'Low', '2026-04-15 19:49:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'open', 0, '2026-04-16 08:38:39'),
('TCK-000002', 'This is a sample Ticket No. 2', 'Testing 2, with attachments', 1, 2, 1, 'Medium', '2026-04-16 10:55:53', '2026-05-01', '2026-06-05', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0, '2026-04-16 08:38:39'),
('TCK-000003', 'This is a sample Ticket No. 3', 'Lorem ipsum dolor sit amet. Cras vitae mi elementum, mattis diam et, sollicitudin elit. Sed sed lectus sed tellus consequat condimentum. Donec tincidunt risus mauris, non ultricies velit congue in. Fusce ullamcorper, ', 2, 1, 1, 'Critical', '2026-04-16 11:01:57', '2026-05-03', '2026-05-21', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0, '2026-04-16 08:38:39'),
('TCK-000004', 'Fixed UI', '', 1, 1, 1, NULL, '2026-04-16 17:42:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'closed', -1, '2026-04-16 09:42:26'),
('TCK-000005', 'TESTTING 101', 'i don\'t know :(', 2, 1, 1, NULL, '2026-04-16 17:43:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'for approval', 0, '2026-04-16 09:43:31'),
('TCK-000006', 'Testing 101', 'Hey, it is only testing', 4, 3, 1, 'Low', '2026-04-16 18:08:06', '2026-03-31', '2026-05-08', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0, '2026-04-16 10:08:06'),
('TCK-000007', 'This is a sample Ticket No. 5', 'AHAHAHAHAH', 1, 1, 1, NULL, '2026-04-16 18:08:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'for approval', 0, '2026-04-16 10:08:32'),
('TCK-000008', 'This is a sample Ticket No. Many Times', 'Heyyyyyyyyyyyyyyyyyyyyyyyy', 2, 1, 1, NULL, '2026-04-16 18:08:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'for approval', 0, '2026-04-16 10:08:48'),
('TCK-000009', 'TESTTING 101', 'AWEWWAWAWD', 3, 3, 1, NULL, '2026-04-16 18:09:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Approval', 0, '2026-04-16 10:09:02'),
('TCK-000010', 'Sample Ticket 101', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vitae mi elementum, mattis diam et, sollicitudin elit. Sed sed lectus sed tellus consequat condimentum. Donec tincidunt risus mauris, non ultricies velit congue in. Fusce ullamcorper, augue eu facilisis consectetur, ligula odio molestie odio, non vestibulum arcu mauris ut velit. Donec pellentesque porttitor turpis, id dignissim diam tempus et. Vivamus eget porttitor libero, tincidunt malesuada erat. Nam at velit at ante eleifend porta. Cras facilisis nunc ex, a congue est tempor at.\n\nCras eget est purus. In hac habitasse platea dictumst. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pellentesque sodales nibh in lacinia. Nunc faucibus dolor quis convallis facilisis. Proin non velit purus. Maecenas ultrices pretium libero, quis elementum lacus lobortis vitae. Mauris at dapibus nisi. Nulla lobortis ligula ut urna accumsan efficitur. Aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec sem quis neque aliquam ornare. Duis consequat vel libero sit amet rhoncus. Proin at aliquet diam. Etiam malesuada maximus imperdiet. Integer porta risus et tellus blandit, et sodales tellus malesuada.', 1, 1, 1, 'Critical', '2026-04-17 18:54:57', '2026-05-06', '2026-05-21', '2026-05-18 01:36:00', NULL, NULL, NULL, NULL, NULL, 'closed', 0, '2026-04-17 10:54:57'),
('TCK-000011', 'Sample Ticket 101 2.0', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vitae mi elementum, mattis diam et, sollicitudin elit. Sed sed lectus sed tellus consequat condimentum. Donec tincidunt risus mauris, non ultricies velit congue in. Fusce ullamcorper, augue eu facilisis consectetur, ligula odio molestie odio, non vestibulum arcu mauris ut velit. Donec pellentesque porttitor turpis, id dignissim diam tempus et. Vivamus eget porttitor libero, tincidunt malesuada erat. Nam at velit at ante eleifend porta. Cras facilisis nunc ex, a congue est tempor at.\r\n\r\nCras eget est purus. In hac habitasse platea dictumst. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pellentesque sodales nibh in lacinia. Nunc faucibus dolor quis convallis facilisis. Proin non velit purus. Maecenas ultrices pretium libero, quis elementum lacus lobortis vitae. Mauris at dapibus nisi. Nulla lobortis ligula ut urna accumsan efficitur. Aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec sem quis neque aliquam ornare. Duis consequat vel libero sit amet rhoncus. Proin at aliquet diam. Etiam malesuada maximus imperdiet. Integer porta risus et tellus blandit, et sodales tellus malesuada.', 2, 1, 1, 'critical', '2026-04-17 18:56:29', '2026-04-27', '2026-05-28', '2026-05-19 03:57:00', '2026-05-19 03:57:00', 0, NULL, NULL, NULL, 'closed', 1, '2026-04-17 10:56:29'),
('TCK-000012', 'Sample Ticket 4/28/2026', 'Sample Description. This is intended to see if some features are working', 3, 2, 1, NULL, '2026-04-28 10:47:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'closed', -1, '2026-04-28 02:47:51'),
('TCK-000013', 'Sample Ticket 4/28/2026', 'Sample Description. This is intended to see if some features are working', 3, 2, 1, 'high', '2026-04-28 10:48:15', '2026-04-30', '2026-05-29', '2026-05-17 22:31:00', NULL, NULL, NULL, NULL, NULL, 'pending', 0, '2026-04-28 02:48:15'),
('TCK-000014', 'Sample Ticket 4/29/2026 with new DB', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget ullamcorper nisl, eu lacinia libero. Nunc sodales enim quis elit gravida, id lobortis sem ultrices. Sed id nulla id lectus laoreet placerat sit amet in nunc. Nunc a vestibulum odio, in condimentum turpis. Pellentesque tincidunt massa nec placerat pharetra. Mauris quis dui at ligula gravida accumsan a ac arcu. Phasellus porttitor mollis placerat. Phasellus eget nisi nec velit molestie convallis. Curabitur venenatis nulla ullamcorper nulla bibendum, vel consectetur felis fermentum. Sed et quam ultricies, suscipit neque a, placerat erat.\n\nDuis lorem sem, ornare in tristique eget, euismod quis nisl. Nulla sed tincidunt turpis. Integer ornare dapibus turpis non aliquam. Integer tempor sed dui ac viverra. Nam vestibulum, augue ut fringilla vestibulum, diam arcu scelerisque lacus, cursus sodales dui erat non lectus. Donec viverra, nulla ac posuere porta, magna mi molestie magna, ut auctor massa mi finibus elit. Nulla ultricies congue risus sed blandit. Mauris quis nibh iaculis, consequat quam id, hendrerit magna. In at nisl a metus tristique convallis in rhoncus mi.\n\nNulla sit amet lacus id ligula sagittis ornare. Nullam eu tortor turpis. Etiam sodales leo ac velit sodales, non sagittis metus egestas. Sed rhoncus aliquam ligula ac rutrum. Vivamus sit amet augue vitae orci tempus eleifend. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vehicula orci ac commodo dignissim. Sed rutrum mauris eget velit vehicula, imperdiet aliquet nisi rutrum. Donec ante est, posuere in nunc sit amet, lobortis blandit magna.\n\nPhasellus pulvinar felis magna, a molestie turpis scelerisque id. Mauris volutpat eros eu eros aliquam, id finibus tellus pellentesque. In eu nunc id neque dapibus congue. Aliquam arcu nulla, vulputate ut malesuada nec, venenatis eget erat. Donec tempor tortor non neque blandit porta. Maecenas placerat libero ut dolor faucibus, id consectetur nulla blandit. Maecenas porta dui vitae mauris consequat, a vestibulum urna vestibulum. Pellentesque facilisis velit dui, eu iaculis lectus congue nec. Pellentesque laoreet tristique auctor. Aliquam vel neque vestibulum, dapibus lacus at, posuere dolor. Proin sagittis ultricies risus sit amet euismod. Donec et arcu nec velit pulvinar rhoncus. Phasellus ut mattis odio, sed commodo urna. Mauris in varius ipsum. Sed eget sagittis elit. Cras vitae diam aliquet quam tempor dapibus.\n\nNam id augue vel nisi condimentum sollicitudin. Vestibulum a pharetra nibh, quis fringilla nulla. Pellentesque non ex rutrum, gravida ligula in, suscipit nibh. Suspendisse at nulla imperdiet, mollis metus sed, eleifend nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus non diam nulla. Duis mi libero, vulputate ut dui vel, maximus tempus dui. Morbi arcu eros, facilisis faucibus aliquam sit amet, consectetur fermentum sapien. Nam faucibus lorem rutrum erat dictum, a aliquam nulla luctus. Aenean lacus odio, sollicitudin non neque ac, interdum pulvinar felis. Fusce rhoncus pulvinar velit, sit amet mattis dui eleifend ac. Donec non leo ut mauris blandit rhoncus quis lacinia ex. Integer non orci et nisl laoreet fringilla ut et dolor.\n\n', 4, 3, 1, 'medium', '2026-04-29 15:10:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'open', 0, '2026-04-29 07:10:09'),
('TCK-000015', 'Testing 4/30/2026', 'Sample Details to test if it is still working', 1, 3, 1, 'medium', '2026-04-30 19:49:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'open', 0, '2026-04-30 11:49:29'),
('TCK-000016', 'Ticket ni Mika at Becca', 'Sample ', 3, 2, 1, NULL, '2026-05-04 15:31:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'closed', -1, '2026-05-04 07:31:22'),
('TCK-000017', 'Just a test (other department)', 'Testing 101', 3, 2, 3, NULL, '2026-05-14 18:43:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'closed', -1, '2026-05-14 10:43:16'),
('TCK-000018', 'Testing 101 using other department', 'Testing 101', 4, 3, 2, NULL, '2026-05-14 18:45:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Approval', 0, '2026-05-14 10:45:42'),
('TCK-000019', 'Testing Creating Ticket with audit', 'Sample Description', 4, 3, 1, NULL, '2026-05-15 16:01:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Approval', 0, '2026-05-15 08:01:51'),
('TCK-000020', 'New ticket to test audit trail with full name', 'Sample ', 4, 3, 1, NULL, '2026-05-18 14:25:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Approval', 0, '2026-05-18 06:25:55'),
('TCK-000021', 'Audit Trail Sample with Full Name', 'Sample', 4, 3, 1, NULL, '2026-05-18 14:29:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Approval', 0, '2026-05-18 06:29:10'),
('TCK-000022', ' Audit Trail Sample with Full Name 2', 'sadada ds', 3, 2, 1, 'high', '2026-05-18 14:30:49', '2026-05-02', '2026-05-27', '2026-05-17 21:31:00', NULL, NULL, NULL, NULL, NULL, 'on going', 0, '2026-05-18 06:30:49'),
('TCK-000023', 'Testing Ticket with history details', 'Sample Description', 4, 2, 2, 'high', '2026-05-18 15:16:56', '2026-05-06', '2026-05-29', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0, '2026-05-18 07:16:56'),
('TCK-000024', 'Sample Ticket Again', 'Sample Text', 3, 2, 2, 'medium', '2026-05-18 18:31:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'open', 0, '2026-05-18 10:31:02'),
('TCK-000025', 'Sample nila Becca at Mika', 'Pauwi na kasi sila', 3, 2, 2, 'medium', '2026-05-18 18:40:52', '2026-04-27', '2026-06-04', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0, '2026-05-18 10:40:52'),
('TCK-000026', 'Sample Ticket 5/19/2026', 'Sample Description', 2, 1, 3, NULL, '2026-05-19 11:59:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Approval', 0, '2026-05-19 03:59:11'),
('TCK-000027', 'TESTTING 101', 'Sample', 2, 1, 3, NULL, '2026-05-19 12:01:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Approval', 0, '2026-05-19 04:01:00'),
('TCK-000028', 'Sample Ticket', 'Sample', 4, 3, 1, NULL, '2026-05-19 16:29:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Approval', 0, '2026-05-19 08:29:39'),
('TCK-000029', 'sample', 'Sample', 1, 1, 1, 'high', '2026-05-19 16:30:16', '2026-05-04', '2026-06-03', '2026-05-18 20:58:00', NULL, NULL, NULL, NULL, NULL, 'on going', 0, '2026-05-19 08:30:16'),
('TCK-000030', 'Testing', '<marquee behavior=\"scroll\" direction=\"left\">HTML marquee...</marquee>', 3, 2, 1, NULL, '2026-05-19 16:42:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Approval', 0, '2026-05-19 08:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_type`
--

CREATE TABLE `ticket_type` (
  `ticket_type_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(11) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `ticket_type_status` varchar(20) NOT NULL,
  `category_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_type`
--

INSERT INTO `ticket_type` (`ticket_type_id`, `department_id`, `type_name`, `ticket_type_status`, `category_created_at`, `category_updated_at`) VALUES
(1, 1, 'Hardware Issue', 'Used', '2026-04-10 06:13:03', '2026-03-17 07:38:49'),
(2, 1, 'Software Issue', 'Used', '2026-04-10 06:13:03', '2026-03-17 07:38:49'),
(3, 2, 'Employee Concern', 'Used', '2026-04-10 06:13:03', '2026-03-17 07:38:49'),
(4, 3, 'Billing Issue', 'Used', '2026-04-10 06:13:03', '2026-03-17 07:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_updates`
--

CREATE TABLE `ticket_updates` (
  `update_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` char(10) NOT NULL,
  `update_detail` text NOT NULL,
  `update_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_updates`
--

INSERT INTO `ticket_updates` (`update_id`, `ticket_id`, `update_detail`, `update_created`) VALUES
(1, 'TCK-000006', 'Diagnosed power supply issue', '2026-03-17 15:38:49'),
(2, 'TCK-000008', 'Downloading installer', '2026-03-17 15:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `access_id` int(11) NOT NULL,
  `is_online` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_active` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `employee_id`, `email`, `password`, `access_id`, `is_online`, `created_at`, `updated_at`, `last_active`) VALUES
(1, 5, 'junard.renacia@lhoopa.com', '$2y$10$klGMgo2zTi7snZb1T4iUAOYjig9nbdO.DwDsdiz0IYtPbsl.T10sG', 3, 1, '2026-04-14 11:00:01', '2026-05-19 09:04:29', '2026-05-19 09:04:29'),
(2, 6, 'hilario@gmail.com', '$2y$10$ggVzWuwRNy0i5fWv0K6quuALA4l0Z49s2UVa8Af51f4XimxgsioCa', 1, 1, '2026-04-16 06:48:03', '2026-05-19 05:42:19', '2026-05-19 05:42:19'),
(3, 7, 'nicole.laurio@email.com', '$2y$10$QzG64pydRbEwl5kkvuVCUO3XKu3KvJS61XwhefzKxFK1h0DbOjT5G', 4, 1, '2026-04-21 07:54:40', '2026-05-19 08:27:50', '2026-05-19 08:27:50'),
(5, 9, 'shanxi.renacia@email.com', '$2y$10$01g/QFHWaI4ON.o0ait5YOs/bWtqR0ChcqB7JUSw1.TuvwyuqFodO', 4, 0, '2026-05-06 08:46:12', '2026-05-15 01:22:35', '2026-05-07 12:00:01'),
(10, 10, 'junard@email.com', '$2y$10$sLlhJQgkh0VO14FRl8Ke7.CHCX.gDl/f1/CcKGEFjZlfZK6MUaK46', 2, 0, '2026-05-12 03:27:40', '2026-05-12 03:27:40', '2026-05-12 03:27:40'),
(11, 11, 'sample@email.com', '$2y$10$/7EABNsaMi1sHiVC0i5Ge.wkvAh9y8OqR6QmKXiII3LAQXEClQJb.', 3, 0, '2026-05-12 03:29:31', '2026-05-12 03:29:31', '2026-05-12 03:29:31'),
(17, 17, 'lhoopa@email.com', '$2y$10$0dzS2fzKY7d8O4HO848/lu.u7i9XPfNDxFvFNCz/kAx864LV8heP2', 3, 0, '2026-05-12 03:35:46', '2026-05-12 09:06:08', '2026-05-12 03:35:46'),
(18, 18, 'becca@email.com', '$2y$10$KC18dFJ2/m2MPcOIzcgHQ.nAHFhCzyiCkqz0J2mHuH/ktclNxfzRW', 1, 0, '2026-05-18 11:02:16', '2026-05-18 11:02:16', '2026-05-18 11:02:16'),
(19, 19, 'mika@email.com', '$2y$10$K81p.kgOpVo2Yq3B74UA.uazoSHXmHpWcW6g19FquFIYV9.gWtEk2', 1, 0, '2026-05-18 11:18:14', '2026-05-19 05:49:03', '2026-05-18 11:18:14'),
(20, 20, 'renacia@lhoopa.com', '$2y$10$t2y0lPcIhoFvwpTKm1wd7umBA.eF/aW.dSpAs.wPTLLhW9xWSlq.W', 1, 0, '2026-05-19 05:38:34', '2026-05-19 05:38:34', '2026-05-19 05:38:34'),
(21, 21, 'mark@gmail.com', '$2y$10$Ys74DWtL5sVDJQgxy/7Z8u94ZpBKjWty2XjquDPede8qwHMzLxDWO', 2, 0, '2026-05-19 05:39:57', '2026-05-19 05:39:57', '2026-05-19 05:39:57'),
(22, 22, 'samp@lhoopa.com', '$2y$10$dZF7sjkEgkL6rJqmUYIeRuzEtfZanTranEtrTURwR5IjwYY98UnBq', 2, 0, '2026-05-19 05:42:10', '2026-05-19 05:42:10', '2026-05-19 05:42:10'),
(23, 23, 'samp.abby@lhoopa.com', '$2y$10$FOltPFKlpARNTsVLSfbjzesB/q4abOqz/8Mjbq9WdFqgw6An78fO6', 2, 0, '2026-05-19 05:43:52', '2026-05-19 05:43:52', '2026-05-19 05:43:52'),
(24, 24, 'rbccbj2603@gmail.com', '$2y$10$avj6IKPRGBT1C5cvvHV9BOKH93/D5uNHc5BBfdeF5dpVpkjr/XtAC', 4, 0, '2026-05-19 09:03:35', '2026-05-19 09:03:35', '2026-05-19 09:03:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_types`
--
ALTER TABLE `access_types`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `audit_tickets`
--
ALTER TABLE `audit_tickets`
  ADD PRIMARY KEY (`audit_ticket_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comment_attachments`
--
ALTER TABLE `comment_attachments`
  ADD PRIMARY KEY (`comment_attachment_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `escalation_id` (`escalation_id`);

--
-- Indexes for table `escalations`
--
ALTER TABLE `escalations`
  ADD PRIMARY KEY (`escalation_id`);

--
-- Indexes for table `history_assigned`
--
ALTER TABLE `history_assigned`
  ADD PRIMARY KEY (`history_assigned_id`);

--
-- Indexes for table `history_tickets`
--
ALTER TABLE `history_tickets`
  ADD PRIMARY KEY (`history_ticket_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`priority_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `ticket_assigned`
--
ALTER TABLE `ticket_assigned`
  ADD PRIMARY KEY (`ticket_assigned_id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD PRIMARY KEY (`attachment_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `ticket_type_id` (`ticket_type_id`),
  ADD KEY `requester_id` (`requester_id`);

--
-- Indexes for table `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`ticket_type_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `ticket_updates`
--
ALTER TABLE `ticket_updates`
  ADD PRIMARY KEY (`update_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `access_id` (`access_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_types`
--
ALTER TABLE `access_types`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `audit_tickets`
--
ALTER TABLE `audit_tickets`
  MODIFY `audit_ticket_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `comment_attachments`
--
ALTER TABLE `comment_attachments`
  MODIFY `comment_attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `escalations`
--
ALTER TABLE `escalations`
  MODIFY `escalation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `history_assigned`
--
ALTER TABLE `history_assigned`
  MODIFY `history_assigned_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history_tickets`
--
ALTER TABLE `history_tickets`
  MODIFY `history_ticket_id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `priority_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ticket_assigned`
--
ALTER TABLE `ticket_assigned`
  MODIFY `ticket_assigned_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  MODIFY `attachment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `ticket_type`
--
ALTER TABLE `ticket_type`
  MODIFY `ticket_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ticket_updates`
--
ALTER TABLE `ticket_updates`
  MODIFY `update_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_details` (`ticket_id`),
  ADD CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`),
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`),
  ADD CONSTRAINT `employees_ibfk_4` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`),
  ADD CONSTRAINT `employees_ibfk_5` FOREIGN KEY (`escalation_id`) REFERENCES `escalations` (`escalation_id`);

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `priorities`
--
ALTER TABLE `priorities`
  ADD CONSTRAINT `priorities_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `ticket_assigned`
--
ALTER TABLE `ticket_assigned`
  ADD CONSTRAINT `ticket_assigned_ibfk_4` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_details` (`ticket_id`),
  ADD CONSTRAINT `ticket_assigned_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD CONSTRAINT `ticket_attachments_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_details` (`ticket_id`);

--
-- Constraints for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD CONSTRAINT `ticket_details_ibfk_6` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`),
  ADD CONSTRAINT `ticket_details_ibfk_8` FOREIGN KEY (`ticket_type_id`) REFERENCES `ticket_type` (`ticket_type_id`),
  ADD CONSTRAINT `ticket_details_ibfk_9` FOREIGN KEY (`requester_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD CONSTRAINT `ticket_type_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `ticket_updates`
--
ALTER TABLE `ticket_updates`
  ADD CONSTRAINT `ticket_updates_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_details` (`ticket_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`access_id`) REFERENCES `access_types` (`access_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
