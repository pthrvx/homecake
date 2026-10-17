<?php
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\GalleryController as AdminGallery;
use App\Http\Controllers\Admin\OrderController as AdminOrder;
use App\Http\Controllers\Admin\ProductController as AdminProduct;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/menu/{product}', 'show')->name('product.show');
    Route::get('/galeri', 'gallery')->name('gallery');
    Route::get('/tentang', 'about')->name('about');
    Route::get('/pesan', 'orderForm')->name('order.create');
    Route::post('/pesan', 'orderStore')->middleware('throttle:5,10')->name('order.store'); // maks 5 pesanan / 10 menit / IP
    Route::get('/pesan/terima-kasih', 'thanks')->name('order.thanks');
});

Route::get('/cek-pesanan', [TrackingController::class, 'form'])->name('track.form');
Route::post('/cek-pesanan', [TrackingController::class, 'check'])->middleware('throttle:10,1')->name('track.check');

Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login'); // nama 'login' dipakai middleware auth
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.post');

    Route::middleware('auth:admin')->name('admin.')->group(function () {
        Route::get('/', fn () => redirect()->route('admin.orders.index'));
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::resource('products', AdminProduct::class)->except('show');
        Route::resource('orders', AdminOrder::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('gallery', AdminGallery::class)->only(['index', 'store', 'destroy']);
    });
});
