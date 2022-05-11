-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour bookshelf_corner
CREATE DATABASE IF NOT EXISTS `bookshelf_corner` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bookshelf_corner`;

-- Listage de la structure de la table bookshelf_corner. administrators
DROP TABLE IF EXISTS `administrators`;
CREATE TABLE IF NOT EXISTS `administrators` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'undefined',
  `role` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='Role 1 : admins that can edit the website\r\nRole 2 : supra admins who can change the ''website'' table and create new admin accounts';

-- Listage des données de la table bookshelf_corner.administrators : ~6 rows (environ)
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
INSERT INTO `administrators` (`ID`, `pseudo`, `mail`, `mdp`, `picture`, `role`) VALUES
	(1, 'La Mumu', 'mum@kercode.bzh', '$2y$10$bh7grQIszoshWb1okR7lj.8vQ./uayojbLKc5b1d2Lkpig08oBGxK', 'mumu.jpg', 1),
	(6, 'Dev', 'dev@dev.com', '$2y$10$SmsAON6723t4aSgZpserl.8o7E0ASprwB.9sROoZAouuyru4t4kP2', 'admin_2022-03-31_15-11-47.gif', 1),
	(7, 'nicolas', 'nicolas@nico.fr', '$2y$10$uJFj99rLdhOauTouQ.TIPu1r9VWlYPAdeWM0kd/yM.WWJyvksZ2li', 'admin_7.jpg', 1),
	(32, 'Muriel', 'nico@nico.frl', '$2y$10$Wmc8lS4Z9MdNLw/VhnIQp.7ECRXPqFDklHLZmzw7oMixb9KhQN8WC', 'admin_32.png', 2),
	(33, 'testa', 'test@test.fr', '$2y$10$0.AZXIqqRpwG6eZlsuGUKe/ePl/L9b3rHCyGgfMmbLHU6rrDp/o5C', 'admin_33.png', 1),
	(36, 'hhddg1', 'h@h.com', '$2y$10$qTsNoDIx8RE7PWeUYvEn5ODkMCP7SNoHKnHuTqeJxi6Baqfe5ZQZS', 'admin_36.png', 1);
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;

-- Listage de la structure de la table bookshelf_corner. books
DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(255) NOT NULL,
  `notation` int(1) NOT NULL,
  `catchphrase` mediumtext NOT NULL,
  `id_genre` int(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `edition` varchar(255) NOT NULL,
  `linkEdition` varchar(500) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'undefined',
  `location` varchar(255) NOT NULL,
  `year_publication` varchar(255) NOT NULL,
  `slider` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `FK_books_genres` (`id_genre`),
  CONSTRAINT `FK_books_genres` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- Listage des données de la table bookshelf_corner.books : ~11 rows (environ)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`ID`, `title`, `created_at`, `author`, `notation`, `catchphrase`, `id_genre`, `content`, `edition`, `linkEdition`, `picture`, `location`, `year_publication`, `slider`) VALUES
	(1, 'Lord of the Ring', '2022-03-10 15:36:55', 'J.R.R. Tolkien', 3, '       Une odyssée au coeur du Mordor', 2, '       Trop cool ce livre', 'Christian Bourgeois', 'https://bourgoisediteur.fr/catalogue/le-seigneur-des-anneaux/', '025.png', 'paris', '1982', '0'),
	(9, 'test no picture', '2022-03-30 17:08:39', '', 0, ' ', 4, '', '', '', 'book_2022-04-13_10-01-27.png', '', '', '0'),
	(13, 'Bioshock Rapture', '2022-04-02 14:48:24', '', 0, '', 2, '', '', '', 'book_2022-04-02_14-48-24.jpg', '', '', '1'),
	(14, 'Sister Carrie', '2022-04-02 14:49:01', '', 0, '', 2, '', '', '', 'book_2022-04-02_14-49-01.jpg', '', '', '1'),
	(15, 'Lady Helen, le club des mauvais jours', '2022-04-02 14:50:43', '', 0, '', 2, '', '', '', 'book_2022-04-02_14-50-43.jpg', '', '', '1'),
	(16, 'Une flamme dans la nuit', '2022-04-02 14:51:25', '', 0, '', 2, '', '', '', 'book_2022-04-02_14-51-25.jpg', '', '', '1'),
	(17, 'Rebel of the sands', '2022-04-02 14:52:09', '', 0, '', 2, '', '', '', 'book_2022-04-02_14-52-09.jpg', '', '', '1'),
	(21, 'L&#039;aiguille creuse', '2022-04-12 11:19:25', 'Maurice Leblanc', 4, 'Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Curabitur aliquet quam id dui posuere blandit. Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. ', 3, 'Vivamus suscipit tortor eget felis porttitor volutpat. Nulla quis lorem ut libero malesuada feugiat. Nulla quis lorem ut libero malesuada feugiat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin molestie malesuada.\r\n\r\nVestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Proin eget tortor risus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt.\r\n\r\nCurabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Sed porttitor lectus nibh. Nulla porttitor accumsan tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec rutrum congue leo eget malesuada.\r\n\r\nPellentesque in ipsum id orci porta dapibus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Sed porttitor lectus nibh. Donec sollicitudin molestie malesuada. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Sed porttitor lectus nibh.', 'Pierre Lafitte', '', 'book_2022-04-12_11-19-25.jpg', 'Etrettat', '1909', '1'),
	(22, 'Harry Potter et la chambre des secrets de l&#039;ordre du phénix des lignes des lignes des lignes quel titre long', '2022-04-15 12:07:20', '', 5, '', 7, '', '', '', 'book_2022-04-15_12-07-20.jpg', '', '', '0'),
	(62, 'test', '2022-04-21 14:47:03', '', 4, '', 3, '', '', '', 'book_62.jpg', '', '', '0'),
	(63, 'My name is Damien', '2022-04-27 15:32:33', '', 2, '', 4, '', '', '', 'book_63.jpg', '', '', '1'),
	(64, 'poit', '2022-04-27 15:33:43', '', 0, '', 5, '', '', '', 'no-cover.png', '', '', '0');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Listage de la structure de la table bookshelf_corner. comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `book_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `content` varchar(10000) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_comments_books` (`book_id`),
  KEY `FK_comments_users` (`user_id`),
  CONSTRAINT `FK_comments_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`ID`),
  CONSTRAINT `FK_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Listage des données de la table bookshelf_corner.comments : ~5 rows (environ)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`ID`, `user_id`, `book_id`, `created_at`, `title`, `content`) VALUES
	(1, 1, 13, '2022-04-18 19:29:06', 'Cool', 'Trop bien cet article'),
	(2, 1, 13, '2022-04-19 09:40:26', 'Test', 'Mon beau commentaire'),
	(10, 1, 13, '2022-04-19 14:04:15', 'Curabitur aliquet quam id dui posuere !', 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Sed porttitor lectus nibh. Nulla quis lorem ut libero malesuada feugiat. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.'),
	(11, 1, 13, '2022-04-19 15:56:26', 'Moi aussi j&#039;ai adoré ce bouquin !', 'Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Sed porttitor lectus nibh. Quisque velit nisi, pretium ut lacinia in, elementum id enim.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Curabitur aliquet quam id dui posuere blandit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.\r\n\r\nProin eget tortor risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor eget felis porttitor volutpat. Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget tortor risus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus suscipit tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus.'),
	(12, 1, 13, '2022-04-27 15:37:08', 'il manque une photo !', 'jzgjigzzgjp');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Listage de la structure de la table bookshelf_corner. genres
DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Listage des données de la table bookshelf_corner.genres : ~7 rows (environ)
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` (`id`, `category`, `picture`) VALUES
	(2, 'Historique', 'historique.png'),
	(3, 'Policier', 'policier.png'),
	(4, 'Romance', 'romance.png'),
	(5, 'Fantastique', 'fantastique.png'),
	(7, 'Classique', 'classique.png'),
	(14, 'Aventure', 'genre_2022-04-06_16-29-58.png'),
	(17, 'test235', 'genre_17.png'),
	(18, '_gè', 'no-icon.png');
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;

-- Listage de la structure de la table bookshelf_corner. messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(255) NOT NULL,
  `familyname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `send_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) NOT NULL,
  `object` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- Listage des données de la table bookshelf_corner.messages : ~16 rows (environ)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `gender`, `familyname`, `firstname`, `send_at`, `email`, `object`, `message`) VALUES
	(2, 'other', 'Lorem', 'Ipsum', '2022-04-08 15:43:53', 'lorem@test.fr', 'My message is quite long', 'Donec rutrum congue leo eget malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Nulla quis lorem ut libero malesuada feugiat. Pellentesque in ipsum id orci porta dapibus.'),
	(3, 'other', 'test', 'test', '2022-04-09 18:21:54', 'helene.dev@yahoo.com', 'Proposer un conseil lecture', 'jtqeyte'),
	(4, 'other', 'test', 'test', '2022-04-09 18:23:24', 'helene.dev@yahoo.com', 'Proposer un conseil lecture', 'jtqeyte'),
	(7, 'female', 'test', 'Héle', '2022-04-09 18:25:12', 'helenec56@laposte.net', 'Accès à mes données', 'f'),
	(8, 'female', 'prat', 'Amélie', '2022-04-10 18:10:22', 'aamma@gmmail.com', 'Réclamation', 'Je teste ton, travail ! '),
	(9, 'male', 'error', 'error', '2022-04-11 08:48:06', 'helene.dev@yahoo.com', 'Accès à mes données', 'test error'),
	(10, 'male', 'error', 'error', '2022-04-11 08:50:49', 'helene.dev@yahoo.com', 'Accès à mes données', 'test error'),
	(12, 'male', 'error', 'error', '2022-04-11 08:53:27', 'helene.dev@yahoo.com', 'Accès à mes données', 'test error'),
	(29, 'female', 'error', 'pl', '2022-04-11 09:57:10', 'agnes@youhou.com', 'Réclamation', 'dsdswxcwxccwx'),
	(51, 'male', 'Dupont', 'Albert', '2022-04-11 14:23:09', 'albert@gmail.com', 'Proposer un conseil lecture', 'Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Sed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.\r\n\r\nCurabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Curabitur aliquet quam id dui posuere blandit.\r\n\r\nCras ultricies ligula sed magna dictum porta. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Cras ultricies ligula sed magna dictum porta. Vivamus suscipit tortor eget felis porttitor volutpat. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Sed porttitor lectus nibh.'),
	(63, 'male', 'gb', 'Muriel', '2022-04-13 12:17:26', 'helenec56@laposte.net', 'Autre', 'df'),
	(66, 'female', 'tgfy', 'fty', '2022-04-13 12:20:59', 'helenec56@laposte.net', 'Accès à mes données', 'fty'),
	(69, 'female', 'error', 'Héle', '2022-04-13 16:10:24', 'helenec56@laposte.net', 'Accès à mes données', 'rf');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Listage de la structure de la table bookshelf_corner. users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'no-avatar.png',
  `role` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='Role 0 : simple registered user';

-- Listage des données de la table bookshelf_corner.users : ~17 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`ID`, `pseudo`, `mail`, `mdp`, `picture`, `role`) VALUES
	(1, 'Konig', 'konig@gmail.com', 'test', 'no-avatar.png', 0),
	(2, 'user', 'user@user.com', '$2y$10$F8.rF/QsiQ60DhF7BJVcy.m9v0suBq4OAtCu5/YFpcZIUReJYZ83y', 'user_2.png', 0),
	(3, 'user', 'user@user.com', '$2y$10$ZbF8i58UkxS3YAEwiUtHyuMENWiu3H1zzQtDEMC090IJHOuklutQi', 'no-avatar.png', 0),
	(4, 'user', 'user@user.com', '$2y$10$/zNRDdSJgU0CvvYcah27Ae6ThALu9xL/0TDD7doa0FwtxqhOSyMvK', 'no-avatar.png', 0),
	(5, 'user', 'user@user.com', '$2y$10$g2oMEP.c4jcnggCW2nZ0Oukpdp5y1Sq6HD1ZkX6eKf71prD5LDaNC', 'no-avatar.png', 0),
	(6, 'user', 'user@user.com', '$2y$10$VFXL6w/2c6lAEWkHUB9RK.nklSXafxyma.p9WeF.hz272KXq0WAmK', 'no-avatar.png', 0),
	(7, 'test', 'test@test.com', '$2y$10$barQpMX0OuMGHIySruE5fO6O/wU9hTkBhlcHW30r2Eee6TCOppIQG', 'user_7.jpg', 0),
	(8, 'test', 'test@test.com', '$2y$10$bkErs5arUO7jsqhLRSNKduzXl2bqFunDt0CSCgcCO69XQ8YRDq2Gq', 'no-avatar.png', 0),
	(9, 'test', 'test@test.com', '$2y$10$ifTcBw1fNzHuaBXcD3i47OIToUv0oKhPbHOtAumSVH1UcyOUC4VC2', 'no-avatar.png', 0),
	(10, 'Bilout', 'bilout@chnord.fr', '$2y$10$vXJl6fLSjPTeO9lVY9Yu3unfHraaECKS4toVSKeG1NJC5tsb6eTsW', 'user_10.png', 0),
	(11, 'pika', 'pika@pika.com', '$2y$10$md91j4sZwBGoSQpxcs4AW.wxq65r.a0HvqUAFlxfvbadVsYPWF23a', 'no-avatar.png', 0),
	(12, 'pika', 'pika@pika.com', '$2y$10$dCKNz3IEhnaHbOq.P.wG2Ob8K4fUYwpqxacxUfbwSqfbXfrCWsaMe', 'no-avatar.png', 0),
	(13, 'pika', 'pika@pika.com', '$2y$10$sV7alh/FodMcLiGuHCR8MO72F4KLwGIFBVGN3LVEd/OBNTPpj0AYC', 'no-avatar.png', 0),
	(14, 'pika', 'pika@pika.com', '$2y$10$WLQ.bmhz3AnF/asBjnRCeu0/hj1Qdob0k/aSIDtfSpWuHBAso7KgS', 'no-avatar.png', 0),
	(15, 'ptitlolo', 'lolo@lolo.bzh', '$2y$10$ubS8bojU3IDz.NSVLHjyl.ipBsPqXBB0BWLeFnZVfA4aj0O03sMcK', 'no-avatar.png', 0),
	(16, 'ptitlolo', 'lolo@lolo.bzh', '$2y$10$oNV9jQjz1r3cAxcRIgJ92e0rhm1ZQw.vGPqiCewwU6zsZQsAEUvcm', 'no-avatar.png', 0),
	(17, 'LuciaMexv123', 'lucia@lucia.mx', '$2y$10$uOoGZPi8IhvkETj0LhCdEOL6ysGHt.boBoGdnTfpUbU1iSCar7WIS', 'no-avatar.png', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table bookshelf_corner. website
DROP TABLE IF EXISTS `website`;
CREATE TABLE IF NOT EXISTS `website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='This table contains all the informations about the website : title, logo...\r\nIt should only contain ONE row';

-- Listage des données de la table bookshelf_corner.website : ~0 rows (environ)
/*!40000 ALTER TABLE `website` DISABLE KEYS */;
INSERT INTO `website` (`id`, `logo`, `name`) VALUES
	(1, 'logo_blog.png', 'The Bookshelf Corner');
/*!40000 ALTER TABLE `website` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
