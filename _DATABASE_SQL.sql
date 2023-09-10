-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2023 at 10:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `webdevfinalproject`
--

CREATE TABLE `tbl_accounts` (
  `AccountId` int(11) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `AuthToken` varchar(100) DEFAULT NULL,
  `StoreId` int(11) DEFAULT NULL,
  `JoinedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `SuccessOrders` int(11) NOT NULL DEFAULT 0,
  `AccountPicture` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_items` (
  `ItemId` int(11) NOT NULL,
  `StoreId` int(11) NOT NULL,
  `ItemName` varchar(50) NOT NULL,
  `ItemCategory` varchar(50) NOT NULL,
  `ItemPrice` float NOT NULL,
  `ItemImage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_stores` (
  `StoreId` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `StoreName` varchar(50) NOT NULL,
  `StoreImage` varchar(255) NOT NULL,
  `StoreOrders` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_transactions` (
  `TransactionId` int(11) NOT NULL,
  `TransactionSeller` text NOT NULL,
  `TransactionBuyer` int(11) NOT NULL,
  `TransactionTimestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `TransactionOrders` text NOT NULL,
  `TransactionStatus` varchar(50) DEFAULT NULL,
  `TransactionAmount` varchar(50) NOT NULL,
  `TransactionBuyerAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`AccountId`);

ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`ItemId`);

ALTER TABLE `tbl_stores`
  ADD PRIMARY KEY (`StoreId`);

ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`TransactionId`);

ALTER TABLE `tbl_accounts`
  MODIFY `AccountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `tbl_items`
  MODIFY `ItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `tbl_stores`
  MODIFY `StoreId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `tbl_transactions`
  MODIFY `TransactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
