<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Tampilkan semua produk (Read)
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Tampilkan detail satu produk
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Simpan produk baru (Create)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'required|string',
            'stok'        => 'required|integer|min:0',
            'kategori'    => 'required|string|max:50',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('pesan', 'Produk berhasil ditambahkan.');
    }

    // Update produk (Update)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'required|string',
            'stok'        => 'required|integer|min:0',
            'kategori'    => 'required|string|max:50',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('pesan', 'Produk berhasil diperbarui.');
    }

    // Hapus produk (Delete)
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('pesan', 'Produk berhasil dihapus.');
    }
}
