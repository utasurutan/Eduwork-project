<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total',
    ];

    // Relasi: satu order dimiliki oleh satu produk
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relasi: satu order dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
