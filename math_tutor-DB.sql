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
    `studentStarID` VARCHAR(8) NULL,
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
    WHERE studentStarID = ssID;
    
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
	SET @countQ = (SELECT COUNT(*) FROM mathTutor.questions WHERE courseID = (SELECT courseID FROM mathTutor.studentInfo WHERE studentStarID = ssID) AND isOverride = false);
	SET @cName = (SELECT courseName FROM mathTutor.courses WHERE courseID = (SELECT courseID FROM mathTutor.studentInfo WHERE studentStarID = ssID));
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
	(SELECT SI.firstName, SI.lastName, R.completedQuestions FROM mathTutor.studentInfo AS SI
		LEFT JOIN (SELECT studentStarID, courseID, COUNT(studentStarID) AS completedQuestions FROM mathTutor.records group by studentStarID, courseID) AS R on R.studentStarID = SI.studentStarID
		WHERE R.courseID = @cID);

END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `signin`(
IN uName VARCHAR (255), 
IN pWord VARCHAR(255)
)
BEGIN

	set @studentCheck = (SELECT studentStarID FROM studentInfo WHERE userName = uName AND password = pWord);
	set @teacherCheck = (SELECT teacherStarID FROM teacherInfo WHERE userName = uName AND password = pWord);
    IF @studentCheck IS NULL THEN
		SELECT @teacherCheck AS starID;
	ELSE
	   SELECT @studentCheck AS starID;
	END IF;

END$$
DELIMITER ;

INSERT INTO `mathtutor`.`teacherinfo` (`teacherStarID`, `lastName`, `firstName`, `userName`, `password`) VALUES ('1', 'Bada', 'Sully', 'sbada', '1');
INSERT INTO `mathtutor`.`teacherinfo` (`teacherStarID`, `lastName`, `firstName`, `userName`, `password`) VALUES ('2', 'and', 'some', 'andsome', '1');
INSERT INTO `mathtutor`.`courses` (`courseID`, `teacherStarID`, `courseName`) VALUES ('1', '1', 'sully class');
INSERT INTO `mathtutor`.`courses` (`courseID`, `teacherStarID`, `courseName`) VALUES ('2', '2', 'and some class');
INSERT INTO `mathtutor`.`studentinfo` (`studentStarID`, `lastName`, `firstName`, `courseID`, `userName`, `password`) VALUES ('3', 'a', 'student', '1', 'guest', '1');
INSERT INTO `mathtutor`.`studentinfo` (`studentStarID`, `lastName`, `firstName`, `courseID`, `userName`, `password`) VALUES ('4', 'second', 'student', '2', 'gest', '2');
INSERT INTO `mathtutor`.`studentinfo` (`studentStarID`, `lastName`, `firstName`, `courseID`, `userName`, `password`) VALUES ('5', 'adf', 'asdf', '1', 'gestg', 'asg');
INSERT INTO `mathtutor`.`studentinfo` (`studentStarID`, `lastName`, `firstName`, `courseID`, `userName`, `password`) VALUES ('6', 'afds', 'afgas', '2', 'gag', 'gsa');
INSERT INTO `mathtutor`.`studentinfo` (`studentStarID`, `lastName`, `firstName`, `courseID`, `userName`, `password`) VALUES ('7', 'ljkko', 'lknsg', '1', 'wl', 'l');
INSERT INTO `mathtutor`.`studentinfo` (`studentStarID`, `lastName`, `firstName`, `courseID`, `userName`, `password`) VALUES ('8', 'lnbkl', 'oinag', '2', 'lfjasd', 'lsafd');
INSERT INTO `mathtutor`.`questions` (`questionID`, `courseID`, `questionNumber`, `questionType`, `isOverride`) VALUES ('1', '1', '1', '2', '0');
INSERT INTO `mathtutor`.`questions` (`questionID`, `courseID`, `questionNumber`, `questionType`, `isOverride`) VALUES ('2', '1', '1', '3', '0');
INSERT INTO `mathtutor`.`questions` (`questionID`, `courseID`, `questionNumber`, `questionType`, `isOverride`) VALUES ('3', '1', '1', '2', '0');
INSERT INTO `mathtutor`.`questions` (`questionID`, `courseID`, `questionNumber`, `questionType`, `isOverride`) VALUES ('4', '1', '1', '3', '0');
INSERT INTO `mathtutor`.`questions` (`questionID`, `courseID`, `questionNumber`, `questionType`, `isOverride`) VALUES ('5', '1', '1', '2', '0');
INSERT INTO `mathtutor`.`questions` (`questionID`, `courseID`, `questionNumber`, `questionType`, `isOverride`) VALUES ('6', '1', '1', '3', '0');
INSERT INTO `mathtutor`.`questions` (`questionID`, `courseID`, `questionNumber`, `questionType`, `isOverride`) VALUES ('7', '1', '1', '2', '0');
INSERT INTO `mathtutor`.`questions` (`questionID`, `courseID`, `questionNumber`, `questionType`, `isOverride`) VALUES ('8', '1', '1', '3', '0');
INSERT INTO `mathtutor`.`records` (`recordsID`, `questionID`, `studentStarID`, `courseID`) VALUES ('1', '1', '3', '1');
