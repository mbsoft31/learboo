<?php

namespace Core\LmsLite;

use Illuminate\Support\ServiceProvider;

class LmsLiteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Add the path to your Blade view files
        $this->loadViewsFrom(__DIR__.'/View/components', 'lms');
    }
}
