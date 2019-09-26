<?php

namespace App;
use Carbon\Carbon;
use App\Like;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'published_at', 'user_id'];
    //
    public function scopePublished($query) {
    $query->where('published_at', '<=', Carbon::now());
    }
    //
    protected $dates = ['published_at'];
    public function user() 
    {
        return $this->belongsTo('App\User');
    }
    //
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    // like
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    public function like_by()
    {
        return Like::where('user_id', \Auth::user()->id)->first();
    }
    public function getUserTimeLine(Int $user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
    }
    public function getArticleCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }
}
