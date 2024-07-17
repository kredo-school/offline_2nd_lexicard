<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;



class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    // getting all of your followers
    public function follower(){
        return $this->hasMany(Follow::class, 'following_id');
    }

    // getting all of your following
    public function following(){
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function isFollowed(){
        return $this->Follower()->where('follower_id', Auth::id())->exists();
    }

    public function Like(){
        return $this->hasMany(Like::class);
    }

    public function userClassroom(){
        return $this->hasMany(UserClassroom::class, 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
