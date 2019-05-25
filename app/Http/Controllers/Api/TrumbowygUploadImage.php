<?php

namespace App\Http\Controllers\Api;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AWS\ImageController as Aws;

class TrumbowygUploadImage extends Controller
{
    public function store(Request $request)
    {
        if ($request->file('fileToUpload')) {
            $featuredImagePath = Aws::uploadImage($request->file('fileToUpload'), 'trumbowyg', 'uploads');
            $file = [
        'file' => env("LOCAL_URL") . $featuredImagePath,
        'success' => 'success'
      ];
            return json_encode($file);
        }
    }
}
