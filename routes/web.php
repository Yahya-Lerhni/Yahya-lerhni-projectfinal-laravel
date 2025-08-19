<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerProductController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// صفحة عامة بعد تسجيل الدخول
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// مسارات خاصة بالأدمن فقط
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.admin-dashboard');
    })->name('admin.dashboard');
});

// مسارات خاصة بالبائع (seller) أو الأدمن
Route::middleware(['auth', 'role:seller|admin'])->group(function () {
    Route::get('/seller/dashboard', function () {
        return view('seller.seller-dashboard');
    })->name('seller.dashboard');
});

// مسارات خاصة بالزبون (customer) أو الأدمن
Route::middleware(['auth', 'role:customer|admin'])->group(function () {
    Route::get('/customer/dashboard', function () {
        return view('customer.customer-dashboard');
    })->name('customer.dashboard');
});

// مسارات البروفايل
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// create product
Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('products/create', [SellerProductController::class, 'create'])->name('products.create');
    Route::post('products', [SellerProductController::class, 'store'])->name('products.store');
});
// admin accept product
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('products/pending', [AdminController::class, 'index'])->name('products.pending');
    Route::patch('products/{product}/approve', [AdminController::class, 'approve'])->name('products.approve');
    Route::patch('products/{product}/reject', [AdminController::class, 'reject'])->name('products.reject');
});
// dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// add to cart
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
});

// stripe check out

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
});

// orders
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// whishlist
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{item}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/move-to-cart/{item}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
});

// Chatify will use its default routes
// The package automatically registers routes at /chatify with proper middleware






require __DIR__ . '/auth.php';
