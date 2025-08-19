<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    // الأعمدة القابلة للتعبئة
    protected $fillable = ['customer_id'];

    /**
     * العلاقة مع العناصر (Cart Items)
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * العلاقة مع المستخدم (العميل اللي عندو السلة)
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * حساب المجموع الكلي للمنتجات
     */
    public function total()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
}
