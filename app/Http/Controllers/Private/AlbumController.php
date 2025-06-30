<?php

namespace App\Http\Controllers\Private;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    // Get albums
    $albums = Album::orderBy('created_at', 'desc')->paginate(6);

    // Render
    return view('albums.index', compact('albums'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view('albums.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // Validate
    $request->validate([
      'title' => 'required|string|max:255|unique:albums',
      'description' => 'nullable|string|max:255',
    ], Album::validationMessages());

    // Create album
    $album = Album::create([
      'title' => $request->title,
      'description' => $request->description,
    ]);

    // Redirect
    return redirect()->route('albums.show', $album->id);
  }

  /**
   * Display the specified resource.
   */
  public function show(Album $album): View
  {
    // Get photo albums
    $photos = $album->photos()->orderBy('created_at', 'desc')->get();

    // Render
    return view('albums.show', compact('album', 'photos'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Album $album): View
  {
    return view('albums.edit', compact('album'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Album $album)
  {
    // Validate
    $request->validate([
      'title' => ['required', 'string', 'max:255', Rule::unique('albums')->ignore($album)],
      'description' => 'nullable|string|max:255',
    ], Album::validationMessages());

    // Update album
    $album->update([
      'title' => $request->title,
      'description' => $request->description,
    ]);

    // Redirect
    return redirect()->route('albums.show', $album->id);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Album $album)
  {
    // Delete all photos from storage & database
    foreach ($album->photos as $photo) {
      Storage::disk('local')->delete('photos/' . $photo->path);
      $photo->delete();
    }

    // Delete album
    $album->delete();

    // Redirect
    return redirect()->route('albums.index');
  }
}
