<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\utlis\ImagesManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_by = request()->order_by ?? 'desc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;
        $posts = Post::when(request()->keyword, function ($query) {

            $query->where('title', 'LIKE', '%' . request()->keyword . '%');
        })
            ->when(!is_null(request()->status), function ($query) {
                $query->where('status', request()->status);
            })->orderBy($sort_by, $order_by)
            ->paginate($limit_by);

        return view('dashbord.adminauth.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('dashbord.adminauth.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $request->merge(['desc' => trim($request->input('desc'))]);


            //use reliontion between admin&posts to store posts for current user
            $post = Auth::guard('admin')->user()->posts()->create($request->except(['_token', 'images', 'samll_desc']));
            //store images
            $imagemanger = new ImagesManger;
            $imagemanger->uploadImages($request, $post);
            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
        Session::flash('success', 'post created successfuly');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $post=Post::findorFail($id);
        return view('dashbord.adminauth.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::where('id', $id)->first();
        return view('dashbord.adminauth.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $id)
    {
        $request->validated();
        try {
            $post = Post::findOrFail($id);
            $post->update($request->except(['_token', '_method', 'images']));
            if ($request->hasFile('images')) {
                ImagesManger::deleteImage($post);
                ImagesManger::uploadImages($request, $post);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
        Session::flash('success', "Post Updated Successfuly !");
        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        //delete post image from local befor delete post 
        ImagesManger::deleteImage($post);
        $post->delete();
        Session::flash('success', " $post->title  Post Deleted Successuflly");
        return redirect()->route('admin.post.index');
    }
    public function PostStatus($id)
    {
        $post = Post::findOrFail($id);
        if ($post->status == 1) {
            $post->update(['status' => 0]);
            Session::flash('success', "$post->title Blocked Successuflly");
        } else {
            $post->update(['status' => 1]);
            Session::flash('success', "$post->title Active Successuflly");
        }
        return redirect()->back();
    }

    //delete post image
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
}
