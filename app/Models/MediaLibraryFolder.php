<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryFolder as BaseMediaLibraryFolder;

class MediaLibraryFolder extends BaseMediaLibraryFolder
{
    public static function booted(): void
    {
        parent::booted();

        if (!auth()->user()->isAdmin()) {
            static::addGlobalScope('user', function (Builder $query) {
                $query->where('created_by_user_id', auth()->user()->id);
            });
        }

        static::creating(function ($folder) {
            $folder->created_by_user_id = auth()->user()->id;
        });
    }
}
