<?php

namespace App\Http\Controllers\Private;

use App\Models\PageBlock;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

class TextEditorController extends Controller
{

  /**
   * Show the text editor
   *
   * @param String $resourceType
   * @param Int $resourceId
   * @return View
   */
  public function show(String $resourceType, Int $resourceId): View
  {
    // Get callback route from sebarch params
    $callBackRoute = request('callBackRoute');
    if (!$callBackRoute || !Route::has($callBackRoute)) $callBackRoute = 'home';

    // Get the resource
    if ($resourceType == 'pageblock') {
      $resource = PageBlock::find($resourceId);
    } elseif ($resourceType == 'announcement') {
      $resource = Announcement::find($resourceId);
    }
    if (!$resource) abort(404);

    // Set the form action
    $action = route('text-editor.update', [
      'resourceType' => $resourceType,
      'resourceId' => $resource->id
    ]);

    // Render
    return view('text-editor.index', [
      'title' => $resource->title,
      'content' => $resource->content,
      'action' => $action,
      'callBackRoute' => $callBackRoute
    ]);
  }

  /**
   * Update the resource
   *
   * @param Request $request
   * @param String $resourceType
   * @param Int $resourceId
   * @return RedirectResponse
   */
  public function update(Request $request, String $resourceType, Int $resourceId = null): RedirectResponse
  {
    // Validate
    $request->validate([
      'title' => 'required|string',
      'content' => 'required|string',
      'callBackRoute' => 'required|string',
    ]);

    // Get callback route from search params
    $callBackRoute = request('callBackRoute');
    if (!$callBackRoute) $callBackRoute = 'home';

    // Case: create a new announcement
    if (!$resourceId && $resourceType == 'announcement') {
      Announcement::create([
        'title' => $request->title,
        'content' => $request->content,
      ]);
    }

    // Case: update existing resource
    if ($resourceType == 'pageblock') {
      $resource = PageBlock::find($resourceId);
    } elseif ($resourceType == 'announcement') {
      $resource = Announcement::find($resourceId);
    }

    if ($resource) {
      $resource->title = $request->title;
      $resource->content = $request->content;
      $resource->save();
    }

    // Redirect
    return redirect()->route($callBackRoute);
  }
}
