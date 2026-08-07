<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Produk</title>
<style>
    body { font-family: Arial, sans-serif; background:#1e2a78; color:#fff; padding:40px; }
    form { max-width:400px; }
    label { display:block; margin-top:15px; font-weight:bold; }
    input, textarea { width:100%; padding:8px; margin-top:5px; border-radius:5px; border:none; box-sizing:border-box; }
    button { margin-top:20px; padding:10px 20px; background:#f2c94c; border:none; border-radius:5px; font-weight:bold; cursor:pointer; }
    .error { color:#ff6b6b; font-weight:bold; }
    a { color:#f2c94c; }
</style>
</head>
<body>

<h2>Tambah Produk</h2>
<p><a href="tampilkan_produk.php">&laquo; Kembali ke daftar produk</a></p>

<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    // ---------- UPLOAD GAMBAR (opsional) ----------
    $nama_gambar = null;
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $ekstensi_diizinkan = ['jpg', 'jpeg', 'png', 'gif'];
        $ekstensi = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

        if (!in_array($ekstensi, $ekstensi_diizinkan)) {
            $errors[] = "Format gambar harus jpg, jpeg, png, atau gif.";
        } else {
            $nama_gambar = uniqid() . '.' . $ekstensi;
            $folder_upload = 'uploads/';
            if (!is_dir($folder_upload)) {
                mkdir($folder_upload, 0755, true);
            }
            move_uploaded_file($_FILES['gambar']['tmp_name'], $folder_upload . $nama_gambar);
        }
    }

    if (count($errors) > 0) {
        echo '<div class="error">';
        foreach ($errors as $err) {
            echo "- $err<br>";
        }
        echo '</div>';
    } else {
        // ---------- SIMPAN KE DATABASE (CREATE) ----------
        $stmt = $conn->prepare("INSERT INTO products (nama_produk, harga, deskripsi, stok, kategori, gambar) VALUES (?, ?, ?, 0, ?, ?)");
        $stmt->bind_param("sdsss", $nama_produk, $harga, $deskripsi, $kategori, $nama_gambar);

        if ($stmt->execute()) {
            echo "<p style='color:#6bff8a;'>Produk '$nama_produk' berhasil disimpan!</p>";
        } else {
            echo "<p class='error'>Gagal menyimpan data: " . $conn->error . "</p>";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<form method="POST" action="" enctype="multipart/form-data">
    <label for="nama_produk">Nama Produk</label>
    <input type="text" name="nama_produk" id="nama_produk" placeholder="Contoh: Mouse Wireless">

    <label for="deskripsi">Deskripsi Produk</label>
    <textarea name="deskripsi" id="deskripsi" rows="3" placeholder="Deskripsi singkat produk"></textarea>

    <label for="harga">Harga Produk</label>
    <input type="number" name="harga" id="harga" placeholder="Contoh: 150000">

    <label for="kategori">Kategori</label>
    <input type="text" name="kategori" id="kategori" placeholder="Contoh: Aksesoris">

    <label for="gambar">Upload Gambar</label>
    <input type="file" name="gambar" id="gambar" accept="image/*">

    <button type="submit">Tambah Produk</button>
</form>

</body>
</html>
