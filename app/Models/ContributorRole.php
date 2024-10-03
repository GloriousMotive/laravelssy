<?php

namespace App\Models;

use App\Models\Contributor;
use App\Models\ContributorMetaField;
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

    public function contributors()
    {
        return $this->hasMany(Contributor::class, 'role_id');
    }

    public function metaFields()
    {
        return $this->hasMany(ContributorMetaField::class, 'contributor_role_id');
    }
}
