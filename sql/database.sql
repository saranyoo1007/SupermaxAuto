-- SuperMax Auto - MySQL Database Schema
-- สร้าง Database: supermax_auto
-- ===================================

CREATE DATABASE IF NOT EXISTS supermax_auto 
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE supermax_auto;

-- ===============================
-- Admin Users Table
-- ===============================
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Insert default admin user (password: supermax2023)
INSERT INTO admin_users (username, password) VALUES 
('admin', '$2y$10$VPuYJvqLqZQ8RqRkYlcCDefJHN3Q0uvzuZMp7RZyHQNqL2xElGGdC');


-- ===============================
-- Categories Table
-- ===============================
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    name_en VARCHAR(100),
    icon VARCHAR(50),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ===============================
-- Services Table
-- ===============================
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    name_en VARCHAR(100),
    description TEXT,
    price_start DECIMAL(10,2),
    price_end DECIMAL(10,2),
    duration VARCHAR(50),
    icon VARCHAR(50),
    image VARCHAR(255),
    is_featured TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ===============================
-- Products Table
-- ===============================
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(200) NOT NULL,
    brand VARCHAR(100),
    description TEXT,
    price DECIMAL(10,2),
    original_price DECIMAL(10,2),
    image VARCHAR(255),
    specs VARCHAR(100),
    is_featured TINYINT(1) DEFAULT 0,
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ===============================
-- Promotions Table
-- ===============================
CREATE TABLE IF NOT EXISTS promotions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    discount_percent INT,
    discount_amount DECIMAL(10,2),
    image VARCHAR(255),
    start_date DATE,
    end_date DATE,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ===============================
-- Contacts Table
-- ===============================
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ===============================
-- INSERT Sample Data
-- ===============================

-- Categories
INSERT INTO categories (name, name_en, icon, description) VALUES
('ยางรถยนต์', 'Tires', 'fa-circle', 'ยางรถยนต์คุณภาพสูงทุกยี่ห้อ'),
('น้ำมันเครื่อง', 'Engine Oil', 'fa-oil-can', 'น้ำมันเครื่องแท้ทุกเกรด'),
('แบตเตอรี่', 'Battery', 'fa-car-battery', 'แบตเตอรี่รถยนต์คุณภาพดี'),
('อะไหล่', 'Parts', 'fa-cogs', 'อะไหล่รถยนต์ทุกชนิด');

-- Services
INSERT INTO services (name, name_en, description, price_start, price_end, duration, icon, is_featured) VALUES
('เปลี่ยนยางรถยนต์', 'Tire Change', 'บริการเปลี่ยนยางรถยนต์ทุกขนาด พร้อมบริการตั้งศูนย์ถ่วงล้อฟรี', 200, 500, '30-60 นาที', 'fa-circle', 1),
('เปลี่ยนน้ำมันเครื่อง', 'Oil Change', 'บริการเปลี่ยนถ่ายน้ำมันเครื่องพร้อมไส้กรอง ด้วยน้ำมันเครื่องคุณภาพสูง', 500, 2500, '20-30 นาที', 'fa-oil-can', 1),
('ตั้งศูนย์ล้อ', 'Wheel Alignment', 'บริการตั้งศูนย์ล้อด้วยเครื่องมือทันสมัย ช่วยยืดอายุยางและเพิ่มความปลอดภัย', 500, 800, '45-60 นาที', 'fa-cog', 1),
('ถ่วงล้อ', 'Wheel Balancing', 'บริการถ่วงล้อป้องกันอาการสั่นของพวงมาลัย', 100, 200, '15-20 นาที', 'fa-sync', 1),
('เช็คสภาพรถ', 'Car Inspection', 'บริการตรวจเช็คสภาพรถยนต์ฟรี 20 รายการ', 0, 0, '30 นาที', 'fa-clipboard-check', 0),
('เปลี่ยนแบตเตอรี่', 'Battery Change', 'บริการเปลี่ยนแบตเตอรี่รถยนต์พร้อมรับประกัน', 2000, 5000, '15-20 นาที', 'fa-car-battery', 0);

-- Products
INSERT INTO products (category_id, name, brand, description, price, original_price, specs, is_featured, stock) VALUES
(1, 'ยาง Michelin Primacy 4', 'Michelin', 'ยางรถยนต์ระดับพรีเมียม นุ่มเงียบ ทนทาน', 4500, 5200, '195/65R15', 1, 20),
(1, 'ยาง Bridgestone Turanza', 'Bridgestone', 'ยางนุ่มสบาย เหมาะกับรถเก๋ง', 3800, 4200, '195/65R15', 1, 15),
(1, 'ยาง Goodyear Assurance', 'Goodyear', 'ยางประหยัด คุณภาพดี ราคาคุ้มค่า', 2900, 3200, '195/65R15', 0, 25),
(1, 'ยาง Continental CC6', 'Continental', 'ยางเยอรมัน คุณภาพสูง', 5200, 5800, '195/65R15', 1, 10),
(2, 'น้ำมันเครื่อง Shell Helix Ultra', 'Shell', 'น้ำมันเครื่องสังเคราะห์แท้ 100%', 1800, 2200, '5W-40 4L', 1, 30),
(2, 'น้ำมันเครื่อง Mobil 1', 'Mobil', 'น้ำมันเครื่องเกรดพรีเมียม', 2200, 2500, '0W-40 4L', 1, 20),
(2, 'น้ำมันเครื่อง Castrol Edge', 'Castrol', 'น้ำมันเครื่องสมรรถนะสูง', 1600, 1900, '5W-30 4L', 0, 25),
(3, 'แบตเตอรี่ 3K', '3K', 'แบตเตอรี่คุณภาพไทย รับประกัน 2 ปี', 2500, 2800, '65Ah', 1, 15),
(3, 'แบตเตอรี่ FB', 'FB', 'แบตเตอรี่ทนทาน รับประกัน 18 เดือน', 2200, 2500, '60Ah', 0, 20),
(3, 'แบตเตอรี่ GS', 'GS', 'แบตเตอรี่มาตรฐานญี่ปุ่น', 2800, 3200, '70Ah', 1, 12);

-- Promotions
INSERT INTO promotions (title, description, discount_percent, start_date, end_date, is_active) VALUES
('ลดสูงสุด 30% ยาง Michelin', 'โปรโมชั่นพิเศษ ยาง Michelin ทุกรุ่น ลดสูงสุด 30% พร้อมติดตั้งฟรี', 30, '2024-01-01', '2025-12-31', 1),
('เปลี่ยนน้ำมันเครื่อง ฟรี! เช็คสภาพรถ 20 รายการ', 'เปลี่ยนน้ำมันเครื่องกับเรา รับบริการเช็คสภาพรถฟรี 20 รายการ', 0, '2024-01-01', '2025-12-31', 1),
('ซื้อยาง 4 เส้น รับส่วนลด 500 บาท', 'ซื้อยางครบ 4 เส้น รับส่วนลดเพิ่มอีก 500 บาท', 0, '2024-01-01', '2025-12-31', 1),
('แบตเตอรี่ลดพิเศษ 20%', 'โปรโมชั่นแบตเตอรี่ลดราคาพิเศษ 20% ทุกยี่ห้อ', 20, '2024-01-01', '2025-12-31', 1);
