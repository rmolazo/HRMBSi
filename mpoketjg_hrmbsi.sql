-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 09:21 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mpoketjg_hrmbsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`user_id`, `playlist_id`) VALUES
('h71adG8ccSr3yYzgFLCc', '5bVvlbRyTkOiZwDTZbBQ'),
('FJS7TUliW8gMQHqjCfVB', '5bVvlbRyTkOiZwDTZbBQ'),
('sq9y6YYdgj8s6otaXLZQ', 'QpihrwXJrC6QiacJjR2Q');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `comment` varchar(5000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content_id`, `user_id`, `tutor_id`, `comment`, `date`) VALUES
('XmZjn9kJVYusqoML1fTB', 'x0Lb8FReyhmveSuFWEgy', 'sq9y6YYdgj8s6otaXLZQ', 'U2PlqZwP2xwdqSNWBxmu', 'wew', '2023-05-30'),
('bAE2rXV3SqFmK67cMrbN', 'ZA3sRbNhnm4pdxUmEB2n', 'sq9y6YYdgj8s6otaXLZQ', 'U2PlqZwP2xwdqSNWBxmu', 'nice video\r\n', '2023-05-30'),
('cgOAr779w7Nkq2r30Sg6', 'ZA3sRbNhnm4pdxUmEB2n', 'sq9y6YYdgj8s6otaXLZQ', 'U2PlqZwP2xwdqSNWBxmu', 'wqewqewq', '2023-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(11) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `date` varchar(250) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `name`, `email`, `number`, `message`, `date`, `status`) VALUES
('fbJdfD8CDMyXsTID5rxu', 'Gkkn5cOIfqSsl9nVjfsU', 'Angelica Bayron', 'angelica@gmail.com', '09984241972', 'SAMPLE FEEDBACK ON 88 MODULES', 'May 29, 2023, 11:00 am', 'Approved'),
('TJfztfjUsg94fM16y1js', 'sq9y6YYdgj8s6otaXLZQ', 'John Doe', 'johndoe@gmail.com', '09984241972', 'wewew', 'May 30, 2023, 1:44 pm', '--'),
('1fBzS8UlW65YvCUwdhfb', 'sq9y6YYdgj8s6otaXLZQ', 'John Doe', 'johndoe@gmail.com', '09984241972', 'ANOTHER ONE', 'May 30, 2023, 2:42 pm', '--');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `link` varchar(250) NOT NULL,
  `video` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `tutor_id`, `playlist_id`, `title`, `description`, `link`, `video`, `thumb`, `date`, `status`) VALUES
('x0Lb8FReyhmveSuFWEgy', 'U2PlqZwP2xwdqSNWBxmu', 'QpihrwXJrC6QiacJjR2Q', 'Sample MV', 'MV', 'https://www.youtube-nocookie.com/embed/dN44xpHjNxE?controls=0', 'bwcX0ZemwWfqXmt7jHTi.', 'eVBqC9BphRBKAROqsI3i.jpg', '2023-05-29', 'Active'),
('ZA3sRbNhnm4pdxUmEB2n', 'U2PlqZwP2xwdqSNWBxmu', 'QpihrwXJrC6QiacJjR2Q', 'Sample MV Pt. 2', 'MV Pt. 2', 'https://www.youtube.com/embed/TrRUhNwWihk?controls=0', 'NG7ewFZb56gjigXkB1U3.', 'NN0gGfC359K8puzGhSRM.jpg', '2023-05-30', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `content_completion`
--

CREATE TABLE `content_completion` (
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `content_id` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content_completion`
--

INSERT INTO `content_completion` (`user_id`, `tutor_id`, `content_id`, `date`) VALUES
('sq9y6YYdgj8s6otaXLZQ', 'U2PlqZwP2xwdqSNWBxmu', 'x0Lb8FReyhmveSuFWEgy', '2023-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `ecert`
--

CREATE TABLE `ecert` (
  `user_id` varchar(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `attachmentlink` varchar(250) NOT NULL,
  `attachmentloc` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ecert`
--

INSERT INTO `ecert` (`user_id`, `email`, `name`, `attachmentlink`, `attachmentloc`, `date`) VALUES
('Gkkn5cOIfqSsl9nVjfsU', 'angelica@gmail.com', 'Angelica Bayron', 'Angelica Bayron-May-29-2023-1685329342.png', '../uploaded_files/ecert/Angelica Bayron-May-29-2023-1685329342.png', 'May-29-2023'),
('Gkkn5cOIfqSsl9nVjfsU', 'angelica@gmail.com', 'Angelica Bayron', 'Angelica Bayron-May-29-2023-1685329610.png', '../uploaded_files/ecert/Angelica Bayron-May-29-2023-1685329610.png', 'May-29-2023'),
('Gkkn5cOIfqSsl9nVjfsU', 'angelica@gmail.com', 'Angelica Bayron', 'Angelica Bayron-May-29-2023-1685329705.png', '../uploaded_files/ecert/Angelica Bayron-May-29-2023-1685329705.png', 'May-29-2023'),
('Gkkn5cOIfqSsl9nVjfsU', 'angelica@gmail.com', 'Angelica Bayron', 'Angelica Bayron-May-29-2023-1685329829.png', '../uploaded_files/ecert/Angelica Bayron-May-29-2023-1685329829.png', 'May-29-2023'),
('Gkkn5cOIfqSsl9nVjfsU', 'angelica@gmail.com', 'Angelica Bayron', 'Angelica Bayron-May-29-2023-1685329841.png', '../uploaded_files/ecert/Angelica Bayron-May-29-2023-1685329841.png', 'May-29-2023'),
('Gkkn5cOIfqSsl9nVjfsU', 'angelica@gmail.com', 'Angelica Bayron', 'Angelica Bayron-May-29-2023-1685329902.png', '../uploaded_files/ecert/Angelica Bayron-May-29-2023-1685329902.png', 'May-29-2023'),
('Gkkn5cOIfqSsl9nVjfsU', 'angelica@gmail.com', 'Angelica Bayron', 'Angelica Bayron-May-29-2023-1685329910.png', '../uploaded_files/ecert/Angelica Bayron-May-29-2023-1685329910.png', 'May-29-2023'),
('Gkkn5cOIfqSsl9nVjfsU', 'angelica@gmail.com', 'Angelica Bayron', 'Angelica Bayron-May-29-2023-1685329956.png', '../uploaded_files/ecert/Angelica Bayron-May-29-2023-1685329956.png', 'May-29-2023'),
('Gkkn5cOIfqSsl9nVjfsU', 'angelica@gmail.com', 'Angelica Bayron', 'Angelica Bayron-May-29-2023-1685330054.png', '../uploaded_files/ecert/Angelica Bayron-May-29-2023-1685330054.png', 'May-29-2023'),
('Gkkn5cOIfqSsl9nVjfsU', 'angelica@gmail.com', 'Angelica Bayron', 'Angelica Bayron-May-29-2023-1685330084.png', '../uploaded_files/ecert/Angelica Bayron-May-29-2023-1685330084.png', 'May-29-2023');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `tutor_id`, `content_id`) VALUES
('sq9y6YYdgj8s6otaXLZQ', 'U2PlqZwP2xwdqSNWBxmu', 'JZoC91i7fQXpsgkpCBcR'),
('sq9y6YYdgj8s6otaXLZQ', 'U2PlqZwP2xwdqSNWBxmu', 'x0Lb8FReyhmveSuFWEgy');

-- --------------------------------------------------------

--
-- Table structure for table `loginactivity`
--

CREATE TABLE `loginactivity` (
  `user_id` varchar(50) NOT NULL,
  `time` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loginactivity`
--

INSERT INTO `loginactivity` (`user_id`, `time`) VALUES
('johndoe@gmail.com', 'May 15 2023 2 22 am'),
('johndoe@gmail.com', 'May 15 2023 3 14 am'),
('johndoe@gmail.com', 'May 15, 2023, 3:16 am'),
('johndoe@gmail.com', 'May 15, 2023, 9:18 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 3:33 am'),
('johndoe@gmail.com', 'May 15, 2023, 9:41 am'),
('johndoe@gmail.com', 'May 15, 2023, 10:00 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 10:02 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 10:02 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 10:14 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 10:35 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 10:47 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 10:50 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 11:09 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 11:11 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 11:15 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 11:17 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 11:37 am'),
('johndoe@gmail.com', 'May 15, 2023, 11:38 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 11:38 am'),
('jeandae@gmail.com', 'May 15, 2023, 11:41 am'),
('yanveryeah@gmail.com', 'May 15, 2023, 11:41 am'),
('johndoe@gmail.com', 'May 15, 2023, 4:10 pm'),
('johndoe@gmail.com', 'May 15, 2023, 4:14 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 4:14 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 4:36 pm'),
('theresiancaviteT1@gm', 'May 15, 2023, 4:43 pm'),
('johndoe@gmail.com', 'May 15, 2023, 4:44 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 4:44 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 4:52 pm'),
('theresiancaviteT1@gm', 'May 15, 2023, 4:52 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 4:53 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 4:54 pm'),
('sample@gmail.com', 'May 15, 2023, 4:54 pm'),
('theresiancaviteT1@gmail.com', 'May 15, 2023, 4:56 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 4:56 pm'),
('theresiancaviteT1@gmail.com', 'May 15, 2023, 4:59 pm'),
('johndoe@gmail.com', 'May 15, 2023, 5:06 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 5:09 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 5:53 pm'),
('johndoe@gmail.com', 'May 15, 2023, 8:00 pm'),
('johndoe@gmail.com', 'May 15, 2023, 8:18 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 8:30 pm'),
('johndoe@gmail.com', 'May 15, 2023, 8:42 pm'),
('johndoe@gmail.com', 'May 15, 2023, 8:50 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 8:54 pm'),
('yanveryeah@gmail.com', 'May 15, 2023, 9:19 pm'),
('johndoe@gmail.com', 'May 15, 2023, 9:39 pm'),
('johndoe@gmail.com', 'May 16, 2023, 10:32 am'),
('yanveryeah@gmail.com', 'May 16, 2023, 10:45 am'),
('johndoe@gmail.com', 'May 16, 2023, 11:02 am'),
('johndoe@gmail.com', 'May 16, 2023, 11:10 am'),
('yanveryeah@gmail.com', 'May 16, 2023, 9:45 pm'),
('johndoe@gmail.com', 'May 17, 2023, 8:04 am'),
('yanveryeah@gmail.com', 'May 17, 2023, 8:13 am'),
('johndoe@gmail.com', 'May 17, 2023, 8:16 am'),
('yanveryeah@gmail.com', 'May 17, 2023, 4:04 pm'),
('johndoe@gmail.com', 'May 18, 2023, 9:07 am'),
('yanveryeah@gmail.com', 'May 18, 2023, 1:36 pm'),
('johndoe@gmail.com', 'May 18, 2023, 1:42 pm'),
('yanveryeah@gmail.com', 'May 18, 2023, 9:43 pm'),
('yanveryeah@gmail.com', 'May 18, 2023, 10:38 pm'),
('yanveryeah@gmail.com', 'May 18, 2023, 11:14 pm'),
('yanveryeah@gmail.com', 'May 19, 2023, 9:43 am'),
('yanveryeah@gmail.com', 'May 19, 2023, 9:50 am'),
('johndoe@gmail.com', 'May 19, 2023, 10:47 am'),
('johndoe@gmail.com', 'May 19, 2023, 10:48 am'),
('yanveryeah@gmail.com', 'May 19, 2023, 11:10 am'),
('yanveryeah@gmail.com', 'May 19, 2023, 7:11 pm'),
('yanveryeah@gmail.com', 'May 19, 2023, 8:15 pm'),
('yanveryeah@gmail.com', 'May 19, 2023, 8:21 pm'),
('johndoe@gmail.com', 'May 19, 2023, 8:35 pm'),
('yanveryeah@gmail.com', 'May 19, 2023, 8:42 pm'),
('cartaciano.caressa@gmail.com', 'May 19, 2023, 8:44 pm'),
('johndoe@gmail.com', 'May 20, 2023, 10:47 am'),
('yanveryeah@gmail.com', 'May 20, 2023, 10:50 am'),
('yanveryeah@gmail.com', 'May 22, 2023, 10:22 am'),
('yanverantonioabrenica@gmail.com', 'May 22, 2023, 10:25 am'),
('yanveryeah@gmail.com', 'May 22, 2023, 10:25 am'),
('johndoe@gmail.com', 'May 22, 2023, 10:32 am'),
('yanveryeah@gmail.com', 'May 22, 2023, 10:32 am'),
('yanveryeah@gmail.com', 'May 22, 2023, 11:00 am'),
('jeandae@gmail.com', 'May 22, 2023, 11:02 am'),
('yanveryeah@gmail.com', 'May 22, 2023, 11:04 am'),
('jeandae@gmail.com', 'May 22, 2023, 11:05 am'),
('johndoe@gmail.com', 'May 22, 2023, 11:07 am'),
('yanveryeah@gmail.com', 'May 22, 2023, 11:11 am'),
('johndoe@gmail.com', 'May 22, 2023, 11:23 am'),
('johndoe@gmail.com', 'May 22, 2023, 3:12 pm'),
('yanveryeah@gmail.com', 'May 22, 2023, 3:29 pm'),
('yanveryeah@gmail.com', 'May 23, 2023, 3:09 pm'),
('yanveryeah@gmail.com', 'May 23, 2023, 3:16 pm'),
('johndoe@gmail.com', 'May 23, 2023, 3:18 pm'),
('yanveryeah@gmail.com', 'May 23, 2023, 3:22 pm'),
('yanveryeah@gmail.com', 'May 23, 2023, 3:36 pm'),
('johndoe@gmail.com', 'May 25, 2023, 10:04 pm'),
('johndoe@gmail.com', 'May 25, 2023, 10:48 pm'),
('johndoe@gmail.com', 'May 25, 2023, 10:49 pm'),
('johndoe@gmail.com', 'May 25, 2023, 10:50 pm'),
('johndoe@gmail.com', 'May 26, 2023, 10:14 am'),
('yanveryeah@gmail.com', 'May 26, 2023, 10:35 am'),
('yanveryeah@gmail.com', 'May 26, 2023, 10:36 am'),
('yanveryeah@gmail.com', 'May 29, 2023, 9:57 am'),
('yanveryeah@gmail.com', 'May 29, 2023, 10:14 am'),
('yanveryeah@gmail.com', 'May 29, 2023, 10:18 am'),
('angelica@gmail.com', 'May 29, 2023, 10:56 am'),
('yanveryeah@gmail.com', 'May 29, 2023, 11:55 am'),
('johndoe@gmail.com', 'May 29, 2023, 12:28 pm'),
('yanveryeah@gmail.com', 'May 29, 2023, 12:36 pm'),
('yanveryeah@gmail.com', 'May 29, 2023, 12:48 pm'),
('yanveryeah@gmail.com', 'May 29, 2023, 4:13 pm'),
('johndoe@gmail.com', 'May 29, 2023, 4:16 pm'),
('yanveryeah@gmail.com', 'May 29, 2023, 4:19 pm'),
('yanveryeah@gmail.com', 'May 29, 2023, 4:24 pm'),
('yanveryeah@gmail.com', 'May 29, 2023, 5:51 pm'),
('johndoe@gmail.com', 'May 29, 2023, 6:28 pm'),
('yanveryeah@gmail.com', 'May 29, 2023, 6:30 pm'),
('yanveryeah@gmail.com', 'May 29, 2023, 7:39 pm'),
('johndoe@gmail.com', 'May 30, 2023, 12:33 pm'),
('yanveryeah@gmail.com', 'May 30, 2023, 1:25 pm'),
('yanveryeah@gmail.com', 'May 30, 2023, 2:45 pm'),
('johndoe@gmail.com', 'May 30, 2023, 2:47 pm');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `email`, `pin`, `date`) VALUES
(39, 'yanveryeah@gmail.com', '125047', 'May 28, 2023, 10:28 pm');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `user_id` varchar(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `event_title` varchar(250) NOT NULL,
  `payment_type` varchar(250) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `image` varchar(255) NOT NULL,
  `payment_id` varchar(20) NOT NULL,
  `date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`user_id`, `name`, `email`, `event_title`, `payment_type`, `amount`, `image`, `payment_id`, `date`) VALUES
('BmuLdnCd83Qb2FZCefCg', 'Rosfer', 'rosferolazo@gmail.com', '88 || MODULES', 'Gcash', '5000', 'K6UpKdZ2MqT62ditpiJU.png', 'TlVoyrItZCQeprZi3uy8', 'May-23-2023'),
('Gkkn5cOIfqSsl9nVjfsU', 'Angelica Bayron', 'angelica@gmail.com', '88 || MODULES', 'Gcash', '5000', 'XquApdlQBWcpSsCh1nxH.png', 'bbUwmKhcE1bELoYXVZSA', 'May-29-2023');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `tutor_id`, `title`, `description`, `thumb`, `date`, `status`) VALUES
('5bVvlbRyTkOiZwDTZbBQ', 'U2PlqZwP2xwdqSNWBxmu', 'HRMBSI | 88  Modules', 'Attorney Josephus B. Jimenez discusses the labor laws of the Philippines and what is to be extracted and removed permanently in his proposal.', 'gjhQeg85NcnAAF8YSOWo.png', '2023-05-12', 'Active'),
('QpihrwXJrC6QiacJjR2Q', 'U2PlqZwP2xwdqSNWBxmu', 'Sample Playlist', 'Sample Description', 'MCCfmp8YXILzv8Xl7Kt7.jpg', '2023-05-15', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` varchar(20) NOT NULL,
  `event_title` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `organization` varchar(250) NOT NULL,
  `source` varchar(250) NOT NULL,
  `attendees` varchar(250) NOT NULL,
  `sector` varchar(250) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `user_id`, `name`, `email`, `message`, `date`) VALUES
('1fBzS8UlW65YvCUwdhfb', 'U2PlqZwP2xwdqSNWBxmu', 'Yanver', 'yanveryeah@gmail.com', 'WEW REPLY', 'May 30, 2023, 9:20 am');

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `name`, `profession`, `email`, `password`, `image`, `status`) VALUES
('U2PlqZwP2xwdqSNWBxmu', 'Yanver', 'Developer', 'yanveryeah@gmail.com', 'f9a1c6473e5b2148a0260596157ae8ec29f7d65f', 'vKBxNDGu8e0JGZ0QLTGt.jpg', 'Active'),
('40Zg9tJVeLoSBvHgFEru', 'Caressa Cartaciano', 'Designer', 'cartaciano.caressa@gmail.com', '3ff10190f19fe8623212942d845d721d7ca3f319', 'lZmRjVq38yNQ4PhkJkhO.jpg', 'Inactive'),
('MaZLtPXuB1cRlC7ZhW4c', 'Wilinda Yu', 'Accountant', 'wilindayu@gmail.com', '11d6c5e5cc3843514f0cb53eade96c0ee2774d28', 'rqRNso0348JQLgurYlR4.jpg', 'Inactive'),
('6C8lRKrA3l6WXqeiKhU3', 'Christian Fernandez', 'Developer', 'christianfernandez@gmail.com', 'e59d7895d05c46a5f048bfb27653d5311246c5a4', 'EIGLGveuvnZJNIju0T8t.png', 'Inactive'),
('ItWZChfJ8ZyJRJTWTnps', 'Reny Yu', 'Developer', 'reny.yu@gmail.com', '45f106493ad54afcee15e117f68841cf3cc1a460', 'XrogJilOPtBKuuIuMp7O.jpg', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `organization` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `attendees` int(50) NOT NULL,
  `source` varchar(250) NOT NULL,
  `sector` varchar(250) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `event_title`, `name`, `organization`, `address`, `email`, `password`, `attendees`, `source`, `sector`, `image`, `status`) VALUES
('sq9y6YYdgj8s6otaXLZQ', 'Sample Zoom Name', 'John Doe', 'HRMBSi', 'Manhattan, New York', 'johndoe@gmail.com', '8072b51da74661e6116b857757b62bf5c3dfb488', 1, 'LinkedIn', 'IT/BPO', 'e9uVjMowfMvxXAFqnN5z.jpg', 'Active'),
('2ZOC5UZAV5lB2mvVKulB', '88 || MODULES', 'Joanna Padawang', 'HRMBSi', 'Taguig City', 'joanna@gmail.com', '12d0ee21089e6daeaecad828b6422be15c0ff32c', 1, 'Colleague', 'IT/BPO', '6hDfzQXP7EN8vxR73T8G.jpg', 'Active'),
('Gkkn5cOIfqSsl9nVjfsU', '88 || MODULES', 'Angelica Bayron', 'HRMBSi', 'Cavite City', 'angelica@gmail.com', 'ca4ab4614f967256178a476bf5e39627f8a5b56e', 1, 'Colleague', 'IT/BPO', 'wjGGYWMWcBQla2DasSXT.png', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `zoom`
--

CREATE TABLE `zoom` (
  `id` varchar(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `start` varchar(250) NOT NULL,
  `end` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zoom`
--

INSERT INTO `zoom` (`id`, `title`, `link`, `password`, `start`, `end`, `date`, `status`) VALUES
('4OxrZDse37nUVC3YUxSN', '88 || MODULES', 'zoom/88modules/27', 'Zoom@27', '9:00AM', '12:00PM', 'May-18-2023', 'Active'),
('uRAsxqDFhUPXDg901OS9', 'Sample Zoom Name', 'Sample Zoom Link', 'Zoom@27', '9:00AM', '11:00AM', 'May-18-2023', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
