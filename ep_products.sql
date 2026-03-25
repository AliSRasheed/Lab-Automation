-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2025 at 01:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ep_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Role` enum('SuperAdmin','Manager','Support') DEFAULT 'Manager',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `Username`, `PasswordHash`, `FullName`, `Email`, `Role`, `CreatedAt`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'System Administrator', 'admin@srs.com', 'SuperAdmin', '2025-09-01 21:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `CartItemID` int(11) NOT NULL,
  `CartID` int(11) NOT NULL,
  `ProductID` char(10) NOT NULL,
  `Quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `CartID` int(11) NOT NULL,
  `SessionID` varchar(255) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`CartID`, `SessionID`, `UserID`, `CreatedAt`) VALUES
(11, '4vvl3t9ricpqc446nhcfn6t4hf', NULL, '2025-09-07 22:33:09'),
(13, '864ld38594ql1lcqnrf8gctqls', NULL, '2025-09-23 09:49:16'),
(20, 'o95krpbd081nqpr32534nnmdtc', NULL, '2025-09-30 12:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `contactmessages`
--

CREATE TABLE `contactmessages` (
  `MessageID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Subject` varchar(150) NOT NULL,
  `Message` text NOT NULL,
  `Status` enum('New','Read','Archived') DEFAULT 'New',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactmessages`
--

INSERT INTO `contactmessages` (`MessageID`, `Name`, `Email`, `Subject`, `Message`, `Status`, `CreatedAt`) VALUES
(1, 'Ismail Hashmi ', 'hashmiismail502@gmail.com', 'idsididid', 'Ismail hahsmiiiiii', 'New', '2025-09-04 22:12:07'),
(2, 'Ismail Hashmi ', 'hashmiismail502@gmail.com', 'idsididid', 'adfvdfvadvcasd', 'New', '2025-09-04 22:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Address` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `Name`, `Email`, `Password`, `Address`, `CreatedAt`) VALUES
(1, 'Ali', 'ali.rasheed4582@gmail.com', '$2y$10$rbNrYQR/d/YG6eqda3LxSuVnG7ZQF3TgNlh8LG1ZE48BL/9UP0lVK', 'Bufferzone', '2025-09-07 18:41:39'),
(2, 'ismail', 'hashmiismial5096@gmail.com', '$2y$10$.m3/xpaq.EZszhjt6IafPO8cmEjjii2XiphtqN5LsEAd6fhI9ffrm', 'qweert', '2025-09-08 07:41:41'),
(3, 'hashmi', 'hashmiismial509@gmail.com', '$2y$10$m/ZI/033AqXziv4ukIhU.Ok9K.fwRryCf/7XkPhWpAzO7QSxkkI1O', 'jhdfgahsdf', '2025-09-08 07:43:14'),
(4, 'ismail', 'hsahmi09@gmail.com', '$2y$10$GjqejRzfF.YVA.eNBRorN./wVbe1rC7OSnoNjk4vR9BPZozcOrimG', 'ismaialal', '2025-09-08 08:16:26'),
(5, 'hashmi', 'hashmi09@gmail.com', '$2y$10$JBfHSaj4EzaAGOuwrlOqJOFcoDpmwKcxKCcoBeble5o/WznCy7aGi', 'ewfwe', '2025-09-08 08:18:05'),
(6, 'ismailhashmi', 'hashmiismail503@gmail.com', '$2y$10$yd/a0gKsG2fyG/wMz69cEOdAuI5kc8cW/O7aysy4Lj2YGSNXcFVHa', 'sasdcsdghvjds', '2025-09-08 08:29:20'),
(7, 'ismal', 'hashmi@gmail.com', '$2y$10$AO6iwXhpC3yQgXyi7H4Daepxl7Vi9vni3VyVCTUk1djbuMaEd0HR2', 'hhhh', '2025-09-23 09:44:57'),
(8, 'ismail hashmi', 'hashmiisamil5096@gmail.com', '$2y$10$hAEU/RcOyA5arIvseAsuQeM56dw6GN8u3vVG1HxciJrYf1rZzHchG', '1', '2025-09-25 13:15:53'),
(9, 'isamil', 'hashmi@gamil.com', '$2y$10$23sfDJU1qL6gfeiWy5L.KeLY584PoW3z.1keLD5njd9woVsVCJFZC', 'hhh', '2025-09-29 10:29:11'),
(10, 'Odysseus Gordon', 'xujyt@mailinator.com', '$2y$10$egjKXgg8bHDZX6N8MUOO4eLpzcAWhKoGczlqdEWOau3BgkNzz2d9O', 'Dolorem in temporibu', '2025-09-29 12:58:54'),
(11, 'Ria Baker', 'purip@mailinator.com', '$2y$10$Lfv1ohyO5E2FypDaQO.bGOaZsC.vytDoVA2ITsEnVE2x50Qy327eC', 'Voluptatem quia pla', '2025-10-01 11:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `featuredproducts`
--

CREATE TABLE `featuredproducts` (
  `FeatureID` int(11) NOT NULL,
  `ProductID` char(10) NOT NULL,
  `Status` enum('Active','Inactive') DEFAULT 'Active',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `ImageID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `FilePath` varchar(255) NOT NULL,
  `UploadedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`ImageID`, `Title`, `Description`, `FilePath`, `UploadedAt`) VALUES
(16, 'Logo', 'Our Company Logo', '1757023249_Tech Company Logo - Modern Wordmark.png', '2025-09-04 22:00:49'),
(19, 'hashmi', 'qweret', '1758620894_images.jfif', '2025-09-23 09:48:14'),
(20, 'ff', 'ff', '1759139707_images.jfif', '2025-09-29 09:55:07'),
(21, 'vsdf', 'gsgf', '1759144088_imge.jfif', '2025-09-29 11:08:08'),
(22, 'Omnis libero velit u', 'Et eum et veritatis ', '1759310057_Capacitors.jpg', '2025-10-01 09:14:17'),
(23, 'Eum est ullamco dol', 'Provident voluptate', '1759310068_Fuses2.jpg', '2025-10-01 09:14:28'),
(24, 'Et ratione et magna ', 'Qui perspiciatis ex', '1759310077_Fuse Z.jpg', '2025-10-01 09:14:37'),
(25, 'Qui officia enim lib', 'Eveniet molestiae r', '1759310086_Fuses1.jpg', '2025-10-01 09:14:46'),
(26, 'Neque unde eveniet ', 'Duis eligendi volupt', '1759310096_Resistors.jpg', '2025-10-01 09:14:56'),
(27, 'Iure id aliquam sed ', 'Laborum ullam saepe ', '1759310105_testing equipement.jpg', '2025-10-01 09:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `heromessages`
--

CREATE TABLE `heromessages` (
  `MessageID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `ButtonText` varchar(50) DEFAULT 'Explore Now',
  `ButtonLink` varchar(255) DEFAULT '#',
  `Status` enum('Active','Inactive') DEFAULT 'Active',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `heromessages`
--

INSERT INTO `heromessages` (`MessageID`, `Title`, `Description`, `ButtonText`, `ButtonLink`, `Status`, `CreatedAt`) VALUES
(1, 'Powering the Future', 'Innovative electrical solutions for industries worldwide.', 'Explore Products', 'products.php', 'Active', '2025-09-01 07:57:59'),
(2, 'Precision Testing', 'Ensuring safety and reliability with advanced labs.', 'Our Services', 'services.php', 'Active', '2025-09-01 07:57:59'),
(3, 'Trusted Quality', 'Delivering certified electrical appliances globally.', 'Learn More', 'about.php', 'Active', '2025-09-01 07:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Subject` varchar(150) DEFAULT NULL,
  `Message` text NOT NULL,
  `SentAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MessageID`, `Name`, `Email`, `Subject`, `Message`, `SentAt`) VALUES
(4, 'ismail', 'hashmiisamil509@Gmail.com', 'kuch bhi', 'yrfrur', '2025-09-08 08:02:54'),
(5, 'ismail', 'hashmiisamil509@Gmail.com', 'math', 'rgegege', '2025-09-08 08:28:43'),
(6, 'dd', 'hashmi@gmail.com', 'y', 'sb kuch sahi hy', '2025-09-29 09:55:46'),
(7, 'dd', 'hashmi@gmail.com', 'y', 'sb kuch sahi hy', '2025-09-29 10:00:32'),
(8, 'gdufy', 'sahabhashmi302@gmail.com', 'jio', 'edf', '2025-10-01 09:34:08'),
(9, 'gdufy', 'sahabhashmi302@gmail.com', 'jio', 'edf', '2025-10-01 09:40:11'),
(10, 'gdufy', 'sahabhashmi302@gmail.com', 'jio', 'edf', '2025-10-01 09:42:12'),
(11, 'Salvador Cotton', 'pani@mailinator.com', 'Culpa aute id dignis', 'Libero quaerat sunt', '2025-10-01 11:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
  `MissionID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Status` enum('Active','Inactive') DEFAULT 'Active',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `missions`
--

INSERT INTO `missions` (`MissionID`, `Title`, `Description`, `Status`, `CreatedAt`) VALUES
(1, 'Our Mission', 'To innovate in electrical engineering, delivering reliable and safe solutions globally.', 'Active', '2025-09-01 07:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` char(10) DEFAULT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `UnitPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`OrderItemID`, `OrderID`, `ProductID`, `ProductName`, `Quantity`, `UnitPrice`) VALUES
(1, 1, NULL, 'sqjbc', 1, 0.00),
(2, 1, NULL, 'nananan', 1, 80.80),
(3, 2, NULL, 'Capacitor C1', 1, 0.00),
(4, 2, NULL, 'rfger', 1, 0.00),
(5, 3, NULL, 'Resistor R1', 1, 0.00),
(6, 4, NULL, 'Resistor R1', 1, 0.00),
(7, 5, NULL, 'Switch Gear B', 1, 0.00),
(8, 6, NULL, 'APPA Switch Gear C', 1, 90.00),
(9, 7, NULL, 'Resistor R1', 1, 0.00),
(10, 8, NULL, 'Switch Gear B', 1, 0.00),
(11, 9, NULL, 'Resistor R2', 1, 0.00),
(12, 10, NULL, 'APPA Switch Gear C', 1, 90.00),
(13, 11, NULL, 'Resistor R2', 1, 0.00),
(14, 12, NULL, 'isialk', 1, 123.00),
(15, 13, NULL, 'aaa', 1, 32.00),
(16, 14, NULL, 'aaa', 1, 21.00),
(17, 15, NULL, 'Vladimir Grant', 1, 945.00),
(18, 16, NULL, 'Resistor R2', 1, 0.00),
(19, 16, NULL, 'ismail', 1, 21.00),
(20, 17, NULL, 'ismail', 1, 23.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `OrderNumber` varchar(50) NOT NULL,
  `SessionID` varchar(255) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `CustomerEmail` varchar(100) NOT NULL,
  `CustomerAddress` text NOT NULL,
  `Total` decimal(10,2) DEFAULT 0.00,
  `CustomerPhone` varchar(20) NOT NULL,
  `PaymentMethod` enum('Credit Card','Bank Transfer','Cash on Delivery') NOT NULL,
  `OrderNotes` text DEFAULT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `Status` enum('Pending','Processing','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `CustomerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderNumber`, `SessionID`, `CustomerName`, `CustomerEmail`, `CustomerAddress`, `Total`, `CustomerPhone`, `PaymentMethod`, `OrderNotes`, `TotalAmount`, `Status`, `CreatedAt`, `CustomerID`) VALUES
(1, 'ORD20250907190931433', '4vvl3t9ricpqc446nhcfn6t4hf', 'Ali', 'ali.rasheed4582@gmail.com', 'Bufferzone', 80.80, '', 'Credit Card', NULL, 0.00, '', '2025-09-07 17:09:31', NULL),
(2, 'ORD20250907204327107', '4vvl3t9ricpqc446nhcfn6t4hf', 'Ali', 'ali.rasheed4582@gmail.com', 'Bufferzone', 0.00, '', 'Credit Card', NULL, 0.00, 'Pending', '2025-09-07 18:43:27', NULL),
(3, 'ORD20250907205439634', '4vvl3t9ricpqc446nhcfn6t4hf', 'Ali', 'ali.rasheed4582@gmail.com', 'NEW ORDER', 0.00, '', 'Credit Card', NULL, 0.00, 'Pending', '2025-09-07 18:54:39', NULL),
(4, 'ORD20250907205937929', '4vvl3t9ricpqc446nhcfn6t4hf', 'Ali', 'ali.rasheed4582@gmail.com', '2nd ORDER', 0.00, '', 'Credit Card', NULL, 0.00, 'Pending', '2025-09-07 18:59:37', NULL),
(5, 'ORD20250907210006590', '4vvl3t9ricpqc446nhcfn6t4hf', 'Ismail Hashmi', 'hashmiismail502@gmail.com', '3rd ORDER', 0.00, '', 'Credit Card', NULL, 0.00, 'Pending', '2025-09-07 19:00:06', NULL),
(6, 'ORD20250907210519863', '4vvl3t9ricpqc446nhcfn6t4hf', 'Ali', 'ali.rasheed4582@gmail.com', 'Order NUmber 4', 90.00, '', 'Credit Card', NULL, 0.00, 'Pending', '2025-09-07 19:05:19', 1),
(7, 'ORD20250907231707879', '4vvl3t9ricpqc446nhcfn6t4hf', 'Ali', 'ali.rasheed4582@gmail.com', 'Bufferzone', 0.00, '', 'Credit Card', NULL, 0.00, 'Completed', '2025-09-07 21:17:07', 1),
(8, 'ORD20250907233029875', '4vvl3t9ricpqc446nhcfn6t4hf', 'Ali', 'ali.rasheed4582@gmail.com', 'ORDER 5', 0.00, '', 'Credit Card', NULL, 0.00, 'Completed', '2025-09-07 21:30:29', 1),
(9, 'ORD20250907234832988', '4vvl3t9ricpqc446nhcfn6t4hf', 'Ali', 'ali.rasheed4582@gmail.com', 'Bufferzone', 0.00, '', 'Credit Card', NULL, 0.00, 'Completed', '2025-09-07 21:48:32', 1),
(10, 'ORD20250907235015607', '4vvl3t9ricpqc446nhcfn6t4hf', 'Ismail Hashmi', 'hashmiismail502@gmail.com', 'Bhdhnsa', 90.00, '', 'Credit Card', NULL, 0.00, 'Completed', '2025-09-07 21:50:15', 1),
(11, 'ORD20250923114535846', '864ld38594ql1lcqnrf8gctqls', 'ismal', 'hashmi@gmail.com', 'hhhh', 0.00, '', 'Credit Card', NULL, 0.00, 'Completed', '2025-09-23 09:45:35', 7),
(12, 'ORD20250925151906806', 'eqpoebrgb00lv0i6n69l0duo30', 'GH', 'HASHMI@GNAIL.COM', '67u', 123.00, '', 'Credit Card', NULL, 0.00, 'Completed', '2025-09-25 13:19:06', 8),
(13, 'ORD20250929115430931', '4p0fglllg1bnb2o8k7b3p6qpt5', 'dd', 'hashmi@gmail.com', 'f', 32.00, '', 'Credit Card', NULL, 0.00, 'Completed', '2025-09-29 09:54:30', NULL),
(14, 'ORD20250929122825676', '4p0fglllg1bnb2o8k7b3p6qpt5', 'dd', 'hashmi@gmail.com', 'gh', 21.00, '', 'Credit Card', NULL, 0.00, 'Completed', '2025-09-29 10:28:25', NULL),
(15, 'ORD20250929145834815', '4p0fglllg1bnb2o8k7b3p6qpt5', 'Sybill Parks', 'merofyxuj@mailinator.com', 'Veniam delectus et', 945.00, '', 'Credit Card', NULL, 0.00, 'Completed', '2025-09-29 12:58:34', NULL),
(16, 'ORD20250929150704238', '4p0fglllg1bnb2o8k7b3p6qpt5', 'Abra Middleton', 'weje@mailinator.com', 'Harum vel nisi ut di', 21.00, '', 'Credit Card', NULL, 0.00, 'Completed', '2025-09-29 13:07:04', 10),
(17, 'ORD20250930144305558', 'o95krpbd081nqpr32534nnmdtc', 'Naida Wolf', 'zagoba@mailinator.com', 'Ad aliquip enim volu', 23.00, '', 'Credit Card', NULL, 0.00, 'Completed', '2025-09-30 12:43:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

CREATE TABLE `productimages` (
  `ImageID` int(11) NOT NULL,
  `ProductID` char(10) NOT NULL,
  `ImagePath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` char(10) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Revision` char(3) NOT NULL,
  `ManufacturingNumber` char(3) NOT NULL,
  `ManufactureDate` date NOT NULL,
  `Status` varchar(50) NOT NULL,
  `ImagePath` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `MainImage` varchar(255) DEFAULT NULL,
  `Datasheet` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Category`, `Revision`, `ManufacturingNumber`, `ManufactureDate`, `Status`, `ImagePath`, `Price`, `MainImage`, `Datasheet`) VALUES
('Enim ab mi', 'Kane Moss', 'Voluptates minim eve', 'Rem', '219', '1998-10-06', 'Discontinued', 'uploads/products/24851_l.jfif', 51.00, NULL, NULL),
('In molesti', 'Whitney Cook', 'Dolor nisi velit et', 'Dis', '891', '1992-06-06', 'Available', 'uploads/products/51133_images.jpg.jfif', 436.00, NULL, NULL),
('Ipsam illo', 'Charde Bonner', 'Recusandae Ducimus', 'Des', '765', '2002-05-04', 'Under Testing', 'uploads/products/52975_img2.jfif', 256.00, NULL, NULL),
('Nostrum ex', 'Quamar Murphy', 'Qui eaque rerum mole', 'Mol', '875', '2004-01-16', 'Discontinued', 'uploads/products/57803_Capacitors.jpg', 999.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ServiceID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Icon` varchar(50) DEFAULT 'bi-gear',
  `ImagePath` varchar(255) DEFAULT NULL,
  `Status` enum('Active','Inactive') DEFAULT 'Active',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ServiceID`, `Title`, `Description`, `Icon`, `ImagePath`, `Status`, `CreatedAt`) VALUES
(11, 'Deserunt hic proiden', 'Necessitatibus dolor', 'Obcaecati in alias v', NULL, 'Active', '2025-10-01 09:32:12'),
(12, 'Ut deserunt harum en', 'Id vel vero delectus', 'Cumque lorem irure s', NULL, 'Active', '2025-10-01 10:31:31'),
(13, 'Reprehenderit bland', 'Consequatur qui reru', 'Voluptatem Vero adi', NULL, 'Active', '2025-10-01 10:31:33'),
(14, 'Consequat At sed vo', 'Eligendi cillum dolo', 'Autem esse ut labor', NULL, 'Active', '2025-10-01 10:31:36'),
(15, 'Sint numquam ea aper', 'Sunt adipisci qui e', 'Incididunt accusanti', NULL, 'Active', '2025-10-01 10:31:41'),
(16, 'Est ut non omnis qui', 'At est in est iusto ', 'Voluptas optio cons', NULL, 'Active', '2025-10-01 10:32:17'),
(17, 'Non qui voluptatibus', 'Atque dicta eos ut c', 'Consequat Corporis ', NULL, 'Active', '2025-10-01 10:32:19'),
(18, 'Qui mollit odio volu', 'Consequatur non eli', 'Nulla sed anim id en', NULL, 'Active', '2025-10-01 10:32:22'),
(19, 'Earum rerum mollit l', 'Quia asperiores blan', 'Quibusdam dolore sit', NULL, 'Active', '2025-10-01 10:32:24'),
(20, 'Ipsum rerum omnis a', 'Non veniam alias li', 'Totam aspernatur ips', NULL, 'Active', '2025-10-01 10:32:27'),
(21, 'Cupidatat placeat q', 'Do ex in animi Nam ', 'Minus incididunt ill', NULL, 'Active', '2025-10-01 10:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `TestimonialID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Company` varchar(100) DEFAULT NULL,
  `Quote` text NOT NULL,
  `ImagePath` varchar(255) DEFAULT NULL,
  `Status` enum('Active','Inactive') DEFAULT 'Active',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`TestimonialID`, `Name`, `Company`, `Quote`, `ImagePath`, `Status`, `CreatedAt`) VALUES
(1, 'Sarah Khan', 'TechCorp', 'SRS’s testing services ensured our equipment met all standards!', 'assets/images/testimonial1.jpg', 'Active', '2025-09-01 07:44:18'),
(2, 'John Lee', 'IndusPower', 'Their capacitors are top-notch, backed by rigorous testing.', 'assets/images/testimonial2.jpg', 'Active', '2025-09-01 07:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `testingdepartments`
--

CREATE TABLE `testingdepartments` (
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testingdepartments`
--

INSERT INTO `testingdepartments` (`DepartmentID`, `DepartmentName`) VALUES
(1, 'Electrical Testing'),
(2, 'Mechanical Testing'),
(3, 'Environmental Testing');

-- --------------------------------------------------------

--
-- Table structure for table `testingstatus`
--

CREATE TABLE `testingstatus` (
  `StatusID` int(11) NOT NULL,
  `TestID` char(12) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `StatusDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `TestID` char(12) NOT NULL,
  `ProductID` char(10) NOT NULL,
  `TestName` varchar(100) NOT NULL,
  `TestCode` char(3) NOT NULL,
  `TestRollNumber` char(3) NOT NULL,
  `TestDate` date NOT NULL,
  `TestingDepartmentID` int(11) NOT NULL,
  `TestResult` varchar(10) NOT NULL,
  `Remarks` text DEFAULT NULL,
  `TestedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`TestID`, `ProductID`, `TestName`, `TestCode`, `TestRollNumber`, `TestDate`, `TestingDepartmentID`, `TestResult`, `Remarks`, `TestedBy`) VALUES
('Sunt vero se', 'Nostrum ex', 'Echo Hays', 'Arc', '275', '1980-08-12', 3, 'Pass', 'Ut tempor rerum cons', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL DEFAULT '12345'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Role`, `Password`) VALUES
(5, 'Ismail', 'Engineer', '$2y$10$5jm5J5G11CqMxP8cGJBbkuw6nNFjYl.j.vuhPZgRrtmWYxa5zJiXy'),
(6, 'Ali Rasheed', 'Manager', '$2y$10$BSHQvBVWQTqeEb5VbhkEMugbrkFLgxfGLA.wHud2c.KpcTgokHhlC'),
(8, 'Hafsa', 'Supervisor', '$2y$10$SVkHOUmMlkVe/hVh3e22Nu8uLFQN9ywGwKXHB5LgevISMnraf18Ra'),
(10, 'Hasnain', 'Tester', '$2y$10$afoWoIZIpQe6IJ5nEhLBXuv8RlM/9b.OFs0GVG8fs74q2P3XUGQme');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`CartItemID`),
  ADD KEY `CartID` (`CartID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`CartID`);

--
-- Indexes for table `contactmessages`
--
ALTER TABLE `contactmessages`
  ADD PRIMARY KEY (`MessageID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `featuredproducts`
--
ALTER TABLE `featuredproducts`
  ADD PRIMARY KEY (`FeatureID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`ImageID`);

--
-- Indexes for table `heromessages`
--
ALTER TABLE `heromessages`
  ADD PRIMARY KEY (`MessageID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`);

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`MissionID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`OrderItemID`),
  ADD KEY `orderitems_ibfk_product` (`ProductID`),
  ADD KEY `orderitems_ibfk_order` (`OrderID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD UNIQUE KEY `OrderNumber` (`OrderNumber`),
  ADD KEY `fk_orders_customer` (`CustomerID`);

--
-- Indexes for table `productimages`
--
ALTER TABLE `productimages`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`TestimonialID`);

--
-- Indexes for table `testingdepartments`
--
ALTER TABLE `testingdepartments`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `testingstatus`
--
ALTER TABLE `testingstatus`
  ADD PRIMARY KEY (`StatusID`),
  ADD KEY `TestID` (`TestID`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`TestID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `TestingDepartmentID` (`TestingDepartmentID`),
  ADD KEY `TestedBy` (`TestedBy`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `CartItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contactmessages`
--
ALTER TABLE `contactmessages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `featuredproducts`
--
ALTER TABLE `featuredproducts`
  MODIFY `FeatureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `heromessages`
--
ALTER TABLE `heromessages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `missions`
--
ALTER TABLE `missions`
  MODIFY `MissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `productimages`
--
ALTER TABLE `productimages`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `TestimonialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testingdepartments`
--
ALTER TABLE `testingdepartments`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testingstatus`
--
ALTER TABLE `testingstatus`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD CONSTRAINT `cartitems_ibfk_1` FOREIGN KEY (`CartID`) REFERENCES `carts` (`CartID`) ON DELETE CASCADE,
  ADD CONSTRAINT `cartitems_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;

--
-- Constraints for table `featuredproducts`
--
ALTER TABLE `featuredproducts`
  ADD CONSTRAINT `featuredproducts_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderitems_ibfk_order` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderitems_ibfk_product` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customer` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`) ON DELETE SET NULL;

--
-- Constraints for table `productimages`
--
ALTER TABLE `productimages`
  ADD CONSTRAINT `productimages_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `testingstatus`
--
ALTER TABLE `testingstatus`
  ADD CONSTRAINT `testingstatus_ibfk_1` FOREIGN KEY (`TestID`) REFERENCES `tests` (`TestID`) ON DELETE CASCADE;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  ADD CONSTRAINT `tests_ibfk_2` FOREIGN KEY (`TestingDepartmentID`) REFERENCES `testingdepartments` (`DepartmentID`),
  ADD CONSTRAINT `tests_ibfk_3` FOREIGN KEY (`TestedBy`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
