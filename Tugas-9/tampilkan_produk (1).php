<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Produk</title>
<style>
    body { font-family: Arial, sans-serif; background:#1e2a78; color:#fff; padding:40px; }
    h2 { margin-bottom:5px; }
    .topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
    .topbar a { color:#0f1745; background:#f2c94c; padding:8px 14px; border-radius:5px; text-decoration:none; font-weight:bold; }
    .filter { margin-bottom:25px; }
    select, button { padding:8px; border-radius:5px; border:none; }
    button { background:#f2c94c; font-weight:bold; cursor:pointer; margin-left:5px; }
    table { width:100%; border-collapse:collapse; background:#16205c; }
    th, td { padding:10px; text-align:left; border-bottom:1px solid #3a4694; vertical-align:middle; }
    th { background:#0f1745; }
    img.thumb { width:50px; height:50px; object-fit:cover; border-radius:5px; }
    .kosong { padding:15px; color:#ffd166; }
    .aksi a { margin-right:8px; padding:5px 10px; border-radius:5px; text-decoration:none; font-size:13px; font-weight:bold; }
    .btn-edit { background:#56ccf2; color:#0f1745; }
    .btn-hapus { background:#ff6b6b; color:#fff; }
    .btn-cart { background:#6fcf97; color:#0f1745; }
    .notif { background:#274690; padding:10px; border-radius:5px; margin-bottom:15px; }
</style>
</head>
<body>

<div class="topbar">
    <h2>Daftar Produk E-Commerce</h2>
    <div>
        <a href="form_input.php">+ Tambah Produk</a>
        <a href="keranjang.php">Keranjang</a>
    </div>
</div>

<?php
include "koneksi.php";

// Notifikasi setelah hapus/update/tambah keranjang
if (isset($_GET['pesan'])) {
    echo '<div class="notif">' . htmlspecialchars($_GET['pesan']) . '</div>';
}

// ---------- AMBIL DAFTAR KATEGORI UNTUK DROPDOWN FILTER ----------
$kategori_list = $conn->query("SELECT DISTINCT kategori FROM products ORDER BY kategori");

// ---------- CEK APAKAH ADA FILTER YANG DIPILIH ----------
$kategori_dipilih = isset($_GET['kategori']) ? $_GET['kategori'] : '';

echo '<form method="GET" action="" class="filter">';
echo '<label for="kategori">Filter Kategori: </label>';
echo '<select name="kategori" id="kategori">';
echo '<option value="">-- Semua Kategori --</option>';

while ($row = $kategori_list->fetch_assoc()) {
    $selected = ($kategori_dipilih == $row['kategori']) ? 'selected' : '';
    echo "<option value=\"{$row['kategori']}\" $selected>{$row['kategori']}</option>";
}

echo '</select>';
echo '<button type="submit">Terapkan</button>';
echo '</form>';

// ---------- QUERY DENGAN FILTER (prepared statement) ----------
if ($kategori_dipilih !== '') {
    $stmt = $conn->prepare("SELECT * FROM products WHERE kategori = ? ORDER BY id");
    $stmt->bind_param("s", $kategori_dipilih);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM products ORDER BY id");
}

// ---------- TAMPILKAN DATA MENGGUNAKAN LOOPING PHP (READ) ----------
if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>Gambar</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>';

    while ($produk = $result->fetch_assoc()) {
        $gambar = $produk['gambar'] ? 'uploads/' . htmlspecialchars($produk['gambar']) : 'https://via.placeholder.com/50?text=No+Img';

        echo '<tr>';
        echo '<td><img class="thumb" src="' . $gambar . '" alt="' . htmlspecialchars($produk['nama_produk']) . '"></td>';
        echo '<td>' . htmlspecialchars($produk['nama_produk']) . '</td>';
        echo '<td>' . htmlspecialchars($produk['kategori']) . '</td>';
        echo '<td>Rp' . number_format($produk['harga'], 0, ',', '.') . '</td>';
        echo '<td>' . $produk['stok'] . '</td>';
        echo '<td class="aksi">';
        echo '<a class="btn-edit" href="edit_produk.php?id=' . $produk['id'] . '">Edit</a>';
        echo '<a class="btn-hapus" href="hapus_produk.php?id=' . $produk['id'] . '" onclick="return confirm(\'Yakin mau hapus produk ini?\')">Hapus</a>';
        echo '<a class="btn-cart" href="tambah_keranjang.php?id=' . $produk['id'] . '">+ Keranjang</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p class="kosong">Tidak ada produk untuk kategori ini.</p>';
}

$conn->close();
?>

</body>
</html>
