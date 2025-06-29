<?php

namespace App\Http\Controllers\frontend\dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\utlis\ImagesManger;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
 {
    public function index(){
        return view('frontend.user-dashboard.profile');
 
    }
    public function storepost(StorePostRequest $request){
        DB::beginTransaction();
        try {
             $request->validated();
             $request->merge(['desc' => trim($request->input('desc'))]);
        // Convert checkbox input to boolean (1 if checked, 0 if not)
        $request->comment_able == "on" ? $request->merge(['comment_able'=>1])
        :$request->merge(['comment_able'=>0]);
        //use reliontion between user&posts to store posts for current user
        $post=auth()->user()->posts()->create($request->except(['_token','images']));
        //store images
       $imagemanger= new ImagesManger;
       $imagemanger->uploadImage($request,$post);
        DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors',$e->getMessage()]);
            
        }
       

        Session::flash('success','post created successfuly');
        return redirect()->back();
    
    }
}