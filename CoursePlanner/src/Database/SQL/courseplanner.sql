-- phpMyAdmin SQL Dump
-- version 4.0.10.17
-- https://www.phpmyadmin.net
--
-- Host: courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com:3306
-- Generation Time: Nov 21, 2016 at 11:53 PM
-- Server version: 5.6.27-log
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `courseplanner`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `dept` char(10) NOT NULL,
  `courseID` char(10) DEFAULT NULL,
  `sectionID` char(5) DEFAULT NULL,
  `course_type` char(50) DEFAULT NULL,
  `course_title` char(100) DEFAULT NULL,
  `course_info` char(100) DEFAULT NULL,
  `course_credit` char(5) DEFAULT NULL,
  `course_location` char(15) DEFAULT NULL,
  `course_term` char(100) DEFAULT NULL,
  `course_schedule_term_row1` char(5) DEFAULT NULL,
  `course_schedule_day_row1` char(30) DEFAULT NULL,
  `course_schedule_day_start_row1` char(5) DEFAULT NULL,
  `course_schedule_day_end_row1` char(5) DEFAULT NULL,
  `course_schedule_building_row1` char(50) DEFAULT NULL,
  `course_schedule_room_row1` char(10) DEFAULT NULL,
  `course_schedule_term_row2` char(5) DEFAULT NULL,
  `course_schedule_day_row2` char(30) DEFAULT NULL,
  `course_schedule_day_start_row2` char(5) DEFAULT NULL,
  `course_schedule_day_end_row2` char(5) DEFAULT NULL,
  `course_schedule_building_row2` char(50) DEFAULT NULL,
  `course_schedule_room_row2` char(10) DEFAULT NULL,
  `course_instructors` char(100) DEFAULT NULL,
  `course_book1` char(200) DEFAULT NULL,
  `course_book2` char(200) DEFAULT NULL,
  `course_book3` char(200) DEFAULT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18099 ;

-- --------------------------------------------------------

--
-- Table structure for table `Unique Calendar Entry`
--

CREATE TABLE IF NOT EXISTS `Unique Calendar Entry` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `courseID` int(10) unsigned DEFAULT NULL,
  `Title` varchar(100) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Info` varchar(750) NOT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `Start` varchar(10) DEFAULT NULL,
  `End` varchar(10) DEFAULT NULL,
  `BColour` varchar(12) NOT NULL,
  `TColour` varchar(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `User ID` (`userID`),
  KEY `courseID` (`courseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

-- --------------------------------------------------------

--
-- Table structure for table `User Profile`
--

CREATE TABLE IF NOT EXISTS `User Profile` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  `Registration_Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fbID` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `fbID` (`fbID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1020 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Unique Calendar Entry`
--
ALTER TABLE `Unique Calendar Entry`
  ADD CONSTRAINT `Unique Calendar Entry_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Unique Calendar Entry_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `User Profile` (`ID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
