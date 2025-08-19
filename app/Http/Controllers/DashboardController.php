<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // البداية: query
        $query = Product::with('category', 'user');

        // حسب role
        if ($user->hasRole('customer')) {
            $query->where('status', 'approved');
        } elseif ($user->hasRole('seller')) {
            $query->where('user_id', $user->id);
        }
        // Admin يشوف كلشي => ما نضيفوش شرط

        // البحث بالاسم
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // الفلترة حسب category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();
        $categories = Category::all();

        return view('dashboard', compact('products', 'categories'));
    }
}
