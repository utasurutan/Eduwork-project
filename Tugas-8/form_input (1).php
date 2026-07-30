<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Produk</title>
<style>
    body { font-family: Arial, sans-serif; background:#1e2a78; color:#fff; padding:40px; }
    form { max-width:400px; }
    label { display:block; margin-top:15px; font-weight:bold; }
    input, textarea { width:100%; padding:8px; margin-top:5px; border-radius:5px; border:none; }
    button { margin-top:20px; padding:10px 20px; background:#f2c94c; border:none; border-radius:5px; font-weight:bold; cursor:pointer; }
    .error { color:#ff6b6b; font-weight:bold; }
</style>
</head>
<body>

<h2>Tugas Form Input: Tambah Produk Baru</h2>

<?php
// TUGAS 3: TUGAS VALIDASI
// Validasi sederhana memastikan data tidak kosong sebelum disimpan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "koneksi.php";

    // Ambil data dari form
    $nama_produk = trim($_POST['nama_produk']);
    $harga       = trim($_POST['harga']);
    $deskripsi   = trim($_POST['deskripsi']);
    $kategori    = trim($_POST['kategori']);

    $errors = [];

    // ---------- VALIDASI ----------
    if (empty($nama_produk)) {
        $errors[] = "Nama produk tidak boleh kosong.";
    }
    if (empty($harga)) {
        $errors[] = "Harga tidak boleh kosong.";
    } elseif (!is_numeric($harga) || $harga <= 0) {
        $errors[] = "Harga harus berupa angka dan lebih dari 0.";
    }
    if (empty($deskripsi)) {
        $errors[] = "Deskripsi tidak boleh kosong.";
    }
    if (empty($kategori)) {
        $errors[] = "Kategori tidak boleh kosong.";
    }

    if (count($errors) > 0) {
        echo '<div class="error">';
        foreach ($errors as $err) {
            echo "- $err<br>";
        }
        echo '</div>';
    } else {
        // ---------- SIMPAN KE DATABASE (CREATE) ----------
        $stmt = $conn->prepare("INSERT INTO products (nama_produk, harga, deskripsi, stok, kategori) VALUES (?, ?, ?, 0, ?)");
        $stmt->bind_param("sdss", $nama_produk, $harga, $deskripsi, $kategori);

        if ($stmt->execute()) {
            echo "<p style='color:#6bff8a;'>Produk '$nama_produk' berhasil disimpan!</p>";
        } else {
            echo "<p class='error'>Gagal menyimpan data: " . $conn->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<form method="POST" action="">
    <label for="nama_produk">Nama Produk</label>
    <input type="text" name="nama_produk" id="nama_produk" placeholder="Contoh: Mouse Wireless">

    <label for="harga">Harga</label>
    <input type="number" name="harga" id="harga" placeholder="Contoh: 150000">

    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi" rows="3" placeholder="Deskripsi singkat produk"></textarea>

    <label for="kategori">Kategori</label>
    <input type="text" name="kategori" id="kategori" placeholder="Contoh: Aksesoris">

    <button type="submit">Simpan Produk</button>
</form>

</body>
</html>
