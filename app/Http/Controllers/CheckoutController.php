<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        // set API key
        Stripe::setApiKey(config('services.stripe.secret'));

        $cart = Cart::firstOrCreate(['customer_id' => Auth::id()]);
        $items = $cart->items()->with('product')->get();

        $line_items = $items->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'usd', // أو MAD
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->product->price * 100, // بالسنت
                ],
                'quantity' => $item->quantity,
            ];
        })->toArray();

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        $user = Auth::user();
        $cart = Cart::where('customer_id', $user->id)->first();

        if ($cart) {
            $items = $cart->items()->with('product')->get();

            // إنشاء Orders لكل عنصر في العربة
            foreach ($items as $item) {
                Order::create([
                    'customer_id' => $user->id,
                    'product_id' => $item->product->id,
                    'status' => 'pending', // الحالة الابتدائية
                ]);
            }

            // مسح العربة بعد إنشاء Orders
            $cart->items()->delete();
        }

        session()->flash('success', '✅ تمت عملية الدفع بنجاح وتم إنشاء الطلبات!');
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        session()->flash('error', '❌ تم إلغاء عملية الدفع أو فشلت.');
        return redirect()->route('cart.index');
    }
}
