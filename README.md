# SSy Larava
## Installation
1. Um das SaasyKit als Basis zu verwenden, wird zuerst ein neues GitHub-Repository erstellt und anschließend das SaasyKit als Basis definiert:
```
git remote add upstream https://github.com/saasykit/saasykit
git remote -v
git fetch upstream
git merge upstream/main
```
2. Composer abhängigkeiten installieren:
```
composer install --ignore-platform-reqs --no-interaction --no-scripts --prefer-dist
```

3. Node Package Manager abhängigkeiten installieren und Build-Prozesses ausführen:
```
npm install
npm run build
```

4. Laravel .env erstellen und anpassen:
```
cp .env.example .env
```

5. Laravel Basis installation durchführen:
```
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

6. Upstream Repository auf Github pushen:
```
git push origin main
```

## Spickzettel
### Erweiterungen
- SaaSykit: [SaaSykit](https://saasykit.com/)
- filament: [filament/filament](https://filamentphp.com/)
- Laravel: [laravel/laravel](https://laravel.com/)
- Profile: [jeffgreco13/filament-breezy](https://github.com/jeffgreco13/filament-breezy)
- Laravel Media Library: [spatie/laravel-medialibrary](https://spatie.be/docs/laravel-medialibrary/v11/introduction)
- Media Library Manager: [ralphjsmit/laravel-filament-media-library](https://filamentphp.com/plugins/ralphjsmit-media-library-manager)

### Git
1. Repository auf Commit zurücksetzen:
```
git reset --soft <commit-id>
git push origin main --force
```

2. Datenbank erneuern und seeden:
```
php artisan migrate:refresh --seed
```

3. Controller erstellen
```
php artisan make:controller DummyController
```

4. Middleware erstellen
```
php artisan make:middleware DummyController
```

5. Events auflisten
```
php artisan event:list
```

6. Listner hinzufügen
```
php artisan make:listener Dummy --event=Illuminate\Auth\Events\Login
```

7. Test hinzufügen
```
php artisan make:test UserTest
php artisan make:test UserTest --unit
```

8. Test durchführen
```
php artisan test
```

9. Nur Custom Feature Tests durchführen
```
php artisan test --testsuite=Feature --stop-on-failure --filter='Custom'
```

## Erweiterungen & Funktionen

### Blog und Roadmap aus saasykit/saasykit entfernen
Die folgenden Dateien und Verzeichnisse werden entfernt:
```
app\Constants\RoadmapItemStatus.php
app\Constants\RoadmapItemType.php
app\Filament\Admin\Resources\BlogPostCategoryResource*
app\Filament\Admin\Resources\BlogPostResource*
app\Filament\Admin\Resources\RoadmapItemResource*
app\Filament\Admin\Resources\BlogPostCategoryResource.php
app\Filament\Admin\Resources\BlogPostResource.php
app\Filament\Admin\Resources\RoadmapItemResource.php
app\Http\Controllers\BlogController.php
app\Http\Controllers\RoadmapController.php
app\Livewire\Forms\RoadmapItemForm.php
app\Livewire\Roadmap*
app\Mapper\RoadmapMapper.php
app\Models\BlogPost.php
app\Models\BlogPostCategory.php
app\Models\RoadmapItem.php
app\Policies\BlogPostCategoryPolicy.php
app\Policies\BlogPostPolicy.php
app\Policies\RoadmapItemPolicy.php
app\Services\BlogManager.php
app\Services\RoadmapManager.php
database\migrations\2023_11_03_132810_create_blog_post_categories_table.php
database\migrations\2023_11_03_132814_create_blog_posts_table.php
database\migrations\2024_03_31_195937_create_roadmap_items_table.php
database\migrations\2024_03_31_200638_create_roadmap_item_user_upvotes_table.php
database\migrations\2024_04_09_095954_table_roadmap_items_adjust_slug_type.php
resources\js\blog.js
resources\views\blog*
resources\views\roadmap*
resources\views\livewire\roadmap*
resources\views\components\blog*
resources\views\components\roadmap*
tests\Feature\Filament\Admin\Resources\BlogPostCategoryResourceTest.php
tests\Feature\Filament\Admin\Resources\BlogPostResourceTest.php
tests\Feature\Filament\Admin\Resources\RoadmapResourceTest.php
tests\Feature\Http\Controllers\BlogControllerTest.php
tests\Feature\Http\Controllers\RoadmapControllerTest.php
tests\Feature\Services\RoadmapManagerTest.php 
```
Nun werden die folgenden Dateien bereinigt:
```
app\Constants\ConfigConstants.php
- 'app.roadmap_enabled',

app\Livewire\Filament\GeneralSettings.php
- 'roadmap_enabled' => $this->configManager->get('app.roadmap_enabled', true),

- Tabs\Tab::make(__('Roadmap'))
-     ->icon('heroicon-o-bug-ant')
-     ->schema([
-         Toggle::make('roadmap_enabled')
-             ->label(__('Roadmap Enabled'))
-             ->helperText(__('If enabled, the roadmap will be visible to the public.'))
-             ->required(),
-     ]),

app\Models\User.php 
- public function roadmapItems()
- {
-     return $this->hasMany(RoadmapItem::class);
- }
- 
- public function roadmapItemUpvotes()
- {
-     return $this->belongsToMany(RoadmapItem::class, 'roadmap_item_user_upvotes');
- }

app\Providers\Filament\AdminPanelProvider.php
- NavigationGroup::make()
-     ->label('Blog')
-     ->icon('heroicon-s-newspaper')
-     ->collapsed(),
- NavigationGroup::make()
-     ->label('Roadmap')
-     ->icon('heroicon-s-bug-ant')
-     ->collapsed(),

resources\views\components\layouts\app\footer.blade.php
- <li class="mb-4">
-     <a href="{{route('blog')}}" class="text-primary-100 hover:text-primary-50">{{ __('Blog') }}</a>
- </li>

resources\views\components\layouts\app\navigation-links.blade.php
- <x-nav.item route="roadmap">{{ __('Roadmap') }}</x-nav.item>
- <x-nav.item route="blog">{{ __('Blog') }}</x-nav.item>

config\app.php
- 'roadmap_enabled' => true,

routes\web.php
- Route::get('/blog/{slug}', [
-     App\Http\Controllers\BlogController::class,
-     'view',
- ])->name('blog.view');
- 
- Route::get('/blog', [
-     App\Http\Controllers\BlogController::class,
-     'all',
- ])->name('blog')->middleware('sitemapped');
- 
- Route::get('/blog/category/{slug}', [
-     App\Http\Controllers\BlogController::class,
-     'category',
- ])->name('blog.category');

- Route::get('/roadmap/suggest', [
-     App\Http\Controllers\RoadmapController::class,
-     'suggest',
- ])->name('roadmap.suggest')->middleware('auth');
- 
- Route::get('/roadmap', [
-     App\Http\Controllers\RoadmapController::class,
-     'index',
- ])->name('roadmap');
- 
- Route::get('/roadmap/i/{itemSlug}', [
-     App\Http\Controllers\RoadmapController::class,
-     'viewItem',
- ])->name('roadmap.viewItem');

vite.config.js
- 'resources/js/blog.js',
```

### User Seeder
Erstellt den admin und user@pornmgr.com Benutzer
```
+ database\seeders\UserSeeder.php

database\seeders\DatabaseSeeder.php
+ UserSeeder::class,

- app\Console\Commands\CreateAdminUser.php
```

### Redirect zum Dashboard nach dem Login
```
app\Http\Controllers\Auth\LoginController.php
+ return redirect()->route('filament.dashboard.pages.dashboard');
```

Test
```
tests\Feature\Custom\RedirectAfterLoginTest.php
```

### Localization
Middleware hinzufügen und registieren
```
+ app\Http\Middleware\SetLocale.php

bootstrap\app.php
+ \App\Http\Middleware\SetLocale::class,

app\Providers\Filament\AdminPanelProvider.php
+ \App\Http\Middleware\SetLocale::class,

app\Providers\Filament\DashboardPanelProvider.php
+ \App\Http\Middleware\SetLocale::class,
```

Controller hinzufügen und in den routes definieren
```
+ app\Http\Controllers\LocaleController.php

routes\web.php
+ Route::get('/', [App\Http\Controllers\LocaleController::class, 'redirect']);

+ Route::prefix('{locale}')->where(['locale' => '([a-z]{2})'])->group(function () {});

+ Route::get('/locale/{locale}', [App\Http\Controllers\LocaleController::class, 'change'])
    ->name('locale.change');
```

Datenbank erweitern
```
database\migrations\2024_09_26_123117_add_locale_column_to_users_table.php
```

Listener erstellen
```
+ app\Listeners\SetLocaleAfterLogin.php
+ app\Listeners\SetLocaleAfterRegistered.php
```

Test
```
tests\Feature\Custom\LocaleTest.php
```

### Redirect zum Dashboard nach product und subscription-thank-you
```
resources\views\checkout\product-thank-you.blade.php
+ <x-button-link.primary href="{{ route('filament.dashboard.pages.dashboard') }}" class="mt-4 mx-auto">

resources\views\checkout\subscription-thank-you.blade.php
+ <x-button-link.primary href="{{ route('filament.dashboard.pages.dashboard') }}" class="mt-4 mx-auto">
```

### Profiel Pfad von my-profile auf profile anpassen
```
app\Providers\Filament\DashboardPanelProvider.php
+ slug: 'profile'

app\Providers\Filament\AdminPanelProvider.php
+ slug: 'profile'

app\Filament\Dashboard\Resources\TransactionResource.php
+ ->url(route('filament.dashboard.pages.profile'))
```

### Profile Sprache auswählen
```
+ app\Livewire\PersonalInfoForm.php

app\Providers\Filament\DashboardPanelProvider.php
+ 'personal_info' => \App\Livewire\PersonalInfoForm::class,

app\Providers\Filament\AdminPanelProvider.php
+ ->myProfileComponents([
+     'personal_info' => \App\Livewire\PersonalInfoForm::class,
+ ]),
```

### Init Laravel Media Library
Composer Paket installieren, Migration veröffentlichen und durchführen sowie Konfiguration veröffentlichen
```
composer require spatie/laravel-medialibrary --ignore-platform-reqs --no-interaction --no-scripts --prefer-dist

php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"
php artisan migrate

php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-config"
```

### Init Media Library Manager
Composer Paket konfigurieren
```
composer.json
+ "repositories": [
+     {
+         "type": "composer",
+         "url": "https://satis.ralphjsmit.com"
+     }
+ ]

auth.json
+ {
+     "http-basic": {
+         "satis.ralphjsmit.com": {
+             "username": "info@valeum.ch",
+             "password": "37941d51-84d3-49a9-9d8d-b3bf03092703"
+         }
+     }
+ }

.gitignore
- auth.json
```

Composer Paket installieren, Migration veröffentlichen und durchführen
```
composer config --no-plugins allow-plugins.ralphjsmit/packages true

composer require ralphjsmit/laravel-filament-media-library --ignore-platform-reqs --no-interaction --no-scripts --prefer-dist
```

```
bootstrap\providers.php
+ RalphJSmit\Filament\MediaLibrary\FilamentMediaLibraryServiceProvider::class,
```

```
php artisan vendor:publish --tag="filament-media-library-migrations"
php artisan migrate
```

Template komponenten hinzufügen
```
resources\css\filament\admin\tailwind.config.js
+ './vendor/ralphjsmit/laravel-filament-media-library/resources/**/*.blade.php'

resources\css\filament\dashboard\tailwind.config.js
+ './vendor/ralphjsmit/laravel-filament-media-library/resources/**/*.blade.php'
```

```
app\Providers\Filament\DashboardPanelProvider.php
+ \RalphJSmit\Filament\MediaLibrary\FilamentMediaLibrary::make()
```

### Media Library Manager Items und Folder auf User einschränken
```
+ database\migrations\2024_09_28_073814_add_created_by_user_id_column_to_filament_media_library_folders_table.php

+ app\Models\MediaLibraryItem.php
+ app\Models\MediaLibraryFolder.php

app\Providers\Filament\DashboardPanelProvider.php
+ ->modelItem(\App\Models\MediaLibraryItem::class)
+ ->modelFolder(\App\Models\MediaLibraryFolder::class)

app\Providers\Filament\AdminPanelProvider.php
+ ->modelItem(\App\Models\MediaLibraryItem::class)
+ ->modelFolder(\App\Models\MediaLibraryFolder::class)
```

### FFMPEG Installieren und konfigurieren
```
https://github.com/BtbN/FFmpeg-Builds/releases
C:\xampp\ffmpeg
Add to Path Variable

composer require php-ffmpeg/php-ffmpeg --ignore-platform-reqs --no-interaction --no-scripts --prefer-dist

.env
+ FFMPEG_PATH="C:\\xampp\\ffmpeg\\ffmpeg.exe"
+ FFPROBE_PATH="C:\\xampp\\ffmpeg\\ffprobe.exe"

config\media-library.php
+ 'max_file_size' => 1024 * 1024 * 10000, // 10GB

config\livewire.php
+ 'rules' => ['required', 'file', 'max:10240000'], // 10GB
```

### Medien darstellen
```
+ app\Filament\Dashboard\Pages\MediaItemPage.php
+ resources\views\filament\dashboard\pages\media-item-page.blade.php
```

### Media Library Manager View pfad ändern
```
+ app\Livewire\MediaInfo.php

app\Providers\Filament\DashboardPanelProvider.php
+ ->mediaInfoComponent(\App\Livewire\MediaInfo::class)
```

### Init fancyapps
```
npm install --save @fancyapps/ui

+ resources\js\fancyapps.js
+ resources\css\fancyapps.css
+ resources\views\filament\dashboard\pages\media-item-page.blade.php
```

### Init video.js
```
npm install --save video.js

+ resources\js\videojs.js
+ resources\css\videojs.css
+ resources\views\filament\dashboard\pages\media-item-page.blade.php
```

### Produkte, Plans und Preis seeder
```
+ database\seeders\ProductsPlansAndPricesSeeder.php

database\seeders\DatabaseSeeder.php
+ ProductsPlansAndPricesSeeder::class,
```

### Plans Page
```
+ app\View\Components\Filament\PlansCustom\All.php
+ resources\views\components\filament\plans-custom\all.blade.php
+ resources\views\components\filament\plans-custom\one.blade.php

+ app\Filament\Dashboard\Pages\PlansPage.php
+ resources\views\filament\dashboard\pages\plans-page.blade.php
```

### Storage bereinigen beim seeden
```
+ database\seeders\ClearStorageSeeder.php

database\seeders\DatabaseSeeder.php
+ ClearStorageSeeder::class,
```

### Tabellen und Models für Performers und Production
```
+ database\migrations\2024_10_01_102701_create_contributor_roles_table.php
+ database\migrations\2024_10_01_102743_create_contributor_meta_fields_table.php
+ database\migrations\2024_10_01_102837_create_contributors_table.php
+ database\migrations\2024_10_01_102906_create_contributor_metas_table.php

+ app\Models\ContributorRole.php
+ app\Models\ContributorMetaField.php
+ app\Models\Contributor.php
+ app\Models\ContributorMeta.php
```

### Rolen und Felder
```
+ app\Filament\Dashboard\Resources\ContributorRoleResource.php
+ app\Filament\Dashboard\Resources\ContributorRoleResource\*
```

### Performer
```
+ app\Filament\Dashboard\Resources\PerformerResource.php
+ app\Filament\Dashboard\Resources\PerformerResource\*
```

### MediaLibraryItem Ressource
```
+ app\Filament\Dashboard\Resources\MediaLibraryItemResource.php
+ app\Filament\Dashboard\Resources\MediaLibraryItemResource\*

+ app\Forms\Components\MediaField.php
+ resources\views\forms\components\media-field.blade.php

+ app\Infolists\Components\MediaEntry.php
+ resources\views\infolists\components\media-entry.blade.php

resources\css\filament\dashboard\tailwind.config.js
+ './resources/views/infolists/**/*.blade.php',
+ './resources/views/forms/**/*.blade.php',
```
