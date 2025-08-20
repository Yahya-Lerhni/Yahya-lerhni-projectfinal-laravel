<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::firstOrCreate(['customer_id' => Auth::id()]);
        $items = $wishlist->items()->with('product')->get();
        return view('wishlist.index', compact('items'));
    }

    public function add(Product $product)
    {
        $wishlist = Wishlist::firstOrCreate(['customer_id' => Auth::id()]);

        $item = $wishlist->items()->where('product_id', $product->id)->first();
        if (!$item) {
            $wishlist->items()->create(['product_id' => $product->id]);
        }

        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى المفضلة.');
    }

    public function remove(WishlistItem $item)
    {
        $item->delete();
        return redirect()->back()->with('success', 'تمت إزالة المنتج من المفضلة.');
    }
    public function moveToCart(WishlistItem $item)
{

    $cart = Cart::firstOrCreate(['customer_id' => Auth::id()]);


    $cartItem = $cart->items()->where('product_id', $item->product_id)->first();
    if($cartItem){
        $cartItem->increment('quantity');
    } else {
        $cart->items()->create(['product_id' => $item->product_id, 'quantity' => 1]);
    }

    
    $item->delete();

    return redirect()->back()->with('success', 'تم نقل المنتج للعربة.');
}

}
