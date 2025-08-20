<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100">Shopping Cart 🛒</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($items->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-10 text-center">
                    <div class="text-5xl mb-3">🛍️</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Your cart is empty</h3>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">Browse products and add your favorites to the cart.</p>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 mt-5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 shadow">
                        <i class="bi bi-shop"></i> Continue Shopping
                    </a>
                </div>
            @else
                @php
                    $total = 0;
                @endphp
                <div class="flex  gap-5">
                    <!-- Items List -->
                    <div class="flex flex-col items-center gap-5">
                        @foreach ($items as $item)
                            @php
                                $product = $item->product;
                            @endphp
                            @if ($product)
                                @php
                                    $img = $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1200&auto=format&fit=crop';
                                    $subtotal = $item->quantity * $product->price;
                                    $total += $subtotal;
                                @endphp
                                <div class="bg-white  dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                                    <div class="flex w-[80%]   sm:flex-row">
                                        <img src="{{ $img }}" alt="{{ $product->name }}" class="w-full sm:w-48  object-cover">
                                        <div class="flex-1  p-5">
                                            <div class="flex flex-col items-start justify-between gap-4">
                                                <div>
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
                                                    <p class="mt-1 text-sm   text-gray-500 dark:text-gray-400 line-clamp-2">{{ $product->description }}</p>
                                                </div>
                                                <div class="text-right flex gap-3">
                                                    <div class="text-xl font-extrabold text-indigo-700 dark:text-indigo-300">${{ $product->price }}</div>
                                                    <div class="mt-1 text-xs text-gray-500">Unit price</div>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-start gap-5">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <label for="qty-{{ $item->id }}" class="text-sm text-gray-600 dark:text-gray-300">Qty</label>
                                                    <input id="qty-{{ $item->id }}" type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-24 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2">
                                                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                        <i class="bi bi-arrow-repeat"></i>
                                                        Update
                                                    </button>
                                                </form>

                                                <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto">
                                                    <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Subtotal: <span class="text-indigo-700 dark:text-indigo-300">${{ $subtotal }}</span></div>
                                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-red-500 hover:bg-red-600 text-white px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                            <i class="bi bi-trash"></i>
                                                            Remove
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 flex items-center justify-between">
                                    <span class="text-gray-500">This product is no longer available.</span>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-red-500 hover:bg-red-600 text-white px-4 py-2 shadow">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Summary -->
                    <div>
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sticky top-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Order Summary</h3>
                            <div class="mt-4 space-y-2 text-sm text-gray-700 dark:text-gray-300">
                                <div class="flex items-center justify-between">
                                    <span>Items</span>
                                    <span>{{ $items->sum('quantity') }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Subtotal</span>
                                    <span class="font-medium">${{ $total }}</span>
                                </div>
                            </div>
                            <div class="mt-6 flex flex-col gap-3">
                                <a href="{{ route('checkout') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-5 py-3 font-semibold shadow hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <i class="bi bi-bag-check"></i>
                                    Proceed to Checkout
                                </a>
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-300 dark:border-gray-700 px-5 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <i class="bi bi-arrow-left"></i>
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
