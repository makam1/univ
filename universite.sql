-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 01 Juillet 2019 à 08:47
-- Version du serveur :  5.7.26-0ubuntu0.18.04.1
-- Version de PHP :  7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `universite`
--

-- --------------------------------------------------------

--
-- Structure de la table `batiments`
--

CREATE TABLE `batiments` (
  `id_batiments` int(11) NOT NULL,
  `nom_batiment` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `batiments`
--

INSERT INTO `batiments` (`id_batiments`, `nom_batiment`) VALUES
(1, 'MAK'),
(2, 'KAM');

-- --------------------------------------------------------

--
-- Structure de la table `bourse`
--

CREATE TABLE `bourse` (
  `id_bourse` int(11) NOT NULL,
  `libelle` varchar(30) NOT NULL,
  `Montant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `bourse`
--

INSERT INTO `bourse` (`id_bourse`, `libelle`, `Montant`) VALUES
(1, 'pension', 40000),
(2, 'demi_pension', 20000);

-- --------------------------------------------------------

--
-- Structure de la table `boursiers`
--

CREATE TABLE `boursiers` (
  `id_etudiant` int(11) NOT NULL,
  `id_bourse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `boursiers`
--

INSERT INTO `boursiers` (`id_etudiant`, `id_bourse`) VALUES
(2, 1),
(12, 1),
(14, 1),
(18, 1),
(3, 2),
(13, 2),
(15, 2),
(17, 2);

-- --------------------------------------------------------

--
-- Structure de la table `chambres`
--

CREATE TABLE `chambres` (
  `id_chambre` int(11) NOT NULL,
  `id_batiment` int(11) DEFAULT NULL,
  `nom_chambre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `chambres`
--

INSERT INTO `chambres` (`id_chambre`, `id_batiment`, `nom_chambre`) VALUES
(1, 1, 'A1'),
(2, 2, 'B2'),
(3, 1, 'A3'),
(4, 2, 'B4'),
(5, 1, 'A5'),
(6, 2, 'B6'),
(7, 2, 'B7'),
(8, 2, 'B8'),
(9, 2, 'B9'),
(10, 2, 'B10'),
(11, 2, 'B11'),
(12, 2, 'B12'),
(13, 2, 'B13'),
(14, 2, 'B14'),
(15, 2, 'B15'),
(16, 2, 'B16'),
(17, 2, 'B17'),
(18, 2, 'B18'),
(19, 2, 'B19'),
(20, 2, 'B20'),
(21, 2, 'B21'),
(22, 2, 'B22'),
(23, 2, 'B23'),
(24, 2, 'B24'),
(25, 2, 'B25'),
(26, 2, 'B26'),
(27, 2, 'B27');

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id_etudiant` int(11) NOT NULL,
  `matricule` varchar(15) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telephone` int(9) NOT NULL,
  `date_de_naissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `etudiants`
--

INSERT INTO `etudiants` (`id_etudiant`, `matricule`, `nom`, `prenom`, `email`, `telephone`, `date_de_naissance`) VALUES
(2, 'DW2-2', 'Camara', 'Aboubacar', 'babs@gmail.com', 774521026, '1995-02-26'),
(3, 'DW3-2', 'Mboup', 'Birame', 'birame@gmail.com', 775754839, '1996-12-25'),
(4, 'DW4-2', 'Dabo', 'Adji Anta', 'adji@gmail.com', 771202563, '1996-05-16'),
(5, 'DW5-2', 'Kane', 'Hawa', 'Hawa@gmail.com', 774102558, '1998-11-30'),
(8, 'DW6-2', 'Sall', 'Awa', 'awa@gmail.com', 785203612, '1996-07-05'),
(10, 'DW7-2', 'Diop', 'Sidy', 'sidy@gmail.com', 786502361, '1994-08-04'),
(11, 'DW8-2', 'Kane', 'Kouna', 'kik@gmail.com', 771530203, '1998-08-09'),
(12, 'DW9-2', 'Sy', 'Thierno', 'thier@gmail.com', 774586320, '1994-11-20'),
(13, 'DW10-2', 'Sene', 'Awa Ndiaye', 'eva@gmail.com', 770023654, '1996-07-17'),
(14, 'DW11', 'Dieye', 'Malick', 'malick@gmail.com', 774120536, '1996-04-25'),
(15, 'DW12-2', 'Ba', 'Lamine', 'lamine@gmail.com', 773042807, '1995-06-01'),
(16, 'DW13-2', 'Samb', 'Mamadou', 'mam@gmail.com', 781962413, '1994-02-14'),
(17, 'DW14-2', 'Ly', 'Kene', 'kene@gmail.com', 778400625, '1999-01-10'),
(18, 'DW15-2', 'Mboaw', 'Penda', 'penda@gmail.com', 774852631, '1994-05-15'),
(46, 'DW16-2', 'Seck', 'Fatim', 'fatim@gmail.com', 774120582, '1992-02-14');

-- --------------------------------------------------------

--
-- Structure de la table `loges`
--

CREATE TABLE `loges` (
  `id_etudiant` int(11) NOT NULL,
  `id_chambre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `loges`
--

INSERT INTO `loges` (`id_etudiant`, `id_chambre`) VALUES
(2, 1),
(15, 3),
(13, 4),
(18, 4),
(46, 14);

-- --------------------------------------------------------

--
-- Structure de la table `non_boursiers`
--

CREATE TABLE `non_boursiers` (
  `id_etudiant` int(11) NOT NULL,
  `adresse` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `non_boursiers`
--

INSERT INTO `non_boursiers` (`id_etudiant`, `adresse`) VALUES
(4, 'Bambilor'),
(5, 'dakar'),
(10, 'Hlm5'),
(11, 'rufisque'),
(16, 'Pikine'),
(46, 'Ouest-Foire');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `batiments`
--
ALTER TABLE `batiments`
  ADD PRIMARY KEY (`id_batiments`);

--
-- Index pour la table `bourse`
--
ALTER TABLE `bourse`
  ADD PRIMARY KEY (`id_bourse`);

--
-- Index pour la table `boursiers`
--
ALTER TABLE `boursiers`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD KEY `bourse` (`id_bourse`);

--
-- Index pour la table `chambres`
--
ALTER TABLE `chambres`
  ADD PRIMARY KEY (`id_chambre`),
  ADD KEY `id_batiment` (`id_batiment`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD UNIQUE KEY `matricule` (`matricule`);

--
-- Index pour la table `loges`
--
ALTER TABLE `loges`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD KEY `chambre` (`id_chambre`);

--
-- Index pour la table `non_boursiers`
--
ALTER TABLE `non_boursiers`
  ADD PRIMARY KEY (`id_etudiant`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `batiments`
--
ALTER TABLE `batiments`
  MODIFY `id_batiments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `bourse`
--
ALTER TABLE `bourse`
  MODIFY `id_bourse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `chambres`
--
ALTER TABLE `chambres`
  MODIFY `id_chambre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `boursiers`
--
ALTER TABLE `boursiers`
  ADD CONSTRAINT `bourse` FOREIGN KEY (`id_bourse`) REFERENCES `bourse` (`id_bourse`),
  ADD CONSTRAINT `boursiers_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`);

--
-- Contraintes pour la table `chambres`
--
ALTER TABLE `chambres`
  ADD CONSTRAINT `chambres_ibfk_1` FOREIGN KEY (`id_batiment`) REFERENCES `batiments` (`id_batiments`);

--
-- Contraintes pour la table `loges`
--
ALTER TABLE `loges`
  ADD CONSTRAINT `chambre` FOREIGN KEY (`id_chambre`) REFERENCES `chambres` (`id_chambre`),
  ADD CONSTRAINT `loges_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`);

--
-- Contraintes pour la table `non_boursiers`
--
ALTER TABLE `non_boursiers`
  ADD CONSTRAINT `non_boursiers_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
