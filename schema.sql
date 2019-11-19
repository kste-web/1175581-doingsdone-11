CREATE DATABASE doingsdone
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE doingsdone;

CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	email VARCHAR(128) NOT NULL UNIQUE,
	name VARCHAR(128) NOT NULL UNIQUE,
	password CHAR(128) NOT NULL 
);

CREATE TABLE tasks (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	status TINYINT UNSIGNED DEFAULT 0,
	name VARCHAR(128) NOT NULL UNIQUE,
	file VARCHAR(128) NOT NULL, 
	dt_do TIMESTAMP,
	user_id INT,
	project_id INT
);	

CREATE TABLE projects (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(128) NOT NULL UNIQUE,
	user_id INT
);