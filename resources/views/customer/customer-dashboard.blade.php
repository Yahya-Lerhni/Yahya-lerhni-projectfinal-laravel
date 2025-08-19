<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لوحة الزبون 🛍️
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900">مرحبا {{ Auth::user()->name }}</h3>
                <p class="mt-2 text-gray-700">دورك: Customer</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-green-100 p-4 rounded-lg shadow">تصفح المنتجات</div>
                <div class="bg-yellow-100 p-4 rounded-lg shadow">عربة التسوق (Cart)</div>
                <div class="bg-blue-100 p-4 rounded-lg shadow">قائمة المفضلة (Wishlist)</div>
                <div class="bg-purple-100 p-4 rounded-lg shadow">تتبع الطلبات والتواصل مع البائعين</div>
            </div>

        </div>
    </div>
</x-app-layout>
