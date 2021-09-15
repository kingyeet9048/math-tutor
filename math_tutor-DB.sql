CREATE SCHEMA IF NOT EXISTS mathTutor;
USE mathTutor;

DROP TABLE IF EXISTS login ;
DROP TABLE IF EXISTS info ;
DROP TABLE IF EXISTS courses ;

CREATE TABLE `info` (
  `starID` varchar(8) PRIMARY KEY UNIQUE,
  `lastName` varchar(255),
  `firstName` varchar(255),
  `role` varchar(14),
  `email` varchar(255)
);

CREATE TABLE `login` (
	`starID` varchar(8) PRIMARY KEY UNIQUE,
	`userName` varchar(255) UNIQUE,
	`password` varchar(500)
);

CREATE TABLE `courses` (
	`ID` INT PRIMARY KEY AUTO_INCREMENT,
    `starID` varchar(8) UNIQUE,
	`courseName` varchar(500) UNIQUE
);

CREATE TABLE `questions` (
	`ID` INT PRIMARY KEY AUTO_INCREMENT,
    `courseID` INT,
	`questionNumber` INT AUTO_INCREMENT, 
    `questionType` varchar(255)
);


ALTER TABLE `login` ADD FOREIGN KEY (`starID`) REFERENCES `info` (`starID`);
ALTER TABLE `courses` ADD FOREIGN KEY (`starID`) REFERENCES `info` (`starID`);
ALTER TABLE `questions` ADD FOREIGN KEY (`courseID`) REFERENCES `courses` (`ID`);






