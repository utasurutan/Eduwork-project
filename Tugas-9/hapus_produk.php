<?php
// hapus_produk.php
// TUGAS CRUD: DELETE

include "koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {
    // Ambil dulu nama produknya buat pesan konfirmasi
    $stmt = $conn->prepare("SELECT nama_produk FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $produk = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($produk) {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        $pesan = "Produk '{$produk['nama_produk']}' berhasil dihapus.";
    } else {
        $pesan = "Produk tidak ditemukan.";
    }
} else {
    $pesan = "ID produk tidak valid.";
}

$conn->close();
header("Location: tampilkan_produk.php?pesan=" . urlencode($pesan));
exit;
?>
