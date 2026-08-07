<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Produk</title>
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

<h2>Edit Produk</h2>
<p><a href="tampilkan_produk.php">&laquo; Kembali ke daftar produk</a></p>

<?php
include "koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$errors = [];

// ---------- PROSES UPDATE ----------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id          = (int) $_POST['id'];
    $nama_produk = trim($_POST['nama_produk']);
    $harga       = trim($_POST['harga']);
    $deskripsi   = trim($_POST['deskripsi']);
    $kategori    = trim($_POST['kategori']);
    $stok        = trim($_POST['stok']);

    // ---------- VALIDASI ----------
    if (empty($nama_produk)) $errors[] = "Nama produk tidak boleh kosong.";
    if ($harga === '' || !is_numeric($harga) || $harga <= 0) $errors[] = "Harga harus angka lebih dari 0.";
    if (empty($deskripsi)) $errors[] = "Deskripsi tidak boleh kosong.";
    if (empty($kategori)) $errors[] = "Kategori tidak boleh kosong.";
    if ($stok === '' || !is_numeric($stok) || $stok < 0) $errors[] = "Stok harus angka dan tidak boleh negatif.";

    if (count($errors) === 0) {
        $stmt = $conn->prepare("UPDATE products SET nama_produk=?, harga=?, deskripsi=?, kategori=?, stok=? WHERE id=?");
        $stmt->bind_param("sdssii", $nama_produk, $harga, $deskripsi, $kategori, $stok, $id);
        $stmt->execute();
        $stmt->close();

        header("Location: tampilkan_produk.php?pesan=" . urlencode("Produk '$nama_produk' berhasil diperbarui."));
        exit;
    }
}

// ---------- AMBIL DATA PRODUK YANG MAU DIEDIT ----------
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$produk = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$produk) {
    echo "<p class='error'>Produk tidak ditemukan.</p>";
    $conn->close();
    exit;
}

if (count($errors) > 0) {
    echo '<div class="error">';
    foreach ($errors as $err) echo "- $err<br>";
    echo '</div>';
}
?>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $produk['id'] ?>">

    <label for="nama_produk">Nama Produk</label>
    <input type="text" name="nama_produk" id="nama_produk" value="<?= htmlspecialchars($_POST['nama_produk'] ?? $produk['nama_produk']) ?>">

    <label for="deskripsi">Deskripsi Produk</label>
    <textarea name="deskripsi" id="deskripsi" rows="3"><?= htmlspecialchars($_POST['deskripsi'] ?? $produk['deskripsi']) ?></textarea>

    <label for="harga">Harga Produk</label>
    <input type="number" name="harga" id="harga" value="<?= htmlspecialchars($_POST['harga'] ?? $produk['harga']) ?>">

    <label for="stok">Stok</label>
    <input type="number" name="stok" id="stok" value="<?= htmlspecialchars($_POST['stok'] ?? $produk['stok']) ?>">

    <label for="kategori">Kategori</label>
    <input type="text" name="kategori" id="kategori" value="<?= htmlspecialchars($_POST['kategori'] ?? $produk['kategori']) ?>">

    <button type="submit">Simpan Perubahan</button>
</form>

<?php $conn->close(); ?>

</body>
</html>
