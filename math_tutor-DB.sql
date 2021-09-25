CREATE SCHEMA IF NOT EXISTS mathTutor;
USE mathTutor;

DROP TABLE IF EXISTS records;
DROP TABLE IF EXISTS questions ;
DROP TABLE IF EXISTS courses ;
DROP TABLE IF EXISTS studentInfo ;
DROP TABLE IF EXISTS teacherInfo ;
DROP TABLE IF EXISTS login ;
DROP PROCEDURE IF EXISTS signUp ;
DROP PROCEDURE IF EXISTS forgotPassword ;
DROP PROCEDURE IF EXISTS deleteCourse ;
DROP PROCEDURE IF EXISTS getStudentProgress ;
DROP PROCEDURE IF EXISTS getEnrolled ;


CREATE TABLE `studentInfo` (
    `studentStarID` VARCHAR(8) PRIMARY KEY UNIQUE,
    `lastName` VARCHAR(255),
    `firstName` VARCHAR(255),
    `courseID` VARCHAR(255),
    `role` VARCHAR(7)
);

CREATE TABLE `teacherInfo` (
    `teacherStarID` VARCHAR(8) PRIMARY KEY UNIQUE,
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
    `teacherStarID` VARCHAR(8) UNIQUE,
    `courseName` VARCHAR(255) UNIQUE
);

CREATE TABLE `questions` (
    `ID` INT PRIMARY KEY AUTO_INCREMENT,
    `courseID` INT,
    `studentStarID` VARCHAR(8),
    `questionNumber` INT,
    `questionType` INT,
    `isOverride` BOOLEAN
);

CREATE TABLE `records` (
    `ID` INT PRIMARY KEY AUTO_INCREMENT,
    `questionID` INT,
    `studentStarID` VARCHAR(8),
    `courseID` INT
);


ALTER TABLE `login` ADD FOREIGN KEY (`starID`) REFERENCES `info` (`starID`);
ALTER TABLE `courses` ADD FOREIGN KEY (`teacherStarID`) REFERENCES `info` (`starID`);
ALTER TABLE `questions` ADD FOREIGN KEY (`studentStarID`) REFERENCES `info` (`starID`);
ALTER TABLE `questions` ADD FOREIGN KEY (`courseID`) REFERENCES `courses` (`ID`);
ALTER TABLE `records` ADD FOREIGN KEY (`questionID`) REFERENCES `questions` (`ID`);
ALTER TABLE `records` ADD FOREIGN KEY (`studentStarID`) REFERENCES `info` (`starID`);
ALTER TABLE `records` ADD FOREIGN KEY (`courseID`) REFERENCES `courses` (`ID`);
ALTER TABLE `info` ADD FOREIGN KEY (`courseID`) REFERENCES `courses` (`ID`);

DELIMITER $$
CREATE PROCEDURE `signUp`(
IN star_ID VARCHAR(8), 
IN lName VARCHAR (255), 
IN fName VARCHAR (255), 
IN role VARCHAR (14), 
IN uName VARCHAR (255), 
IN pWord VARCHAR(255)
)
BEGIN

    INSERT INTO mathTutor.info (starID, lastName, firstName, role )
    VALUES (star_ID, lName, fName, role);

    INSERT INTO mathTutor.login (starID, userName, password)
    VALUES (star_ID, uName, pWord);
    
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `forgotPassword`(
IN star_ID VARCHAR(8), 
IN pWord VARCHAR(255)
)
BEGIN

    UPDATE mathTutor.login
    SET password = pWord 
    WHERE starID = star_ID;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `deleteCourse`(
IN cName VARCHAR(255)
)
BEGIN

	SET @courseID = (SELECT ID FROM mathTutor.courses WHERE courseName = cName);
    DELETE FROM mathTutor.records WHERE courseID = courseID;
    DELETE FROM mathTutor.questions WHERE courseID = courseID;
    DELETE FROM mathTutor.courses WHERE courseID = courseID;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `getStudentProgress`(
IN ssID VARCHAR(8)
)
BEGIN

	SET @questionID = (SELECT COUNT(*) FROM mathTutor.courses WHERE studentStarID = ssID);
	SET @cName = (SELECT courseName FROM mathTutor.courses WHERE studentStarID = ssID);
    SET @recordID = (SELECT COUNT(*) FROM mathTutor.records WHERE studentStarID = ssID);
    
    SET @percentComplete = (@questionID/@recordID) * 100;
    
    IF (@cName LIKE '' OR @recordID LIKE 0) THEN
		SELECT '';
	ELSE
		SELECT @percentComplete;
	END IF;

END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `getEnrolled`(
IN tsID VARCHAR(8)
)
BEGIN

	SET @cID = (SELECT ID FROM mathTutor.courses WHERE teacherStarID = tsID);
	SET @firstName = (SELECT firstName FROM mathTutor.info WHERE starID = (SELECT studentStarID FROM mathTutor.questions WHERE courseID = @cID));
	SET @lastName = (SELECT lastName FROM mathTutor.info WHERE starID = (SELECT studentStarID FROM mathTutor.questions WHERE courseID = @cID));
	SET @correctQ = (SELECT COUNT(*) FROM mathTutor.records WHERE studentStarID = (SELECT studentStarID FROM mathTutor.records WHERE courseID = @cID)) ;
    SELECT @cID, @firstName, @lastName, @correctQ;

END$$
DELIMITER ;

