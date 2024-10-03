<?php

namespace App\Models;

use App\Models\Contributor;
use App\Models\ContributorMetaField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContributorMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'contributor_id',
        'contributor_meta_field_id',
        'value'
    ];

    public function contributor()
    {
        return $this->belongsTo(Contributor::class, 'contributor_id');
    }

    public function metaField()
    {
        return $this->belongsTo(ContributorMetaField::class, 'contributor_meta_field_id');
    }
}
