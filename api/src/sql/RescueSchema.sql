-- Create Rescue database
-- -----------------------------------------------------
DROP DATABASE IF EXISTS RESCUE ;

CREATE DATABASE IF NOT EXISTS RESCUE DEFAULT CHARACTER SET utf8 ;
USE RESCUE ;
-- -----------------------------------------------------

-- Users
-- -----------------------------------------------------
DROP TABLE IF EXISTS USERS ;

CREATE TABLE IF NOT EXISTS USERS (
  USER_ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
  USER_NAME VARCHAR(45) NOT NULL,
  USER_EMAIL VARCHAR(45) NOT NULL,
  CONSTRAINT USER_PK PRIMARY KEY (USER_ID)
);
-- -----------------------------------------------------

-- Institutions
-- -----------------------------------------------------
DROP TABLE IF EXISTS INSTITUTIONS ;

CREATE TABLE IF NOT EXISTS INSTITUTIONS (
  INST_ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
  INST_CNPJ VARCHAR(18) NOT NULL,
  INST_DESCRIPTION VARCHAR(255) NULL,
  USER_ID INT UNSIGNED NOT NULL,
  CONSTRAINT INST_PK PRIMARY KEY (INST_ID),
  CONSTRAINT INST_USER_FK FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID)
);
-- -----------------------------------------------------

-- People
-- -----------------------------------------------------
DROP TABLE IF EXISTS PEOPLE ;

CREATE TABLE IF NOT EXISTS PEOPLE (
  PEOP_ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
  PEOP_CPF VARCHAR(18) NOT NULL,
  USER_ID INT UNSIGNED NOT NULL,
  CONSTRAINT PEOP_PK PRIMARY KEY (PEOP_ID),
  CONSTRAINT PEOP_USER_FK FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID)
);
-- -----------------------------------------------------

-- Address
-- -----------------------------------------------------
DROP TABLE IF EXISTS ADDRESS ;

CREATE TABLE IF NOT EXISTS ADDRESS (
  ADDR_ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
  ADDR_CEP VARCHAR(9) NULL,
  ADDR_STATE VARCHAR(30) NULL,
  ADDR_CITY VARCHAR(30) NULL,
  ADDR_PUBLIC_PLACE VARCHAR(45) NULL,
  USER_ID INT UNSIGNED NOT NULL,
  CONSTRAINT ADDR_PK PRIMARY KEY (ADDR_ID),
  CONSTRAINT ADDR_USER_FK FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID)
);
-- -----------------------------------------------------

-- Posts
-- -----------------------------------------------------
DROP TABLE IF EXISTS POSTS ;

CREATE TABLE IF NOT EXISTS POSTS (
  POST_ID INT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  POST_TITLE VARCHAR(45) NOT NULL,
  POST_DESCRIPTION VARCHAR(45) NOT NULL,
  POST_VERIFIED TINYINT(1) NOT NULL,
  POST_ENDED_AT DATE NULL,
  POST_CREATED_AT DATE NOT NULL,
  USER_ID INT UNSIGNED NOT NULL,
  CONSTRAINT POST_PK PRIMARY KEY (POST_ID),
  CONSTRAINT POST_USER_FK FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID)
);
-- -----------------------------------------------------

-- Photos
-- -----------------------------------------------------
DROP TABLE IF EXISTS PHOTOS ;

CREATE TABLE IF NOT EXISTS PHOTOS (
  PHOT_ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
  PHOT_PATH VARCHAR(255) NOT NULL,
  POST_ID INT UNSIGNED ZEROFILL NOT NULL,
  CONSTRAINT POST_PK PRIMARY KEY (PHOT_ID),
  CONSTRAINT PHOT_POST_FK FOREIGN KEY (POST_ID) REFERENCES POSTS (POST_ID)
);
-- -----------------------------------------------------

-- Locations
-- -----------------------------------------------------
DROP TABLE IF EXISTS LOCATIONS ;

CREATE TABLE IF NOT EXISTS LOCATIONS (
  LOC_ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
  LOC_LATITUDE DECIMAL(9,9) NULL,
  LOC_LONGITUDE DECIMAL(9,9) NULL,
  LOC_ZOOM INT NULL,
  LOC_REGION VARCHAR(45) NOT NULL,
  POST_ID INT UNSIGNED ZEROFILL NOT NULL,
  CONSTRAINT LOC_PK PRIMARY KEY (LOC_ID),
  CONSTRAINT LOC_POST_FK FOREIGN KEY (POST_ID) REFERENCES POSTS (POST_ID)
);
-- -----------------------------------------------------

-- Comments
-- -----------------------------------------------------
DROP TABLE IF EXISTS COMMENTS ;

CREATE TABLE IF NOT EXISTS COMMENTS (
  POST_ID INT UNSIGNED ZEROFILL NOT NULL,
  USER_ID INT UNSIGNED NOT NULL,
  COMT_DESCRIPTION VARCHAR(255) NOT NULL,
  CONSTRAINT COMT_PK PRIMARY KEY (POST_ID, USER_ID),
  CONSTRAINT COMT_POST_FK FOREIGN KEY (POST_ID) REFERENCES POSTS (POST_ID),
  CONSTRAINT COMT_USER_FK FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID)
);
-- -----------------------------------------------------