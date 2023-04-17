DROP DATABASE IF EXISTS studentsworks;
CREATE DATABASE studentsworks
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE studentsworks;

CREATE TABLE studentsworkstable (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_name VARCHAR(128) NOT NULL,
  year_of_study INT,
  supervisor_name VARCHAR(128),
  work_name TEXT NOT NULL,
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE supervisors_list (
  id INT AUTO_INCREMENT PRIMARY KEY,
  supervisor_name VARCHAR(128) ,
  supervisor_code INT
);

CREATE TABLE supervisors_select (
  id INT AUTO_INCREMENT PRIMARY KEY,
  supervisor_name VARCHAR(128) ,
  supervisor_code INT
);

CREATE TABLE years_of_study (
  id INT AUTO_INCREMENT PRIMARY KEY,
  year_of_study INT
);