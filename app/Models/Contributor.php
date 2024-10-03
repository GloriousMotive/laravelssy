<?php

namespace App\Models;

use App\Models\ContributorMeta;
use App\Models\ContributorRole;
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
