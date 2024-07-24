<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizTitle extends Model
{
    use HasFactory;

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id'  );
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'title_id');
    }
}
