<?php

namespace App\Http\Controllers\Admin;

use App\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ArticleCategory::latest('created_at')->paginate(10);

        return view('admin.articles.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        ArticleCategory::create([
            'name' => $request->name
        ]);

        alert()->success('Article Category Created');
        return redirect()->route('articles.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArticleCategory $category
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleCategory $category)
    {
        return view('admin.articles.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArticleCategory $category
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleCategory $category)
    {
        return view('admin.articles.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArticleCategory $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArticleCategory $category)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category->update($request->all());

        alert()->success('Article Category Updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArticleCategory $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleCategory $category)
    {
        $category->delete();
        return back();
    }
}
