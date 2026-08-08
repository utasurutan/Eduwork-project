<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan penting: kategori harus ada dulu sebelum produk (foreign key)
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
