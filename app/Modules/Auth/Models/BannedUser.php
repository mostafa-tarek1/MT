<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;

class BannedUser extends Model
{
    protected $table = 'banned_users';

    protected $fillable = [
        'user_id',
        'reason',
        'banned_by',
        'banned_at',
        'unbanned_at',
    ];

    protected $casts = [
        'banned_at' => 'datetime',
        'unbanned_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function banner()
    {
        return $this->belongsTo(Manager::class, 'banned_by');
    }
}
