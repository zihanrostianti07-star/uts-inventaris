CREATE DATABASE IF NOT EXISTS inventaris;
USE inventaris;

CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL,
    keterangan VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(20) NOT NULL,
    nama_barang VARCHAR(150) NOT NULL,
    merk VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    gambar VARCHAR(255) NOT NULL DEFAULT ''
);

CREATE TABLE IF NOT EXISTS supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_supplier VARCHAR(20) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(50) NOT NULL,
    gambar VARCHAR(255) NOT NULL DEFAULT ''
);

INSERT INTO kategori (nama_kategori, keterangan) VALUES
('Elektronik', 'Perangkat elektronik dan komputer'),
('Furnitur', 'Meja, kursi, dan perabot kantor'),
('ATK', 'Alat tulis kantor dan perlengkapan habis pakai');

INSERT INTO barang (kode_barang, nama_barang, merk, kategori) VALUES
('BR001', 'Laptop', 'Asus', 'Elektronik'),
('BR002', 'Printer', 'Epson', 'Elektronik'),
('BR003', 'Proyektor', 'Epson', 'Elektronik'),
('BR004', 'Meja Kerja', 'Olympic', 'Furnitur'),
('BR005', 'Kursi Kantor', 'Chitose', 'Furnitur'),
('BR006', 'Spidol Whiteboard', 'Snowman', 'ATK'),
('BR007', 'Kertas A4', 'Sidu', 'ATK');

INSERT INTO supplier (kode_supplier, nama, email, no_hp) VALUES
('SP001', 'PT Sinar Jaya', 'sinarjaya@gmail.com', '081234567801'),
('SP002', 'CV Maju Bersama', 'majubersama@gmail.com', '081234567802'),
('SP003', 'Toko Elektronik Purwakarta', 'tokoelektronik@gmail.com', '081234567803'),
('SP004', 'UD Berkah Furnitur', 'berkahfurnitur@gmail.com', '081234567804'),
('SP005', 'PT Alat Tulis Nusantara', 'atknusantara@gmail.com', '081234567805'),
('SP006', 'CV Sumber Rezeki', 'sumberrezeki@gmail.com', '081234567806');
