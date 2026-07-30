<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Produk</title>
<style>
    body { font-family: Arial, sans-serif; background:#1e2a78; color:#fff; padding:40px; }
    h2 { margin-bottom:5px; }
    .filter { margin-bottom:25px; }
    select, button { padding:8px; border-radius:5px; border:none; }
    button { background:#f2c94c; font-weight:bold; cursor:pointer; margin-left:5px; }
    table { width:100%; border-collapse:collapse; background:#16205c; }
    th, td { padding:10px; text-align:left; border-bottom:1px solid #3a4694; }
    th { background:#0f1745; }
    .kosong { padding:15px; color:#ffd166; }
</style>
</head>
<body>

<h2>Daftar Produk E-Commerce</h2>

<?php
include "koneksi.php";

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

// ---------- QUERY DENGAN FILTER (prepared statement, aman dari SQL injection) ----------
if ($kategori_dipilih !== '') {
    $stmt = $conn->prepare("SELECT * FROM products WHERE kategori = ? ORDER BY id");
    $stmt->bind_param("s", $kategori_dipilih);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM products ORDER BY id");
}

// ---------- TAMPILKAN DATA MENGGUNAKAN LOOPING PHP ----------
if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>ID</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Deskripsi</th></tr>';

    while ($produk = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $produk['id'] . '</td>';
        echo '<td>' . htmlspecialchars($produk['nama_produk']) . '</td>';
        echo '<td>' . htmlspecialchars($produk['kategori']) . '</td>';
        echo '<td>Rp' . number_format($produk['harga'], 0, ',', '.') . '</td>';
        echo '<td>' . $produk['stok'] . '</td>';
        echo '<td>' . htmlspecialchars($produk['deskripsi']) . '</td>';
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
