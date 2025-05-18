<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        // validate data
        $request->validate([
            'search'=>['string','nullable','max:100'],
        ]);
        // to filter content from any code 
        $keyword=strip_tags($request->search);
        // search about posts by title
        $posts=Post::active()->where('title','like','%'.$keyword.'%') 
        //or search about posts by desc
        ->orwhere('desc','like','%'.$keyword.'%') 
        ->paginate(14);
        return view('frontend.search',compact('posts'));
}
}