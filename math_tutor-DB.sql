CREATE SCHEMA IF NOT EXISTS mathTutor;
USE mathTutor;

DROP TABLE IF EXISTS login ;
DROP TABLE IF EXISTS info ;

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
	`password` varchar(500),
	`datetime` timestamp
);



ALTER TABLE `login` ADD FOREIGN KEY (`starID`) REFERENCES `info` (`starID`);

DELIMITER $$
CREATE PROCEDURE `signUp`(
IN star_ID VARCHAR(8), 
IN lName VARCHAR (255), 
IN fName VARCHAR (255), 
IN role VARCHAR (14), 
IN email VARCHAR (255),
IN uName VARCHAR (255), 
IN pWord VARCHAR(255)
)
BEGIN

SET time_zone = '-05:00';
    INSERT INTO mathTutor.info (starID, lastName, firstName, role, email )
    VALUES (star_ID, lName, fName, role, email);

    INSERT INTO mathTutor.login (starID, userName, password, datetime)
    VALUES (star_ID, uName, pWord, NOW());
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `insertUser`(
IN star_ID VARCHAR(8), 
IN lName VARCHAR (255), 
IN fName VARCHAR (255), 
IN role VARCHAR (14), 
IN email VARCHAR (255),
IN uName VARCHAR (255), 
IN pWord VARCHAR(255)
)
BEGIN

SET time_zone = '-05:00';
    INSERT INTO mathTutor.all_users (starID, lastName, firstName, role, email )
    VALUES (star_ID, lName, fName, role, email);

    INSERT INTO mathTutor.login (starID, userName, password, datetime)
    VALUES (star_ID, uName, pWord, NOW());
END$$
DELIMITER ;






