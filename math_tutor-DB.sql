CREATE SCHEMA IF NOT EXISTS mathTutor;
USE mathTutor;

DROP TABLE IF EXISTS login ;
DROP TABLE IF EXISTS info ;
DROP TABLE IF EXISTS courses ;
DROP TABLE IF EXISTS questions ;

CREATE TABLE `info` (
    `starID` VARCHAR(8) PRIMARY KEY UNIQUE,
    `lastName` VARCHAR(255),
    `firstName` VARCHAR(255),
    `role` VARCHAR(7)
);

CREATE TABLE `login` (
    `starID` VARCHAR(8) PRIMARY KEY UNIQUE,
    `userName` VARCHAR(255) UNIQUE,
    `password` VARCHAR(500)
);

CREATE TABLE `courses` (
    `ID` INT PRIMARY KEY AUTO_INCREMENT,
    `starID` VARCHAR(8) UNIQUE,
    `courseName` VARCHAR(255) UNIQUE
);

CREATE TABLE `questions` (
    `ID` INT PRIMARY KEY AUTO_INCREMENT,
    `courseID` INT,
    `starID` VARCHAR(8),
    `questionNumber` INT AUTO_INCREMENT,
    `questionType` VARCHAR(255),
    `isOverride` BOOLEAN
);


ALTER TABLE `login` ADD FOREIGN KEY (`starID`) REFERENCES `info` (`starID`);
ALTER TABLE `courses` ADD FOREIGN KEY (`starID`) REFERENCES `info` (`starID`);
ALTER TABLE `questions` ADD FOREIGN KEY (`starID`) REFERENCES `info` (`starID`);
ALTER TABLE `questions` ADD FOREIGN KEY (`courseID`) REFERENCES `courses` (`ID`);