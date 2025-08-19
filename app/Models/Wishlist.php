<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id'];

    public function items()
    {
        return $this->hasMany(WishlistItem::class);
    }
}

