<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderStatusUpdated;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    // عرض جميع الطلبات (Seller)
    public function index()
    {
        $orders = Order::with('product','customer')->get();
        return view('orders.index', compact('orders'));
    }

    // تغيير حالة الطلب
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,checked,arrived'
        ]);

        $order->update(['status' => $request->status]);

        // إرسال إيميل للزبون
        Mail::to($order->customer->email)->send(new OrderStatusUpdated($order));

        return redirect()->back()->with('success', "Order #{$order->id} status updated!");
    }
}

