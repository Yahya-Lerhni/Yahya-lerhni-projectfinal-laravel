<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-gray-900 dark:text-gray-100">Admin Dashboard</h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                    <div class="flex flex-col items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300"><i class="bi bi-shop"></i></span>
                        <div class="flex items-center gap-5">
                            <div class="text-gray-500 text-sm">Total Sellers</div>
                            <div class="mt-1 text-3xl font-extrabold text-gray-900 dark:text-white">{{ $totalSellers }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                    <div class="flex flex-col items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300"><i class="bi bi-people"></i></span>
                        <div class="flex items-center gap-5">
                            <div class="text-gray-500 text-sm">Total Customers</div>
                            <div class="mt-1 text-3xl font-extrabold text-gray-900 dark:text-white">{{ $totalCustomers }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                    <div class="flex flex-col items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300"><i class="bi bi-bag-check"></i></span>
                        <div class="flex items-center gap-5">
                            <div class="text-gray-500 text-sm">Total Products Sold</div>
                            <div class="mt-1 text-3xl font-extrabold text-gray-900 dark:text-white">{{ $totalProductsSold }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                    <div class="flex flex-col items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300"><i class="bi bi-currency-dollar"></i></span>
                        <div class="flex items-center gap-5">
                            <div class="text-gray-500 text-sm">Total Sales Revenue</div>
                            <div class="mt-1 text-3xl font-extrabold text-gray-900 dark:text-white">${{ number_format($totalSalesRevenue, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sellers Table -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Sellers and Products</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Approved Products</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($sellers as $seller)
                                <tr>
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $seller->name }}</td>
                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ $seller->email }}</td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $seller->products_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-6 text-center text-gray-500">No sellers found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Customers Table -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Customers and Purchases</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purchased Products</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($customers as $customer)
                                <tr>
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $customer->name }}</td>
                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ $customer->email }}</td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $customer->orders_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-6 text-center text-gray-500">No customers found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
