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
        /** @var \App\Models\User $user */
        $user = Auth::user();

        //  query
        $query = Product::with('category', 'user');

        // role
        if ($user->hasRole('customer')) {
            $query->where('status', 'approved');
        } elseif ($user->hasRole('seller')) {
            $query->where('user_id', $user->id);
        }
        // Admin

        // search bsmia
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // filter b categorie
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Price  filter
        if ($request->filled('price_min')) {
            $query->where('price', '>=', (int) $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', (int) $request->price_max);
        }

        $products = $query->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('dashboard', compact('products', 'categories'));
    }
}
