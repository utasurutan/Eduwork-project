@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div style="text-align:center; padding:60px 20px;">
        <h1 style="font-size:38px; margin-bottom:10px;">Selamat Datang di TokoKita</h1>
        <p style="font-size:18px; color:#c5cae9; max-width:500px; margin:0 auto 30px;">
            Belanja kebutuhan sehari-hari kamu dengan mudah, cepat, dan harga terbaik.
        </p>
        <a href="{{ route('products.index') }}" style="background:#f2c94c; color:#0f1745; padding:12px 28px; border-radius:6px; text-decoration:none; font-weight:bold;">
            Mulai Belanja
        </a>
    </div>

    <div style="display:flex; gap:20px; justify-content:center; flex-wrap:wrap; margin-top:20px;">
        <div style="background:#16205c; padding:25px; border-radius:8px; width:220px; text-align:center;">
            <h3 style="color:#f2c94c; margin-top:0;">Produk Lengkap</h3>
            <p style="font-size:14px; color:#c5cae9;">Berbagai kategori produk tersedia untuk kebutuhan kamu.</p>
        </div>
        <div style="background:#16205c; padding:25px; border-radius:8px; width:220px; text-align:center;">
            <h3 style="color:#f2c94c; margin-top:0;">Belanja Mudah</h3>
            <p style="font-size:14px; color:#c5cae9;">Tambahkan ke keranjang dan checkout hanya dalam beberapa klik.</p>
        </div>
        <div style="background:#16205c; padding:25px; border-radius:8px; width:220px; text-align:center;">
            <h3 style="color:#f2c94c; margin-top:0;">Terpercaya</h3>
            <p style="font-size:14px; color:#c5cae9;">Transaksi aman dan pengiriman yang bisa diandalkan.</p>
        </div>
    </div>
@endsection
