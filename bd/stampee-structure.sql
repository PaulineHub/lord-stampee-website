-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 21 sep. 2022 à 14:57
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stampee`
--
CREATE DATABASE IF NOT EXISTS `stampee` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `stampee`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `cat_id` int(11) NOT NULL,
  `cat_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`cat_id`, `cat_nom`) VALUES
(1, 'architecture'),
(2, 'art'),
(3, 'canada'),
(4, 'europe'),
(5, 'ferroviaire'),
(6, 'maritime'),
(7, 'monde'),
(8, 'royauté'),
(9, 'sport');

-- --------------------------------------------------------

--
-- Structure de la table `conservation`
--

CREATE TABLE `conservation` (
  `con_id` int(11) NOT NULL,
  `con_etat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `conservation`
--

INSERT INTO `conservation` (`con_id`, `con_etat`) VALUES
(1, 'parfaite'),
(2, 'très bonne'),
(3, 'bonne'),
(4, 'endommagée');

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

CREATE TABLE `enchere` (
  `enc_id` int(11) NOT NULL,
  `enc_date_debut` date NOT NULL,
  `enc_date_fin` date NOT NULL,
  `enc_tim_id_ce` int(11) NOT NULL,
  `enc_uti_id_ce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`enc_id`, `enc_date_debut`, `enc_date_fin`, `enc_tim_id_ce`, `enc_uti_id_ce`) VALUES
(1, '2022-10-10', '2022-10-20', 1, 2),
(2, '2022-10-10', '2022-10-20', 2, 2),
(3, '2022-10-10', '2022-10-20', 3, 2),
(4, '2022-10-10', '2022-10-20', 4, 2),
(5, '2022-10-10', '2022-10-20', 5, 2),
(6, '2022-10-10', '2022-10-20', 6, 2),
(7, '2022-10-10', '2022-10-20', 7, 2),
(8, '2022-10-10', '2022-10-20', 8, 2),
(9, '2022-10-10', '2022-10-20', 9, 2),
(10, '2022-10-10', '2022-10-20', 10, 2),
(11, '2022-10-10', '2022-10-20', 11, 2),
(12, '2022-10-10', '2022-10-20', 12, 3),
(13, '2022-10-10', '2022-10-20', 13, 3),
(25, '2022-10-10', '2022-10-19', 25, 3);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `ima_id` int(11) NOT NULL,
  `ima_nom` varchar(250) NOT NULL,
  `ima_path` varchar(250) NOT NULL,
  `ima_tim_id_ce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`ima_id`, `ima_nom`, `ima_path`, `ima_tim_id_ce`) VALUES
(1, 'stamp1.jpg', 'ressources/images/timbres/stamp1.jpg', 1),
(2, 'stamp2.jpg', 'ressources/images/timbres/stamp2.jpg', 2),
(3, 'stamp3.jpg', 'ressources/images/timbres/stamp3.jpg', 3),
(4, 'stamp4.jpg', 'ressources/images/timbres/stamp4.jpg', 4),
(5, 'stamp5.jpg', 'ressources/images/timbres/stamp5.jpg', 5),
(6, 'stamp6.jpg', 'ressources/images/timbres/stamp6.jpg', 6),
(7, 'stamp7.jpg', 'ressources/images/timbres/stamp7.jpg', 7),
(8, 'stamp8.jpg', 'ressources/images/timbres/stamp8.jpg', 8),
(9, 'stamp9.jpg', 'ressources/images/timbres/stamp9.jpg', 9),
(10, 'stamp10.jpg', 'ressources/images/timbres/stamp10.jpg', 10),
(11, 'stamp11.jpg', 'ressources/images/timbres/stamp11.jpg', 11),
(12, 'stamp12.jpg', 'ressources/images/timbres/stamp12.jpg', 12),
(13, 'stamp9.jpg', 'ressources/images/timbres/stamp9.jpg', 13),
(16, 'stamp1.jpg', 'ressources/images/timbres/stamp10.jpg', 1),
(17, 'stamp1.jpg', 'ressources/images/timbres/stamp10.jpg', 1),
(25, 'stamp5.jpg', 'ressources/images/timbres/stamp5.jpg', 25),
(26, 'stamp4.jpg', 'ressources/images/timbres/stamp4.jpg', 25);


-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `pay_id` int(11) NOT NULL,
  `pay_nom` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`pay_id`, `pay_nom`) VALUES
(1, 'angleterre'),
(2, 'australie'),
(3, 'canada'),
(4, 'france');

-- --------------------------------------------------------

--
-- Structure de la table `privilege`
--

CREATE TABLE `privilege` (
  `pri_id` int(11) NOT NULL,
  `pri_niveau` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `privilege`
--

INSERT INTO `privilege` (`pri_id`, `pri_niveau`) VALUES
(1, 'visiteur'),
(2, 'membre'),
(3, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `timbre`
--

CREATE TABLE `timbre` (
  `tim_id` int(11) NOT NULL,
  `tim_nom` varchar(250) NOT NULL,
  `tim_tirage` smallint(6) NOT NULL,
  `tim_dimensions` varchar(250) NOT NULL,
  `tim_prix_dep` smallint(6) NOT NULL,
  `tim_certificat` varchar(3) NOT NULL,
  `tim_cat_id_ce` int(11) NOT NULL,
  `tim_con_id_ce` int(11) NOT NULL,
  `tim_pay_id_ce` int(11) NOT NULL,
  `tim_uti_id_ce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `timbre`
--

INSERT INTO `timbre` (`tim_id`, `tim_nom`, `tim_tirage`, `tim_dimensions`, `tim_prix_dep`, `tim_certificat`, `tim_cat_id_ce`, `tim_con_id_ce`, `tim_pay_id_ce`, `tim_uti_id_ce`) VALUES
(1, 'HRH Prince Albert (1851)', 900, '27 X 22 mm', 195, 'oui', 8, 2, 1, 2),
(2, 'HRH Prince Albert (1858)', 900, '27 X 22 mm', 245, 'oui', 8, 2, 1, 2),
(3, 'Reine Victoria (1851)', 600, '27 X 22 mm', 500, 'oui', 8, 1, 1, 2),
(4, 'HRH Prince Albert (1851)', 600, '27 X 22 mm', 495, 'oui', 8, 1, 1, 2),
(5, 'Reine Victoria (1855)', 200, '27 X 22 mm', 995, 'oui', 8, 1, 1, 2),
(6, 'Reine Victoria (1859) 1¢', 900, '27 X 22 mm', 195, 'oui', 8, 2, 1, 2),
(7, 'Reine Victoria (1859) rose 1¢', 200, '27 X 22 mm', 745, 'oui', 8, 1, 1, 2),
(8, 'Reine Victoria (1868) gris ½¢', 900, '27 X 22 mm', 135, 'non', 8, 2, 1, 2),
(9, 'Reine Victoria (1868) vert ½¢', 900, '27 X 22 mm', 125, 'non', 8, 2, 3, 2),
(10, 'Reine Victoria (1868) brun fonce 6¢', 900, '27 X 22 mm', 80, 'non', 8, 2, 3, 3),
(11, 'Reine Victoria (1868) brun jaune 6¢', 600, '27 X 22 mm', 495, 'oui', 8, 1, 3, 3),
(12, 'Reine Victoria (1868) bleu 12½¢', 200, '27 X 22 mm', 995, 'oui', 8, 1, 3, 3),
(13, 'test', 566, '27 X 22 mm', 566, 'oui', 1, 1, 1, 3),
(25, 'test6', 400, '27 x 23', 200, 'oui', 3, 1, 2, 3);


-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `uti_id` int(11) NOT NULL,
  `uti_nom` varchar(250) NOT NULL,
  `uti_courriel` varchar(250) NOT NULL,
  `uti_mdp` varchar(250) NOT NULL,
  `uti_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `uti_confirmation` char(30) DEFAULT NULL,
  `uti_pri_id_ce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`uti_id`, `uti_nom`, `uti_courriel`, `uti_mdp`, `uti_date`, `uti_confirmation`, `uti_pri_id_ce`) VALUES
(2, 'Lord Stampee', 'test@test.com', '$2y$10$6YrfbU.PyHKQyEjNpQSQ2.gyDIQRz7QRwxwtcdfINgwQMSsIdh0FC', '2022-09-15 18:01:39', '', 2),
(3, 'Bernadette Dutruc', 'test2@test2.com', '$2y$10$RhhcdkbEdn7/qFVovIwG5.Ws0h4kDXfxPE94dmG6HWXb/wBGD0A3i', '2022-09-19 14:13:01', '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `mise`
--

CREATE TABLE `mise` (
  `mis_id` int(11) NOT NULL,
  `mis_montant` int(11) NOT NULL,
  `mis_date` date NOT NULL,
  `mis_uti_id_ce` int(11) NOT NULL,
  `mis_enc_id_ce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mise`
--

INSERT INTO `mise` (`mis_id`, `mis_montant`, `mis_date`, `mis_uti_id_ce`, `mis_enc_id_ce`) VALUES
(1, 250, '2022-09-21', 3, 4),
(2, 300, '2022-09-22', 3, 7),
(3, 400, '2022-09-22', 2, 1),
(4, 555, '2022-09-23', 2, 2),
(7, 1000, '2022-09-23', 3, 12),
(8, 135, '2022-09-26', 3, 9),
(9, 135, '2022-09-26', 3, 9),
(10, 135, '2022-09-26', 3, 9),
(11, 140, '2022-09-26', 3, 9),
(12, 140, '2022-09-26', 3, 9),
(13, 140, '2022-09-26', 3, 9),
(14, 140, '2022-09-26', 3, 9),
(15, 140, '2022-09-26', 3, 9),
(16, 140, '2022-09-26', 3, 9),
(17, 145, '2022-09-26', 3, 9),
(18, 145, '2022-09-26', 3, 9),
(19, 145, '2022-09-26', 3, 9),
(20, 150, '2022-09-26', 3, 9),
(21, 151, '2022-09-26', 3, 9),
(22, 152, '2022-09-26', 3, 9),
(23, 153, '2022-09-26', 3, 9),
(24, 154, '2022-09-26', 3, 9),
(25, 155, '2022-09-26', 3, 9),
(26, 160, '2022-09-27', 3, 9),
(27, 161, '2022-09-27', 3, 9),
(28, 162, '2022-09-27', 3, 9);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `fav_id` int(11) NOT NULL,
  `fav_tim_id_ce` int(11) NOT NULL,
  `fav_uti_id_ce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`fav_id`, `fav_tim_id_ce`, `fav_uti_id_ce`) VALUES
(1, 11, 2),
(2, 10, 2),
(3, 9, 2),
(4, 12, 2),
(5, 12, 3),
(10, 25, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `conservation`
--
ALTER TABLE `conservation`
  ADD PRIMARY KEY (`con_id`);

--
-- Index pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD PRIMARY KEY (`enc_id`),
  ADD KEY `enc_ibkf_1` (`enc_uti_id_ce`),
  ADD KEY `enc_ibkf_2` (`enc_tim_id_ce`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ima_id`),
  ADD KEY `ima_ibkf_1` (`ima_tim_id_ce`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`pay_id`);

--
-- Index pour la table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`pri_id`);

--
-- Index pour la table `timbre`
--
ALTER TABLE `timbre`
  ADD PRIMARY KEY (`tim_id`),
  ADD KEY `tim_ibkf_1` (`tim_cat_id_ce`),
  ADD KEY `tim_ibkf_2` (`tim_con_id_ce`),
  ADD KEY `tim_ibkf_4` (`tim_pay_id_ce`),
  ADD KEY `tim_ibkf_3` (`tim_uti_id_ce`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`uti_id`),
  ADD KEY `uti_ibfk_1` (`uti_pri_id_ce`);

--
-- Index pour la table `mise`
--
ALTER TABLE `mise`
  ADD PRIMARY KEY (`mis_id`),
  ADD KEY `mis_enc_id_ce` (`mis_enc_id_ce`),
  ADD KEY `mis_uti_id_ce` (`mis_uti_id_ce`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `fav_tim_id_ce` (`fav_tim_id_ce`),
  ADD KEY `fav_uti_id_ce` (`fav_uti_id_ce`);


--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `conservation`
--
ALTER TABLE `conservation`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `enchere`
--
ALTER TABLE `enchere`
  MODIFY `enc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `ima_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `pri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `timbre`
--
ALTER TABLE `timbre`
  MODIFY `tim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `uti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


--
-- AUTO_INCREMENT pour la table `mise`
--
ALTER TABLE `mise`
  MODIFY `mis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;


--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enc_ibkf_1` FOREIGN KEY (`enc_uti_id_ce`) REFERENCES `utilisateur` (`uti_id`),
  ADD CONSTRAINT `enc_ibkf_2` FOREIGN KEY (`enc_tim_id_ce`) REFERENCES `timbre` (`tim_id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `ima_ibkf_1` FOREIGN KEY (`ima_tim_id_ce`) REFERENCES `timbre` (`tim_id`);

--
-- Contraintes pour la table `timbre`
--
ALTER TABLE `timbre`
  ADD CONSTRAINT `tim_ibkf_1` FOREIGN KEY (`tim_cat_id_ce`) REFERENCES `categorie` (`cat_id`),
  ADD CONSTRAINT `tim_ibkf_2` FOREIGN KEY (`tim_con_id_ce`) REFERENCES `conservation` (`con_id`),
  ADD CONSTRAINT `tim_ibkf_3` FOREIGN KEY (`tim_uti_id_ce`) REFERENCES `utilisateur` (`uti_id`),
  ADD CONSTRAINT `tim_ibkf_4` FOREIGN KEY (`tim_pay_id_ce`) REFERENCES `pays` (`pay_id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `uti_ibfk_1` FOREIGN KEY (`uti_pri_id_ce`) REFERENCES `utilisateur` (`uti_id`);
COMMIT;

--
-- Contraintes pour la table `mise`
--
ALTER TABLE `mise`
  ADD CONSTRAINT `mise_ibfk_1` FOREIGN KEY (`mis_enc_id_ce`) REFERENCES `enchere` (`enc_id`),
  ADD CONSTRAINT `mise_ibfk_2` FOREIGN KEY (`mis_uti_id_ce`) REFERENCES `utilisateur` (`uti_id`);
COMMIT;

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`fav_tim_id_ce`) REFERENCES `timbre` (`tim_id`),
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`fav_uti_id_ce`) REFERENCES `utilisateur` (`uti_id`);
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;