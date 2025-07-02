CREATE DATABASE IF NOT EXISTS grocery_db;
USE grocery_db;

CREATE TABLE IF NOT EXISTS groceries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE groceries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL
);
-- Get all groceries
SELECT * FROM groceries;

-- Add a grocery item
INSERT INTO groceries (name, quantity) VALUES (?, ?);

-- Get grocery by ID
SELECT * FROM groceries WHERE id = ?;

-- Update grocery item
UPDATE groceries SET name = ?, quantity = ? WHERE id = ?;

-- Delete grocery item
DELETE FROM groceries WHERE id = ?;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Login: find user by username
SELECT * FROM users WHERE username = ?;

-- Registration: check if username or email already exists
SELECT id FROM users WHERE username = ? OR email = ?;

-- Register a new user
INSERT INTO users (username, email, password) VALUES (?, ?, ?);

CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Get saved cart for user
SELECT item_name, quantity FROM cart_items WHERE user_id = ?;

-- Clear existing cart for user
DELETE FROM cart_items WHERE user_id = ?;

-- Save each item in user's cart
INSERT INTO cart_items (user_id, item_name, quantity) VALUES (?, ?, ?);

