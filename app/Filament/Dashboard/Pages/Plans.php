<?php

namespace App\Filament\Dashboard\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Plans extends Page
{
    protected static string $view = 'filament.dashboard.pages.plans';

    // Slug
    protected static ?string $slug = 'plans';

    // Navigration Group
    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }

    // Navigration
    protected static ?int $navigationSort = 90;

    protected static ?string $navigationIcon = '';

    public static function getNavigationLabel(): string
    {
        return __('Plans');
    }

    // Title
    public function getTitle(): string | Htmlable
    {
        return __('Plans');
    }
}
