<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AWS\ImageController as AWS;
use App\Http\Controllers\Controller;
use App\SupportArticle;
use Illuminate\Http\Request;

class SupportArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create article|edit article|delete article']);
    }

    public function index(SupportArticle $article)
    {
        $articles = $article->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.support-articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.support-articles.create');
    }

    public function store(Request $request, SupportArticle $article)
    {

        $request->validate([
            'title' => 'required'
        ]);

        if ($request->image) {
            $path = AWS::uploadImage(
                request()->file('image'),
                'support-articles'
            );
        }

        $article->fill([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'user_id' => auth()->user()->id,
            'image' => isset($path) ? env("LOCAL_URL").$path : null
        ]);
        
        if($request->author){
            $article->author = $request->author;
        }

        $article->save();

        return redirect()->route('support-articles.index');
    }

    public function show(SupportArticle $article)
    {
        dd($article);
        return view('admin.support-articles.show', compact('article'));
    }

    public function edit($articleid)
    {
        $article = SupportArticle::find($articleid);
        return view('admin.support-articles.edit', compact('article'));
    }

    public function update(Request $request, $articleid)
    {
        $article = SupportArticle::findOrFail($articleid);

        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($request->image) {
            $path = AWS::uploadImage(
                request()->file('image'),
                'support-articles'
            );
        }

        $article->update([
            'image' =>   isset($path) ? env("LOCAL_URL").$path : $article->image,
            'title' => $request->title,
            'body' => $request->body,
        ]);
        
        if($request->author){
            $article->update([
                'author'=> $request->author
            ]);
        }
                
        alert()->success('Support Article Updated');

        return redirect()->route('support-articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($articleid)
    {
        $article = SupportArticle::findOrFail($articleid);
        $article->delete();
        alert()->success('Support Article deleted.');

        return back();
    }

    /**
     *
     * Upload image coming from WUSIWUG
     *
     */
    public function imageUpload(Request $request, $supportArticleId)
    {
        $path = $request->image->storeAs('support-articles/'.$supportArticleId,$request->image->getClientOriginalName(), 'public'); 
        return ['success'=>true,'url'=>asset('storage/'.$path)];
    }
}
