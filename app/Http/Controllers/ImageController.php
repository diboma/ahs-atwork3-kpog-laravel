<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class ImageController extends Controller
{
  /**
   * These functions will display an image in a Blade template.
   * You can use them either because the image is in the private folder
   * or because the app cannot use symlinks.
   *
   * You will have to create a route for each folder you want to display images from.
   * Then in your Blade template, you can use the following code to display an image:
   * @example <img src="{{ route('render.photo', $photo->path) }}" alt="{{ $photo->title }}">
   */


  /**
   * Show image
   * @param string $filename
   * @return void
   */
  public function showImage(string $filename): Response
  {

    $storagePath = storage_path('app/public/images/' . $filename);
    return $this->render($storagePath);
  }

  /**
   * Show avatar
   * @param string $filename
   * @return void
   */
  public function showAvatar(string $filename): Response
  {

    $storagePath = storage_path('app/public/images/avatars/' . $filename);
    return $this->render($storagePath);
  }

  /**
   * Show photo
   * @param string $filename
   * @return void
   */
  public function showPhoto(string $filename): Response
  {

    $storagePath = storage_path('app/private/photos/' . $filename);
    return $this->render($storagePath);
  }

  /**
   * Render image
   *
   * @param [type] $storagePath
   * @return Response
   */
  public function render($storagePath): Response
  {
    if (!file_exists($storagePath)) {
      abort(404);
    }
    $file = file_get_contents($storagePath);
    $type = mime_content_type($storagePath);

    return response($file, 200)->header("Content-Type", $type);
  }
}
