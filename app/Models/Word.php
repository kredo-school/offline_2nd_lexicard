<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'word',
        'meaning',
        'definition',
        'example',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoryWord(){
        return $this->hasMany(CategoryWord::class, 'word_id');
    }
}
