<?php

namespace App\Models;

use App\Models\Contributor;
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

    public function contributors()
    {
        return $this->belongsToMany(Contributor::class, 'contributor_filament_media_library');
    }

    public function performers()
    {
        return $this->belongsToMany(Contributor::class, 'contributor_filament_media_library')
            ->whereHas('role', function ($query) {
                $query->where('type', 'performer');
            });
    }

    public function producers()
    {
        return $this->belongsToMany(Contributor::class, 'contributor_filament_media_library')
            ->whereHas('role', function ($query) {
                $query->where('type', 'producers');
            });
    }
}
