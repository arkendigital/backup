<?php

namespace App\Http\Controllers\Admin\SupportBlocks;

use App\Http\Controllers\AWS\ImageController as AWS;
use App\Http\Controllers\Controller;
use App\SupportBlock;
use App\SupportBlockItem;
use Illuminate\Http\Request;

class SupportBlockController extends Controller
{
    public function index()
    {
        $supportBlocks = SupportBlock::all();
        return view("admin.support.blocks.index", compact(
            "supportBlocks"
        ));
    }

    public function create()
    {
        return view("admin.support.blocks.create");
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'required'
        ]);

        $supportBlock = SupportBlock::create([
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle']
        ]);

        if (request()->file("image")) {
            $image_path = AWS::uploadImage(
                request()->file("image"),
                "support_blocks",
                $supportBlock->image
            );

            $supportBlock->update([
                "image" => $image_path
            ]);
        }

        return redirect(route("support-blocks.edit", compact(
            "supportBlock"
        )));
    }

    public function edit($id)
    {
        $supportBlock = SupportBlock::find($id);

        return view("admin.support.blocks.edit", compact(
            "supportBlock"
        ));
    }

    public function update(SupportBlock $supportBlock, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'subtitle' => 'required'
        ]);

        $supportBlock->update([
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle']
        ]);

        if (request()->file("image")) {
            $image_path = AWS::uploadImage(
                request()->file("image"),
                "support_blocks",
                $supportBlock->image
            );

            $supportBlock->update([
                "image" => $image_path
            ]);
        }

        return redirect(route("support-blocks.edit", compact(
            "supportBlock"
        )));
    }


    public function destroy(SupportBlock $supportBlock)
    {
        //delete support block items
        SupportBlockItem::where('support_block_id',$supportBlock->id)->delete();
        
        $supportBlock->delete();

        alert()->success("Support Block Deleted");

        return redirect()
        ->back();
    }


}
