SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- Database: `travel`
-- Only one student DB
CREATE DATABASE IF NOT EXISTS `mindsight1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mindsight1`;



DROP TABLE IF EXISTS `reflection`;
CREATE TABLE `reflection` (
  `Day` mediumint(8) UNSIGNED NOT NULL,
  `customerID` mediumint(8) UNSIGNED NOT NULL,
  `step1` longtext NOT NULL,
  `step2` longtext NOT NULL,
  `step3` longtext NOT NULL,
  `step4` longtext NOT NULL,  
  `date` datetime NOT NULL,  
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `user_table`;
CREATE TABLE `user_table` (
  `customerID` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password_hash` char(255) NOT NULL,
  `customer_forename` varchar(255) NOT NULL,
  `customer_surname` varchar(255) NOT NULL,
  `customer_address1` varchar(255) NOT NULL,
  `customer_address2` varchar(255) DEFAULT NULL,
  `date_of_birth` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `user_table`
  ADD PRIMARY KEY (`customerID`);

ALTER TABLE `reflection`
  ADD PRIMARY KEY (`day`);

ALTER TABLE `user_table`
  MODIFY `customerID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;