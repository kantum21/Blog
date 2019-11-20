-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 20 nov. 2019 à 16:16
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `head` text NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `head`, `content`, `createdAt`, `updatedAt`, `user_id`) VALUES
(7, 'Installer WAMP/MAMP/XAMPP', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eros odio, gravida suscipit egestas nec, aliquet nec nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque id accumsan odio, et consectetur sapien. Suspendisse cursus sed ex eu volutpat. Proin nec bibendum mi, id bibendum odio. Nam volutpat neque nisl. Donec venenatis justo a lobortis blandit. Donec aliquet, augue quis porttitor elementum, dolor ex auctor sapien, quis porta est metus hendrerit arcu. Nunc pretium augue odio, et efficitur urna consectetur quis. Integer semper elit in augue efficitur fermentum. Duis dui leo, lobortis quis viverra non, rhoncus sit amet nibh.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non condimentum nisl. Morbi at ullamcorper lacus, vel bibendum purus. Suspendisse potenti. Cras molestie suscipit metus. Phasellus eleifend risus et sollicitudin scelerisque. Integer volutpat ultrices pellentesque. Morbi auctor purus quis mattis commodo. Proin accumsan nibh a felis commodo imperdiet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac ipsum id enim condimentum feugiat nec eget neque. Cras elementum pharetra commodo. Cras pellentesque dolor vel luctus pulvinar. Nunc metus augue, commodo ut urna nec, sodales mattis lectus. Morbi ac congue magna.\r\n\r\nCurabitur pulvinar erat eget lectus tempor sagittis. Nam aliquet eros nulla, vel semper nunc tempor vel. Sed lacinia neque ligula, id eleifend lacus varius eget. In at sodales lectus, vel gravida arcu. Aenean eleifend ante nec risus aliquam maximus sit amet in urna. Aliquam erat volutpat. Sed in orci et tortor porttitor rhoncus quis nec quam. Ut in finibus magna. Fusce fermentum eget libero dictum faucibus. Ut consectetur mollis ultrices. Sed congue imperdiet nunc sit amet vulputate.\r\n\r\nDonec dignissim metus arcu, at semper lectus rhoncus ac. Integer quis sem malesuada, commodo sapien et, vulputate justo. Suspendisse magna arcu, tempor eget tincidunt a, condimentum quis augue. Aliquam ornare leo at quam malesuada, et luctus nibh interdum. Quisque eleifend lacus at ex posuere vulputate. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus ornare vestibulum ex egestas viverra.', '2019-10-07 12:05:00', '2019-11-20 16:50:59', 3),
(8, 'Comment installer Bootstrap ?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eros odio, gravida suscipit egestas nec, aliquet nec nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque id accumsan odio, et consectetur sapien. Suspendisse cursus sed ex eu volutpat. Proin nec bibendum mi, id bibendum odio. Nam volutpat neque nisl. Donec venenatis justo a lobortis blandit. Donec aliquet, augue quis porttitor elementum, dolor ex auctor sapien, quis porta est metus hendrerit arcu. Nunc pretium augue odio, et efficitur urna consectetur quis. Integer semper elit in augue efficitur fermentum. Duis dui leo, lobortis quis viverra non, rhoncus sit amet nibh.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non condimentum nisl. Morbi at ullamcorper lacus, vel bibendum purus. Suspendisse potenti. Cras molestie suscipit metus. Phasellus eleifend risus et sollicitudin scelerisque. Integer volutpat ultrices pellentesque. Morbi auctor purus quis mattis commodo. Proin accumsan nibh a felis commodo imperdiet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac ipsum id enim condimentum feugiat nec eget neque. Cras elementum pharetra commodo. Cras pellentesque dolor vel luctus pulvinar. Nunc metus augue, commodo ut urna nec, sodales mattis lectus. Morbi ac congue magna.\r\n\r\nCurabitur pulvinar erat eget lectus tempor sagittis. Nam aliquet eros nulla, vel semper nunc tempor vel. Sed lacinia neque ligula, id eleifend lacus varius eget. In at sodales lectus, vel gravida arcu. Aenean eleifend ante nec risus aliquam maximus sit amet in urna. Aliquam erat volutpat. Sed in orci et tortor porttitor rhoncus quis nec quam. Ut in finibus magna. Fusce fermentum eget libero dictum faucibus. Ut consectetur mollis ultrices. Sed congue imperdiet nunc sit amet vulputate.\r\n\r\nDonec dignissim metus arcu, at semper lectus rhoncus ac. Integer quis sem malesuada, commodo sapien et, vulputate justo. Suspendisse magna arcu, tempor eget tincidunt a, condimentum quis augue. Aliquam ornare leo at quam malesuada, et luctus nibh interdum. Quisque eleifend lacus at ex posuere vulputate. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus ornare vestibulum ex egestas viverra.', '2019-10-07 12:11:56', '2019-11-08 14:38:21', 3),
(9, 'Comment créer un système de routes en PHP ?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eros odio, gravida suscipit egestas nec, aliquet nec nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque id accumsan odio, et consectetur sapien. Suspendisse cursus sed ex eu volutpat. Proin nec bibendum mi, id bibendum odio. Nam volutpat neque nisl. Donec venenatis justo a lobortis blandit. Donec aliquet, augue quis porttitor elementum, dolor ex auctor sapien, quis porta est metus hendrerit arcu. Nunc pretium augue odio, et efficitur urna consectetur quis. Integer semper elit in augue efficitur fermentum. Duis dui leo, lobortis quis viverra non, rhoncus sit amet nibh.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non condimentum nisl. Morbi at ullamcorper lacus, vel bibendum purus. Suspendisse potenti. Cras molestie suscipit metus. Phasellus eleifend risus et sollicitudin scelerisque. Integer volutpat ultrices pellentesque. Morbi auctor purus quis mattis commodo. Proin accumsan nibh a felis commodo imperdiet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac ipsum id enim condimentum feugiat nec eget neque. Cras elementum pharetra commodo. Cras pellentesque dolor vel luctus pulvinar. Nunc metus augue, commodo ut urna nec, sodales mattis lectus. Morbi ac congue magna.\r\n\r\nCurabitur pulvinar erat eget lectus tempor sagittis. Nam aliquet eros nulla, vel semper nunc tempor vel. Sed lacinia neque ligula, id eleifend lacus varius eget. In at sodales lectus, vel gravida arcu. Aenean eleifend ante nec risus aliquam maximus sit amet in urna. Aliquam erat volutpat. Sed in orci et tortor porttitor rhoncus quis nec quam. Ut in finibus magna. Fusce fermentum eget libero dictum faucibus. Ut consectetur mollis ultrices. Sed congue imperdiet nunc sit amet vulputate.\r\n\r\nDonec dignissim metus arcu, at semper lectus rhoncus ac. Integer quis sem malesuada, commodo sapien et, vulputate justo. Suspendisse magna arcu, tempor eget tincidunt a, condimentum quis augue. Aliquam ornare leo at quam malesuada, et luctus nibh interdum. Quisque eleifend lacus at ex posuere vulputate. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus ornare vestibulum ex egestas viverra.', '2019-10-07 12:18:05', '2019-11-08 14:38:21', 3);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `flag` tinyint(1) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_id` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `pseudo`, `content`, `createdAt`, `flag`, `article_id`) VALUES
(3, 'Céline', 'Cet article n\'est pas vraiment utile !', '2019-11-07 15:18:30', 1, 7),
(4, 'Thomas', 'Tout à fait d\'accord avec Céline', '2019-11-07 16:02:19', 0, 7);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `createdAt` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`, `createdAt`, `active`, `role_id`) VALUES
(3, 'Quentin', '$2y$10$c89xYQpsKbyzUspu8yf.iua0z2CnD95amzpa7ORw0LbqRh.inbZhq', '2019-10-07 11:29:26', 1, 1),
(6, 'Céline', '$2y$10$GmboqkNMXX9ywrTAAcGeH.7xI7M6jbuVJ.GAWyd7oXeSWaBjeqtcC', '2019-10-30 17:57:22', 1, 2),
(21, 'Thomas', '$2y$10$lfFpCQtItKBinmOaJCruWevt8GbVlkJqH8l1orxZbstpd2mL8ZnJ2', '2019-11-18 13:15:06', 1, 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_article_id` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
