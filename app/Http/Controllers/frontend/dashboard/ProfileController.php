<?php

namespace App\Http\Controllers\frontend\dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\utlis\ImagesManger;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;

class ProfileController extends Controller
{
    public function index()
    {

        $posts = auth()->user()->posts()->active()->with(['images'])->latest()->get();
        return view('frontend.user-dashboard.profile', compact('posts'));
    }

    //store Post
    public function storepost(StorePostRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $request->merge(['desc' => trim($request->input('desc'))]);

            $this->convertCommentAble($request);
            //use reliontion between user&posts to store posts for current user
            $post = auth()->user()->posts()->create($request->except(['_token', 'images']));
            //store images
            $imagemanger = new ImagesManger;
            $imagemanger->uploadImages($request, $post);
            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }
        Session::flash('success', 'post created successfuly');
        return redirect()->back();
    }

    public function deletepost(Request $request)
    {
        $post = Post::where('slug', $request->slug)->first();
        if (!$post) {
            abort(404);
        }
        ImagesManger::deleteImage($post);
        $post->delete();
        return redirect()->back()->with('success', 'Post Deleted Successfully ! ');
    }

    //Edit Post
    public function showEditForm($slug)
    {
        $post = Post::with(['images'])->where('slug', $slug)->first();
        if (!$post) {
            abort(404);
        }
        return view('frontend.user-dashboard.edit-post', compact("post"));
    }
    public function deletePostImage(Request $request)
    {
        $image = Image::find($request->key); //key from json have {{image->id}}
        if (!$image) {
            return response()->json([
                'status' => '201',
                'msg' => 'image not found',
            ]);
        }
        //delete image from local
        ImagesManger::checkFileAndDelete($image->path);
        //delete image from database
        $image->delete();
        return response()->json([
            'status' => '200',
            'msg' => 'image deleted successfully !'
        ]);
    }
    public function updatePost(StorePostRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $post = Post::findOrFail($request->id);
            $this->convertCommentAble($request);
            $post->update($request->except(['images', '_token', '_method']));
            if ($request->hasFile('images')) {
                ImagesManger::deleteImage($post);
                ImagesManger::uploadImages($request, $post);
            }
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }


        Session::flash('success', "Post Updated Successfuly !");
        return redirect()->route('frontend.dashboard.profile');
    }

    //get comments for post
    public function getcomments($id)
    {
        $comments = Comment::with(['user'])->where('post_id', $id)->get();
        if ($comments->isEmpty()) {
            return response()->json([
                "data" => null,
                "msg" => "no comments for this post",
            ]);
        }
        return response()->json([
            "data" => $comments,
            "msg" => "contain comments",
        ]);
    }
    // Convert checkbox input to boolean (1 if checked, 0 if not)
    private function convertCommentAble($request)
    {
        return $request->comment_able == "on" ? $request->merge(['comment_able' => 1])
            : $request->merge(['comment_able' => 0]);
    }
}
