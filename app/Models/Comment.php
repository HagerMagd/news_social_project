<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function user()
    {
        $this->belongsTo(User::class,'users_id');
    }
    public function post()
    {
        $this->belongsTo(Post::class,'post_id');
    }
}
