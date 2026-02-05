<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Models\BannedUser;
use App\Modules\Auth\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class BannedUserService
{
    public function getPaginatedBannedUsers(?string $search = null, int $perPage = 20): LengthAwarePaginator
    {
        $query = BannedUser::with(['user', 'banner']);

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return $query->orderByDesc('banned_at')->paginate($perPage);
    }

    public function banUser(int $userId, ?string $reason, int $bannedBy): array
    {
        $user = User::findOrFail($userId);

        if ($user->is_banned) {
            return [
                'success' => false,
                'message' => __('dashboard.user_already_banned'),
            ];
        }

        BannedUser::create([
            'user_id' => $user->id,
            'reason' => $reason,
            'banned_by' => $bannedBy,
            'banned_at' => now(),
        ]);

        return [
            'success' => true,
            'message' => __('dashboard.user_banned_successfully'),
        ];
    }

    public function banUserByPhone(string $phone, ?string $reason, int $bannedBy): array
    {
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            return [
                'success' => false,
                'message' => __('dashboard.user_not_found'),
            ];
        }

        if ($user->is_banned) {
            return [
                'success' => false,
                'message' => __('dashboard.user_already_banned'),
            ];
        }

        BannedUser::create([
            'user_id' => $user->id,
            'reason' => $reason,
            'banned_by' => $bannedBy,
            'banned_at' => now(),
        ]);

        return [
            'success' => true,
            'message' => __('dashboard.user_banned_successfully'),
        ];
    }

    public function unbanUser(int $banId): array
    {
        $ban = BannedUser::findOrFail($banId);

        if ($ban->unbanned_at) {
            return [
                'success' => false,
                'message' => __('dashboard.user_already_unbanned'),
            ];
        }

        $ban->update(['unbanned_at' => now()]);

        return [
            'success' => true,
            'message' => __('dashboard.user_unbanned_successfully'),
        ];
    }
}
