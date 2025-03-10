<?php

namespace App\Models;

use App\Notifications\Auth\QueuedVerifyEmail;
use App\Services\OrderManager;
use App\Services\SubscriptionManager;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'public_name',
        'locale',
        'is_admin',
        'is_blocked',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userParameters(): HasMany
    {
        return $this->hasMany(UserParameter::class);
    }

    public function stripeData(): HasMany
    {
        return $this->hasMany(UserStripeData::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() == 'admin' && ! $this->is_admin) {
            return false;
        }

        return true;
    }

    public function getPublicName()
    {
        return $this->public_name ?? $this->name;
    }

    public function scopeAdmin($query)
    {
        return $query->where('is_admin', true);
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function canImpersonate()
    {
        return $this->hasPermissionTo('impersonate users') && $this->isAdmin();
    }

    public function isSubscribed(?string $productSlug = null): bool
    {
        /** @var SubscriptionManager $subscriptionManager */
        $subscriptionManager = app(SubscriptionManager::class);

        return $subscriptionManager->isUserSubscribed($this, $productSlug);
    }

    public function isTrialing(?string $productSlug = null): bool
    {
        /** @var SubscriptionManager $subscriptionManager */
        $subscriptionManager = app(SubscriptionManager::class);

        return $subscriptionManager->isUserTrialing($this, $productSlug);
    }

    public function hasPurchased(?string $productSlug = null): bool
    {
        /** @var OrderManager $orderManager */
        $orderManager = app(OrderManager::class);

        return $orderManager->hasUserOrdered($this, $productSlug);
    }

    public function subscriptionProductMetadata()
    {
        /** @var SubscriptionManager $subscriptionManager */
        $subscriptionManager = app(SubscriptionManager::class);

        return $subscriptionManager->getUserSubscriptionProductMetadata($this);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new QueuedVerifyEmail());
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
