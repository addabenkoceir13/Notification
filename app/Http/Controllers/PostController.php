<?php

namespace App\Http\Controllers;

use App\Events\PostApprovedEvent;
use App\Events\PostCreatedEvent;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'user_id' => 2,
            'status' => 'pending',
        ]);

        event(new PostCreatedEvent($post));

        return redirect()->route('dashboard')->with('status', 'Post created.');
    }

    public function approve(Post $post) {
        $post->update(['status' => 'approved']);
        event(new PostApprovedEvent($post));
        return back()->with('status', 'Post approved.');
    }
}
