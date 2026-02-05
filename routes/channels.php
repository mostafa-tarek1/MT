<?php

use App\Modules\Messages\Models\Chat;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chats.{chatId}', function ($user, $chatId) {
    if (! $user) {
        return false;
    }

    $chat = Chat::query()->find($chatId);

    if (! $chat) {
        return false;
    }

    if (! $chat->involves($user->id)) {
        return false;
    }

    return [
        'id' => $user->id,
        'name' => $user->name,
    ];
});
