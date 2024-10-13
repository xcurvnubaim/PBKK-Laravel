<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'item_id', 'quantity', 'price'];

    // Define relationship to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define relationship to Item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
