--
-- Database: `stampee`
--
CREATE DATABASE IF NOT EXISTS `stampee` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `stampee`;

-- --------------------------------------------------------

--
-- Tables structure 
--

DROP TABLE IF EXISTS timbre ;
CREATE TABLE timbre (id_timbre INT AUTO_INCREMENT NOT NULL,
titre_timbre VARCHAR(250),
tirage_timbre SMALLINT,
dimensions_timbre VARCHAR(250),
prix_plancher_timbre SMALLINT,
certificat_timbre BOOL,
id_categorie **NOT FOUND**,
id_utilisateur **NOT FOUND**,
id_pays **NOT FOUND**,
enchere_id_enchere INT,
id_condition **NOT FOUND**,
PRIMARY KEY (id_timbre)) ENGINE=InnoDB;

DROP TABLE IF EXISTS utilisateur ;
CREATE TABLE utilisateur (id_utilisateur VARCHAR AUTO_INCREMENT NOT NULL,
nom_utilisateur VARCHAR(250),
prenom_utilisateur VARCHAR(250),
mot_de_passe_utilisateur VARCHAR(250),
courriel_utilisateur VARCHAR(250),
dcc_utilisateur TIMESTAMP,
confirmation_utilisateur CHAR(28),
actif_utilisateur TINYINT(1),
id_privilege **NOT FOUND**,
PRIMARY KEY (id_utilisateur)) ENGINE=InnoDB;

DROP TABLE IF EXISTS categorie ;
CREATE TABLE categorie (id_categorie INT AUTO_INCREMENT NOT NULL,
nom_categorie VARCHAR(250),
PRIMARY KEY (id_categorie)) ENGINE=InnoDB;

DROP TABLE IF EXISTS pays ;
CREATE TABLE pays (id_pays INT AUTO_INCREMENT NOT NULL,
nom_pays VARCHAR(250),
PRIMARY KEY (id_pays)) ENGINE=InnoDB;

DROP TABLE IF EXISTS privilege ;
CREATE TABLE privilege (id_privilege INT AUTO_INCREMENT NOT NULL,
niveau_privilege VARCHAR(250),
PRIMARY KEY (id_privilege)) ENGINE=InnoDB;

DROP TABLE IF EXISTS image ;
CREATE TABLE image (id_image INT AUTO_INCREMENT NOT NULL,
nom_image VARCHAR(250),
path_image VARCHAR(250),
id_timbre **NOT FOUND**,
PRIMARY KEY (id_image)) ENGINE=InnoDB;

DROP TABLE IF EXISTS enchere ;
CREATE TABLE enchere (id_enchere INT AUTO_INCREMENT NOT NULL,
date_debut_enchere DATE,
date_fin_enchere DATE,
timbre_id_timbre INT,
id_utilisateur **NOT FOUND**,
PRIMARY KEY (id_enchere)) ENGINE=InnoDB;

DROP TABLE IF EXISTS condition ;
CREATE TABLE condition (id_condition INT AUTO_INCREMENT NOT NULL,
etat_condition VARCHAR(250),
PRIMARY KEY (id_condition)) ENGINE=InnoDB;

DROP TABLE IF EXISTS mise ;
CREATE TABLE mise (id_utilisateur **NOT FOUND** AUTO_INCREMENT NOT NULL,
id_enchere **NOT FOUND** NOT NULL,
montant_mise sur SMALLINT,
date_mise sur DATE,
PRIMARY KEY (id_utilisateur,
 id_enchere)) ENGINE=InnoDB;

DROP TABLE IF EXISTS aime ;
CREATE TABLE aime (id_utilisateur **NOT FOUND** AUTO_INCREMENT NOT NULL,
id_timbre **NOT FOUND** NOT NULL,
id_préfère INT,
PRIMARY KEY (id_utilisateur,
 id_timbre)) ENGINE=InnoDB;

ALTER TABLE timbre ADD CONSTRAINT FK_timbre_id_categorie FOREIGN KEY (id_categorie) REFERENCES categorie (id_categorie);

ALTER TABLE timbre ADD CONSTRAINT FK_timbre_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur);
ALTER TABLE timbre ADD CONSTRAINT FK_timbre_id_pays FOREIGN KEY (id_pays) REFERENCES pays (id_pays);
ALTER TABLE timbre ADD CONSTRAINT FK_timbre_enchere_id_enchere FOREIGN KEY (enchere_id_enchere) REFERENCES enchere (id_enchere);
ALTER TABLE timbre ADD CONSTRAINT FK_timbre_id_condition FOREIGN KEY (id_condition) REFERENCES condition (id_condition);
ALTER TABLE utilisateur ADD CONSTRAINT FK_utilisateur_id_privilege FOREIGN KEY (id_privilege) REFERENCES privilege (id_privilege);
ALTER TABLE image ADD CONSTRAINT FK_image_id_timbre FOREIGN KEY (id_timbre) REFERENCES timbre (id_timbre);
ALTER TABLE enchere ADD CONSTRAINT FK_enchere_timbre_id_timbre FOREIGN KEY (timbre_id_timbre) REFERENCES timbre (id_timbre);
ALTER TABLE enchere ADD CONSTRAINT FK_enchere_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur);
ALTER TABLE mise ADD CONSTRAINT FK_mise_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur);
ALTER TABLE mise ADD CONSTRAINT FK_mise_id_enchere FOREIGN KEY (id_enchere) REFERENCES enchere (id_enchere);
ALTER TABLE aime ADD CONSTRAINT FK_aime_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur);
ALTER TABLE aime ADD CONSTRAINT FK_aime_id_timbre FOREIGN KEY (id_timbre) REFERENCES timbre (id_timbre);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `categorie`
--
INSERT INTO `categorie` (`id_categorie`, `nom_categorie`)
VALUES 
(1, 'architecture'),
(2, 'art'),
(3, 'canada'),
(4, 'europe'),
(5, 'ferroviaire'),
(6, 'maritime'),
(7, 'monde'),
(8, 'royauté'),
(9, 'sport');

--
-- Déchargement des données de la table `pays`
--
INSERT INTO `pays` (`id_pays`, `nom_pays`)
VALUES 
(1, 'angleterre'),
(2, 'australie'),
(3, 'canada'),
(4, 'france');

--
-- Déchargement des données de la table `privilege`
--
INSERT INTO `privilege` (`id_privilege`, `niveau_privilege`)
VALUES 
(1, 'visiteur'),
(2, 'membre'),
(3, 'administrateur');

--
-- Déchargement des données de la table `condition`
--
INSERT INTO `condition` (`id_condition`, `etat_condition`)
VALUES 
(1, 'parfaite'),
(2, 'très bonne'),
(3, 'bonne'),
(4, 'endommagée');

--
-- Déchargement des données de la table `timbre`
--

INSERT INTO `timbre` (`titre_timbre`, `tirage_timbre`, `dimensions_timbre`, `certifié_timbre`, `prix_plancher_timbre`, `id_categorie`, `id_utilisateur`, `id_pays`, `enchere_id_enchere`)
VALUES
('HRH Prince Albert (1851)', 900, '27 X 22 mm', true, 195, 8, , 1, ),
('HRH Prince Albert (1858)', 900, '27 X 22 mm', true, 245, 8, , 1, ),
('Reine Victoria (1851)', 600, '27 X 22 mm', true, 500, 8, , 1, ),
('HRH Prince Albert (1851)', 600, '27 X 22 mm', true, 495, 8, , 1, ),
('Reine Victoria (1855)'), 200, '27 X 22 mm', true, 995, 8, , 1, ),
('Reine Victoria (1859) 1¢'), 900, '27 X 22 mm', true, 195, 8, , 1, ),
('Reine Victoria (1859) rose 1¢'), 200, '27 X 22 mm', true, 745, 8, , 1, ),
('Reine Victoria (1868) gris ½¢'), 900, '27 X 22 mm', false, 135, 8, , 1, ),
('Reine Victoria (1868) vert ½¢'), 900, '27 X 22 mm', false, 125, 8, , 3, ),
('Reine Victoria (1868) brun fonce 6¢'), 900, '27 X 22 mm', false, 80, 8, , 3, ),
('Reine Victoria (1868) brun jaune 6¢'), 600, '27 X 22 mm', true, 495, 8, , 3, ),
('Reine Victoria (1868) bleu 12½¢'), 200, '27 X 22 mm', true, 995, 8, , 3, );

