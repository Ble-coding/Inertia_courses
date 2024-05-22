<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Course; // Assurez-vous d'importer votre modèle Course
use App\Policies\CoursePolicy;

// use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Course::class => CoursePolicy::class,
    ];

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
        // $this->registerPolicies();
        Gate::define('update-course', function ($course) {
            return $course->user_id === auth()->id();
        });

        Gate::define('delete-course', function ($course) {
            return $course->user_id === auth()->id();
        });
    }
}
