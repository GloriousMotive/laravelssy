<?php

namespace App\Models;

use App\Models\Contributor;
use App\Models\ContributorMetaField;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContributorRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name'
    ];

    public const TYPE_PERFORMER = 'performer';
    public const TYPE_PRODUCTION = 'production';

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

    public function contributors()
    {
        return $this->hasMany(Contributor::class, 'role_id');
    }

    public function metaFields()
    {
        return $this->hasMany(ContributorMetaField::class, 'contributor_role_id');
    }
}
