-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 07:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `premier-league`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('main_admin','news','standing','fixture','result','stats') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `role`) VALUES
(12, 'ari_ayar', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'main_admin'),
(17, 'ayar', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'news'),
(18, 'ari', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'standing'),
(19, 'ari2', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'fixture'),
(20, 'ari3', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'result'),
(21, 'ayar2', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'stats');

-- --------------------------------------------------------

--
-- Table structure for table `assists`
--

CREATE TABLE `assists` (
  `id` int(11) NOT NULL,
  `player_name` varchar(255) DEFAULT NULL,
  `stat_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assists`
--

INSERT INTO `assists` (`id`, `player_name`, `stat_value`) VALUES
(1, 'Triper', 10),
(2, 'Son', 9),
(3, 'Salah', 9),
(4, 'gross', 10),
(5, 'palmer', 9),
(6, 'watkins', 12),
(7, 'Pedro Neto', 9),
(8, 'saka', 8),
(9, 'bailey', 8),
(10, 'alvarez', 8);

-- --------------------------------------------------------

--
-- Table structure for table `clean_sheets`
--

CREATE TABLE `clean_sheets` (
  `id` int(11) NOT NULL,
  `player_name` varchar(255) DEFAULT NULL,
  `stat_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clean_sheets`
--

INSERT INTO `clean_sheets` (`id`, `player_name`, `stat_value`) VALUES
(1, 'Raya', 13),
(2, 'Leno', 11),
(3, 'Onana', 8),
(4, 'Pickford', 9),
(5, 'Neto', 8),
(6, 'Martinez', 7),
(7, 'Alison', 7),
(8, 'Ederson', 7),
(9, 'Johnstone', 6),
(10, 'Vicario', 6);

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `id` int(11) NOT NULL,
  `home_team` varchar(255) NOT NULL,
  `away_team` varchar(255) NOT NULL,
  `match_time` time NOT NULL,
  `match_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`id`, `home_team`, `away_team`, `match_time`, `match_date`) VALUES
(1, 'Bournemouth', 'Brighton', '16:00:00', '2024-04-28'),
(2, 'Aston Villa', 'Chelsea', '22:00:00', '2024-04-27'),
(3, 'Everton', 'Brentford', '19:30:00', '2024-04-27'),
(4, 'Fulham', 'Crystal', '17:00:00', '2024-04-27'),
(5, 'Man United', 'Burnley', '17:00:00', '2024-04-27'),
(6, 'Newcastle', 'Sheffield', '17:00:00', '2024-04-27'),
(7, 'Man City', 'Nottingham', '18:30:00', '2024-04-28'),
(8, 'Tottenham', 'Arsenal', '16:00:00', '2024-04-28'),
(9, 'Arsenal', 'Aston Villa', '15:30:00', '2024-04-27'),
(10, 'Wolfs', 'Luton', '17:00:00', '2024-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(11) NOT NULL,
  `player_name` varchar(255) DEFAULT NULL,
  `stat_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `player_name`, `stat_value`) VALUES
(1, 'haaland', 25),
(2, 'Salah', 18),
(3, 'Watkins', 19),
(4, 'son', 17),
(5, 'palmer', 21),
(6, 'isak', 20),
(7, 'solanke', 18),
(8, 'foden', 16),
(9, 'saka', 16),
(10, 'bowen', 16);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `image`) VALUES
(102, 'Ronaldo is gone', 'Ronaldo is gone be punished for 1 game because of that af3ala qorra he did against Faiha motivate ', './image/ronaldo-item.jpg'),
(108, 'Salah injury', 'Mo Salah is gone loss the next 6 game in premier league because his nickle injury that he inured in national games of Egyp VS Suadia Arabia ', './image/news/GCy4Y8PXMAAkt7J.jpg'),
(131, 'Best Min in PL', 'It was the two-word answer David Moyes gave in the final press conference before it was announced he would be leaving West Ham at the end of the season as to why his side have been defensively more open this season.', './image/news/rice.jpg'),
(132, 'Halaand about PL', 'Halaand last day talk about premier league and said i wish to stay in this league for a long years i so glad to be here and i so happy in Man City with Pep(his couch) i play.', './image/news/halaand.jpg'),
(133, 'Kloop Leaving!', 'Jürgen Klopp has said he will try “absolutely everything” when his team visit Aston Villa on Monday to avoid the yellow card that would banish him to the stands for his final home game as Liverpool manager.Klopp has been booked twice this season,', './image/news/kloop.jpg'),
(152, 'Solanke injury', 'Dominic Solanke penned a new chapter in the AFC Bournemouth record books as the Cherries battled out an enthralling 2-2 draw with Manchester United at Vitality Stadium.', './image/news/solanke.jpg'),
(154, 'Havertz', 'i am going to be the biggest Tottenham fan ever, Kai Havertz ready to support Arsenals bitter rivals against Manchester City as Gunners pray for a title favou.', './image/news/5031220.jpg'),
(155, 'Guardiola', 'It’s obvious I would say. We have just one option, win the game. We will go from there, the boss said at his pre-match news conference', './image/news/pep.jpg'),
(158, 'Haaland Feature', 'Haaland talk about his future and said, i am happy to stay in Man City and its glad to me to be here with those perfect guys and best couch ', './image/news/230510130603-01-erling-haaland-profile-restricted.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `home_team` varchar(255) NOT NULL,
  `away_team` varchar(255) NOT NULL,
  `home_goals` int(11) NOT NULL,
  `away_goals` int(11) NOT NULL,
  `home_scorers` text DEFAULT NULL,
  `away_scorers` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `home_team`, `away_team`, `home_goals`, `away_goals`, `home_scorers`, `away_scorers`) VALUES
(1, 'Newcastle', 'Tottenham', 4, 0, 'Isak 30\', 51\';Gordon 32\';Schar 87\'', ''),
(2, 'Bournemouth', 'Man United', 2, 2, 'Solanke 44\'; Elanga 80\'', 'Bruno 44\', 76\' (pen)'),
(3, 'Chelsea', 'Burnley', 2, 2, 'Palmer 44\' (pen), 78\'', 'Cullen 47\';O\'Shea 81\''),
(4, 'Nottingham', 'Crystal', 1, 1, 'Wood 61\'', 'Mateta 11\''),
(5, 'Sheffield', 'Fulham', 3, 3, 'Ben Brereton 58\', 70\'; MCBurnie 68\'', 'Palhinha 62\';Reid 86\';Muniz 90+3\''),
(6, 'Tottenham', 'Luton', 2, 1, 'Kabore 51\' (OG); Son 86\'', 'Chong 3\''),
(7, 'Astonvilla', 'Burnley', 2, 0, 'Diaby 36\'; Konsa 65\'', ''),
(8, 'Brentford', 'Man United', 1, 1, 'Ajer 96+9\'', 'Mount 90+6\''),
(9, 'Liverpool', 'Brighton', 2, 1, 'Diaz 27\';Salah 65\'', 'Welback 47\''),
(10, 'Man City', 'Arsenal', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `standings`
--

CREATE TABLE `standings` (
  `id` int(11) NOT NULL,
  `club_name` varchar(255) NOT NULL,
  `club_logo` varchar(255) NOT NULL,
  `played` int(11) NOT NULL,
  `won` int(11) NOT NULL,
  `draw` int(11) NOT NULL,
  `lost` int(11) NOT NULL,
  `plus_minus` varchar(100) NOT NULL,
  `goal_difference` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `standings`
--

INSERT INTO `standings` (`id`, `club_name`, `club_logo`, `played`, `won`, `draw`, `lost`, `plus_minus`, `goal_difference`, `points`) VALUES
(1, 'Liverpool', './image/teamLogo/liverpool.png', 32, 21, 8, 3, '72-31', 41, 71),
(2, 'Man City', './image/teamLogo/mancity.png', 34, 24, 7, 3, '80-32', 48, 79),
(3, 'Arsenal', './image/teamLogo/arsenal.png', 35, 25, 5, 5, '76-26', 50, 80),
(4, 'Aston Villa', './image/teamLogo/astonvilla.png', 32, 18, 6, 8, '66-49', 17, 60),
(5, 'Tottenham', './image/teamLogo/tottenham.png', 32, 17, 6, 9, '62-48', 14, 57),
(6, 'Man United', './image/teamLogo/manunited.png', 32, 15, 5, 12, '47-48', -1, 50),
(7, 'West Ham', './image/teamLogo/westham.png', 32, 13, 9, 10, '52-56', -4, 48),
(8, 'Wolfs', './image/teamLogo/wolfs.png', 31, 12, 6, 13, '44-49', -5, 42),
(9, 'Newcastle', './image/teamLogo/newcastle.png', 34, 17, 5, 12, '69-52', 17, 56),
(10, 'Brighton', './image/teamLogo/brighton.png', 31, 11, 10, 10, '51-49', 2, 43),
(11, 'Chelsea', './image/teamLogo/chelsea.png', 31, 14, 6, 11, '44-43', 1, 48),
(12, 'Fulham', './image/teamLogo/fulham.png', 32, 11, 6, 15, '47-51', -4, 39),
(13, 'Bournemouth', './image/teamLogo/bournemouth.png', 31, 11, 8, 12, '45-55', -10, 41),
(14, 'Crystal Palace', './image/teamLogo/crystalpalace.png', 31, 7, 9, 15, '36-54', -18, 30),
(15, 'Brentford', './image/teamLogo/brentford.png', 32, 7, 8, 17, '45-58', -13, 29),
(16, 'Everton', './image/teamLogo/everton.png', 31, 9, 8, 14, '32-42', -10, 27),
(17, 'Nottingham', './image/teamLogo/nottingham.png', 31, 7, 8, 16, '39-53', -14, 25),
(18, 'Luton', './image/teamLogo/luton.png', 32, 6, 7, 19, '45-65', -20, 25),
(19, 'Sheffield', './image/teamLogo/sheffield.png', 30, 3, 6, 21, '28-80', -52, 15),
(20, 'Burnly', './image/teamLogo/burnley.png', 32, 4, 7, 21, '32-67', -35, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assists`
--
ALTER TABLE `assists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clean_sheets`
--
ALTER TABLE `clean_sheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standings`
--
ALTER TABLE `standings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `assists`
--
ALTER TABLE `assists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `clean_sheets`
--
ALTER TABLE `clean_sheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
