<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',        
        'menu_id',
        'quantity',
        'total_cost',
        'status',
    ];

    // Relationship: Order belongs to Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // Relationship: Order belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Order has one Payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}