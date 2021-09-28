CREATE DATABASE hospital;

USE hospital;

CREATE TABLE IF NOT EXISTS `user`(
  user_id INT(6) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  email VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(500)
)
