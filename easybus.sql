-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 24 Septembre 2016 à 17:52
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `easybus`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte_voyageur`
--

CREATE TABLE `compte_voyageur` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `compte_voyageur`
--

INSERT INTO `compte_voyageur` (`id`, `created`, `phone`, `email`, `nom`) VALUES
(1, '2016-09-24 11:39:12', '09195003', 'dogbo.curtis@gmail.com', 'Oumar');

-- --------------------------------------------------------

--
-- Structure de la table `conducteur`
--

CREATE TABLE `conducteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenoms` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  `lieuDeNaissance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permis` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `conducteur`
--

INSERT INTO `conducteur` (`id`, `nom`, `prenoms`, `email`, `created`, `contact`, `dateNaissance`, `lieuDeNaissance`, `permis`, `path`) VALUES
(1, 'Coulibaly', 'Nahoua', 'dogbo.curtis@gmail.com', '2016-09-24 11:05:13', '09195003', '2016-09-24', 'Korogho', 'A', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `gare`
--

CREATE TABLE `gare` (
  `id` int(11) NOT NULL,
  `ville_id` int(11) NOT NULL,
  `nomgare` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `gare`
--

INSERT INTO `gare` (`id`, `ville_id`, `nomgare`, `description`) VALUES
(1, 1, 'Yopougon-Siporex', 'Gare de Yop City'),
(2, 1, 'Marcory', 'Gare de marcory'),
(3, 3, 'Bouaké', NULL),
(4, 2, 'Yakro', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `compte_voyageur_id` int(11) NOT NULL,
  `voyage_id` int(11) NOT NULL,
  `pu` double DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `places` int(11) DEFAULT NULL,
  `operateur` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `testSMSSend` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `testEmailSend` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `transaction`
--

INSERT INTO `transaction` (`id`, `compte_voyageur_id`, `voyage_id`, `pu`, `montant`, `reference`, `places`, `operateur`, `created`, `info`, `etat`, `testSMSSend`, `testEmailSend`) VALUES
(1, 1, 1, 6500, NULL, NULL, 5, 'orange', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenoms` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `habitation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `nom`, `prenoms`, `habitation`, `tel1`, `tel2`) VALUES
(1, 'admin', 'admin', 'admin@easybus.com', 'admin@easybus.com', 1, 'a5watae635kwcs0wsc84sk40c00cwko', '$2y$13$Dca/3djUoTDgjVODYlFnwOuqjhLlLLmGgOonLD9/UuQgSCc0rXLxe', '2016-09-24 16:02:10', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'dreamdogbo', 'dreamdogbo', 'dogbo.curtis@gmail.com', 'dogbo.curtis@gmail.com', 1, 'ffloccl50g84o0k8w04s8gggsc0wsws', '$2y$13$21MNEAkeFFOReGnJMl9OWOjvE7DVmntYw7hAIyQz5r5H2mfe33UU2', NULL, 0, 0, NULL, NULL, NULL, 'a:2:{i:0;s:9:"ROLE_EASY";i:1;s:10:"ROLE_ADMIN";}', 0, NULL, 'Dogbo', 'Curtis', 'Marcory', '09195003', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `marque` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `immatriculation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `places` int(11) DEFAULT NULL,
  `climatisation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tele` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `marque`, `immatriculation`, `places`, `climatisation`, `tele`, `created`, `path`) VALUES
(1, 'TOYOTA', '2347EK01', 40, 'NON', 'NON', '2016-09-24 11:06:26', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id` int(11) NOT NULL,
  `nomVille` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`id`, `nomVille`) VALUES
(1, 'Abidjan'),
(3, 'Bouaké'),
(2, 'Yamoussoukro');

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

CREATE TABLE `voyage` (
  `id` int(11) NOT NULL,
  `gare_id` int(11) NOT NULL,
  `lieu_depart_id` int(11) NOT NULL,
  `lieu_arrivee_id` int(11) NOT NULL,
  `vehicule_id` int(11) NOT NULL,
  `conducteur_id` int(11) DEFAULT NULL,
  `dateVoyage` date NOT NULL,
  `heureDepart` time NOT NULL,
  `heureArrivee` time NOT NULL,
  `placesDispo` int(11) NOT NULL,
  `prixVoyage` double NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `voyage`
--

INSERT INTO `voyage` (`id`, `gare_id`, `lieu_depart_id`, `lieu_arrivee_id`, `vehicule_id`, `conducteur_id`, `dateVoyage`, `heureDepart`, `heureArrivee`, `placesDispo`, `prixVoyage`, `created`) VALUES
(1, 1, 1, 3, 1, 1, '2016-09-24', '06:00:00', '07:00:00', 20, 6500, '2016-09-24 00:00:00'),
(2, 4, 2, 3, 1, 1, '2016-10-29', '04:00:00', '09:00:00', 40, 8000, '2016-09-24 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `voyageur`
--

CREATE TABLE `voyageur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `compte_voyageur`
--
ALTER TABLE `compte_voyageur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conducteur`
--
ALTER TABLE `conducteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gare`
--
ALTER TABLE `gare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EE713F12A73F0036` (`ville_id`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_723705D14E80DE56` (`compte_voyageur_id`),
  ADD KEY `IDX_723705D168C9E5AF` (`voyage_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1D1C63B392FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_1D1C63B3A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_1D1C63B3C05FB297` (`confirmation_token`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_292FFF1DBE73422E` (`immatriculation`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_43C3D9C32DF74CB2` (`nomVille`);

--
-- Index pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3F9D895563FD956` (`gare_id`),
  ADD KEY `IDX_3F9D8955C16565FC` (`lieu_depart_id`),
  ADD KEY `IDX_3F9D8955BF9A3FF6` (`lieu_arrivee_id`),
  ADD KEY `IDX_3F9D89554A4A3511` (`vehicule_id`),
  ADD KEY `IDX_3F9D8955F16F4AC6` (`conducteur_id`);

--
-- Index pour la table `voyageur`
--
ALTER TABLE `voyageur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `compte_voyageur`
--
ALTER TABLE `compte_voyageur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `conducteur`
--
ALTER TABLE `conducteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `gare`
--
ALTER TABLE `gare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `voyage`
--
ALTER TABLE `voyage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `voyageur`
--
ALTER TABLE `voyageur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `gare`
--
ALTER TABLE `gare`
  ADD CONSTRAINT `FK_EE713F12A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`);

--
-- Contraintes pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FK_723705D14E80DE56` FOREIGN KEY (`compte_voyageur_id`) REFERENCES `compte_voyageur` (`id`),
  ADD CONSTRAINT `FK_723705D168C9E5AF` FOREIGN KEY (`voyage_id`) REFERENCES `voyage` (`id`);

--
-- Contraintes pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD CONSTRAINT `FK_3F9D89554A4A3511` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicule` (`id`),
  ADD CONSTRAINT `FK_3F9D895563FD956` FOREIGN KEY (`gare_id`) REFERENCES `gare` (`id`),
  ADD CONSTRAINT `FK_3F9D8955BF9A3FF6` FOREIGN KEY (`lieu_arrivee_id`) REFERENCES `ville` (`id`),
  ADD CONSTRAINT `FK_3F9D8955C16565FC` FOREIGN KEY (`lieu_depart_id`) REFERENCES `ville` (`id`),
  ADD CONSTRAINT `FK_3F9D8955F16F4AC6` FOREIGN KEY (`conducteur_id`) REFERENCES `conducteur` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
