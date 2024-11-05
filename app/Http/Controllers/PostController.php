<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        Post::create($incomingFields);
        return redirect('/');
    }

    public function UpdatePost(Post $post, Request $request) {
        if (auth()->user()->id !== $post['user_id']) {  // Berechtigungsprüfung angepasst
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/');
    }

    public function showEditScreen(Post $post) {
        if (auth()->user()->id !== $post['user_id']) {  // Berechtigungsprüfung angepasst
            return redirect('/');
        }
        
        return view('edit-post', ['post' => $post]);
    }

    public function deletePost(Post $post) {
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/')->with('error', 'Unauthorized action.');
        }
        $post->delete();
        return redirect('/')->with('success', 'Post deleted successfully.');
    }
}
