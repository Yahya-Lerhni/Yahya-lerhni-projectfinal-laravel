<x-guest-layout>
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 shadow-lg px-4 py-4 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold text-white tracking-wide">
            Swi9a<span class="text-yellow-300">.com</span>
        </a>
        <div class="hidden sm:flex sm:space-x-6">
            <a href="{{ route('login') }}" class="text-white font-medium hover:text-yellow-300 transition flex items-center">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </a>
            <a href="{{ route('register') }}" class="text-white font-medium hover:text-yellow-300 transition flex items-center">
                <i class="bi bi-person-plus-fill me-1"></i> Register
            </a>
        </div>
        <div class="sm:hidden">
            <button @click="open = ! open" class="text-white">
                <i class="bi bi-list text-2xl"></i>
            </button>
        </div>
    </nav>

    <!-- Login Form Section -->
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/95 dark:bg-gray-800/95 p-8 rounded-2xl shadow-xl backdrop-blur">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-gray-100">
                تسجيل الدخول
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('register') }}" class="text-sm text-purple-700 dark:text-purple-300 hover:underline">Create account</a>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3 bg-purple-600 hover:bg-purple-700">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
