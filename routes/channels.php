<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

Broadcast::channel('admins', function ($user) {
    return $user && $user->role === 'admin';
});

Broadcast::channel('users.{id}', function ($user, $id) {
    return $user && (int)$user->id === (int)$id;
});
