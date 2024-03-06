-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 06:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`, `email`) VALUES
(1, 'Bsamh', '1212', 'Bsamh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `name`, `description`) VALUES
(1, 'Adventures', 'An adventure is an exciting experience or undertaking that is typically bold, sometimes risky. Adventures may be activities with danger such as traveling, exploring, skydiving, mountain climbing, scuba diving, river rafting, or other extreme sport.'),
(2, 'Workshops & classes', 'A workshop is a building that contains tools or machinery for making or repairing things.'),
(3, 'Sports', 'an activity involving physical exertion and skill in which an individual or team competes against another or others for entertainment:'),
(4, 'Other experiences', 'Other experiences and fun activities.');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `LOGO` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `LOGO`, `description`, `CategoryID`) VALUES
(1, 'Edge of the World Day Trip.', '1685206533.jpg', 'Experience phenomenal views from the Edge of the World viewpoint. Gaze at the panoramic view from the 300-meter-high cliffs overlooking a vast rocky landscape. Tuck into a light meal and learn about Saudi culture as you watch the sunset on this day trip.', 1),
(2, 'Desert Quad Bike', '1685206594.jpg', 'Experience the thrill of dune bashing aboard a quad bike on a guided trip to the Riyadh desert. Escape from the hustle and bustle of the city and dive into the desert to ride across the red dunes.', 1),
(3, 'Valley Padel.', '1685206770.jpg', 'Feel like playing padel tennis in Riyadh surrounded by mountains? Valley Padel is located in Wadi Hanifa and is fully surrounded by the unique rock monuments in the area. Prices for one class start from SAR330 for 90 minutes while private training courses per person start at SAR350.\r\nFrom SAR330. Wadi Hanifa.', 3),
(4, 'Lift.', '1685208126.jpg', 'Looking for an amazing art experience in the capital? HRH Princess Nouf bint Abdulaziz Al Saud just launched an art gallery called Nine by Lift.\r\n\r\nLift KSA is an exclusive social club designed for artists, art-lovers and creative minds to relax. Nine by Lift offers a unique opportunity to interact with local designers and artists. The gallery will be showcasing everything from abayas and gowns to accessories and jewellery.', 2),
(5, 'Archery Range', '1685208358.jpg', 'Learn how to throw your first arrow at Archery Range and compete with your friends Additional Experiences: - SMASH Room - Carnival games - Smashing Plates.', 3),
(6, 'BOBs Famous', '1685208542.jpg', 'Bowling where you and your friend enjoy in 16 lanes, delicious food.', 3),
(7, 'Doos Karting', '1685208631.jpg', 'Looking for an unusual experience? Get an adrenaline rush on top speed 80 km/h. Come and experience the thrill of facing off against other enthusiastic motorsport fans at our indoor Go Karting circuit. Doos Karting is KSA’s first-ever indoor electric Go-Karting track, so be the first one to experience it. Female and male participants are welcome to try this exciting and competitive activity with friends and family. Doos Karting is also fit for people of all ages, so don’t leave your kids behind. If you’re looking for the perfect family getaway event, then this electric indoor go-karting activity is what you need.', 3),
(8, 'Escape The Room', '1685208732.jpg', 'Heat up your day with the Scorched escape room experience in downtown St. Petersburg. You and your group will have one hour to solve puzzles, decipher clues, and escape this room designed by Outerlife Studios. Immerse yourself in the story of a young boy exiled to his room, featuring special effects, props, and unique designs that’ll challenge you to solve the mystery before time runs out.', 1),
(9, 'Stargazing in the Desert', '1685208883.jpg', 'Travel from Riyadh to admire the stars over the desert. Sit around a bonfire as you enjoy dinner. Discover constellations with your guide and listen to stories about the history of the area.', 1),
(10, 'Cup and Cat', '1685209138.jpg', 'A place where you can rest your mind , drink your coffee , and enjoy the company of our adorable cats.', 4),
(11, 'Ahaji', '1685209424.jpg', 'Games. A unique collection of escape rooms. We guarantee you an enjoyable experience in rooms full of puzzles, secrets and surprises.\n', 1),
(12, 'Al Wadi Stables.', '1685212677.jpg', 'Al Wadi Stable Project was one of our challenging projects, designed in 2021 for the Al Wadi Stable Sports Company in Riyadh, Saudi Arabia. The total area spans over 40,000 sqm, and the client brief helped us experiment with our creative liberties and design spaces that reflect the local architecture, which has steadily evolved over the years. The primary objective of the project was to facilitate and contribute towards the advancement of equestrian sport in the Kingdom. The project comprises an equestrian academy, multi-use buildings, and areas designated for the ruling class and public visitors. The site, features seven prominent indoor and outdoor racetracks, with more than 53 rooms/shelter halls for the horses.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `body` text NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Id`, `item_id`, `name`, `body`, `rating`) VALUES
(1, 9, 'Sarah', 'I loved this place!', 5),
(3, 12, 'Jana', 'lovely', 4),
(4, 11, 'Abdullah', 'amazing', 4),
(5, 10, 'Noni', 'Nice', 2),
(6, 8, 'Ahmad', 'wonderful', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
