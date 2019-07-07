<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\SupportArticle;
use App\SupportBlock;
use App\SupportBlockItem;
use Illuminate\Http\Request;

class SupportArticleController extends Controller
{
    public function items($supportblockid)
    {
        //get block items and show them on a seperate page which link to show
        $block = SupportBlock::find($supportblockid);
        $this->seo()->setTitle('Support Articles');
        $blockItems = SupportBlockItem::where('support_block_id',$supportblockid)->orderBy('created_at', 'DESC')->paginate(9);
        //loop and get linked articles slugs
        foreach($blockItems as $blockItem){
            $blockItem->slug = SupportArticle::find($blockItem->support_article_id)['slug'];
        }
        return view('support-articles.index', compact('blockItems','block'))->compileShortcodes();
    }

    public function show($articleslug)
    {   
        $article = SupportArticle::where('slug',$articleslug)->first();
        return view('support-articles.show', compact('article'))->compileShortcodes();
    }
}
