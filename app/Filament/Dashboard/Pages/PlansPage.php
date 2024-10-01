<?php

namespace App\Filament\Dashboard\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class PlansPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.dashboard.pages.plans-page';

    public function getTitle(): string | Htmlable
    {
        return __('Plans');
    }

    public static function getNavigationLabel(): string
    {
        return __('Plans');
    }

    protected static ?string $slug = 'plans';
}
