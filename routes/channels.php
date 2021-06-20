<?php

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

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('like-channel', function($user) {
    return  true;
});

Broadcast::channel('share-channel', function($user) {
    return  true;
});

Broadcast::channel('shortie-reply-channel', function($user) {
    return  true;
});

Broadcast::channel('group-channel', function($user) {
    return  true;
});

Broadcast::channel('comment-channel', function($user) {
    return  true;
    
});


Broadcast::channel('reply-channel', function($user) {
    return  true;
});

Broadcast::channel('newpost-channel', function($user) {
    return  true;
});