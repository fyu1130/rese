<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopManagerController;
use App\Http\Controllers\PaymentController;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return redirect('/thanks');
    }

    if ($request->hasValidSignature()) {
        $request->fulfill();

        return redirect('/thanks');
    }

    return redirect('/login')->withErrors(['message' => '無効なリンクです。']);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['auth', 'role_based_verified'])->group(function () {
    Route::get('/', [ShopController::class, 'index']);
    Route::post('/', [SearchController::class, 'search'])->name('shop.search');
    Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('shop.detail');
    Route::post('/like', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/reserve/{id}', [ReserveController::class, 'destroy'])->name('reserve.cancel');
    Route::delete('/like/{id}', [LikeController::class, 'destroy'])->name('like.destroy');
    Route::post('/done', [ReserveController::class, 'store'])->name('reserve.store');
    Route::get('/thanks', function () {
        return view('thanks');
    })->name('thanks');
    Route::get('/done', function () {
        return view('done');
    });
    Route::get('/mypage', [UserController::class, 'index'])->name('my_page');
    Route::get('/reserve/{id}/edit', [ReserveController::class, 'edit'])->name('reserve.edit');
    Route::put('/reserve/{id}', [ReserveController::class, 'update'])->name('reserve.update');
    Route::get('/shops/{shop}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/shops/{shop}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::post('/reserve/{id}/qr', [ReserveController::class, 'generateQrCode'])->name('reserve.qr');
    Route::post('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/{paymentId}/charge', [PaymentController::class, 'charge'])->name('payments.charge');
    Route::get('/payments/{paymentId}/complete', [PaymentController::class, 'complete'])->name('payments.complete');

});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin/shops', [AdminController::class, 'index'])->name('admin.shops.index');
    Route::get('/admin/shops/create', [AdminController::class, 'store'])->name('admin.users.store');
    Route::post('/admin/shops/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::get('/admin/users/email', [AdminController::class, 'createEmail'])->name('admin.email.create');
    Route::post('/admin/users/email', [AdminController::class, 'sendEmail'])->name('admin.email.send');
});
Route::middleware(['auth', 'can:shop_manager'])->group(function () {
    Route::get('/shop-manager/shops', [ShopManagerController::class, 'index'])->name('shop_manager.shops.index');

    Route::get('/shop-manager/shops/create', [ShopManagerController::class, 'store'])->name('shop_manager.shops.store');
    Route::post('/shop-manager/shops/create', [ShopManagerController::class, 'create'])->name('shop_manager.shops.create');
    Route::get('/shop-manager/shops/{shop}/edit', [ShopManagerController::class, 'edit'])->name('shop_manager.shops.edit');
    Route::put('/shop-manager/shops/{shop}', [ShopManagerController::class, 'update'])->name('shop_manager.shops.update');
    Route::get('/shop-manager/reservations', [ShopManagerController::class, 'reservations'])->name('shop_manager.reservations.index');
    Route::get('/shop-manager/verify-reservation', [ShopManagerController::class, 'verify'])->name('reserve.verify');
});