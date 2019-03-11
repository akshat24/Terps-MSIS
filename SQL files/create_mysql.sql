
CREATE TABLE TerpsMSIS.Alumni
(
alumniID CHAR(7) NOT NULL,
alumniFName VARCHAR(25) NOT NULL,
alumniMName VARCHAR(25),
alumniLName VARCHAR(25) NOT NULL,
gender CHAR,
ethnicity VARCHAR(30),
streetAddress VARCHAR(50),
city VARCHAR(30),
state VARCHAR(30),
country VARCHAR(30),
zipcode VARCHAR(10),
countryCode VARCHAR(4),
alumniPhoneNo CHAR(10),
yearOfPassing CHAR(4) NOT NULL,
dOB DATE,
linkedInURL VARCHAR(100),
CONSTRAINT pk_Alumni_alumniID PRIMARY KEY (alumniID)
);

CREATE TABLE TerpsMSIS.Company(
companyID CHAR(6) NOT NULL,
companyName VARCHAR(50) NOT NULL,
industry VARCHAR(30),
CONSTRAINT pk_Company_companyID PRIMARY KEY (companyID));

CREATE TABLE TerpsMSIS.Skill(
skillID CHAR(7) NOT NULL,
skillName VARCHAR(50) NOT NULL,
skillType VARCHAR(50),
CONSTRAINT pk_Skill_skillID PRIMARY KEY (skillID));

CREATE TABLE TerpsMSIS.University(
universityID CHAR(6) NOT NULL,
universityName VARCHAR(150) NOT NULL,
CONSTRAINT pk_University_universityID PRIMARY KEY (universityID));

CREATE TABLE TerpsMSIS.Major(
majorID CHAR(4) NOT NULL,
majorName VARCHAR(80) NOT NULL,
CONSTRAINT pk_Major_majorID PRIMARY KEY (majorID));

CREATE TABLE TerpsMSIS.Course(
courseID CHAR(8) NOT NULL,
courseName VARCHAR(150) NOT NULL,
CONSTRAINT pk_Course_courseID PRIMARY KEY (courseID));

CREATE TABLE TerpsMSIS.Requires(
companyID CHAR(6) NOT NULL,
skillID CHAR(7) NOT NULL,
CONSTRAINT pk_Requires_companyID_skillID PRIMARY KEY (companyID,skillID),
CONSTRAINT fk_Requires_companyID FOREIGN KEY (companyID)
	REFERENCES TerpsMSIS.Company (companyID)
	ON DELETE NO ACTION ON UPDATE CASCADE,
CONSTRAINT fk_Requires_skillID FOREIGN KEY (skillID)
	REFERENCES TerpsMSIS.Skill (skillID)
	ON DELETE NO ACTION ON UPDATE CASCADE);

CREATE TABLE TerpsMSIS.Taken(
alumniID CHAR(7) NOT NULL,
courseID CHAR(8) NOT NULL,
CONSTRAINT pk_Taken_alumniID_courseID PRIMARY KEY (alumniID,courseID),
CONSTRAINT fk_Taken_alumniID FOREIGN KEY (alumniID)
	REFERENCES TerpsMSIS.Alumni(alumniID)
	ON DELETE NO ACTION ON UPDATE CASCADE,
CONSTRAINT fk_Taken_courseID FOREIGN KEY (courseID)
	REFERENCES TerpsMSIS.Course(courseID)
	ON DELETE NO ACTION ON UPDATE CASCADE);

CREATE TABLE TerpsMSIS.Possess(
alumniID CHAR(7) NOT NULL,
skillID CHAR(7) NOT NULL,
CONSTRAINT pk_Possess_alumniID_skillID PRIMARY KEY (alumniID,skillID),
CONSTRAINT fk_Possess_alumniID FOREIGN KEY (alumniID)
	REFERENCES TerpsMSIS.Alumni(alumniID)
	ON DELETE NO ACTION ON UPDATE CASCADE,
CONSTRAINT fk_Possess_skillID FOREIGN KEY (skillID)
	REFERENCES TerpsMSIS.Skill(skillID)
	ON DELETE NO ACTION ON UPDATE CASCADE);

CREATE TABLE TerpsMSIS.Hires
(
alumniID CHAR(7) NOT NULL,
companyID CHAR(6) NOT NULL,
workStartDate DATE,
workEndDate DATE,
type CHAR(10),
salary DECIMAL(10),
title VARCHAR(50),
department VARCHAR(25),
location VARCHAR(25),
CONSTRAINT pk_Hires_alumniID_companyID PRIMARY KEY (alumniID,companyID),
CONSTRAINT fk_Hires_alumniID FOREIGN KEY (alumniID)
REFERENCES TerpsMSIS.Alumni (alumniID)
ON DELETE NO ACTION ON UPDATE CASCADE,
CONSTRAINT fk_Hires_companyID FOREIGN KEY (companyID)
REFERENCES TerpsMSIS.Company (companyID)
ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE TerpsMSIS.Study
(
alumniID CHAR(7) NOT NULL,
universityID CHAR(6) NOT NULL,
majorID CHAR(4) NOT NULL,
universityStartDate DATE,
universityEndDate DATE,
degreeEarned VARCHAR(25),
CONSTRAINT pk_Study_alumniID_universityID_majorID PRIMARY KEY (alumniID,universityID,majorID),
CONSTRAINT fk_Study_alumniID FOREIGN KEY (alumniID)
REFERENCES TerpsMSIS.Alumni (alumniID)
ON DELETE NO ACTION ON UPDATE CASCADE,
CONSTRAINT fk_Study_universityID FOREIGN KEY (universityID)
REFERENCES TerpsMSIS.University (universityID)
ON DELETE NO ACTION ON UPDATE CASCADE,
CONSTRAINT fk_Study_majorID FOREIGN KEY (majorID)
REFERENCES TerpsMSIS.Major (majorID)
ON DELETE NO ACTION ON UPDATE CASCADE
);