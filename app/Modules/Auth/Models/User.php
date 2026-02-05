<?php

namespace App\Modules\Auth\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

class User extends Authenticatable implements JWTSubject, LaratrustUser
{
    use HasApiTokens, HasFactory, HasRolesAndPermissions, Notifiable;

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'phone_verified_at',
        'email_verified_at',
        'otp_verified',
        'is_active',
        'role_id',
        'profile_image',
        'background_image',
        'bio_ar',
        'bio_en',
        'store_location_lat',
        'store_location_lng',
        'additional_phones',
        'social_links',
        'tax_number',
        'external_links',
        'points',
        'points_used',
        'points_expired',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
            'additional_phones' => 'array',
            'social_links' => 'array',
            'external_links' => 'array',
            'store_location_lat' => 'decimal:8',
            'store_location_lng' => 'decimal:8',
            'points' => 'integer',
            'points_used' => 'integer',
            'points_expired' => 'integer',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function token()
    {
        return JWTAuth::fromUser($this);
    }

    public function otp()
    {
        return $this->hasOne(Otp::class);
    }

    public function otps()
    {
        return $this->hasMany(Otp::class);
    }

    /**
     * Get the user's store windows
     */
    public function storeWindows()
    {
        return $this->hasMany(StoreWindow::class);
    }

    /**
     * Get the full URL for the user's profile image (Laravel 9+ Attribute style).
     */
    public function profileImageUrl(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->profile_image) {
                return null;
            }

            return asset('storage/'.$this->profile_image);
        });
    }

    /**
     * Get the full URL for the user's background image
     */
    public function backgroundImageUrl(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->background_image) {
                return null;
            }

            return asset('storage/'.$this->background_image);
        });
    }

    /**
     * Get the bio based on current locale
     */
    public function getBioAttribute()
    {
        $locale = app()->getLocale();

        return $locale === 'ar' ? $this->bio_ar : ($this->bio_en ?? $this->bio_ar);
    }

    /**
     * Get banned user relation
     */
    public function bannedUser()
    {
        return $this->hasOne(BannedUser::class);
    }

    /**
     * Check if user is banned
     */
    public function getIsBannedAttribute()
    {
        return $this->bannedUser && ! $this->bannedUser->unbanned_at;
    }

    /**
     * Get user's favorites
     */
    public function favorites()
    {
        return $this->hasMany(\App\Modules\Favorites\Models\Favorite::class);
    }

    /**
     * Get user's favorited ads
     */
    public function favoriteAds()
    {
        return $this->belongsToMany(\App\Modules\Ads\Models\Ads::class, 'favorites', 'user_id', 'ad_id')
            ->withTimestamps();
    }

    /**
     * Get ratings given by this user
     */
    public function ratingsGiven()
    {
        return $this->hasMany(\App\Modules\Ratings\Models\Rating::class, 'rater_id');
    }

    /**
     * Get ratings received by this user
     */
    public function ratingsReceived()
    {
        return $this->hasMany(\App\Modules\Ratings\Models\Rating::class, 'rated_user_id');
    }

    /**
     * Get rating replies by this user
     */
    public function ratingReplies()
    {
        return $this->hasMany(\App\Modules\Ratings\Models\RatingReply::class);
    }

    /**
     * Get average rating for this user
     */
    public function getAverageRatingAttribute()
    {
        return $this->ratingsReceived()
            ->where('status', 'approved')
            ->avg('rating') ?? 0;
    }

    /**
     * Get total ratings count for this user
     */
    public function getTotalRatingsAttribute()
    {
        return $this->ratingsReceived()
            ->where('status', 'approved')
            ->count();
    }

    /**
     * Point purchases relationship
     */
    public function pointPurchases()
    {
        return $this->hasMany(\App\Modules\Points\Models\PointPurchase::class);
    }

    /**
     * Add points to user
     */
    public function addPoints(int $points): void
    {
        $this->increment('points', $points);
    }

    /**
     * Deduct points from user
     */
    public function deductPoints(int $points): bool
    {
        if ($this->points >= $points) {
            $this->decrement('points', $points);
            $this->increment('points_used', $points);

            return true;
        }

        return false;
    }

    /**
     * Expire points from user
     */
    public function expirePoints(int $points): void
    {
        $this->decrement('points', $points);
        $this->increment('points_expired', $points);
    }

    /**
     * Get available points
     */
    public function getAvailablePointsAttribute(): int
    {
        return max(0, $this->points);
    }
}
