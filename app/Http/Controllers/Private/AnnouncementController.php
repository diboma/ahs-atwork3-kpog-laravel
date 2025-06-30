<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    // Get announcements
    $announcements = Announcement::with(['readers' => function ($query) {
      $query->where('user_id', Auth::id());
    }])->orderBy('created_at', 'desc')->get();

    // Render
    return view('announcements.index', compact('announcements'));
  }

  /**
   * Show the text-editor for creating a new resource.
   */
  public function create()
  {
    // Set the form action
    $action = route('text-editor.update', [
      'resourceType' => 'announcement'
    ]);

    // Render
    return view('text-editor.index', [
      'title' => '',
      'content' => '',
      'action' => $action,
      'callBackRoute' => 'announcements.index'
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Announcement $announcement)
  {
    // Mark as read
    $announcement->markAsRead(Auth::id());

    // Render
    return view('announcements.show', compact('announcement'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  public function markAsNotRead(Announcement $announcement): RedirectResponse
  {
    // Mark as read
    $announcement->markAsNotRead(Auth::id());

    // Redirect
    return redirect()->route('announcements.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Announcement $announcement)
  {
    $announcement->delete();
    return redirect()->route('announcements.index');
  }
}
