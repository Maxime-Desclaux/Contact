-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 08 jan. 2025 à 22:35
-- Version du serveur : 10.11.8-MariaDB-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Contact`
--

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `name`, `phone`, `email`, `created_at`) VALUES
(12, 5, 'Sophie DESCLAUX', '0625884997', 'sophie@desclaux.fr', '2025-01-08 22:17:46'),
(14, 5, 'Sophie DESCLAUX', '0625884997', 'maxime@desclaux.fr', '2025-01-08 22:19:14'),
(15, 1, 'Sophie DESCLAUX', '0625884997', 'sophie@desclaux.fr', '2025-01-08 22:21:49'),
(16, 1, 'Maxime DESCLAUX', '0625884997', 'maxime@desclaux.fr', '2025-01-08 22:32:24'),
(17, 1, 'Sophie DESCLAUX', '0625884997', 'sophie@desclaux.fr', '2025-01-08 22:33:20'),
(18, 1, 'Maxime DESCLAUX', '0625884997', 'maxime@desclaux.fr', '2025-01-08 22:33:24'),
(19, 1, 'Maxime DESCLAUX', '5', 'maxime.desclaux@efrei.net', '2025-01-08 22:33:29'),
(20, 1, 'Sophie DESCLAUX', '0625884997', 'maxime.desclaux@efrei.net', '2025-01-08 22:33:43');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'Max', '$2y$10$mU7aF0qIvmFvKauKiNMUzuzHlDKI9iei/Ss8U7N4Rkw2gC5aEMRCK', '2025-01-08 20:05:02'),
(2, 'Alice', '$2y$10$A7zCw./NNBp2OeXM0oWP1O/r2HI5f2zratDngf1jI81EYJfSpjNfe', '2025-01-08 20:05:02'),
(4, 'Maxou', '$2y$10$3DVv8CF8sXRuGTy4CsVdcu/hjmh4BaA9S1vqHZC4RavYmCjc7MJxG', '2025-01-08 20:19:35'),
(5, 'root', '$2y$10$cP5gqubODiJckKtk7zQg0eO7OGts7F5CQoKNa6dzoMozX9eQEPq2S', '2025-01-08 20:34:21'),
(6, 'Maw', '$2y$10$zYpnl3G3cT0/Y8QDIQg6I.PvrxJKHH58HzsjwS2Gl9w31h1YB8Tq2', '2025-01-08 22:15:17');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;