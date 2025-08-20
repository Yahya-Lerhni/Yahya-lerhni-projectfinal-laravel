<section id="home" class="bg-gray-50 dark:bg-gray-900">
    <!-- Hero with Background Image and CTA -->
    <div class="relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1920&auto=format&fit=crop" alt="E-commerce background" class="w-full h-[360px] sm:h-[440px] object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-700/80 via-purple-700/70 to-pink-600/70"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
                <h1 class="text-3xl sm:text-5xl font-extrabold leading-tight">Discover modern products at unbeatable prices</h1>
                <p class="mt-3 text-white/90 max-w-2xl">Shop the latest electronics, fashion, and accessories. Seamless checkout, wishlist, and role-based features are ready for you.</p>
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('login') }}" class="px-5 py-3 rounded-xl bg-white text-indigo-700 font-semibold shadow hover:shadow-lg transition">Login</a>
                    <a href="{{ route('register') }}" class="px-5 py-3 rounded-xl bg-gradient-to-r from-yellow-300 to-pink-300 text-gray-900 font-semibold shadow hover:shadow-lg transition">Register</a>
                </div>
            </div>
        </div>
    </div>

    <!-- cards dyal product dyali -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Featured Products</h2>
            <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Sign in to buy</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-6">
            @php
                $products = ($products ?? null) ?: \App\Models\Product::where('status', 'approved')
                    ->latest()
                    ->take(30)
                    ->get();
            @endphp

            @forelse($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition group overflow-hidden flex flex-col">
                    @php
                        $img = $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1200&auto=format&fit=crop';
                    @endphp
                    <img src="{{ $img }}" alt="{{ $product->name }}" class="h-40 w-full object-cover group-hover:scale-105 transition duration-300">
                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="font-semibold text-gray-900 dark:text-white">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">Top-quality product for daily use and style.</p>
                        <div class="flex items-center justify-between mt-auto pt-3">
                            <span class="text-indigo-700 dark:text-indigo-300 font-bold text-lg">${{ $product->price }}</span>
                            <a href="{{ route('login') }}" class="text-sm px-3 py-1.5 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 dark:text-gray-400">No products available yet.</div>
            @endforelse
        </div>
    </div>

    <!-- Background image khfifa -->
    <div class="relative mt-8">
        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1920&auto=format&fit=crop" alt="Shop CTA" class="w-full h-[260px] object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-800/80 via-purple-700/70 to-pink-600/70"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white">
                <h3 class="text-2xl sm:text-3xl font-extrabold">Your marketplace for everything</h3>
                <p class="mt-2 text-white/90">Join now and start shopping the smart way.</p>
                <div class="mt-5 flex gap-3 justify-center">
                    <a href="{{ route('login') }}" class="px-5 py-3 rounded-xl bg-white text-indigo-700 font-semibold shadow hover:shadow-lg transition">Login</a>
                    <a href="{{ route('register') }}" class="px-5 py-3 rounded-xl bg-gradient-to-r from-yellow-300 to-pink-300 text-gray-900 font-semibold shadow hover:shadow-lg transition">Register</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Carousel mn tailwind -->
    <div x-data="{ i: 0, slides: [
        'https://plus.unsplash.com/premium_photo-1681488262364-8aeb1b6aac56?w=1200',
        'https://plus.unsplash.com/premium_photo-1664475347754-f633cb166d13?w=1200',
        'https://plus.unsplash.com/premium_photo-1677995700941-100976883af7?w=1200'] }"
     class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="relative h-72 sm:h-80 md:h-96 rounded-2xl overflow-hidden shadow-lg">
        <template x-for="(src, idx) in slides" :key="idx">
            <img :src="src"
                 x-show="i === idx"
                 x-transition
                 class="absolute inset-0 w-full h-full object-cover"
                 alt="carousel">
        </template>

        <div class="absolute inset-0 bg-black/20"></div>

        <!-- Indicators -->
        <div class="absolute inset-x-0 bottom-3 flex justify-center gap-2">
            <template x-for="(src, idx) in slides" :key="idx">
                <button @click="i = idx"
                        :class="i === idx ? 'bg-white' : 'bg-white/60'"
                        class="w-2.5 h-2.5 rounded-full"></button>
            </template>
        </div>

        <!-- Controls -->
        <button @click="i = (i + slides.length - 1) % slides.length"
                class="absolute left-3 top-1/2 -translate-y-1/2 text-white bg-black/30 hover:bg-black/50 p-2 rounded-full">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button @click="i = (i + 1) % slides.length"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-white bg-black/30 hover:bg-black/50 p-2 rounded-full">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>
</div>

</section>


