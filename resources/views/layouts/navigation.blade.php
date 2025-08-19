<nav x-data="{ open: false }"
     class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 shadow-lg border-b border-gray-200 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo / Brand -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold text-white tracking-wide">
                    Swi9a<span class="text-yellow-300">.com</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex sm:space-x-6 ms-10 items-center">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                   <i class="bi bi-speedometer2 me-1"></i> Dashboard
                </a>

                @role('admin')
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                       <i class="bi bi-shield-lock-fill me-1"></i> Admin
                    </a>
                    <a href="{{ route('seller.dashboard') }}"
                       class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                       <i class="bi bi-shop me-1"></i> Sellers
                    </a>
                    <a href="{{ route('customer.dashboard') }}"
                       class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                       <i class="bi bi-people-fill me-1"></i> Customers
                    </a>
                    <a href="{{ route('admin.products.pending') }}"
                       class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                       <i class="bi bi-box-seam me-1"></i> Products
                    </a>
                @endrole

                @role('seller')
                    <a href="{{ route('seller.dashboard') }}"
                       class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                       <i class="bi bi-speedometer me-1"></i> Seller Dash
                    </a>
                    <a href="{{ route('orders.index') }}"
                       class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                       <i class="bi bi-receipt-cutoff me-1"></i> Orders
                    </a>
                    <a href="{{ route('seller.products.create') }}"
                       class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                       <i class="bi bi-plus-square me-1"></i> Add Product
                    </a>
                @endrole

                @role('customer')
                    <a href="{{ route('customer.dashboard') }}"
                       class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                       <i class="bi bi-house-door me-1"></i> Home
                    </a>
                    <a href="{{ route('cart.index') }}"
                       class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                       <i class="bi bi-cart-fill me-1"></i> Cart
                    </a>
                    <a href="{{ route('wishlist.index') }}"
                       class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                       <i class="bi bi-heart-fill me-1 text-pink-300"></i> Wishlist
                    </a>
                @endrole

                @hasanyrole('customer|seller')
                    <a href="{{ url('/chatify') }}"
                       class="flex items-center text-white font-medium hover:text-yellow-300 transition">
                       <i class="bi bi-chat-dots-fill me-1"></i> Messages
                    </a>
                @endhasanyrole
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md
                                   text-white bg-indigo-700 hover:bg-indigo-800 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <i class="bi bi-caret-down-fill ms-2"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="bi bi-person-circle me-1"></i> Profile
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-indigo-700 focus:outline-none transition">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
