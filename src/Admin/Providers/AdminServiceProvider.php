<?php

namespace Core\Admin\Providers;

use Core\Admin\Repositories\Testimonial\TestimonialFileRepository;
use Illuminate\Support\ServiceProvider;
use Core\Admin\Repositories\Testimonial\TestimonialRepositoryContract;
use Core\Admin\Repositories\Testimonial\TestimonialEloquentRepository;

class AdminServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/testimonial.php', 'testimonial');

        $key = config('testimonial.database');
        $repository = config('testimonial.' . $key);

        $repositoryClass = $key === 'file' ? fn() => new TestimonialFileRepository($repository['path']) :
            ($key === 'eloquent' ? fn() => new TestimonialEloquentRepository($repository['model']) :
                fn() => new TestimonialFileRepository());

        //dump($repositoryClass, $repository);
        $this->app->bind(TestimonialRepositoryContract::class, $repositoryClass);
    }

    /*public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->publishes([
            __DIR__ . '/../config/admin.php' => config_path('admin.php'),
        ], 'config');
    }*/
}
