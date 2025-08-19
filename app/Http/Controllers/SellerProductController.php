<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function create()
{
    return view('seller.create-product');
}

public function store(Request $request)
{

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'price' => 'required|integer',
        'quantity' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    $path = null;
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
    }

    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'image' => $path,
        'user_id' => auth()->id(),
        'category_id' => $request->category_id, // مهم
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'تم إضافة المنتج، في انتظار موافقة الإدارة.');
}


}
