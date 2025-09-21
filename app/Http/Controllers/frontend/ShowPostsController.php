<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Notifications\NewCommentNotifi;

class ShowPostsController extends Controller
{
    public function showposts($slug)
    {

        $mainpost = Post::active()->with(['comments' => function ($query) {
            $query->latest()->limit(3);
        }])->whereslug($slug)->firstorFail();
        $category = $mainpost->catgegory; //العلاقة
        $belongs_posts = $category->posts()
            ->select('id', 'slug', 'title')
            ->limit(6)
            ->get();
            $mainpost->increment('num_of_views'); //To increase the number of views
        
        return view("frontend.show-posts", compact('mainpost', 'belongs_posts'));
    }


    public function GetAllPosts($slug)
    {
        $post = Post::active()->whereSlug($slug)->first();
        $comments = $post->comments()->with('user')->get();
        return response()->json($comments);
    }

    public function storecomment(Request $request)
    {
        // make validaiton for request
        $request->validate([
            'users_id' => ['required', 'exists:users,id'],
            'post_id' => ['required', 'exists:posts,id'],
            'comment' => ['required', 'string', 'max:200'],

        ]);
        //stor comments after validaiton 
        $comment = Comment::create([
            'users_id' => $request->users_id,
            'comment' => $request->comment,
            'ip_address' => $request->ip(),
            'post_id' => $request->post_id,

        ]);

        $post=Post::findOrFail($request->post_id);
        $post->user->notify(new NewCommentNotifi($comment,$post));
        // to return relation with users tb to show users names .. in blade page
        $comment->load('user');

        if (!$comment) {
            return response()->json([
                'data' => 'operation failed',
                'status' => 403,
            ]);
        }
        return response()->json([
            'msg' => 'comment stored sucessfully',
            'comment' => $comment,
            'status' => 201,
        ]);
    }
}
