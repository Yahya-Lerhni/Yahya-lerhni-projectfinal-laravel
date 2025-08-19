<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لوحة تحكم الأدمن 👑
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900">مرحبا {{ Auth::user()->name }}</h3>
                <p class="mt-2 text-gray-700">دورك: Admin</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-100 p-4 rounded-lg shadow">إحصائيات المستخدمين</div>
                <div class="bg-green-100 p-4 rounded-lg shadow">إدارة المنتجات</div>
                <div class="bg-yellow-100 p-4 rounded-lg shadow">مراجعة الطلبات</div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow">
                روابط سريعة:
                <ul class="list-disc ml-5">
                    <li><a href="/seller/dashboard" class="text-blue-600">لوحة البائعين</a></li>
                    <li><a href="/customer/dashboard" class="text-purple-600">لوحة الزبائن</a></li>
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>
