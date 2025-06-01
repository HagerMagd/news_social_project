<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowPostsController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\SearchController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\NewsSubscribController;
use App\Http\Controllers\frontend\ShowPostsController as FrontendShowPostsController;

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

Route::redirect('/','/home');
Route::group([
'as'=>'frontend.',] ,function(){
    Route::get('/home',[HomeController::class,'index'])->name('index');
    Route::post('new-subscribe',[NewsSubscribController::class,'store'])->name('new.subscribe');
    Route::get('category/{slug}',CategoryController::class)->name('category.posts');

    //for show posts,comments and save comments
    Route::controller(FrontendShowPostsController::class)->prefix('posts')->group(function(){
     Route::get('/{slug}','showposts')->name('show.posts');
    Route::get('/comments/{slug}','GetAllPosts')->name('post.get-all-comments');
    Route::post('/comment/store',  'storecomment')->name('posts.comments.store');
    });

    // for contact-us show and send data 
    Route::controller(ContactController::class)->name('contact.')->prefix('contact-us')->group(function(){
    Route::get('/','index')->name('index');
    Route::post('/store','store')->name('store');
    });

    // for search request
    Route::match(['post','get'],'search',SearchController::class)->name('search');
   
});

// for Verify Email Address
Route::prefix('email')->controller(VerificationController::class,)->name('verification.')->group(function(){
Route::get('/verify', 'show')->name('notice');
Route::get('/verify/{id}/{hash}','verify')->name('verify');
Route::post('/resend','resend')->name('resend');
});


Auth::routes();
  
