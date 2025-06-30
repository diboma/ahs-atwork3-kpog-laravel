<?php

namespace App\Http\Controllers\Private;

use App\Models\Album;
use App\Models\Photo;
use Spatie\Image\Image;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
  /**
   * Show the form for creating a new resource.
   */
  public function create(Album $album): View
  {
    return view('photos.create', compact('album'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, Album $album)
  {
    // Validate
    $request->validate([
      'photos' => 'required|array|min:1|max:10', // Minimaal 1 en maximaal 10 foto's
      'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Maximaal 2MB per foto
    ], Photo::validationMessages());

    // Get all photos from request
    $photos = $request->file('photos');

    // Upload all photos
    foreach ($photos as $photo) {
      // Store in storage
      $filename = $this->handlePhotoUpload($photo);

      // Store in database
      Photo::create([
        'album_id' => $album->id,
        'path' => $filename
      ]);
    }

    // Add cover id to album
    $album->checkCover();

    // Redirect
    return redirect()->route('albums.show', $album->id);
  }

  /**
   * Handle photo upload
   *
   * @param [type] $newPhoto
   * @return String
   */
  public function handlePhotoUpload($newPhoto): String
  {
    // File will automatically be renamed
    $uploaded_path = $newPhoto->store('photos', 'local');
    $filename = basename($uploaded_path);

    // Optimize and resize using spatie/image
    Image::load(storage_path('app/private/photos/' . $filename))
      ->optimize()
      ->width(800)
      ->save();

    // Return file name
    return $filename;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Album $album, Photo $photo)
  {
    // Delete photo from storage
    Storage::disk('local')->delete('photos/' . $photo->path);

    // Delete photo from database
    $photo->delete();

    // Check if album has a cover, if not, set a new one
    $album->checkCover();

    // Redirect
    return redirect()->route('albums.show', $photo->album->id);
  }
}
