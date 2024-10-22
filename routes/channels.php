<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('chat.{chatUserId}', function ($user, $chatUserId) {
    // Authorization logic
    return $user->id === $chatUserId; // Authorize if the authenticated user matches the chat user
});

