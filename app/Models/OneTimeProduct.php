<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneTimeProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'max_quantity',
        'metadata',
        'features',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'metadata' => 'array',
    ];

    public function prices()
    {
        return $this->hasMany(OneTimeProductPrice::class);
    }

    protected static function booted(): void
    {
        static::updating(function (OneTimeProduct $oneTimeProduct) {
            // booleans are a bit tricky to compare, so we use boolval to compare them
            if ($oneTimeProduct->isDirty([
                'max_quantity',
            ])) {
                $oneTimeProduct->paymentProviderData()->delete();
                foreach ($oneTimeProduct->prices as $price) {
                    $price->pricePaymentProviderData()->delete();
                }
            }
        });

        static::deleting(function (OneTimeProduct $oneTimeProduct) {
            $oneTimeProduct->paymentProviderData()->delete();
            foreach ($oneTimeProduct->prices as $price) {
                $price->pricePaymentProviderData()->delete();
            }
        });
    }

    public function paymentProviderData()
    {
        return $this->hasMany(OneTimeProductPaymentProviderData::class);
    }
}
