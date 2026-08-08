<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Elektronik', 'Aksesoris', 'Pakaian', 'Rumah Tangga'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
