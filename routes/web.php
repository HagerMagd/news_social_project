<?php

use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\NewsSubscribController;
use App\Http\Controllers\frontend\ShowPostsController as FrontendShowPostsController;
use App\Http\Controllers\ShowPostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group([
'as'=>'frontend.',] ,function(){
    Route::get('/',[HomeController::class,'index'])->name('index');
    Route::post('new-subscribe',[NewsSubscribController::class,'store'])->name('new.subscribe');
    Route::get('category/{slug}',CategoryController::class)->name('category.posts');
    Route::get('posts/{slug}',[FrontendShowPostsController::class,'showposts'])->name('show.posts');
    Route::get('posts/comments/{slug}',[FrontendShowPostsController::class,'GetAllPosts'])->name('post.get-all-comments');
    Route::post('posts/comment/store', [FrontendShowPostsController::class, 'storecomment'])->name('posts.comments.store');
    Route::get('contact-us',[ContactController::class,'index'])->name('contact.index');
    Route::post('contact-us/store',[ContactController::class,'store'])->name('contact.store');
});


Auth::routes();
  
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
