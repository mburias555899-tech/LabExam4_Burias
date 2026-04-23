<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'order_id',
        'amount_paid',
        'balance',
        'payment_method',
        'status',
    ];

    // Relationship: Payment belongs to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}