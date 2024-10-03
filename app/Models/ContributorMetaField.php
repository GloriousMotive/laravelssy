<?php

namespace App\Models;

use App\Models\ContributorMeta;
use App\Models\ContributorRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContributorMetaField extends Model
{
    use HasFactory;

    protected $fillable = [
        'contributor_role_id',
        'name',
        'type',
        'options',
        'sort_order',
        'description'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (isset($model->options) && is_array($model->options)) {
                // Temporäres Array, um das geänderte options-Array zu speichern
                $newOptions = [];

                foreach ($model->options as $index => $option) {
                    // Überprüfen, ob der Key gesetzt ist
                    if (!isset($option['key'])) {
                        $option['key'] = $index + 1; // Key automatisch generieren
                    }
                    // Füge die geänderte Option zum neuen Array hinzu
                    $newOptions[] = $option;
                }

                // Setze das modifizierte options-Array zurück
                $model->options = $newOptions;
            }
        });
    }

    public function contributorRole()
    {
        return $this->belongsTo(ContributorRole::class, 'contributor_role_id');
    }

    public function metas()
    {
        return $this->hasMany(ContributorMeta::class, 'contributor_meta_field_id');
    }
}
