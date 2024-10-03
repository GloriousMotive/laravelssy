<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Filament\Http\Middleware\Authenticate;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class DashboardPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('dashboard')
            ->path('dashboard')
            ->colors([
                'primary' => Color::Teal,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label(__('Admin Panel'))
                    ->visible(
                        fn() => auth()->user()->isAdmin()
                    )
                    ->url(fn() => route('filament.admin.pages.dashboard'))
                    ->icon('heroicon-s-cog-8-tooth'),
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label(fn(): string => __('Settings'))
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ])
            ->navigationItems([
                NavigationItem::make('Profile')
                    ->label(fn(): string => __('Profile'))
                    ->group(fn(): string => __('Settings'))
                    ->icon('')
                    ->url(fn(): string => \Jeffgreco13\FilamentBreezy\Pages\MyProfilePage::getUrl())
                    ->isActiveWhen(fn() => request()->routeIs('filament.dashboard.pages.profile')),
            ])
            ->discoverResources(in: app_path('Filament/Dashboard/Resources'), for: 'App\\Filament\\Dashboard\\Resources')
            ->discoverPages(in: app_path('Filament/Dashboard/Pages'), for: 'App\\Filament\\Dashboard\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->viteTheme('resources/css/filament/dashboard/theme.css')
            ->discoverWidgets(in: app_path('Filament/Dashboard/Widgets'), for: 'App\\Filament\\Dashboard\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \App\Http\Middleware\SetLocale::class,
            ])
            ->renderHook('panels::head.start', function () {
                return view('components.layouts.partials.analytics');
            })
            ->authMiddleware([
                Authenticate::class,
            ])->plugins([
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: true,
                        shouldRegisterNavigation: false,
                        hasAvatars: false,
                        slug: 'profile',
                        navigationGroup: 'Settings',
                    )
                    ->myProfileComponents([
                        \App\Livewire\AddressForm::class,
                        'personal_info' => \App\Livewire\PersonalInfoForm::class,
                    ]),
                \RalphJSmit\Filament\MediaLibrary\FilamentMediaLibrary::make()
                    ->modelItem(\App\Models\MediaLibraryItem::class)
                    ->modelFolder(\App\Models\MediaLibraryFolder::class)
                    ->mediaInfoComponent(\App\Livewire\MediaInfo::class)
                    ->acceptImage()
                    ->acceptVideo()
                    ->slug('media-library')
                    ->pageTitle('Media Library')
                    ->navigationLabel('Media Library')
                    ->navigationIcon('heroicon-o-folder-arrow-down')
                    ->navigationGroup('')
                    ->navigationSort(20),
            ]);
    }
}
