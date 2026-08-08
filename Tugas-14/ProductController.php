<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Tampilkan semua produk (Read) dengan pagination
    public function index()
    {
        $products = Product::with('category')->paginate(9); // 9 produk per halaman
        return view('products.index', compact('products'));
    }

    // Tampilkan detail satu produk
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Simpan produk baru (Create)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:100',
            'description' => 'required|string',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|string',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('pesan', 'Produk berhasil ditambahkan.');
    }

    // Update produk (Update)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:100',
            'description' => 'required|string',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|string',
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
