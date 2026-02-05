<?php

namespace App\Modules\Base\Http\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Apply filters to query
     */
    public function scopeFilter(Builder $query, array $filters = []): Builder
    {
        $filters = empty($filters) ? request()->all() : $filters;

        // Search
        if (isset($filters['search']) && ! empty($filters['search'])) {
            $this->applySearch($query, $filters['search']);
        }

        // Sorting
        if (isset($filters['sort_by'])) {
            $sortOrder = $filters['sort_order'] ?? $filters['sort_direction'] ?? 'asc';
            $query->orderBy($filters['sort_by'], $sortOrder);
        } else {
            $query->latest();
        }

        // Status filter
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Active/Inactive filter
        if (isset($filters['is_active'])) {
            $query->where('is_active', filter_var($filters['is_active'], FILTER_VALIDATE_BOOLEAN));
        }

        // Date range filter
        if (isset($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        // Price range filter
        if (isset($filters['price_from'])) {
            $query->where('price', '>=', $filters['price_from']);
        }

        if (isset($filters['price_to'])) {
            $query->where('price', '<=', $filters['price_to']);
        }

        // Category filter
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // User filter
        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        // Custom filters (override in model if needed)
        $this->applyCustomFilters($query, $filters);

        return $query;
    }

    /**
     * Apply search to query
     */
    protected function applySearch(Builder $query, string $search): void
    {
        $searchableFields = $this->searchableFields ?? ['name'];

        $query->where(function ($q) use ($search, $searchableFields) {
            foreach ($searchableFields as $field) {
                $q->orWhere($field, 'LIKE', "%{$search}%");
            }
        });
    }

    /**
     * Apply custom filters (override in model)
     */
    protected function applyCustomFilters(Builder $query, array $filters): void
    {
        // Override in model for custom filters
    }

    /**
     * Get filtered and paginated results
     */
    public static function getFiltered(array $filters = [], int $perPage = 15)
    {
        return static::filter($filters)->paginate($perPage);
    }
}
