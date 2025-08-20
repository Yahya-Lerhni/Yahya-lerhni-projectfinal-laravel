<div class="sticky top-6 space-y-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-5">
        <h3 class="text-gray-900 dark:text-gray-100 font-semibold mb-3 flex items-center">
            <i class="bi bi-grid me-2 text-indigo-600"></i> Navigation
        </h3>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 transition">
                    <span class="text-gray-700 dark:text-gray-200"><i class="bi bi-speedometer2 me-2"></i>Dashboard</span>
                    <i class="bi bi-chevron-right text-gray-400"></i>
                </a>
            </li>

            @role('admin')
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 transition">
                        <span class="text-gray-700 dark:text-gray-200"><i class="bi bi-shield-lock me-2"></i>Admin Panel</span>
                        <i class="bi bi-chevron-right text-gray-400"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.pending') }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 transition">
                        <span class="text-gray-700 dark:text-gray-200"><i class="bi bi-box-seam me-2"></i>Pending Products</span>
                        <span class="text-xs bg-yellow-400/20 text-yellow-700 px-2 py-0.5 rounded">Admin</span>
                    </a>
                </li>
            @endrole

            @role('seller')

                <li>
                    <a href="{{ route('orders.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 transition">
                        <span class="text-gray-700 dark:text-gray-200"><i class="bi bi-receipt-cutoff me-2"></i>Orders</span>
                        <i class="bi bi-chevron-right text-gray-400"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('seller.products.create') }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 transition">
                        <span class="text-gray-700 dark:text-gray-200"><i class="bi bi-plus-square me-2"></i>Add Product</span>
                        <span class="text-xs bg-indigo-500/20 text-indigo-700 px-2 py-0.5 rounded">Seller</span>
                    </a>
                </li>
            @endrole

            @role('customer')

                <li>
                    <a href="{{ route('cart.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 transition">
                        <span class="text-gray-700 dark:text-gray-200"><i class="bi bi-cart-fill me-2"></i>Cart</span>
                        <i class="bi bi-chevron-right text-gray-400"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('wishlist.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 transition">
                        <span class="text-gray-700 dark:text-gray-200"><i class="bi bi-heart-fill me-2 text-pink-500"></i>Wishlist</span>
                        <i class="bi bi-chevron-right text-gray-400"></i>
                    </a>
                </li>
            @endrole

            @hasanyrole('customer|seller')
                <li>
                    <a href="{{ url('/chatify') }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 transition">
                        <span class="text-gray-700 dark:text-gray-200"><i class="bi bi-chat-dots me-2"></i>Messages</span>
                        <i class="bi bi-chevron-right text-gray-400"></i>
                    </a>
                </li>
            @endhasanyrole
        </ul>
    </div>

    <!-- Promo / Help Card -->
    <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 text-white rounded-xl shadow-lg p-6">
        <h4 class="font-semibold mb-1">Need help?</h4>
        <p class="text-white/90 text-sm mb-3">Check our FAQs or contact support anytime.</p>
        <a href="#contact" class="inline-flex items-center gap-2 bg-white/15 hover:bg-white/25 px-3 py-2 rounded-lg transition">
            <i class="bi bi-life-preserver"></i> Support
        </a>
    </div>
</div>


