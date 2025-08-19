<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            المنتجات في انتظار الموافقة
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full table-auto border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">اسم المنتج</th>
                            <th class="border px-4 py-2">البائع</th>
                            <th class="border px-4 py-2">السعر</th>
                            <th class="border px-4 py-2">الكمية</th>
                            <th class="border px-4 py-2">حالة الموافقة</th>
                            <th class="border px-4 py-2">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td class="border px-4 py-2">{{ $product->name }}</td>
                            <td class="border px-4 py-2">{{ $product->user->name }}</td>
                            <td class="border px-4 py-2">{{ $product->price }}</td>
                            <td class="border px-4 py-2">{{ $product->quantity }}</td>
                            <td class="border px-4 py-2">{{ $product->status }}</td>
                            <td class="border px-4 py-2 flex space-x-2">
                                <form action="{{ route('admin.products.approve', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-green-500 text-white px-2 py-1 rounded">موافقة</button>
                                </form>
                                <form action="{{ route('admin.products.reject', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-red-500 text-white px-2 py-1 rounded">رفض</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
