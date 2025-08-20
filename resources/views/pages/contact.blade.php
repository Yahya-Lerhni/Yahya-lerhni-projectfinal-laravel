<x-app-layout :show-search-bar="false">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100">Contact</h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Map (Casablanca) -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow overflow-hidden">
            <div class="aspect-[16/9]">
                <iframe title="Casablanca Map" class="w-full h-full" frameborder="0" style="border:0"
                        loading="lazy" allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13269.91717793521!2d-7.639091!3d33.5724109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7d25c1a5c6d03%3A0x261a2b7f0a5b8a1a!2sCasablanca!5e0!3m2!1sen!2sma!4v1700000000000"></iframe>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Get in touch</h3>
            <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Name</label>
                    <input type="text" class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-3 py-2" placeholder="Your name">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-3 py-2" placeholder="you@example.com">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Subject</label>
                    <input type="text" class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-3 py-2" placeholder="How can we help?">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Message</label>
                    <textarea rows="5" class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-3 py-2" placeholder="Write your message..."></textarea>
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button type="button" class="px-5 py-3 rounded-xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 text-white shadow hover:shadow-lg transition">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


