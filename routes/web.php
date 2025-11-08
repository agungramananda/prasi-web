<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\EcommerceLinkController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])
    ->middleware('throttle:contact')
    ->name('contact.submit');

// Public news routes
Route::get('/news', [PageController::class, 'newsIndex'])->name('news.index');
Route::get('/news/{slug}', [PageController::class, 'newsShow'])->name('news.show');

Route::get('/lang/{locale}', function (Request $request, string $locale) {
    $available = ['id', 'en'];
    if (! in_array($locale, $available, true)) {
        abort(404);
    }

    session(['locale' => $locale]);

    $redirect = $request->query('redirect');
    if (is_string($redirect) && $redirect !== '') {
        $appHost = parse_url(url('/'), PHP_URL_HOST);
        $targetHost = parse_url($redirect, PHP_URL_HOST);
        if ($targetHost === null || $targetHost === $appHost) {
            return redirect()->to($redirect);
        }
    }

    return redirect()->back() ?: redirect()->route('home');
})->name('lang.switch');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::resource('social-media', SocialMediaController::class);
    Route::resource('ecommerce-links', EcommerceLinkController::class);
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::get('contact-messages', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('contact-messages/{contact_message}', [App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::delete('contact-messages/{contact_message}', [App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');
    Route::patch('contact-messages/{contact_message}/read', [App\Http\Controllers\Admin\ContactMessageController::class, 'markAsRead'])->name('contact-messages.read');
    Route::post('contact-messages/bulk', [App\Http\Controllers\Admin\ContactMessageController::class, 'bulk'])->name('contact-messages.bulk');
});

require __DIR__.'/auth.php';
