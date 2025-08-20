<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen  bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Global Search & Category Filter (shown when $categories is available or when $showSearchBar is true) -->
            @includeWhen(isset($categories) || ($showSearchBar ?? false), 'layouts.topbar-filter')

            <!-- Content with Sidebar Layout -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 grid grid-cols-1 md:grid-cols-12 gap-6">
                <!-- Sidebar -->
                <aside class="hidden md:block md:col-span-3 lg:col-span-3">
                    @include('layouts.sidebar')
                </aside>

                <!-- Main Content -->
                <div class="md:col-span-9 lg:col-span-9 space-y-6">
                    @isset($header)
                        <header class="bg-white dark:bg-gray-800 shadow rounded-xl">
                            <div class="py-6 px-6">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </body>
</html>
