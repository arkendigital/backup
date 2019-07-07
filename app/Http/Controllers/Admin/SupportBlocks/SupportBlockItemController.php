<?php

namespace App\Http\Controllers\Admin\SupportBlocks;

use App\Http\Controllers\AWS\ImageController as AWS;
use App\Http\Controllers\Controller;
use App\SupportArticle;
use App\SupportBlock;
use App\SupportBlockItem;
use Illuminate\Http\Request;

class SupportBlockItemController extends Controller
{
    public function create()
    {
        $supportArticles = SupportArticle::all();
        $block = SupportBlock::find($_GET["block_id"]);
        return view("admin.support.items.create", compact('block','supportArticles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'required',
            'support_block_id' => 'required',
            'support_article_id' => 'required',
        ]);

        $block = SupportBlock::find($validatedData['support_block_id']);

        $supportBlockItem = SupportBlockItem::create([
            'support_block_id' => $validatedData['support_block_id'],
            'support_article_id' => $validatedData['support_article_id'],
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle']
        ]);

        if (request()->file("image")) {
            $image_path = AWS::uploadImage(
                request()->file("image"),
                "support_blocks/items/".$validatedData['support_block_id'],
                $supportBlockItem->image
            );

            $supportBlockItem->update([
                "image" => $image_path
            ]);
        }

        return redirect(route("support-blocks.edit", compact(
            "block"
        )));
    }

    public function edit($itemid)
    {
        $item = SupportBlockItem::find($itemid);
        $block = SupportBlock::find($_GET["block_id"]);
        $supportArticles = SupportArticle::all();
        return view("admin.support.items.edit", compact(
            "item",
            "supportArticles",
            "block"
        ));
    }

    public function update($supportBlockItemId, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'support_block_id' => 'required',
            'support_article_id' => 'required',
        ]);

        $supportBlockitem = SupportBlockItem::find($supportBlockItemId);
        $block = SupportBlock::find($validatedData['support_block_id']);

        $supportBlockitem->update([
            'support_block_id' => $validatedData['support_block_id'],
            'support_article_id' => $validatedData['support_article_id'],
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle']
        ]);

        if (request()->file("image")) {
            $image_path = AWS::uploadImage(
                request()->file("image"),
                "support_blocks/items/".$validatedData['support_block_id'],
                $supportBlockItem->image
            );

            $supportBlockItem->update([
                "image" => $image_path
            ]);
        }

        return redirect(route("support-blocks.edit", compact(
            "block"
        )));
    }


    public function destroy(SupportBlockItem $supportBlockItem)
    {

        $supportBlockItem->delete();

        alert()->success("Support Block Item Deleted");

        return redirect()
        ->back();
    }


}
