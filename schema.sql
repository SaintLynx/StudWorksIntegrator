-- Создаем базу данных, задаем ей параметры
DROP DATABASE IF EXISTS studentsworks;
CREATE DATABASE studentsworks
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE studentsworks;

-- Создаем таблицу, которая будет заполняться данными из формы для студентов
CREATE TABLE studentsworkstable (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_name VARCHAR(128) NOT NULL,
  year_of_study INT,
  supervisor_name VARCHAR(128),
  work_name TEXT NOT NULL,
  user_id INT UNIQUE,
  work_file VARCHAR(128),
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Создаем таблицу для выпадающего списка научных руководителей на странице для преподавателей(есть строка с выбором "всех")
CREATE TABLE supervisors_select (
  id INT AUTO_INCREMENT PRIMARY KEY,
  supervisor_name VARCHAR(128) ,
  supervisor_code INT
);

-- Создаем таблицу для выпадающего списка курсов
CREATE TABLE years_of_study (
  id INT AUTO_INCREMENT PRIMARY KEY,
  year_of_study INT
);

-- Создаем таблицу с карточками научных руководителей
CREATE TABLE supervisor_cards (
  id INT AUTO_INCREMENT PRIMARY KEY,
  supervisor_name VARCHAR(128),
  supervisor_photo VARCHAR(128),
  supervisor_status VARCHAR(128),
  supervisor_interests VARCHAR(255),
  supervisor_site VARCHAR(255)
);

-- Создаем БД пользователей
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_surname VARCHAR(128),
  user_name VARCHAR(128),
  user_last_name VARCHAR(128),
  user_email VARCHAR(128) NOT NULL UNIQUE,
  user_password CHAR(255),
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Создаем таблицу данных Администратора
CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  admin_surname VARCHAR(128),
  admin_name VARCHAR(128),
  admin_password CHAR(255)
);