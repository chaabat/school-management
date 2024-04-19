<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\parentRepository;
use App\Repositories\studentRepository;
use App\Repositories\teacherRepository;
use App\Repositories\classRepository;
use App\Repositories\examRepository;
use App\Repositories\subjectRepository;
use App\Repositories\subjectToClasseRepository;
use App\Repositories\teacherToClasseRepository;
use App\RepositoriesInterfaces\parentRepositoryInterface;
use App\RepositoriesInterfaces\studentRepositoryInterface;
use App\RepositoriesInterfaces\teacherRepositoryInterface;
use App\RepositoriesInterfaces\classeRepositoryInterface;
use App\RepositoriesInterfaces\examRepositoryInterface;
use App\RepositoriesInterfaces\subjectsRepositoryInterface;
use App\RepositoriesInterfaces\subjectToClasseRepositoryInterface;
use App\RepositoriesInterfaces\teacherToClasseRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(parentRepositoryInterface::class, parentRepository::class);
        $this->app->bind(studentRepositoryInterface::class, studentRepository::class);
        $this->app->bind(teacherRepositoryInterface::class, teacherRepository::class);
        $this->app->bind(classeRepositoryInterface::class, classRepository::class);
        $this->app->bind(subjectsRepositoryInterface::class, subjectRepository::class);   
        $this->app->bind(examRepositoryInterface::class, examRepository::class);   
        $this->app->bind(subjectToClasseRepositoryInterface::class, subjectToClasseRepository::class);   
        $this->app->bind(teacherToClasseRepositoryInterface::class, teacherToClasseRepository::class);  
         
     }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
