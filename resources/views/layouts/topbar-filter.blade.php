@php
    $currentSearch = request('search');
    $currentCategory = request('category');
    $currentMin = request('price_min');
    $currentMax = request('price_max');
@endphp

<div class="w-full bg-white/70 dark:bg-gray-800/70 backdrop-blur sticky top-0 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col md:flex-row gap-3 items-stretch">
        <form method="GET" action="{{ url()->current() }}" class="flex-1 flex gap-3">
            <div class="relative flex-1">
                <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Search products..." class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 ps-10 py-3 shadow focus:ring-2 focus:ring-purple-400 focus:border-purple-400" />
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            @isset($categories)
                <div class="relative">
                    <select name="category" class="rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 py-3 pe-9 ps-3 shadow focus:ring-2 focus:ring-purple-400 focus:border-purple-400" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (string)$currentCategory === (string)$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            @endisset

            <div class="relative">
                <input type="number" name="price_min" value="{{ $currentMin }}" min="0" placeholder="Min price" class="w-32 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 ps-3 py-3 shadow focus:ring-2 focus:ring-purple-400 focus:border-purple-400" />
            </div>
            <div class="relative">
                <input type="number" name="price_max" value="{{ $currentMax }}" min="0" placeholder="Max price" class="w-32 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 ps-3 py-3 shadow focus:ring-2 focus:ring-purple-400 focus:border-purple-400" />
            </div>

            <button class="rounded-xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 text-white px-5 shadow hover:shadow-lg transition">Search</button>
        </form>
    </div>
</div>


