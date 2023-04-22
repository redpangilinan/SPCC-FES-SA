CREATE DATABASE fesdb;

USE fesdb;

CREATE TABLE
    tb_users (
        user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_type ENUM('admin', 'faculty', 'student') NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(60) NOT NULL,
        firstname VARCHAR(50) NOT NULL,
        lastname VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

ALTER TABLE `tb_users` ADD UNIQUE(`email`);

CREATE TABLE
    tb_categories (
        category_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        category VARCHAR(255) NOT NULL,
        weight TINYINT UNSIGNED NOT NULL CHECK (
            weight BETWEEN 0 AND 100
        )
    );

ALTER TABLE `tb_categories` ADD UNIQUE(`category`);

CREATE TABLE
    tb_questions (
        question_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        category_id INT UNSIGNED NOT NULL,
        question VARCHAR(255) NOT NULL,
        FOREIGN KEY (category_id) REFERENCES tb_categories(category_id)
    );

CREATE TABLE
    tb_evaluations (
        evaluation_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        faculty_id INT UNSIGNED NOT NULL,
        semester VARCHAR(255) NOT NULL,
        access_code VARCHAR(255) NOT NULL,
        expiration_date DATE NOT NULL,
        FOREIGN KEY (faculty_id) REFERENCES tb_users(user_id),
        UNIQUE (faculty_id)
    );

CREATE TABLE
    tb_reports (
        report_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        evaluation_id INT UNSIGNED NOT NULL,
        student_id INT UNSIGNED NOT NULL,
        rating FLOAT NOT NULL,
        comment TEXT,
        responses JSON,
        sentiment JSON,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (evaluation_id) REFERENCES tb_evaluations(evaluation_id),
        FOREIGN KEY (student_id) REFERENCES tb_users(user_id)
    );

CREATE TABLE
    tb_verification (
        verification_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        otp INT(6) NOT NULL,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );