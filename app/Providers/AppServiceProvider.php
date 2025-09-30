<?php
namespace App\Providers;

use App\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

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
        // تخصيص rate limit لـ API بشكل عام
        RateLimiter::for('api', function (Request $request) {
            return RateLimiter::perMinute(60); 
        });

        // تخصيص rate limit لـ login مثلا
        RateLimiter::for('login', function (Request $request) {
            return RateLimiter::perMinute(5); 
        });

        Route::middleware([
            EnsureFrontendRequestsAreStateful::class,
        ])->group(function () {
        });
    }
}
