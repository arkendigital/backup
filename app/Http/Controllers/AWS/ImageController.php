<?php

namespace App\Http\Controllers\AWS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    private static $size;
    private static $name;

    /**
    * Upload Featured Image to local storage
    */
    public static function uploadImage($file, $originalPath, $oldPath = "", $size = "")
    {
        /**
        * Remove the old photo if it exists
        */
        if ($oldPath != "") {
            \Storage::disk('public')->delete($oldPath);
        }

        $file_name = $file->getClientOriginalName();

        /**
        * Create a thumbnail version of the image
        */
        // $image_thumb = \Image::make($file)->fit(390,390);
        // $image_rectangle = \Image::make($file)->fit(390,250);
        // $image_thumb = $image_thumb->stream();
        // $image_rectangle = $image_rectangle->stream();
        $image_original = $file;

        if (isset(self::$size)) {
            $image_custom = \Image::make($image_original)->fit(self::$size[0], self::$size[1]);
            $image_custom = $image_custom->stream();

            $path = \Storage::disk('public')->putFileAs(
                $originalPath , $image_custom, $file_name
            );

        } else {
            $path = \Storage::disk('public')->putFileAs(
                $originalPath , $image_original, $file_name
            );
        }

        /**
        * Return file path
        */
        return $path;
    }

    public static function setCustomSize($size)
    {
        self::$size = $size;
    }

    public static function setCustomName($name)
    {
        self::$name = $name;
    }


    /**
    * Remove a specified image from local storage
    */
    public static function deleteImage($path)
    {
        if ($path != "") {
            \Storage::disk('public')->delete($path);
        }
    }
}
