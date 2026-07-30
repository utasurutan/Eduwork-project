-- ============================================
-- 1. BUAT DATABASE E-COMMERCE
-- ============================================
CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- --------------------------------------------
-- Tabel products
-- --------------------------------------------
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    deskripsi TEXT,
    stok INT NOT NULL DEFAULT 0,
    kategori VARCHAR(50) NOT NULL DEFAULT 'Umum'
);

-- Data contoh biar ada isinya waktu ditampilkan
INSERT INTO products (nama_produk, harga, deskripsi, stok, kategori) VALUES
('Keyboard Mechanical', 450000, 'Keyboard mechanical switch blue, RGB backlight', 25, 'Aksesoris'),
('Mouse Wireless', 150000, 'Mouse wireless dengan sensor presisi tinggi', 40, 'Aksesoris'),
('Laptop Ultrabook', 8500000, 'Laptop ringan dengan performa tinggi', 10, 'Elektronik'),
('Headset Gaming', 300000, 'Headset dengan surround sound dan mic noise cancelling', 15, 'Aksesoris'),
('Smartphone Android', 3200000, 'Smartphone dengan kamera 108MP', 20, 'Elektronik');

-- --------------------------------------------
-- Tabel users
-- --------------------------------------------
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- --------------------------------------------
-- Tabel orders
-- --------------------------------------------
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);


-- ============================================
-- 2. QUERY CRUD UNTUK DATA PRODUK
-- ============================================

-- ---------- CREATE (Menambah data produk) ----------
INSERT INTO products (nama_produk, harga, deskripsi, stok)
VALUES ('Keyboard Mechanical', 450000, 'Keyboard mechanical switch blue, RGB backlight', 25);

-- ---------- READ (Membaca data produk) ----------
-- Ambil semua produk
SELECT * FROM products;

-- Ambil satu produk berdasarkan id
SELECT * FROM products WHERE id = 1;

-- Cari produk berdasarkan nama (like search)
SELECT * FROM products WHERE nama_produk LIKE '%keyboard%';

-- ---------- UPDATE (Mengubah data produk) ----------
UPDATE products
SET harga = 400000, stok = 30
WHERE id = 1;

-- ---------- DELETE (Menghapus data produk) ----------
DELETE FROM products
WHERE id = 1;
