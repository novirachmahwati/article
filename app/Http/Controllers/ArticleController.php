<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');
        $author = $request->query('author');

        $articles = Cache::remember('articles', 600, function() use ($query, $author) {
            $articlesQuery = Article::query();

            if ($query) {
                $articlesQuery->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%$query%")
                      ->orWhere('body', 'like', "%$query%");
                });
            }

            if ($author) {
                $articlesQuery->where('author', $author);
            }

            return $articlesQuery->orderBy('created_at', 'desc')->get();
        });

        return response()->json($articles);
    }
    
    public function create(Request $request)
    {
        $article = Article::create($request->all());
        Cache::forget('articles'); 
        return response()->json($article, 201);
    }
}
