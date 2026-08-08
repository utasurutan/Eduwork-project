<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan CategorySeeder dijalankan dulu (lihat DatabaseSeeder)
        $elektronik = Category::where('name', 'Elektronik')->first();
        $aksesoris  = Category::where('name', 'Aksesoris')->first();
        $pakaian    = Category::where('name', 'Pakaian')->first();
        $rumah      = Category::where('name', 'Rumah Tangga')->first();

        $products = [
            [
                'category_id' => $elektronik->id,
                'name'        => 'Laptop Ultrabook',
                'description' => 'Laptop ringan dengan performa tinggi, cocok untuk kerja dan kuliah.',
                'stock'       => 10,
                'image'       => null,
                'price'       => 8500000,
            ],
            [
                'category_id' => $elektronik->id,
                'name'        => 'Smartphone Android',
                'description' => 'Smartphone dengan kamera 108MP dan baterai tahan lama.',
                'stock'       => 20,
                'image'       => null,
                'price'       => 3200000,
            ],
            [
                'category_id' => $aksesoris->id,
                'name'        => 'Keyboard Mechanical',
                'description' => 'Keyboard mechanical switch blue dengan RGB backlight.',
                'stock'       => 25,
                'image'       => null,
                'price'       => 450000,
            ],
            [
                'category_id' => $aksesoris->id,
                'name'        => 'Mouse Wireless',
                'description' => 'Mouse wireless dengan sensor presisi tinggi.',
                'stock'       => 40,
                'image'       => null,
                'price'       => 150000,
            ],
            [
                'category_id' => $aksesoris->id,
                'name'        => 'Headset Gaming',
                'description' => 'Headset dengan surround sound dan mic noise cancelling.',
                'stock'       => 15,
                'image'       => null,
                'price'       => 300000,
            ],
            [
                'category_id' => $pakaian->id,
                'name'        => 'Kaos Polos Cotton',
                'description' => 'Kaos polos bahan cotton combed 30s, nyaman dipakai sehari-hari.',
                'stock'       => 50,
                'image'       => null,
                'price'       => 75000,
            ],
            [
                'category_id' => $rumah->id,
                'name'        => 'Rice Cooker Mini',
                'description' => 'Rice cooker kapasitas 1 liter, cocok untuk anak kos.',
                'stock'       => 12,
                'image'       => null,
                'price'       => 250000,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
