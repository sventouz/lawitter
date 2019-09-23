<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // いいね
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    // フォロー系
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }
    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }
    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }
    // フォローする
    public function follow(Int $user_id) 
    {
        return $this->follows()->attach($user_id);
    }
    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }
    // フォローしているか
    public function isFollowing(Int $user_id) 
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }
    // フォローされているか
    public function isFollowed(Int $user_id) 
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }
}
