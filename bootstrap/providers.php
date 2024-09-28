<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\BladeProvider::class,
    App\Providers\ConfigProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\Filament\DashboardPanelProvider::class,
    App\Providers\HorizonServiceProvider::class,
    App\Providers\RiakServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    RalphJSmit\Filament\MediaLibrary\FilamentMediaLibraryServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
];
