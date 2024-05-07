<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 
        'need_by_date', 
        'start_production_date', 
        'end_production_date',
    ];

    public function orderItems(): hasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
