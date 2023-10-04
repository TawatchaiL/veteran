<?php

namespace App\Providers;

use App\Services\AsteriskAmiService;
use Illuminate\Support\ServiceProvider;
use App\Services\FileUploadService;
use App\Services\GraphService;
use App\Services\ECCP;
use App\Services\IssableService;
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
        $this->app->bind('asterisk_ami-service', AsteriskAmiService::class);
        $this->app->bind('eccp-service', ECCP::class);
        $this->app->bind('issable-service', IssableService::class);
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
