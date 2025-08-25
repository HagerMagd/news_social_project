<?php

namespace App\utlis;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\fileExists;

class ImagesManger
{
    public  static function uploadImages($request, $post = null, $user = null)
    {
        //store Multiple images for posts
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $image_name =self::generateImageName($image);
                $path =self::storeImageInLocal($image,'posts',$image_name);
                $post->images()->create([
                    'path' => $path,
                ]);
            }
        }
        //store single image for user
        if ($request->hasFile('image')) {
            //1- delete old image from local
           self::checkFileAndDelete($user->image);
            // 2-store new image in local  
            $image = $request->image;
            $image_name=self::generateImageName($image);
            $path =self::storeImageInLocal($image,'users',$image_name);
            // 3- update new image in database
            $user->update([
                'image' => $path
            ]);
        }
    }

    public static function deleteImage($post)
    {
        if ($post->images->count() > 0) {
            foreach ($post->images as $image) {
                self::checkFileAndDelete($image->path);
                $image->delete();
            }
        }
    }
    private static function generateImageName($image)
    {
        $image_name = Str::uuid() . time() . $image->getClientoriginalExtension();
        return $image_name;
    }
    private static function storeImageInLocal($image,$path,$image_name)
    {
        $path = $image->storeAs('uploads/'.$path, $image_name, ['disk' => 'uploads']);
        return $path;
    }
    public static function checkFileAndDelete($image_path)
    {
         if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
    }
}
