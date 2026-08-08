<footer style="background:#0f1745; color:#c5cae9; padding:30px 40px; margin-top:60px; text-align:center;">
    <p style="margin:0 0 10px 0; font-weight:bold; color:#f2c94c;">TokoKita</p>
    <p style="margin:0 0 15px 0; font-size:14px;">
        Belanja kebutuhan kamu dengan mudah, cepat, dan terpercaya.
    </p>
    <div style="display:flex; justify-content:center; gap:20px; margin-bottom:15px;">
        <a href="{{ route('home') }}" style="color:#c5cae9; text-decoration:none; font-size:14px;">Beranda</a>
        <a href="{{ route('products.index') }}" style="color:#c5cae9; text-decoration:none; font-size:14px;">Produk</a>
        <a href="{{ route('about') }}" style="color:#c5cae9; text-decoration:none; font-size:14px;">Tentang</a>
        <a href="{{ route('contact') }}" style="color:#c5cae9; text-decoration:none; font-size:14px;">Kontak</a>
    </div>
    <p style="margin:0; font-size:12px; color:#7986cb;">
        &copy; {{ date('Y') }} TokoKita. Semua hak dilindungi.
    </p>
</footer>
