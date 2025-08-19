<x-app-layout>
    <h2>Order Status Update</h2>

<p>Hi {{ $order->customer->name }},</p>

<p>Your order #{{ $order->id }} for product <strong>{{ $order->product->name }}</strong> has been updated.</p>

<p><strong>New Status:</strong> {{ ucfirst($order->status) }}</p>

<p>Thank you for shopping with us!</p>
</x-app-layout>
