CREATE DATABASE `es_casino`;
USE `es_casino`;

----------------------------------------------------------

CREATE TABLE `users` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `chips` int NOT NULL DEFAULT 1000,
  `lastAccess` datetime DEFAULT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);