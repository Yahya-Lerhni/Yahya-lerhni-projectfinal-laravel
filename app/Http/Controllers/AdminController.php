<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'pending')->get();
        return view('admin.accept-product', compact('products'));
    }

    public function approve(Product $product)
    {
        $product->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'تمت الموافقة على المنتج.');
    }

    public function reject(Product $product)
    {
        $product->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'تم رفض المنتج.');
    }
}
