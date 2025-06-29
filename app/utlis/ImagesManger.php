<?php
namespace App\utlis;

use Illuminate\Support\Str;

class ImagesManger{
    public function uploadImage($request,$post)
    {
         if($request->hasFile('images')){
            foreach($request->images as $image){
                $image_name= Str::uuid() .time() .$image->getClientoriginalExtension();
                $path=$image->storeAs('uploads/posts',$image_name,['disk'=>'uploads']);
                $post->images()->create([
                    'path'=>$path,
                ]);

            }
        }
    }
}