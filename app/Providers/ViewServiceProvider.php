<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Category;
use App\Models\RelatedNewsSite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
         //share related 
         $relatedsites=RelatedNewsSite::Select('name','url')->get();
         //share Categories
         $categories=Category::Select ('id','name','slug')->get();
 
        if(!Cache::has('latest_posts')){
            $latest_posts= Post::select('id','slug','title')->latest()->limit(5)->get();
            Cache::remember('latest_posts', 3600 , function() use($latest_posts){
                return $latest_posts;
            });

        }
        
        if(!Cache::has('popular_posts')){
            $popular_posts=Post::withCount('comments')
        ->orderBy('comments_count','desc')
        ->limit(5)
        ->get();
        Cache::remember('popular_posts', 3600, function()use($popular_posts){
            return $popular_posts;
        });
    }
        $latest_posts = Cache::get('latest_posts');
        $popular_posts=Cache::get('popular_posts');
        view()->share([
            'relatedsites'=> $relatedsites,
            'categories'=>$categories,
            'latest_posts'=> $latest_posts,
            'popular_posts'=>$popular_posts,
        ]);
    }
}
