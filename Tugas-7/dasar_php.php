<?php
// dasar_php.php
// TUGAS 1: DASAR PHP
// Belajar deklarasi variabel, operator, dan penggunaan if-else

// ---------- DEKLARASI VARIABEL ----------
$nama_produk = "Keyboard Mechanical";
$harga       = 450000;
$stok        = 25;
$diskon      = 10; // dalam persen

// ---------- OPERATOR ----------

// Operator aritmatika
$potongan_harga = $harga * ($diskon / 100); // operator perkalian & pembagian
$harga_final    = $harga - $potongan_harga; // operator pengurangan

// Operator perbandingan
$stok_habis = ($stok == 0); // true jika stok sama dengan 0
$stok_aman  = ($stok > 10); // true jika stok lebih dari 10

// Operator logika
$boleh_dijual = ($stok > 0) && ($harga_final > 0); // AND: stok ada DAN harga valid

echo "Nama Produk   : $nama_produk<br>";
echo "Harga Asli    : Rp" . number_format($harga, 0, ',', '.') . "<br>";
echo "Harga Setelah Diskon: Rp" . number_format($harga_final, 0, ',', '.') . "<br>";

// ---------- PENGGUNAAN IF-ELSE ----------
if ($stok_habis) {
    echo "Status Stok: Habis, produk tidak bisa dibeli.<br>";
} elseif ($stok_aman) {
    echo "Status Stok: Aman, stok masih banyak ($stok).<br>";
} else {
    echo "Status Stok: Menipis, sisa $stok, segera restock!<br>";
}

if ($boleh_dijual) {
    echo "Produk ini boleh ditampilkan di toko.";
} else {
    echo "Produk ini TIDAK boleh ditampilkan di toko.";
}
?>
