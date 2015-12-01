DROP DATABASE IF EXISTS loginData;
CREATE DATABASE loginData;

USE loginData;

DROP TABLE IF EXISTS users;
CREATE TABLE users(
  id int PRIMARY KEY AUTO_INCREMENT,
  fullname varchar(20) NOT NULL,
  email varchar(80) NOT NULL ,
  tel varchar(15) NOT NULL ,
  username varchar(20) NOT NULL UNIQUE ,
  passwordHash varchar(255) NOT NULL ,
  timeAdded timestamp DEFAULT current_timestamp
)
