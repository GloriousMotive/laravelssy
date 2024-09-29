<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryItem as BaseMediaLibraryItem;

class MediaLibraryItem extends BaseMediaLibraryItem
{
    public static function booted(): void
    {
        parent::booted();

        if (!auth()->user()->isAdmin()) {
            static::addGlobalScope('user', function (Builder $query) {
                $query->where('uploaded_by_user_id', auth()->user()->id);
            });
        }
    }
}
