<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // ---------- CART (pakai session, sederhana) ----------

    // Tampilkan isi keranjang
    public function showCart(Request $request)
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Tambah produk ke keranjang
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'nama_produk' => $product->nama_produk,
                'harga'       => $product->harga,
                'quantity'    => 1,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('pesan', "Produk '{$product->nama_produk}' ditambahkan ke keranjang.");
    }

    // Hapus produk dari keranjang
    public function removeFromCart($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('pesan', 'Produk dihapus dari keranjang.');
    }

    // ---------- CHECKOUT ----------

    // Tampilkan halaman checkout
    public function showCheckout(Request $request)
    {
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    // Proses checkout: simpan setiap item cart jadi record di tabel orders
    public function processCheckout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('pesan', 'Keranjang masih kosong.');
        }

        foreach ($cart as $productId => $item) {
            Order::create([
                'user_id'    => auth()->id() ?? 1, // sementara pakai id 1 kalau belum ada auth
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'total'      => $item['harga'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('home')->with('pesan', 'Checkout berhasil! Pesanan kamu sedang diproses.');
    }
}
