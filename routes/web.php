<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Private\UserController;
use App\Http\Controllers\Private\AlbumController;
use App\Http\Controllers\Private\PhotoController;
use App\Http\Controllers\Private\ProfileController;
use App\Http\Controllers\Private\DocumentController;
use App\Http\Controllers\Private\TextEditorController;
use App\Http\Controllers\Private\AnnouncementController;

/** @disregard */
Auth::routes();

/**
 * Public routes
 */

// ------
//  Home
// ------
Route::get('/', [HomeController::class, 'index'])->name('home');

// --------------------------------------------------------
// Routes to render images
// For private images or when your app cannot use symlinks.
// --------------------------------------------------------
Route::get('/image/{filename}', [ImageController::class, 'showImage'])->name('render.image');
Route::get('/avatar/{filename}', [ImageController::class, 'showAvatar'])->name('render.avatar');
Route::get('/photo/{filename}', [ImageController::class, 'showPhoto'])->name('render.photo');


/**
 * Private routes (only authenticated users)
 */
Route::group(['middleware' => 'auth'], function () {

  // -------
  // Profile
  // -------
  Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
  Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

  // -----------
  // Text editor
  // -----------
  Route::get('/text-editor/{resourceType}/{resourceId?}', [TextEditorController::class, 'show'])
    ->name('text-editor.show')
    ->middleware('editor');
  Route::put('/text-editor/{resourceType}/{resourceId?}', [TextEditorController::class, 'update'])
    ->name('text-editor.update')
    ->middleware('editor');

  // -------------
  // Announcements
  // -------------
  Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
  Route::get('/announcements/create', [AnnouncementController::class, 'create'])
    ->name('announcements.create')
    ->middleware('editor');
  Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');
  Route::put('/announcements/{announcement}/not-read', [AnnouncementController::class, 'markAsNotRead'])->name('announcements.mark-as-not-read');
  Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])
    ->name('announcements.destroy')
    ->middleware('editor');

  // -------
  // Members
  // -------
  Route::get('/users', [UserController::class, 'index'])->name('users.index');

  // ---------------
  // Photos (Albums)
  // ---------------
  Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
  Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
  Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
  Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');
  Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
  Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
  Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');

  Route::get('/albums/{album}/photos/create', [PhotoController::class, 'create'])->name('photos.create');
  Route::post('/albums/{album}/photos', [PhotoController::class, 'store'])->name('photos.store');
  Route::delete('/albums/{album}/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');

  // ---------
  // Documents
  // ---------
  Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
  Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');

  // -----
  // Admin
  // -----
  Route::group(['middleware' => 'admin'], function () {

    // CRUD Users
    // ----------
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    // Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // CRUD Documents
    // --------------
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
  });
});
