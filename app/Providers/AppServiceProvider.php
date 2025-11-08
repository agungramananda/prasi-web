<?php

namespace App\Providers;

use App\Models\SocialMedia;
use App\Models\EcommerceLink;
use App\Models\Product;
use App\Models\News;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    // Locale is now set via middleware (App\Http\Middleware\SetLocale)

        // Share social media and ecommerce links with all views
        View::composer('*', function ($view) {
            $view->with('socialMedia', SocialMedia::active()->get());
            $view->with('ecommerceLinks', EcommerceLink::active()->get());
        });

        // Cache invalidation for home page cached queries
        $clearHomeCaches = function () {
            foreach (['id','en'] as $locale) {
                Cache::forget("home.featuredProducts.$locale");
                Cache::forget("home.news.$locale");
            }
            Cache::forget('home.socialMedia');
            Cache::forget('home.ecommerceLinks');
        };

        Product::saved($clearHomeCaches);
        Product::deleted($clearHomeCaches);
    News::saved($clearHomeCaches);
    News::deleted($clearHomeCaches);

        // Define rate limiter for contact form submissions
        RateLimiter::for('contact', function (Request $request) {
            $ip = $request->ip() ?: 'unknown';
            return \Illuminate\Cache\RateLimiting\Limit::perMinute(5)->by($ip)
                ->response(function () use ($request) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'message' => __('Terlalu banyak percobaan. Coba lagi nanti.')
                        ], 429);
                    }
                    return redirect()->back()->withInput()->withErrors([
                        'rate' => __('Terlalu banyak percobaan. Coba lagi nanti.'),
                    ]);
                });
        });
    }
}
