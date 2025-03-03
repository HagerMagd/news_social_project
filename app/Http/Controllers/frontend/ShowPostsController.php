<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowPostsController extends Controller
{
    public function showposts($slug)
    {
        
        $post = Post::whereSlug($slug)->firstOrFail();
        $category = $post->category; 
        $posts_belongsto_category = $category->posts()
            ->select('id', 'slug', 'title')
            ->limit(6)
            ->get();

        return view('frontend.show-posts', compact('post', 'posts_belongsto_category'));
    }
}
