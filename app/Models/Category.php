<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function categoryWord()
    {
        return $this->hasMany(CategoryWord::class);
    }

    public function like(){
        return $this->hasMany(Like::class);
    }

    public function isliked(){
        return $this->Like()->where('user_id', Auth::id())->exists();
    }

    public function QuizResult(){
        return $this->hasMany(QuizResult::class, 'category_id');
    }
}
