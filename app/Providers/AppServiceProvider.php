<?php

namespace App\Providers;

use App\Repository\Admin\AdminInterface;
use App\Repository\Admin\AdminRepository;
use App\Repository\Employee\EmployeeInterface;
use App\Repository\Employee\EmployeeRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(EmployeeInterface::class, EmployeeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
