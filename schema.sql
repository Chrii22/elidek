CREATE database IF NOT EXISTS ELIDEK;
USE ELIDEK;

CREATE TABLE IF NOT EXISTS Programme (
    ID int(10) NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    department varchar(50) NOT NULL,
    PRIMARY KEY (ID)
    )ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Field (
    ID int(10) AUTO_INCREMENT,
    name varchar(50) NOT NULL UNIQUE,
    PRIMARY KEY (ID)
    )ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Executive (
    SIN int(10) NOT null AUTO_INCREMENT ,
    firstName varchar(50) NOT NULL,
    lastName varchar(50) NOT NULL,
    birthdate date NOT NULL,
    gender varchar(7) NOT NULL,
    age int(10) as (TIMESTAMPDIFF(YEAR, birthdate, CURDATE())),
    PRIMARY KEY (SIN),
    CONSTRAINT exec1 CHECK (gender in ('male', 'female', 'other'))
    )ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Researcher (
    SIN int(10) NOT NULL AUTO_INCREMENT,
    firstName varchar(50) NOT NULL,
    lastName varchar(50) NOT NULL,
    birthdate date NOT NULL,
    gender varchar(6) NOT NULL CHECK (gender IN ('male', 'female', 'other')),
    age int(10) as (TIMESTAMPDIFF(YEAR, birthdate, CURDATE())),
    PRIMARY KEY (SIN)
    )ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS Organization (
    ID int(10) NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    abbreviation varchar(10) NOT NULL,
    city varchar(50) NOT NULL,
    postalCode int(10) NOT NULL,
    street varchar(50) NOT NULL,
    or_type varchar(16) NOT NULL,
    PRIMARY KEY (ID),
	CHECK (or_type IN ('University', 'Company', 'Research Center'))
    )ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Project (
    ID int(10) NOT NULL AUTO_INCREMENT,
    ProgrammeID int(10) NOT NULL,
    ExecutiveSIN int(10) NOT NULL,
    OrganizationID int(10) NOT NULL,
    ManagerSIN int(10) NOT NULL UNIQUE,
    title varchar(256) NOT NULL,
    summary varchar(1024) NOT NULL,
    startDate date NOT NULL,
    endDate date NOT NULL,
    duration int(10) as (TIMESTAMPDIFF(month, startDate, endDate)),
    amount int(10) NOT NULL,
    PRIMARY KEY (ID),
    INDEX pr_enddate (endDate ASC),
    CONSTRAINT pr_pr2 FOREIGN KEY (ProgrammeID) REFERENCES Programme (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT pr_ex2 FOREIGN KEY (ExecutiveSIN) REFERENCES Executive (SIN) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT pr_or2 FOREIGN KEY (OrganizationID) REFERENCES Organization (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (ManagerSIN) REFERENCES Researcher (SIN) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT CHECK (duration between 12 and 48),
    CONSTRAINT CHECK (amount between 100000 and 1000000)
    )ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Project_Field (
    FieldID int(10) NOT NULL AUTO_INCREMENT,
    ProjectID int(10) NOT NULL,
    PRIMARY KEY (FieldID, ProjectID),
    INDEX field_pr (ProjectID ASC),
    CONSTRAINT field1 FOREIGN KEY (FieldID) REFERENCES Field (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT field2 FOREIGN KEY (ProjectID) REFERENCES Project (ID) ON DELETE CASCADE ON UPDATE CASCADE
    )ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Phone (
    phoneNo int(10) NOT NULL,
    OrganizationID int(10) NOT NULL,
    PRIMARY KEY (phoneNo),
    CONSTRAINT phone1 FOREIGN KEY (OrganizationID) REFERENCES Organization (ID) ON DELETE CASCADE ON UPDATE CASCADE
    )ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Works_on (
    ProjectID int(10) NOT NULL,
    ResearcherSIN int(10) NOT NULL,
    startDate date NOT NULL,
    PRIMARY KEY (ProjectID, ResearcherSIN),
    CONSTRAINT wo1 FOREIGN KEY (ProjectID) REFERENCES Project (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT wo2 FOREIGN KEY (ResearcherSIN) REFERENCES Researcher (SIN) ON DELETE CASCADE ON UPDATE CASCADE
    )ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Works_for (
    ResearcherSIN int(10) NOT null UNIQUE,
    OrganizationID int(10) NOT NULL,
    startDate date NOT NULL,
    PRIMARY KEY (ResearcherSIN),
    CONSTRAINT wf1 FOREIGN KEY (ResearcherSIN) REFERENCES Researcher (SIN) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT wf2 FOREIGN KEY (OrganizationID) REFERENCES Organization (ID) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Evaluation (
    ProjectID int(10) NOT NULL UNIQUE,
    ResearcherSIN int(10) NOT NULL,
    ev_date date NOT NULL,
    grade int(10) NOT NULL,
    PRIMARY KEY (ProjectID),
    CONSTRAINT ev1 FOREIGN KEY (ProjectID) REFERENCES Project (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT ev2 FOREIGN KEY (ResearcherSIN) REFERENCES Researcher (SIN) ON DELETE CASCADE ON UPDATE CASCADE
    )ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Sub_Project (
    ID int(10) NOT NULL AUTO_INCREMENT,
    ProjectID int(10) NOT NULL,
    dueDate date NOT NULL,
    title varchar(128) NOT NULL,
    summary varchar(500) NOT NULL,
    PRIMARY KEY (ID),
    INDEX sub_pr1 (ProjectID ASC),
    CONSTRAINT sub1 FOREIGN KEY (ProjectID) REFERENCES Project (ID) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB;