<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use App\Models\Product;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'order_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
