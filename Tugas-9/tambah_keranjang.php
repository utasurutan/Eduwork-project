<?php
// tambah_keranjang.php
// TUGAS CART: Tambahkan produk ke keranjang belanja

session_start();
include "koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Pastikan keranjang sudah ada di session
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Ambil data produk dari database
$stmt = $conn->prepare("SELECT id, nama_produk, harga FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$produk = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

if ($produk) {
    // Kalau produk sudah ada di keranjang, tambah quantity-nya
    if (isset($_SESSION['keranjang'][$id])) {
        $_SESSION['keranjang'][$id]['quantity']++;
    } else {
        $_SESSION['keranjang'][$id] = [
            'nama_produk' => $produk['nama_produk'],
            'harga'       => $produk['harga'],
            'quantity'    => 1
        ];
    }
    $pesan = "Produk '{$produk['nama_produk']}' ditambahkan ke keranjang.";
} else {
    $pesan = "Produk tidak ditemukan.";
}

header("Location: tampilkan_produk.php?pesan=" . urlencode($pesan));
exit;
?>
