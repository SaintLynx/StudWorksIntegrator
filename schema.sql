DROP DATABASE IF EXISTS studentsworks;
CREATE DATABASE studentsworks
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE studentsworks;

CREATE TABLE studentsworkstable (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_name VARCHAR(128),
  year_of_study INT,
  group VARCHAR(64),
  supervisor VARCHAR(128),
  work_name TEXT NOT NULL,
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
);