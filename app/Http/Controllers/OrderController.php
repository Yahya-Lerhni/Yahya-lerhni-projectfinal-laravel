<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderStatusUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // (Seller)
    public function index()
    {
        $sellerId = Auth::id();
        $orders = Order::with(['product', 'customer'])
            ->whereHas('product', function ($query) use ($sellerId) {
                $query->where('user_id', $sellerId);
            })
            ->get();
        return view('orders.index', compact('orders'));
    }

    // nchanger order statut
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,checked,arrived'
        ]);


        $order->loadMissing('product');
        if (!$order->product || $order->product->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to update this order.');
        }

        $order->update(['status' => $request->status]);

        // email user
        Mail::to($order->customer->email)->send(new OrderStatusUpdated($order));

        return redirect()->back()->with('success', "Order #{$order->id} status updated!");
    }
}

