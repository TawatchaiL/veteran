<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FileUploadService;
use App\Services\GraphService;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('file-upload-service', function () {
            return new FileUploadService();
        });
        $this->app->bind('graph-service', GraphService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::addNamespace('graph', resource_path('views/graph'));
    }
   

}
