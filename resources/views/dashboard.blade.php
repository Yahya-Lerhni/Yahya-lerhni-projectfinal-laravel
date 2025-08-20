<x-app-layout :categories="$categories" :show-search-bar="true">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-gray-900 dark:text-gray-100 tracking-tight">Browse Products</h2>
            @role('seller')
                <a href="{{ route('seller.products.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 shadow">
                    <i class="bi bi-plus-square"></i> New Product
                </a>
            @endrole
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        @auth
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-5 shadow">
                    <div class="text-white/80 text-sm">Visible Products</div>
                    <div class="text-3xl font-extrabold mt-1">{{ $products->total() }}</div>
                </div>
                <div class="rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 p-5 shadow">
                    <div class="text-gray-500 text-sm">Categories</div>
                    <div class="text-3xl font-extrabold mt-1">{{ $categories->count() }}</div>
                </div>
                <div class="rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 p-5 shadow">
                    <div class="text-gray-500 text-sm">Role</div>
                    <div class="text-3xl font-extrabold mt-1">
                        @if (Auth::user()->hasRole('admin')) Admin @elseif(Auth::user()->hasRole('seller')) Seller @else Customer @endif
                    </div>
                </div>
            </div>
        @endauth

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition group overflow-hidden flex flex-col">
                    @php
                        $img = $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1200&auto=format&fit=crop';
                    @endphp
                    <img src="{{ $img }}" alt="{{ $product->name }}" class="h-48 w-full object-cover mb-4 group-hover:scale-105 transition duration-300">

                    <div class="px-4 pb-4 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold mb-1 text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2 line-clamp-2">{{ $product->description }}</p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-xl font-extrabold text-indigo-700 dark:text-indigo-300">${{ $product->price }}</span>
                            @if($product->category)
                                <span class="text-xs px-2 py-1 rounded-full bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">{{ $product->category->name }}</span>
                            @endif
                        </div>
                    </div>

                    @role('customer')
                        <div class="px-4 pb-4 pt-0">
                            <div class="border-t border-gray-100 dark:border-gray-700 pt-4">
                                <div class="flex flex-col gap-5">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="contents">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center gap-2 w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2.5 rounded-xl shadow hover:shadow-lg transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            <i class="bi bi-cart-plus"></i>
                                            <span>Add to Cart</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="contents">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center gap-2 w-full bg-pink-500 hover:bg-pink-600 text-white px-4 py-2.5 rounded-xl shadow transition focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                            <i class="bi bi-heart-fill"></i>
                                            <span>Wishlist</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endrole

                    @role('seller')
                        <div class="px-4 pb-4 -mt-2 text-sm text-gray-500 flex flex-col items-center justify-between gap-3">
                            <span>Status: <span class="font-medium">{{ $product->status }}</span></span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('seller.products.edit', $product) }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 dark:border-gray-700 px-3 py-1.5 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('seller.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-red-500 hover:bg-red-600 text-white px-3 py-1.5">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endrole

                    @role('admin')
                        <div class="px-4 pb-4 -mt-2 text-sm text-gray-500 flex flex-col items-center justify-between gap-3">
                            <span>Seller: <span class="font-medium">{{ $product->user->name }}</span> | Status: <span class="font-medium">{{ $product->status }}</span></span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 dark:border-gray-700 px-3 py-1.5 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-red-500 hover:bg-red-600 text-white px-3 py-1.5">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endrole
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-500">No products found</p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
