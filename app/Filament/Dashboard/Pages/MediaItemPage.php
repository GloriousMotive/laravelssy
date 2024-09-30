<?php

namespace App\Filament\Dashboard\Pages;

use Filament\Pages\Page;
use App\Models\MediaLibraryItem;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaItemPage extends Page
{
    protected static string $view = 'filament.dashboard.pages.media-item-page';

    protected static ?string $slug = 'media/{uuid}';

    protected static bool $shouldRegisterNavigation = false;

    public Media $media;
    public MediaLibraryItem $item;

    public function mount($uuid): void
    {
        $this->item = MediaLibraryItem::findOrFail($uuid);
        $this->media = $this->item->getItem();

        if (! $this->media instanceof Media) {
            abort(403); // Forbidden
        }
    }

    private function isImage(Media $media): bool
    {
        return \Illuminate\Support\Str::startsWith($media->mime_type, 'image/');
    }

    private function isVideo(Media $media): bool
    {
        return \Illuminate\Support\Str::startsWith($media->mime_type, 'video/');
    }

    public function getHeading(): string
    {
        return $this->media->uuid;
    }

    protected function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'isVideo' => $this->isVideo($this->media),
            'isImage' => $this->isImage($this->media),
            'media' => $this->media,
            'item' => $this->item,
        ]);
    }
}
