<?php

namespace App\Modules\Structure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'items',
        'is_read',
    ];

    protected $casts = [
        'items' => 'array',
        'is_read' => 'boolean',
    ];
}
