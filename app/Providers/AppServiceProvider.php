<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

use App\Models\Setting;

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
        //
        View::composer('dashboard.layouts.utils.sidebar', function ($view) {
            $data = Cache::remember('assets', 3600, function() {

                $setting = Setting::where('key','logo')->first();

                return [ 'logo' => $setting->value,];
            });

            return $view->with('data', $data);
        });
    }
}
