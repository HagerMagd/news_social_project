<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory;
     use Sluggable;
    
    protected $guarded=[];

   public function posts()
   {
    return $this->hasMany(Post::class,'category_id');
   }
   public function scopeActive($query)
    {
        return $query->where('status',1);
    }
        public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
