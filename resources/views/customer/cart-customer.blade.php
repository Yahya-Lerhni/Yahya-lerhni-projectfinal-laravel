<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            عربة التسوق 🛒
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">{{ session('success') }}</div>
                    @endif

                    @if ($items->isEmpty())
                        <p class="text-center text-gray-500">لا توجد منتجات في العربة بعد.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b">
                                        <th class="pb-2">صورة</th>
                                        <th class="pb-2">اسم المنتج</th>
                                        <th class="pb-2">السعر</th>
                                        <th class="pb-2">الكمية</th>
                                        <th class="pb-2">المجموع الفرعي</th>
                                        <th class="pb-2">حذف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total=0; @endphp
                                    @foreach ($items as $item)
                                        @php
                                            $subtotal = $item->quantity * $item->product->price;
                                            $total += $subtotal;
                                        @endphp
                                        <tr class="border-b">
                                            <td class="py-4"><img src="{{ asset('storage/' . $item->product->image) }}"
                                                    class="w-16 h-16 object-cover rounded"></td>
                                            <td class="py-4">{{ $item->product->name }}</td>
                                            <td class="py-4">{{ $item->product->price }} MAD</td>
                                            <td class="py-4">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                    class="flex items-center space-x-2">
                                                    @csrf @method('PATCH')
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                        min="1" class="w-16 px-2 py-1 border rounded">
                                                    <button type="submit"
                                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">تحديث</button>
                                                </form>
                                            </td>
                                            <td class="py-4">{{ $subtotal }} MAD</td>
                                            <td class="py-4">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">حذف</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class=" flex justify-between  mt-6 text-right">
                            <a href="{{ route('checkout') }}"
                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                إتمام الشراء
                            </a>
                            <div class="text-xl font-bold">المجموع الكلي: {{ $total }} MAD</div>


                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
