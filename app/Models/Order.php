<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'transaction_number',
        'cashier_id',
        'total_price',
        'total_item',
        'payment_method',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'cahier_id');
    }
}
