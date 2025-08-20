<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'pending')->get();
        return view('admin.accept-product', compact('products'));
    }

    public function dashboard()
    {
        // Sellers: users having role seller, count only approved products as listed for sale
        $sellers = User::role('seller')
            ->withCount([
                'products as products_count' => function ($query) {
                    $query->where('status', 'approved');
                }
            ])
            ->get();
        $totalSellers = $sellers->count();

        // Customers: users having role customer with number of purchased products (completed orders)
        $customers = User::role('customer')
            ->withCount([
                'orders as orders_count' => function ($query) {
                    $query->whereIn('status', ['pending','checked', 'arrived']);
                }
            ])
            ->get();
        $totalCustomers = $customers->count();

        // Total products sold = completed orders count
        $totalProductsSold = Order::whereIn('status', ['pending','checked', 'arrived'])->count();

        // Total sales revenue = sum of product price for each completed order
        $totalSalesRevenue = Order::whereIn('orders.status', ['pending','checked', 'arrived'])
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->sum('products.price');

        return view('admin.admin-dashboard', compact(
            'sellers',
            'totalSellers',
            'customers',
            'totalCustomers',
            'totalProductsSold',
            'totalSalesRevenue'
        ));
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

    // Admin: edit any product
    public function editProduct(Product $product)
    {
        return view('admin.edit-product', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:pending,approved,rejected',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        return Redirect::route('dashboard')->with('success', 'Product updated successfully.');
    }

    public function destroyProduct(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
