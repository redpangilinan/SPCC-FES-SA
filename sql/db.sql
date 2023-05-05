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
        faculty_name VARCHAR(255) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        school_year VARCHAR(10) NOT NULL,
        semester VARCHAR(20) NOT NULL,
        access_code VARCHAR(12) NOT NULL,
        permit JSON NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

ALTER TABLE `tb_evaluations` ADD UNIQUE(`access_code`);

CREATE TABLE
    tb_reports (
        report_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        evaluation_id INT UNSIGNED NOT NULL,
        student_id INT UNSIGNED NOT NULL,
        rating DECIMAL(3,2) NOT NULL,
        comment TEXT,
        responses JSON,
        sentiment VARCHAR(10),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (evaluation_id) REFERENCES tb_evaluations(evaluation_id),
        FOREIGN KEY (student_id) REFERENCES tb_users(user_id)
    );

CREATE TABLE
    tb_verification (
        verification_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        verification_code VARCHAR(10) NOT NULL,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

ALTER TABLE `tb_verification` ADD UNIQUE(`email`);

CREATE TABLE
    tb_activation_codes (
        activation_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        activation_code VARCHAR(32) NOT NULL,
        activation_type VARCHAR(10) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

ALTER TABLE `tb_activation_codes` ADD UNIQUE(`activation_code`);

CREATE TABLE
    tb_api_keys (
        api_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT UNSIGNED NOT NULL,
        api_name VARCHAR(60) NOT NULL,
        key_value VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES tb_users(user_id)
    );

CREATE TABLE
    tb_students (
        student_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        firstname VARCHAR(50) NOT NULL,
        lastname VARCHAR(50) NOT NULL,
        section VARCHAR(50) NOT NULL
    );

ALTER TABLE `tb_students` ADD UNIQUE(`email`);