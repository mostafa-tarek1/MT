<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreWindow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'window_type',
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
        'images',
        'order',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Section types constants - أنواع أقسام المتجر
     */
    public const TYPE_ABOUT_STORE = 'about_store';           // عن المتجر

    public const TYPE_FAQ = 'faq';                           // الأسئلة الشائعة

    public const TYPE_SHIPPING_POLICY = 'shipping_policy';   // سياسة الشحن والدفع

    public const TYPE_STORE_POLICY = 'store_policy';         // سياسة المتجر والإرجاع

    public const TYPE_CUSTOMER_REVIEWS = 'customer_reviews'; // آراء وتقييمات العملاء

    /**
     * Get all available section types
     */
    public static function getWindowTypes(): array
    {
        return [
            self::TYPE_ABOUT_STORE,
            self::TYPE_FAQ,
            self::TYPE_SHIPPING_POLICY,
            self::TYPE_STORE_POLICY,
            self::TYPE_CUSTOMER_REVIEWS,
        ];
    }

    /**
     * Get section type names in Arabic
     */
    public static function getTypeNames(): array
    {
        return [
            self::TYPE_ABOUT_STORE => 'عن المتجر',
            self::TYPE_FAQ => 'الأسئلة الشائعة',
            self::TYPE_SHIPPING_POLICY => 'سياسة الشحن والدفع',
            self::TYPE_STORE_POLICY => 'سياسة المتجر والإرجاع',
            self::TYPE_CUSTOMER_REVIEWS => 'آراء العملاء',
        ];
    }

    /**
     * Get the user that owns the store window
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for active windows
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for specific window type
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('window_type', $type);
    }

    /**
     * Scope ordered by order field
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
