<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // Kolom yang boleh diisi lewat mass-assignment (create/update)
    protected $fillable = [
        'nama_produk',
        'harga',
        'deskripsi',
        'stok',
        'kategori',
        'gambar',
    ];

    // Relasi: satu produk bisa muncul di banyak order
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
}
