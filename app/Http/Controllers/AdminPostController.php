<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {
        return view ('admin.posts.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required|min:3|max:255',
            'thumbnail' => 'required|image',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' =>['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();
        
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        Post::create($attributes);

        return redirect('/')->with('success', 'New Post Created Successfully');
    }

    public function edit(Post $post)
    {
        return view ('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {

        $attributes = request()->validate([
            'title' => 'required|min:3|max:255',
            'thumbnail' => 'image',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => 'required|min:5',
            'body' => 'required|min:5',
            'category_id' =>['required', Rule::exists('categories', 'id')]
        ]);

        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        $post->update($attributes);
        
        return back()->with('success','Post Updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    } 

}
