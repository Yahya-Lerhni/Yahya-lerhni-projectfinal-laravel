<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;


    protected $fillable = ['customer_id'];

    /**
     *(Cart Items)
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**

     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     */
    public function total()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
}
