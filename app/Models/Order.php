<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'order_date', 'total_amount', 'staff_id'];

    // Define relationship to OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Define relationship to User (staff)
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
