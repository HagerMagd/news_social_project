<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    use HasFactory;
    protected $fillable = ['role','permession'];
    protected $casts = [
    'permession' => 'array',
];
    public function admins(){
        return $this->hasMany(Admin::class,'role_id');
    }
}
