-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2021 at 04:55 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.3.28-2+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `client_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `client_id`, `title`, `link_image`, `description`, `createdAt`) VALUES
(1, NULL, 'samy', 'http://fsdfsdgfdgfdgdf', 'test test ', NULL),
(2, NULL, 'samyemad', 'http://link link link', 'description description', NULL),
(3, NULL, 'samyemad', 'http://link link link', 'description description', '2021-09-03 14:15:53'),
(4, 1, 'fsdfsd', 'http://sfsdfdsfds', 'fdsfsdfsd', '2021-09-03 14:21:54'),
(5, 1, 'sssfsdfsd', 'https://via.placeholder.com/150C/O', 'fdsfsdfsd', '2021-09-03 14:22:25'),
(6, 1, 'samyemad', 'http://gdhgfhgfhgf', 'dfgdfgfdgfd', '2021-09-03 14:46:13'),
(7, 1, 'rwerewr', 'http://rwetertreter', 'werwerwer', '2021-09-03 15:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` tinytext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `email`, `roles`, `password`, `api_token`) VALUES
(1, 'samyemad4@gmail.com', '[\"ROLE_USER\"]', '$2y$13$vZHKcz.R6b0YGA2uiHUew.RtJUY2Q0QYhejK0BJTlJZtKYkeVoGzi', 'samyemad'),
(2, 'samy.emad@businessboomers.net', '[]', '$2y$13$pitTHNsclO7CCw7I.DfO9uEUU91Ym1e.hWWrnaFRVuRCGcVA1mTVK', NULL),
(3, 'samy.emad25@businessboomers.net', '[\"ROLE_USER\"]', '$2y$13$mmzihNGw8iW85utVS.grPuHIOpTaQ6x1vsYa9ZV3R0jVmBQz6sBVe', 'eerrrrr');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `client_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `client_id`, `name`, `url_link`, `email`, `description`, `article_id`) VALUES
(1, NULL, 'dsfsdf', 'fdsfsdf', 'fdsfdsf', 'fdsfdsfds', 5),
(2, 1, 'fsdfsd', 'http://sfsdfsdfsd', 'samyemad4@gmail.com', 'fdsfdsf', 5),
(3, 1, 'fsdfsd', 'http://sfsdfsdfsd', 'samyemad4@gmail.com', 'fdsfdsf', 5),
(4, 1, 'fsdfs', 'http://fdsfdsf', 'samyemad4@gmail.com', 'dsfdsfds', 5);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210831191239', '2021-08-31 22:13:29', 1894),
('DoctrineMigrations\\Version20210903094633', '2021-09-03 12:52:29', 7171),
('DoctrineMigrations\\Version20210903095659', '2021-09-03 12:57:33', 6127),
('DoctrineMigrations\\Version20210903104338', '2021-09-03 13:44:11', 829);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BFDD316819EB6921` (`client_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C7440455E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_C74404557BA2F5EB` (`api_token`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5F9E962A19EB6921` (`client_id`),
  ADD KEY `IDX_5F9E962A7294869C` (`article_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_BFDD316819EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962A19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_5F9E962A7294869C` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
