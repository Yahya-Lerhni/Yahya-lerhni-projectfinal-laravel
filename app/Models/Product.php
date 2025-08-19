<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // الأعمدة القابلة للتعبئة
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image',
        'status',
        'user_id',
        'category_id',
    ];

    /**
     * العلاقة مع الـ User (Seller)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * العلاقة مع الـ Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
