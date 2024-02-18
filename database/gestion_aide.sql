-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE  IF NOT EXISTS gestion_aide;
USE gestion_aide;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_aide`
--



--
-- Table structure for table `snmm_departments`
--

CREATE TABLE `snmm_departments` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `snmm_departments`
--

INSERT INTO `snmm_departments` (`id`, `name`, `status`) VALUES
(1, 'Informatique', 1),
(2, 'Achats', 1),
(3, 'Ventes', 1),
(4, 'Production', 1),
(5, 'Logistique ', 1);
-- --------------------------------------------------------

--
-- Table structure for table `snmm_tickets`
--

CREATE TABLE `snmm_tickets` (
  `id` int(11) NOT NULL,
  `uniqid` varchar(20) NOT NULL,
  `user` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `init_msg` text NOT NULL,
  `department` int(11) NOT NULL,
  `date` varchar(250) NOT NULL,
  `last_reply` int(11) NOT NULL,
  `user_read` int(11) NOT NULL,
  `admin_read` int(11) NOT NULL,
  `resolved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `snmm_tickets`
--

INSERT INTO `snmm_tickets` (`id`, `uniqid`, `user`, `title`, `init_msg`, `department`, `date`, `last_reply`, `user_read`, `admin_read`, `resolved`) VALUES
(1, '617181b83c1e7', 1, 'Le système ne fonctionne pas', 'Le système ne fonctionne pas', 1, '1634828728', 1, 0, 1, 1),
(4, '617bfc35a93af', 2, 'Il y a quelques problèmes', 'Il y a quelques problèmes', 3, '1635515445', 2, 1, 0, 0),
(5, '617c0a73661fd', 1, 'Il y a des failles de sécurité !', 'Il y a des failles de sécurité !', 1, '1635519091', 1, 0, 1, 0),
(6, '617c0ba6d462b', 2, 'Il y a quelques problèmes.


', 'Il y a quelques problèmes.




', 1, '1635519398', 2, 1, 0, 0);



CREATE TABLE `snmm_ticket_replies` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `text` text NOT NULL,
  `ticket_id` text NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `snmm_ticket_replies`
--

INSERT INTO `snmm_ticket_replies` (`id`, `user`, `text`, `ticket_id`, `date`) VALUES
(1, 1, 'This is fixed', '1', '1634829030'),
(2, 1, 'Please check it.', '1', '1634829129'),
(3, 1, 'The issue is fixed, you can check at your end. Thanks', '2', '1634829404'),
(4, 2, 'fixed', '2', '1635515403'),
(5, 2, 'this is fixed!', '4', '1635517083'),
(6, 1, 'I am looking into this', '5', '1635519340'),
(7, 2, 'ewtewt', '6', '1635519418');

-- --------------------------------------------------------

--
-- Table structure for table `snmm_users`
--

CREATE TABLE `snmm_users` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(250) NOT NULL,
  `user_type` enum('admin','user') NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `snmm_users`
--

INSERT INTO `snmm_users` (`id`, `email`, `password`, `create_date`, `name`, `user_type`, `status`) VALUES
(1, 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2021-10-25 23:24:33', 'ilyas ', 'admin', 1),
(2, 'utilisateur@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2021-10-25 23:24:46', 'amine', 'user', 1);


CREATE TABLE `resets` (
  `id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `Expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Indexes for dumped tables
--

--
-- Indexes for table `snmm_departments`
--
ALTER TABLE `snmm_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snmm_tickets`
--
ALTER TABLE `snmm_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snmm_ticket_replies`
--
ALTER TABLE `snmm_ticket_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snmm_users`
--
ALTER TABLE `snmm_users`
  ADD PRIMARY KEY (`id`);

-- 
-- Indexes for table `resets`
-- 

ALTER TABLE `resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Code` (`Code`),
  ADD KEY `Expiry_date` (`Expire`),
  ADD KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `snmm_departments`
--
ALTER TABLE `snmm_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `snmm_tickets`
--
ALTER TABLE `snmm_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `snmm_ticket_replies`
--
ALTER TABLE `snmm_ticket_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `snmm_users`
--
ALTER TABLE `snmm_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;



-- AUTO_INCREMENT for table `resets`
--
ALTER TABLE `resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
---------------------------


