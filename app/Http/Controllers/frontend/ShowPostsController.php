<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class ShowPostsController extends Controller
{
    public function showposts($slug)
    {
        
       $mainpost= Post::with(['comments'=>function($query){
        $query->latest()->limit(3);
       }])-> whereslug($slug)->firstorFail();
       $category= $mainpost->catgegory; //العلاقة
       $belongs_posts=$category->posts()
       ->select('id','slug','title')
       ->limit(6)
       ->get();
       return view("frontend.show-posts",compact('mainpost','belongs_posts'));
    }

    public function GetAllPosts($slug){
        $post= Post::whereSlug($slug)->first();
       $comments= $post->comments()->with('user')->get();
       return response()->json($comments);
}

    public function storecomment(Request $request){
        // make validaiton for request
        $request->validate([
            'users_id' =>['required','exists:users,id'],
            'post_id' => ['required', 'exists:posts,id'],
            'comment'=>['required','string','max:200'],
            
        ]);
        //stor comments after validaiton 
        $comment=Comment::create([
            'users_id'=>$request->users_id,
            'comment'=>$request->comment,
            'ip_address'=>$request->ip(),
            'post_id'=>$request->post_id,

        ]);
        // to return relation with users tb to show users names .. in blade page
        $comment->load('user'); 
        
        if(!$comment){
            return response()->json([
                'data'=> 'operation failed',
                'status'=>403,
            ]);
        }return response()->json([
            'msg'=> 'comment stored sucessfully',
            'comment'=>$comment,
            'status'=>201,
        ]);



}
}