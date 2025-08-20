<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        'user_id' => Auth::id(),
        'category_id' => $request->category_id, // مهم
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'تم إضافة المنتج، في انتظار موافقة الإدارة.');
}


public function edit(Product $product)
{
    // Ensure the authenticated seller owns this product
    abort_if($product->user_id !== Auth::id(), 403);
    return view('seller.edit-product', compact('product'));
}

public function update(Request $request, Product $product)
{
    abort_if($product->user_id !== Auth::id(), 403);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'price' => 'required|integer',
        'quantity' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    // Reset status to pending after edit for re-approval if desired (optional)
    $validated['status'] = $product->status === 'approved' ? 'pending' : $product->status;

    $product->update($validated);

    return redirect()->route('dashboard')->with('success', 'Product updated successfully.');
}

public function destroy(Product $product)
{
    abort_if($product->user_id !== Auth::id(), 403);
    $product->delete();
    return redirect()->route('dashboard')->with('success', 'Product deleted successfully.');
}
}
