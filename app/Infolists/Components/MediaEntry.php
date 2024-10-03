<?php

namespace App\Infolists\Components;

use App\Models\MediaLibraryItem;
use Filament\Infolists\Components\Entry;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaEntry extends Entry
{
    protected string $view = 'infolists.components.media-entry';

    private ?Media $media = null;

    private function initMedia(): void
    {
        $item = $this->getRecord();
        if ($item instanceof MediaLibraryItem) {
            $this->media = $item->getItem();

            if (!$this->media instanceof Media) {
                abort(500);
            }
        }
    }

    public function getMedia(): ?Media
    {
        if (! $this->media) {
            $this->initMedia();
        }

        return $this->media;
    }

    public function isImage(): bool
    {
        return \Illuminate\Support\Str::startsWith($this->media->mime_type, 'image/');
    }

    public function isVideo(): bool
    {
        return \Illuminate\Support\Str::startsWith($this->media->mime_type, 'video/');
    }
}
