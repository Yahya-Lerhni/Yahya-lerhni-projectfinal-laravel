<x-guest-layout>
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 shadow-lg px-4 py-4 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold text-white tracking-wide">
            Swi9a<span class="text-yellow-300">.com</span>
        </a>
        <div class="hidden sm:flex sm:space-x-6">
            <a href="{{ route('login') }}" class="text-white font-medium hover:text-yellow-300 transition flex items-center gap-1">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
            <a href="{{ route('register') }}" class="text-white font-medium hover:text-yellow-300 transition flex items-center gap-1">
                <i class="bi bi-person-plus-fill"></i> Register
            </a>
        </div>
        <div class="sm:hidden">
            <button @click="open = ! open" class="text-white text-2xl">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </nav>

    <!-- Register Form Section -->
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/95 dark:bg-gray-800/95 p-8 rounded-2xl shadow-xl backdrop-blur">
            <div class="text-center mb-6">
                <a href="{{ route('dashboard') }}" class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">
                    Swi9a<span class="text-yellow-300">.com</span>
                </a>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-300 focus:ring-opacity-50" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-300 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Role -->
                <div>
                    <x-input-label for="role" :value="__('Role')" />
                    <select id="role" name="role" required class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-300 focus:ring-opacity-50">
                        <option selected disabled value="">-- Choose Role --</option>
                        <option value="seller">Seller</option>
                        <option value="customer">Customer</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-300 focus:ring-opacity-50" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-300 focus:ring-opacity-50" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-purple-700 dark:text-purple-300 hover:underline">
                        Already registered?
                    </a>
                    <x-primary-button class="bg-purple-600 hover:bg-purple-700 focus:ring-purple-300 transition">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
