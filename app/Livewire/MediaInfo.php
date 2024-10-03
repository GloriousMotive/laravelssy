<?php

namespace App\Livewire;

use RalphJSmit\Filament\MediaLibrary\Media\Components\MediaInfo as BaseMediaInfo;

class MediaInfo extends BaseMediaInfo
{
    /*
    public function setMedia(null | int | string | array $ids, mixed $mediaLibraryFolderId): void
    {
        parent::setMedia($ids, $mediaLibraryFolderId);

        $this->mediaItemMeta->full_url = route('filament.dashboard.pages.media.{uuid}', ['uuid' => $this->mediaItemMeta->id]);
    }
    */
}
