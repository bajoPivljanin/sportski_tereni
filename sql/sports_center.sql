-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2026 at 11:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sports_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `courts`
--

CREATE TABLE `courts` (
  `court_id` int(11) NOT NULL,
  `court_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sport` varchar(255) NOT NULL,
  `equipment` varchar(255) NOT NULL DEFAULT 'None provided',
  `initial_price` int(11) NOT NULL,
  `last_edited_admin_id` int(11) DEFAULT NULL,
  `last_edited_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by_admin_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courts`
--

INSERT INTO `courts` (`court_id`, `court_name`, `type`, `sport`, `equipment`, `initial_price`, `last_edited_admin_id`, `last_edited_at`, `created_by_admin_id`, `created_at`) VALUES
(1, 'Glavni košarkaški teren', 'Zatvoreni', 'Košarka', 'Lopta uključena u cenu', 2500, NULL, '2026-07-09 14:25:00', 6, '2026-07-09 14:24:48'),
(2, 'Fudbal veštačka trava - Prozivka', 'Otvoreni', 'Fudbal', 'Markeri i lopta', 3500, NULL, '2026-07-09 14:25:06', 6, '2026-07-09 14:24:48'),
(3, 'Teniski teren - Dudova šuma', 'Otvoreni', 'Tenis', 'Oprema nije obezbeđena', 3500, NULL, '2026-07-09 14:25:12', 6, '2026-07-09 14:24:48'),
(4, 'Premium Padel Arena', 'Zatvoreni', 'Padel', 'Reketi i loptice', 1500, NULL, '2026-07-09 14:25:16', 6, '2026-07-09 14:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reservation_code` varchar(30) NOT NULL,
  `duration_minute` int(11) NOT NULL,
  `reservation_status` varchar(255) NOT NULL,
  `player_status` varchar(255) NOT NULL,
  `reservation_datetime` datetime NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `last_note_by_employee_id` int(11) DEFAULT NULL,
  `note_added_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_token_expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `points`, `status`, `role`, `token`, `reset_token`, `reset_token_expire`) VALUES
(6, 'Marko', 'Bajagic', 'bajagaaa9@gmail.com', '$2y$10$pnwy8/mZsi/v7LVLxHGnpuaCoEZJokrGs0pWSyovFpmbxkDUjmf.q', '0616443350', 0, 'aktivan', 'user', 'fe28684117e1655c549be38d176a5429a8fe967c66d351cb4330440a2378aff2', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`court_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD UNIQUE KEY `reservation_code` (`reservation_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
  MODIFY `court_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
