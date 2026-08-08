<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // Tabel di database masih bernama 'categories' (dari migration sebelumnya)
    protected $table = 'categories';

    protected $fillable = ['name'];

    // Relasi: satu kategori punya banyak produk
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
