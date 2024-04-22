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
 use App\Services\parentService;
 
use App\Services\teacherService;
 
use App\Services\studentService;
use App\Repositories\TimeTableRepository;
use App\RepositoriesInterfaces\TimeTableRepositoryInterface;
use App\ServiceInterface\teacherToClasseServiceInterface;
use App\Services\classeService;
use App\Services\examService;
use App\Services\subjectService;
use App\Services\subjectToClasseService;
use App\Services\teacherToClasseService;
use App\Services\timeTableService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        

 
 
        $this->app->bind(TimeTableRepositoryInterface::class, TimeTableRepository::class);
        $this->app->bind(timeTableService::class, function ($app) {
            return new timeTableService($app->make(TimeTableRepositoryInterface::class));
        });
         


        $this->app->bind(parentRepositoryInterface::class, parentRepository::class);
        $this->app->bind(parentService::class, function ($app) {
            return new parentService($app->make(parentRepositoryInterface::class));
        });

        $this->app->bind(teacherRepositoryInterface::class, teacherRepository::class);
        $this->app->bind(teacherService::class, function ($app) {
            return new teacherService($app->make(teacherRepositoryInterface::class));
        });

        $this->app->bind(studentRepositoryInterface::class, studentRepository::class);
        $this->app->bind(studentService::class, function ($app) {
            return new studentService($app->make(studentRepositoryInterface::class));
        });

        $this->app->bind(subjectsRepositoryInterface::class, subjectRepository::class);   
        $this->app->bind(subjectService::class, function ($app) {
            return new subjectService($app->make(subjectsRepositoryInterface::class));
        });


        $this->app->bind(classeRepositoryInterface::class, classRepository::class);
        $this->app->bind(classeService::class, function ($app) {
            return new classeService($app->make(classeRepositoryInterface::class));
        });

        $this->app->bind(examRepositoryInterface::class, examRepository::class);   
        $this->app->bind(examService::class, function ($app) {
            return new examService($app->make(examRepositoryInterface::class));
        });

        $this->app->bind(subjectToClasseRepositoryInterface::class, subjectToClasseRepository::class); 
        $this->app->bind(subjectToClasseService::class, function ($app) {
            return new subjectToClasseService($app->make(subjectToClasseRepositoryInterface::class));
        });

        $this->app->bind(teacherToClasseRepositoryInterface::class, teacherToClasseRepository::class);
        // $this->app->bind(teacherToClasseService::class, function ($app) {
        //     return new teacherToClasseService($app->make(teacherToClasseRepositoryInterface::class));
        // });
        
        
     }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
