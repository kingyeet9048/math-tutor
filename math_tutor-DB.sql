DROP SCHEMA IF EXISTS mathTutor;
CREATE SCHEMA IF NOT EXISTS mathTutor;
USE mathTutor;

DROP TABLE IF EXISTS records;
DROP TABLE IF EXISTS questions ;
DROP TABLE IF EXISTS courses ;
DROP TABLE IF EXISTS studentInfo ;
DROP TABLE IF EXISTS teacherInfo ;
DROP PROCEDURE IF EXISTS signUpStudent ;
DROP PROCEDURE IF EXISTS signUpTeacher ;
DROP PROCEDURE IF EXISTS forgotPasswordStudent ;
DROP PROCEDURE IF EXISTS forgotPasswordTeacher ;
DROP PROCEDURE IF EXISTS deleteCourse ;
DROP PROCEDURE IF EXISTS getStudentProgress ;
DROP PROCEDURE IF EXISTS getEnrolled ;


CREATE TABLE `studentInfo` (
    `studentStarID` VARCHAR(8) PRIMARY KEY UNIQUE,
    `lastName` VARCHAR(255),
    `firstName` VARCHAR(255),
    `courseID` INT,
    `userName` VARCHAR(255) UNIQUE,
    `password` VARCHAR(500)
);

CREATE TABLE `teacherInfo` (
    `teacherStarID` VARCHAR(8) PRIMARY KEY UNIQUE,
    `lastName` VARCHAR(255),
    `firstName` VARCHAR(255),
    `userName` VARCHAR(255) UNIQUE,
    `password` VARCHAR(500)
);

CREATE TABLE `courses` (
    `courseID` INT PRIMARY KEY AUTO_INCREMENT,
    `teacherStarID` VARCHAR(8) UNIQUE,
    `courseName` VARCHAR(255) UNIQUE
);

CREATE TABLE `questions` (
    `questionID` INT PRIMARY KEY AUTO_INCREMENT,
    `courseID` INT,
    `studentStarID` VARCHAR(8),
    `questionNumber` INT,
    `questionType` INT,
    `isOverride` BOOLEAN
);

CREATE TABLE `records` (
    `recordsID` INT PRIMARY KEY AUTO_INCREMENT,
    `questionID` INT,
    `studentStarID` VARCHAR(8),
    `courseID` INT
);


ALTER TABLE `courses` ADD FOREIGN KEY (`teacherStarID`) REFERENCES `teacherInfo` (`teacherStarID`);
ALTER TABLE `questions` ADD FOREIGN KEY (`studentStarID`) REFERENCES `studentInfo` (`studentStarID`);
ALTER TABLE `questions` ADD FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`);
ALTER TABLE `records` ADD FOREIGN KEY (`questionID`) REFERENCES `questions` (`questionID`);
ALTER TABLE `records` ADD FOREIGN KEY (`studentStarID`) REFERENCES `studentInfo` (`studentStarID`);
ALTER TABLE `records` ADD FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`);
ALTER TABLE `studentInfo` ADD FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`);


DELIMITER $$
CREATE PROCEDURE `signUpTeacher`(
IN star_ID VARCHAR(8), 
IN lName VARCHAR (255), 
IN fName VARCHAR (255),
IN uName VARCHAR (255), 
IN pWord VARCHAR(255)
)
BEGIN

    INSERT INTO mathTutor.teacherInfo (teacherStarID, lastName, firstName, userName, password)
    VALUES (star_ID, lName, fName, uName, pWord);
    
END$$
DELIMITER ;


DELIMITER $$
CREATE PROCEDURE `signUpStudent`(
IN star_ID VARCHAR(8), 
IN lName VARCHAR (255), 
IN fName VARCHAR (255),
IN uName VARCHAR (255), 
IN pWord VARCHAR(255), 
IN cID INT
)
BEGIN

    INSERT INTO mathTutor.studentInfo (studentStarID, lastName, firstName, userName, password, courseID)
    VALUES (star_ID, lName, fName, uName, pWord, cID);
    
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `forgotPasswordTeacher`(
IN tsID VARCHAR(8), 
IN pWord VARCHAR(255)
)
BEGIN

    UPDATE mathTutor.teacherInfo
    SET password = pWord 
    WHERE teacherStarID = tsID;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `forgotPasswordStudent`(
IN ssID VARCHAR(8), 
IN pWord VARCHAR(255)
)
BEGIN

    UPDATE mathTutor.studentInfo
    SET password = pWord 
    WHERE teacherStarID = ssID;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `deleteCourse`(
IN cName VARCHAR(255)
)
BEGIN

	SET @courseID = (SELECT courseID FROM mathTutor.courses WHERE courseName = cName);
    DELETE FROM mathTutor.records WHERE courseID = courseID;
    DELETE FROM mathTutor.questions WHERE courseID = courseID;
    DELETE FROM mathTutor.courses WHERE courseID = courseID;
    DELETE FROM mathTutor.studentInfo WHERE courseID = courseID;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `getStudentProgress`(
IN ssID VARCHAR(8)
)
BEGIN
	SET @countQ = (SELECT COUNT(*) FROM mathTutor.questions WHERE courseID = (SELECT courseID FROM mathTutor.studenInfo WHERE studentStarID = ssID) AND isOverride = false);
	SET @cName = (SELECT courseName FROM mathTutor.courses WHERE courseID = (SELECT courseID FROM mathTutor.studenInfo WHERE studentStarID = ssID));
    SET @countR = (SELECT COUNT(*) FROM mathTutor.records WHERE studentStarID = ssID);
    
    SET @percentComplete = (@countR/@countQ) * 100;
    
    IF (@cName LIKE '' OR @countQ LIKE 0) THEN
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

	SET @cID = (SELECT courseID FROM mathTutor.courses WHERE teacherStarID = tsID);
	SET @enrollment = (SELECT SI.firstName, SI.lastName, COUNT(R.studentStarID) FROM mathTutor.studentInfo AS SI, mathTutor.records AS R
						WHERE SI.studentStarID = R.studentStarID AND R.courseID = @cID);
-- 	SET @correctQ = (SELECT COUNT(*) FROM mathTutor.records WHERE studentStarID = (SELECT studentStarID FROM mathTutor.records WHERE courseID = @cID)) ;
    
    SELECT @enrollment;

END$$
DELIMITER ;

