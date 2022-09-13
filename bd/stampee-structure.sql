-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 13 sep. 2022 à 17:48
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
  `enc_id_uti_ce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `ima_id` int(11) NOT NULL,
  `ima_nom` varchar(250) NOT NULL,
  `ima_path` varchar(250) NOT NULL,
  `ima_id_tim_ce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `tim_titre` varchar(250) NOT NULL,
  `tim_tirage` smallint(6) NOT NULL,
  `tim_dimensions` varchar(250) NOT NULL,
  `tim_prix_plancher` smallint(6) NOT NULL,
  `tim_certificat` varchar(3) NOT NULL,
  `tim_ima_id_ce` int(11) NOT NULL,
  `tim_cat_id_ce` int(11) NOT NULL,
  `tim_con_id_ce` int(11) NOT NULL,
  `tim_pay_id_ce` int(11) NOT NULL,
  `tim_uti_id_ce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `uti_id` int(11) NOT NULL,
  `uti_nom` varchar(250) NOT NULL,
  `uti_mdp` varchar(250) NOT NULL,
  `uti_courriel` varchar(250) NOT NULL,
  `uti_dcc` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `uti_confirmation` char(28) DEFAULT NULL,
  `uti_actif` tinyint(1) NOT NULL,
  `uti_pri_id_ce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `enc_ibkf_1` (`enc_id_uti_ce`),
  ADD KEY `enc_ibkf_2` (`enc_tim_id_ce`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ima_id`);

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
  ADD KEY `tim_ibkf_3` (`tim_ima_id_ce`),
  ADD KEY `tim_ibkf_4` (`tim_pay_id_ce`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`uti_id`),
  ADD KEY `uti_ibfk_1` (`uti_pri_id_ce`);

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
  MODIFY `enc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `ima_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `tim_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `uti_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enc_ibkf_1` FOREIGN KEY (`enc_id_uti_ce`) REFERENCES `utilisateur` (`uti_id`),
  ADD CONSTRAINT `enc_ibkf_2` FOREIGN KEY (`enc_tim_id_ce`) REFERENCES `timbre` (`tim_id`);

--
-- Contraintes pour la table `timbre`
--
ALTER TABLE `timbre`
  ADD CONSTRAINT `tim_ibkf_1` FOREIGN KEY (`tim_cat_id_ce`) REFERENCES `categorie` (`cat_id`),
  ADD CONSTRAINT `tim_ibkf_2` FOREIGN KEY (`tim_con_id_ce`) REFERENCES `conservation` (`con_id`),
  ADD CONSTRAINT `tim_ibkf_3` FOREIGN KEY (`tim_ima_id_ce`) REFERENCES `image` (`ima_id`),
  ADD CONSTRAINT `tim_ibkf_4` FOREIGN KEY (`tim_pay_id_ce`) REFERENCES `pays` (`pay_id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `uti_ibfk_1` FOREIGN KEY (`uti_pri_id_ce`) REFERENCES `utilisateur` (`uti_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





---------------------------------------------------------------------------------------------
--
-- Déchargement des données de la table `timbre`
--

INSERT INTO `timbre` (`titre_timbre`, `tirage_timbre`, `dimensions_timbre`, `certifié_timbre`, `prix_plancher_timbre`, `id_categorie`, `id_utilisateur`, `id_pays`, `enchere_id_enchere`)
VALUES
('HRH Prince Albert (1851)', 900, '27 X 22 mm', 'oui', 195, 8, , 1, ),
('HRH Prince Albert (1858)', 900, '27 X 22 mm', 'oui', 245, 8, , 1, ),
('Reine Victoria (1851)', 600, '27 X 22 mm', 'oui', 500, 8, , 1, ),
('HRH Prince Albert (1851)', 600, '27 X 22 mm', 'oui', 495, 8, , 1, ),
('Reine Victoria (1855)'), 200, '27 X 22 mm', 'oui', 995, 8, , 1, ),
('Reine Victoria (1859) 1¢'), 900, '27 X 22 mm', 'oui', 195, 8, , 1, ),
('Reine Victoria (1859) rose 1¢'), 200, '27 X 22 mm', 'oui', 745, 8, , 1, ),
('Reine Victoria (1868) gris ½¢'), 900, '27 X 22 mm', 'non', 135, 8, , 1, ),
('Reine Victoria (1868) vert ½¢'), 900, '27 X 22 mm', 'non', 125, 8, , 3, ),
('Reine Victoria (1868) brun fonce 6¢'), 900, '27 X 22 mm', 'non', 80, 8, , 3, ),
('Reine Victoria (1868) brun jaune 6¢'), 600, '27 X 22 mm', 'oui', 495, 8, , 3, ),
('Reine Victoria (1868) bleu 12½¢'), 200, '27 X 22 mm', 'oui', 995, 8, , 3, );

