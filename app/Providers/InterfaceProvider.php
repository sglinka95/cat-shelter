<?php

namespace App\Providers;

use App\Repositories\CatRepository;
use App\Repositories\CatRepositoryInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\DepartmentRepositoryInterface;
use App\Repositories\EmployeeRepository;
use App\Repositories\EmployeeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class InterfaceProvider extends ServiceProvider
{
    const REPOSITORIES = [
        CatRepositoryInterface::class => CatRepository::class,
        EmployeeRepositoryInterface::class => EmployeeRepository::class,
        DepartmentRepositoryInterface::class => DepartmentRepository::class
    ];
    public function register()
    {
        $this->registerRepositories();
    }

    private function registerRepositories(): void
    {
        foreach(self::REPOSITORIES as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}
