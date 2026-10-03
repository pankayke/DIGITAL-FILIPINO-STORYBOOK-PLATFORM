<?php

return [
    'default_panel' => 'admin',
    'panels' => [
        'admin' => [
            'id' => 'admin',
            'path' => 'admin',
            'middleware' => ['web'],
            'auth' => [
                'guard' => 'web',
                'login' => '/login',
            ],
            'brand' => [
                'name' => 'Digital Filipino Storybook',
            ],
            'colors' => [
                'primary' => '#2E7D32',
            ],
            'pages' => [
                App\Filament\Pages\Dashboard::class,
            ],
        ],
    ],
];
