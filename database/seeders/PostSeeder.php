<?php

namespace Database\Seeders;

use App\Models\image;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //لكل بوست صورتين 
        $post=Post::factory(50)->create(); 
        $post->each(function($post){

            image::factory(2)->create([ 
                'posts_id'=>$post->id,//ربط الصورتين بالبوست الحالي

            ]);
        });

    }
}
