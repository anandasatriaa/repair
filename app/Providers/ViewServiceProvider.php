<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProductService;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Kirim data notifikasi ke semua view yang menggunakan layouts.app
        View::composer('admin.layouts.app', function ($view) {
            // Notifikasi
            $notifications = ProductService::where('status', 'ON PROGRESS')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Distinct category untuk sidebar Services
            $categories = ProductService::select('category')
                ->distinct()
                ->orderBy('category')
                ->get();

            // Kirim ke view
            $view->with([
                'notifications' => $notifications,
                'serviceCategories' => $categories,
            ]);
        });
    }
}
