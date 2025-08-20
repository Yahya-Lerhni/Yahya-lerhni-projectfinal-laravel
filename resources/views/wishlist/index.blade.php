<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100">Your Wishlist</h2>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($items as $item)
            @php $product = $item->product; @endphp
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition overflow-hidden flex flex-col">
                @if($product)
                    @php
                        $img = $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1200&auto=format&fit=crop';
                    @endphp
                    <img src="{{ $img }}" alt="{{ $product->name }}" class="h-48 w-full object-cover">

                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ $product->description }}</p>
                        <div class="mt-auto pt-3 flex items-center justify-between">
                            <span class="text-xl font-extrabold text-indigo-700 dark:text-indigo-300">${{ $product->price }}</span>
                            @if($product->category)
                                <span class="text-xs px-2 py-1 rounded-full bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">{{ $product->category->name }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="px-4 pb-4">
                        <div class="flex flex-col gap-3">
                            <form action="{{ route('wishlist.moveToCart', $item->id) }}" method="POST" class="contents">
                                @csrf
                                <button type="submit" class="inline-flex items-center justify-center gap-2 w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2.5 rounded-xl shadow hover:shadow-lg transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <i class="bi bi-cart-plus"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </form>
                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="contents">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center gap-2 w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2.5 rounded-xl shadow transition focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    <i class="bi bi-trash"></i>
                                    <span>Remove</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="p-6 text-center text-gray-500">This product is no longer available.</div>
                    <div class="px-6 pb-6">
                        <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="contents">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center gap-2 w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2.5 rounded-xl shadow transition">
                                <i class="bi bi-trash"></i>
                                <span>Remove</span>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 dark:text-gray-400">Your wishlist is empty.</p>
        @endforelse
    </div>
</x-app-layout>
