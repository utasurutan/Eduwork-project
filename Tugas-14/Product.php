<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'stock',
        'image',
        'price',
    ];

    // Relasi: satu produk termasuk dalam satu kategori
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    // Relasi: satu produk bisa muncul di banyak order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
