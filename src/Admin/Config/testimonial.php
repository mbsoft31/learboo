<?php


return [
    'database' => 'eloquent', // eloquent or file

    'file' => [
        'path' => resource_path('data/testimonials.php'),
    ],

    'eloquent' => [
        'model' => \App\Models\Testimonial::class,
    ],
];
