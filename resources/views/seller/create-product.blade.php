<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            إضافة منتج جديد
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">

                <!-- رسالة النجاح -->
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" placeholder="اسم المنتج" required>
                    <textarea name="description" placeholder="الوصف" required></textarea>
                    <input type="number" name="price" placeholder="السعر" required>
                    <input type="number" name="quantity" placeholder="الكمية" required>
                    <input type="file" name="image">

                    <div>
                        <label>Category</label>
                        <select name="category_id" required>
                            <option value="">Choose category</option>
                            @foreach (\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit">إضافة المنتج</button>
                </form>


            </div>
        </div>
    </div>
</x-app-layout>
