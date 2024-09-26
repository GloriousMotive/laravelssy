# pornmgr.com
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
