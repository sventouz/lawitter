<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;
class Like extends Model
{
    use CounterCache;
    public $counterCacheOptions = [
        'Article' => [
            'field' => 'likes_count',
            'foreignKey' => 'article_id'
        ]
    ];
    protected $fillable = ['user_id', 'article_id'];
    public function Article()
    {
        return $this->belongsTo('App\Article');
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
