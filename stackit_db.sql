CREATE DATABASE IF NOT EXISTS stackit_db;
USE stackit_db;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS answers;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(20) DEFAULT 'user'
);

CREATE TABLE IF NOT EXISTS questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  tags VARCHAR(255),
  votes INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS answers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question_id INT NOT NULL,
  user_id INT NOT NULL,
  content TEXT NOT NULL,
  votes INT DEFAULT 0,
  accepted TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert sample users
INSERT INTO users (name, email, password, role) VALUES
('Alice', 'alice@example.com', '$2y$10$G3Q0yV6yxQZ8U2zWr8ciGuFvbmzybDuBkqzvK5ayZ50T48vn5jaQG', 'user'),
('Bob', 'bob@example.com', '$2y$10$G3Q0yV6yxQZ8U2zWr8ciGuFvbmzybDuBkqzvK5ayZ50T48vn5jaQG', 'admin');

-- Insert sample questions
INSERT INTO questions (user_id, title, description, tags) VALUES
(1, 'How do I learn PHP?', 'I want to start with PHP, any resources?', 'php,web'),
(2, 'What is an API?', 'Can someone explain API in simple terms?', 'api,basics');
