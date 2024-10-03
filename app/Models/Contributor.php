<?php

namespace App\Models;

use App\Models\ContributorMeta;
use App\Models\ContributorRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_library_item_id',
        'name',
        'role_id'
    ];

    public static function booted(): void
    {
        parent::booted();

        static::addGlobalScope('user', function (Builder $query) {
            $query->where('created_by_user_id', auth()->user()->id);
        });

        static::creating(function ($folder) {
            $folder->created_by_user_id = auth()->user()->id;
        });
    }

    public function role()
    {
        return $this->belongsTo(ContributorRole::class, 'role_id');
    }

    public function metas()
    {
        return $this->hasMany(ContributorMeta::class, 'contributor_id');
    }

    public function getImageUrlAttribute()
    {
        $mediaLibraryItem = MediaLibraryItem::find($this->media_library_item_id);

        if ($mediaLibraryItem) {
            $spatieMediaModel = $mediaLibraryItem->getItem();
            return $spatieMediaModel->getUrl();
        }

        return null;
    }
}
