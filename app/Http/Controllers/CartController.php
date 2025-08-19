<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['customer_id' => Auth::id()]);
        $items = $cart->items()->with('product')->get();
        return view('customer.cart-customer', compact('items'));
    }

    public function add(Product $product)
    {
        $cart = Cart::firstOrCreate(['customer_id' => Auth::id()]);

        $item = $cart->items()->where('product_id', $product->id)->first();
        if($item) {
            $item->increment('quantity');
        } else {
            $cart->items()->create(['product_id' => $product->id, 'quantity' => 1]);
        }

        return redirect()->back()->with('success', 'تمت إضافة المنتج للعربة.');
    }

    public function update(Request $request, CartItem $item)
    {
        $request->validate(['quantity'=>'required|integer|min:1']);
        $item->update(['quantity'=>$request->quantity]);
        return redirect()->back()->with('success','تم تحديث الكمية.');
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return redirect()->back()->with('success','تم حذف المنتج من العربة.');
    }
}

