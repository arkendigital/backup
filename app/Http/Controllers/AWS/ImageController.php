<?php

namespace App\Http\Controllers\AWS;

/**
* Load Modules
*/
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BusinessRequest;
use Webpatser\Uuid\Uuid;

class ImageController extends Controller {

  private static $size;
  private static $name;

  /**
  * Upload Featured Image to Amazon S3 Bucket
  */
  public static function uploadImage($file, $section, $oldPath = "", $size = "") {

    /**
    * Remove the old photo if it exists
    */
    if ($oldPath != "") {
      $s3 = \Storage::disk('s3');
      $s3->delete($oldPath);
    }

    if (isset(self::$name) && self::$name != "") {
      $file_name = self::$name;
    } else {
      $file_name = Uuid::generate()->string;
    }

    /**
    * Create S3 Instance
    */
    $s3 = \Storage::disk('s3');

    /**
    * Create file path for this image
    */
    $originalPath = '/'.$section.'/'. $file_name . "." . $file->extension();

    /**
    * Create a thumbnail version of the image
    */
    // $image_thumb = \Image::make($file)->fit(390,390);
    // $image_rectangle = \Image::make($file)->fit(390,250);
    // $image_thumb = $image_thumb->stream();
    // $image_rectangle = $image_rectangle->stream();
    $image_original = $file;

    if (isset(self::$size)) {
      $image_custom = \Image::make($image_original)->fit(self::$size[0],self::$size[1]);
      $image_custom = $image_custom->stream();

      $s3->getDriver()->put($originalPath, $image_custom->__toString(), ["visibility" => "public", "Expires" => gmdate('D, d M Y H:i:s \G\M\T', time() + (60000 * 60000))]);

    } else {

      /**
      * Upload to S3
      * If production upload to the production S3 bucket
      * If local, dev whatever, upload to the 15dev S3 bucket
      */
      $s3->getDriver()->put($originalPath, file_get_contents($image_original), ["visibility" => "public", "Expires" => gmdate('D, d M Y H:i:s \G\M\T', time() + (60000 * 60000))]);

    }

    /**
    * Return file path
    */
    return $originalPath;

  }

  public static function setCustomSize($size) {
    self::$size = $size;
  }

  public static function setCustomName($name) {
    self::$name = $name;
  }


  /**
  * Remove a specified image from S3 bucket
  */
  public static function deleteImage($path) {
    if ($path != "") {
      $s3 = \Storage::disk('s3');
      $s3->delete($path);
    }
  }

}
