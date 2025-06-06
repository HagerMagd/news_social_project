<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts= Post::active()->with("images")->latest()->paginate(9);
        $gretest_posts_views= Post::active()->orderBy('num_of_views','desc')->limit(3)->get();
        $oldest_posts=Post::active()->oldest()->take(3)->get();
        $popular_posts=Post::active()->withCount('comments')
        ->orderBy('comments_count','desc')
        ->limit(3)
        ->get();
        $categories=Category::all();
        $categories_with_posts=$categories->map(function($category){
            $category->posts=$category->posts()->limit(4)->get();
            return $category;
        });
        return(view('frontend.index',compact('posts','gretest_posts_views','oldest_posts',
        'popular_posts','categories_with_posts')));
    }
}
