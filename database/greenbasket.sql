CREATE DATABASE IF NOT EXISTS greenbasket;
USE greenbasket;
CREATE TABLE users(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,email VARCHAR(150) UNIQUE NOT NULL,password VARCHAR(255) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE products(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(120) NOT NULL,category VARCHAR(60),description TEXT,price DECIMAL(10,2) NOT NULL,emoji VARCHAR(10),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE orders(id INT AUTO_INCREMENT PRIMARY KEY,customer_name VARCHAR(100),email VARCHAR(150),address TEXT,total DECIMAL(10,2),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
INSERT INTO products(name,category,description,price,emoji) VALUES
('Fresh Broccoli','Vegetables','Crisp farm-fresh broccoli.',80,'🥦'),
('Red Apples','Fruits','Sweet and crunchy apples.',160,'🍎'),
('Organic Milk','Dairy','Fresh everyday milk.',65,'🥛'),
('Whole Wheat Bread','Bakery','Soft whole wheat bread.',55,'🍞'),
('Fresh Tomatoes','Vegetables','Juicy red tomatoes.',50,'🍅'),
('Bananas','Fruits','Naturally sweet bananas.',60,'🍌');