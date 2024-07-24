<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'choice1',
        'choice2',
        'choice3',
        'title_id',
    ];

    public function quizTitle()
    {
        return $this->belongsTo(QuizTitle::class, 'title_id');
    }
}
