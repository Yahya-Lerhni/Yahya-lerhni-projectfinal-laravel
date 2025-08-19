<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100">
            🛍️ لوحة التحكم
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        {{-- ✅ Role Message --}}
        @auth
            @if (Auth::user()->hasRole('admin'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow">أنت Admin ✅</div>
            @elseif(Auth::user()->hasRole('seller'))
                <div class="bg-blue-100 text-blue-700 p-4 rounded-lg shadow">أنت Seller 🛒</div>
            @elseif(Auth::user()->hasRole('customer'))
                <div class="bg-purple-100 text-purple-700 p-4 rounded-lg shadow">أنت Customer 🛍️</div>
            @endif
        @endauth

        {{-- ✅ Stats Section --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition">
                <p class="text-gray-500">المنتجات</p>
                <h3 class="text-2xl font-bold">{{ $products->count() }}</h3>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition">
                <p class="text-gray-500">الفئات</p>
                <h3 class="text-2xl font-bold">{{ $categories->count() }}</h3>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition">
                <p class="text-gray-500">طلبات</p>
                <h3 class="text-2xl font-bold">--</h3>
            </div>
        </div>

        {{-- ✅ Search & Filter --}}
        <form method="GET" class="flex flex-col md:flex-row md:space-x-4 space-y-2 md:space-y-0">
            <div class="relative w-full md:w-1/3">
                <input type="text" name="search" placeholder="🔍 بحث بالاسم..."
                    value="{{ request('search') }}"
                    class="border border-gray-300 dark:border-gray-700 p-2 pl-10 rounded w-full focus:ring focus:ring-blue-200 dark:bg-gray-900 dark:text-white">
                <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
            </div>
            <select name="category" onchange="this.form.submit()"
                class="border p-2 rounded dark:bg-gray-900 dark:text-white">
                <option value="">كل الفئات</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">بحث</button>
        </form>

        {{-- ✅ Products Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg p-4 flex flex-col transition">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="h-48 w-full object-cover rounded mb-4 hover:scale-105 transition">
                    @else
                        <div class="h-48 w-full bg-gray-200 rounded mb-4 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif

                    <h3 class="text-lg font-bold mb-1">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-500 mb-2 line-clamp-2">{{ $product->description }}</p>
                    <p class="text-gray-900 font-semibold mb-1">السعر: ${{ $product->price }}</p>
                    <p class="text-gray-600 mb-3">الكمية: {{ $product->quantity }}</p>

                    @role('customer')
                        <div class="space-y-2 mt-auto">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    🛒 إضافة للعربة
                                </button>
                            </form>
                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">
                                    ❤️ إضافة للمفضلة
                                </button>
                            </form>
                        </div>
                    @endrole

                    @role('seller')
                        <p class="text-gray-500 mt-auto">حالتك: {{ $product->status }}</p>
                    @endrole

                    @role('admin')
                        <div class="mt-auto">
                            <p class="text-gray-500">البائع: {{ $product->user->name }} | الحالة: {{ $product->status }}</p>
                        </div>
                    @endrole
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">لا توجد منتجات حالياً</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
