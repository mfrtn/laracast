<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
    
        // return view('posts', [
        //     'posts' =>  $this->getPosts(),
        //     'categories' => Category::all()
        // ]);

        return view('posts', [
            'posts' =>  Post::latest()->filter(request(['search']))->get(),
            'categories' => Category::all()
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' =>  $post
        ]);
    }

    protected function getPosts()
    {
        return Post::latest()->filter()->get();

        // $posts = Post::latest();

        // if (request('search')) {
        //     $posts
        //         ->where('title', 'like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%' . request('search') . '%');
        // }

        // return $posts->get();
    }
}
