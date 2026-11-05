DROP DATABASE IF EXISTS blesk_db;
CREATE DATABASE blesk_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE blesk_db;


CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100),
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(150) NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);


CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE statuses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);


CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    desired_date DATE NOT NULL,
    desired_time TIME NOT NULL,
    service_id INT NOT NULL,
    payment_method_id INT NOT NULL,
    status_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (service_id) REFERENCES services(id),
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id),
    FOREIGN KEY (status_id) REFERENCES statuses(id)
);


CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL UNIQUE,
    rating INT NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (application_id) REFERENCES applications(id)
);


INSERT INTO roles (name) VALUES ('user'), ('admin');
INSERT INTO statuses (name) VALUES ('Новая'), ('В работе'), ('Выполнено'), ('Отменено');
INSERT INTO services (name) VALUES ('Общий клининг'), ('Генеральная уборка'), ('Послестроительная уборка'), ('Химчистка ковров и мебели');
INSERT INTO payment_methods (name) VALUES ('Наличными'), ('Банковской картой');

INSERT INTO users (role_id, login, password_hash, last_name, first_name, middle_name, phone, email) 
VALUES (
    2,
    'Admin', 
    '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe1HlyQ08t21K.W3jXl2L8Kln6Oq5.E6W', 
    'Администратор', 
    'Главный', 
    '', 
    '8(999)123-45-67', 
    'admin@blesk.ru'
);