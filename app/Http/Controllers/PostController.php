<?php

namespace App\Http\Controllers;

use App\Models\Post;  // <--- HII LAZIMA IWE!
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Orodha ya posts
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // Fomu ya kuunda post
    public function create()
    {
        return view('posts.create');
    }

    // Kuhifadhi post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'author' => 'required|string|max:255',
        ]);

        Post::create($request->all());

        return redirect('/posts')->with('success', 'Post created successfully!');
    }

    // Kuonyesha post moja
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // Fomu ya kuhariri
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    // Kuhifadhi mabadiliko
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'author' => 'required|string|max:255',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return redirect('/posts')->with('success', 'Post updated successfully!');
    }

    // Kufuta post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted successfully!');
    }
}
