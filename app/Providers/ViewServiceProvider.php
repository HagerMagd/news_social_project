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
         $categories=Category::Select ('id','name','slug')->active()->get();
 
         view()->share([
            'relatedsites'=> $relatedsites,
            'categories'=>$categories,
            
        ]);
    }
      
      
    
}