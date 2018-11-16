<?php

namespace App\Http\Controllers\Article;

use App\Article;
use App\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index(Article $article, ArticleCategory $category)
    {
        $this->seo()->setTitle('Latest News');
        $articles = $article->orderBy('created_at', 'DESC')->paginate(5);
        $categories = $category->paginate(25, ['*'], 'cat_page');

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
}
