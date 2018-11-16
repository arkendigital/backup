<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create article|edit article|delete article']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
        $articles = $article->orderBy('created_at', 'DESC')->paginate(20);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {

        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($request->image) {
            $path = 'storage/'. $request->image->store('images/articles', 'public');
        }

        $article->fill([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'body' => $request->body,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'image' => $path ?? null,
        ]);

        $article->save();

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Article                  $article
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {

        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($request->image) {
            $path = 'storage/'. $request->image->store('images/articles', 'public');
        }

        $article->update([
            'image' => $path ?? $article->image,
            'title' => $request->title,
            'body' => $request->body,
        ]);
                
        alert()->success('Article Updated');

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        alert()->success('Article deleted.');

        return back();
    }
}
