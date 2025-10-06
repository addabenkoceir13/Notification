<?php

namespace App\Http\Controllers;

use App\Events\UserApprovedEvent;
use App\Events\UserCreatedEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        event(new UserCreatedEvent($user));

        return back()->with('status', 'User created and notification sent.');
    }

    public function approve(User $user) {
        // Your approval logic here (e.g., mark verified)
        event(new UserApprovedEvent($user));
        return back()->with('status', 'User approved.');
    }
}
