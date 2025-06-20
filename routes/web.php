<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ProductCategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\Frontend\ProductCollectionController;
use App\Http\Controllers\Frontend\ProductTagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController; // New controller for cart
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Product routes
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

Route::middleware('auth')->group(function () {
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/share', [WishlistController::class, 'share'])->name('wishlist.share');
Route::middleware('auth')->post('/wishlist/{product}', [App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

// Agendas 

Route::get('/agendar', function () {
    return view('agendas.agendas');
});
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

Route::get('/wishlist/shared/{shareToken}', [WishlistController::class, 'sharedWishlist'])->name('wishlist.shared');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Category routes
Route::get('/categories', [ProductCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [ProductCategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/products', [ProductCategoryController::class, 'products'])->name('categories.products');

// Collection routes
Route::get('/collections', [ProductCollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{collection}', [ProductCollectionController::class, 'show'])->name('collections.show');
Route::get('/collections/{collection}/products', [ProductCollectionController::class, 'products'])->name('collections.products');

// Tag routes
Route::get('/tags', [ProductTagController::class, 'index'])->name('tags.index');
Route::get('/tags/{tag}', [ProductTagController::class, 'show'])->name('tags.show');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'initiateCheckout'])->name('checkout.initiate');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'showConfirmation'])->name('checkout.confirmation');

// Shipping routes
Route::get('/shipping', [ShippingController::class, 'index'])->name('shipping.index');
Route::post('/shipping', [ShippingController::class, 'store'])->name('shipping.store');
Route::put('/shipping/{shippingMethod}', [ShippingController::class, 'update'])->name('shipping.update');
Route::delete('/shipping/{shippingMethod}', [ShippingController::class, 'destroy'])->name('shipping.destroy');

// Order history routes
Route::get('/orders', [OrderHistoryController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderHistoryController::class, 'show'])->name('orders.show');

Route::prefix('payment_methods')->group(function () {
    Route::get('/', [PaymentMethodController::class,'index'])->name('payment_methods.index');
    Route::post('/store', [PaymentMethodController::class, 'addPaymentMethod'])->name('payment_methods.store');
    Route::get('/edit/{id}', [PaymentMethodController::class, 'editPaymentMethod'])->name('payment_methods.edit');
    Route::post('/update/{id}', [PaymentMethodController::class, 'editPaymentMethod'])->name('payment_methods.update');
    Route::delete('/destroy/{id}', [PaymentMethodController::class, 'deletePaymentMethod'])->name('payment_methods.destroy');
    Route::post('/set_default/{id}', [PaymentMethodController::class, 'setDefaultPaymentMethod'])->name('payment_methods.setDefault');
});

Route::post('/payment', [StripePaymentController::class, 'createOneTimePayment'])->name('payment.create');

Route::get('/subscriptions', [SubscriptionController::class, 'viewAvailableSubscriptions'])->name('subscriptions.view');
Route::post('/subscription', [SubscriptionController::class, 'subscribeToPlan'])->name('subscription.create');
Route::patch('/subscription/change', [SubscriptionController::class, 'changePlan'])->name('subscription.change-plan');
Route::delete('/subscription/cancel', [SubscriptionController::class, 'cancelSubscription'])->name('subscription.cancel');

Route::post('/paypal/payment', [PaypalPaymentController::class, 'createOneTimePayment'])->name('paypal.payment.create');
Route::post('/paypal/subscription', [PayPalPaymentController::class, 'createSubscription'])->name('paypal.subscription.create');
Route::patch('/paypal/subscription/update', [PayPalPaymentController::class, 'updateSubscription'])->name('paypal.subscription.update');
Route::delete('/paypal/subscription/cancel', [PayPalPaymentController::class, 'cancelSubscription'])->name('paypal.subscription.cancel');

// Cart route
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add'); // New route
Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // New route

// Ratings and reviews
Route::get('/product/{product}/reviews', [ReviewController::class, 'show'])->name('reviews.show');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('/reviews/approve/{id}', [ReviewController::class, 'approve'])->name('reviews.approve');
Route::post('/reviews/{id}/vote', [ReviewController::class, 'vote'])->name('reviews.vote');

Route::get('/product/{product}/ratings/average', [RatingController::class, 'calculateAverageRating'])->name('ratings.average');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

// New comparison routes
Route::post('/product/{category}/{product}/compare', [ProductController::class, 'addToCompare'])->name('products.addToCompare');
Route::get('/products/compare', [ProductController::class, 'compare'])->name('products.compare');
Route::delete('/product/{category}/{product}/compare', [ProductController::class, 'removeFromCompare'])->name('products.removeFromCompare');
Route::delete('/products/compare/clear', [ProductController::class, 'clearCompare'])->name('products.clearCompare');

// Rutas de recuperación de contraseña
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/download/{category}/{product}', [DownloadController::class, 'generateSecureLink'])->name('download.generate-link');
    Route::get('/download/file/{category}/{product}', [DownloadController::class, 'serveFile'])->name('download.serve-file');
});
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::resource('site-settings', SiteSettingController::class);
    Route::get('/site-settings', [SiteSettingController::class, 'index'])->name('site_settings.index');
    Route::get('/site-settings/{id}/edit', [SiteSettingController::class, 'edit'])->name('site_settings.edit');
    Route::post('/site-settings/{id}', [SiteSettingController::class, 'update'])->name('site_settings.update');
});

Route::get('sitemap.xml', function(){
    return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
});

Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// Pages
// TODO: implement CMS features for page and form editing 
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');
Route::view('/shop', 'shop')->name('shop');

Route::view('/account', 'account')->middleware('auth')->name('about');

// Blog routes

require __DIR__.'/socialstream.php';
