<x-app-layout>
    <x-slot name="header">
        <h2>Wishlist</h2>
    </x-slot>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($items as $item)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col">
                <h3 class="text-lg font-bold mb-2">{{ $item->product->name }}</h3>
                <p class="text-gray-900 font-semibold mb-2">السعر: ${{ $item->product->price }}</p>


                <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="mt-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full">
                        إزالة من المفضلة ❌
                    </button>
                </form>
                <form action="{{ route('wishlist.moveToCart', $item->id) }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full">
                        نقل للعربة 🛒
                    </button>
                </form>


            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">لا توجد منتجات في المفضلة حالياً</p>
        @endforelse
    </div>
</x-app-layout>
