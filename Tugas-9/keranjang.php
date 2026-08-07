<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Keranjang Belanja</title>
<style>
    body { font-family: Arial, sans-serif; background:#1e2a78; color:#fff; padding:40px; }
    h2 { margin-bottom:5px; }
    a.back { color:#f2c94c; }
    table { width:100%; border-collapse:collapse; background:#16205c; margin-top:20px; }
    th, td { padding:10px; text-align:left; border-bottom:1px solid #3a4694; }
    th { background:#0f1745; }
    .kosong { padding:15px; color:#ffd166; }
    .btn-hapus { background:#ff6b6b; color:#fff; padding:5px 10px; border-radius:5px; text-decoration:none; font-size:13px; font-weight:bold; }
    .total { text-align:right; font-size:18px; font-weight:bold; margin-top:15px; }
</style>
</head>
<body>

<h2>Keranjang Belanja</h2>
<p><a class="back" href="tampilkan_produk.php">&laquo; Kembali belanja</a></p>

<?php
session_start();

// ---------- HAPUS ITEM DARI KERANJANG ----------
if (isset($_GET['hapus'])) {
    $id_hapus = (int) $_GET['hapus'];
    unset($_SESSION['keranjang'][$id_hapus]);
    header("Location: keranjang.php");
    exit;
}

$keranjang = $_SESSION['keranjang'] ?? [];

if (count($keranjang) > 0) {
    echo '<table>';
    echo '<tr><th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th><th>Aksi</th></tr>';

    $total = 0;
    foreach ($keranjang as $id => $item) {
        $subtotal = $item['harga'] * $item['quantity'];
        $total += $subtotal;

        echo '<tr>';
        echo '<td>' . htmlspecialchars($item['nama_produk']) . '</td>';
        echo '<td>Rp' . number_format($item['harga'], 0, ',', '.') . '</td>';
        echo '<td>' . $item['quantity'] . '</td>';
        echo '<td>Rp' . number_format($subtotal, 0, ',', '.') . '</td>';
        echo '<td><a class="btn-hapus" href="keranjang.php?hapus=' . $id . '">Hapus</a></td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '<p class="total">Total: Rp' . number_format($total, 0, ',', '.') . '</p>';
} else {
    echo '<p class="kosong">Keranjang masih kosong. Yuk tambah produk dulu!</p>';
}
?>

</body>
</html>
