<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Classroom extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->hasMany(Category::class, 'classroom_id');
    }

    public function userClassroom()
    {
        return $this->hasMany(UserClassroom::class, 'classroom_id');
    }

    public function isJoined(){
        return $this->userClassroom()->where('user_id', Auth::id())->exists();
    }
}
