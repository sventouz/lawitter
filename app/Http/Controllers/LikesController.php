<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Like;
use Auth;
use App\Article;

class LikesController extends Controller
{
    public function store(Request $request, $articleId)
    {
        Like::create(
            array(
            'user_id' => Auth::user()->id,
            'article_id' => $articleId
            )
        );
        $article = Article::findOrFail($articleId);
        return redirect()
            ->action('ArticlesController@show', $article->id);
    }
    public function destroy($articleId, $likeId) {
        $article = Article::findOrFail($articleId);
        $article->like_by()->findOrFail($likeId)->delete();
        return redirect()
            ->action('ArticlesController@show', $article->id);
    }
}
