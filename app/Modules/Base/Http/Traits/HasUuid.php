<?php

namespace App\Modules\Base\Http\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    /**
     * Boot the HasUuid trait for a model.
     */
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            $column = property_exists($model, 'uuidColumn') ? $model->uuidColumn : 'uuid';

            if (empty($model->{$column})) {
                $model->{$column} = Str::uuid()->toString();
            }
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return true;
    }
}
