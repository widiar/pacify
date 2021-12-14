<?php

use App\Models\Room;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.{roomName}', function ($user, $roomName) {
    // return (int) $user->id === (int) $id;
    $room = Room::where('nama', $roomName)->first();
    if ($user->id == $room->user1 || $user->id == $room->user2) return true;
    return false;
});
