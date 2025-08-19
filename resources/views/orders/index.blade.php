<x-app-layout>
    <x-slot name="header">
        <h2>Orders List</h2>
    </x-slot>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full text-left border">
        <thead>
            <tr class="bg-gray-200">
                <th>Order ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr class="border-b">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status">
                                <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                                <option value="checked" {{ $order->status=='checked'?'selected':'' }}>Checked</option>
                                <option value="arrived" {{ $order->status=='arrived'?'selected':'' }}>Arrived</option>
                            </select>
                            <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
