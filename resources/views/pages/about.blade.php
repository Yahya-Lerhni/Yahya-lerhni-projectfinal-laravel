<x-app-layout :show-search-bar="false">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100">About</h2>
    </x-slot>

    <!-- Hero Background -->
    <div class="relative overflow-hidden rounded-2xl shadow">
        <img src="https://plus.unsplash.com/premium_photo-1683141052679-942eb9e77760?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="About image" class="w-full h-64 object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-700/70 via-purple-700/60 to-pink-600/60"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="px-6 sm:px-8 text-white">
                <h3 class="text-3xl font-extrabold">Swi9a.com</h3>
                <p class="mt-2 text-white/90 max-w-2xl">A modern e‑commerce experience built with Laravel. Browse, chat, wishlist, and purchase seamlessly across devices with role-based dashboards for Admins, Sellers, and Customers.</p>
            </div>
        </div>
    </div>

    <!-- Content Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
            <h4 class="font-semibold text-gray-900 dark:text-white">Our Mission</h4>
            <p class="text-gray-600 dark:text-gray-300 mt-2">Empower small businesses and customers with a clean, fast, and secure marketplace featuring messaging and smooth checkout.</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
            <h4 class="font-semibold text-gray-900 dark:text-white">Technology</h4>
            <p class="text-gray-600 dark:text-gray-300 mt-2">Laravel, Tailwind CSS, Alpine.js, and a modular Blade component architecture for maintainability and performance.</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
            <h4 class="font-semibold text-gray-900 dark:text-white">Experience</h4>
            <p class="text-gray-600 dark:text-gray-300 mt-2">Beautiful UI, responsive layouts, role-aware sidebars, and delightful micro-interactions throughout the shopping journey.</p>
        </div>
    </div>

    <!-- Gallery -->
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $imgs = [
                'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1600&auto=format&fit=crop',
                'https://plus.unsplash.com/premium_photo-1664302148512-ddea30cd2a92?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://plus.unsplash.com/premium_photo-1663957923326-f05b0b3912e8?q=80&w=1343&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ];
        @endphp
        @foreach($imgs as $src)
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <img src="{{ $src }}" alt="E-commerce" class="w-full h-56 object-cover">
            </div>
        @endforeach
    </div>
</x-app-layout>


