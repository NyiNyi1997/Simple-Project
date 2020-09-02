<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EmployeeRepository;
use App\Repositories\PositionRepository;
use App\Repositories\EmployeeDepartmentPositionRepository;
use App\Repositories\Interfaces\EmployeeRepositoryInterfaces;
use App\Repositories\Interfaces\PositionRepositoryInterfaces;
use App\Repositories\Interfaces\EmployeeDepartmentPositionRepositoryInterfaces;



class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeeRepositoryInterfaces::class, EmployeeRepository::class);

        $this->app->bind(EmployeeDepartmentPositionRepositoryInterfaces::class, EmployeeDepartmentPositionRepository::class);

        $this->app->bind(PositionRepositoryInterfaces::class, PositionRepository::class);
        
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
