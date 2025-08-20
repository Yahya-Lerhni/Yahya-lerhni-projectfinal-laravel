<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin: Edit Product</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 md:p-8">
                @if (session('success'))
                    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                        <strong>There were some problems with your input:</strong>
                        <ul class="mt-2 list-disc ps-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Product Name</label>
                            <input id="name" name="name" type="text" required value="{{ old('name', $product->name) }}" class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price</label>
                            <input id="price" name="price" type="number" min="0" step="1" required value="{{ old('price', $product->price) }}" class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Quantity</label>
                            <input id="quantity" name="quantity" type="number" min="0" step="1" required value="{{ old('quantity', $product->quantity) }}" class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Category</label>
                            <select id="category_id" name="category_id" required class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id)==$category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                        <textarea id="description" name="description" rows="4" required class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                            <select id="status" name="status" class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach (['pending','approved','rejected'] as $st)
                                    <option value="{{ $st }}" @selected(old('status', $product->status)===$st)>{{ ucfirst($st) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Product Image</label>
                            <div class="mt-2 flex items-center gap-4">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="h-28 w-28 rounded-lg object-cover ring-1 ring-gray-200 dark:ring-gray-700" alt="Current Image" />
                                @endif
                                <input id="image" name="image" type="file" accept="image/*" class="block w-full text-sm text-gray-900 dark:text-gray-100" />
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Leave blank to keep the current image.</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


