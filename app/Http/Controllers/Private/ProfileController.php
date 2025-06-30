<?php

namespace App\Http\Controllers\Private;

use App\Models\User;
use Spatie\Image\Image;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
  /**
   * Show profile
   *
   * @return void
   */
  public function index(): View
  {
    /** @disregard */
    $user = auth()->user();

    return view('profile.index', compact('user'));
  }


  /**
   * Show form to edit profile
   *
   * @return View
   */
  public function edit(): View
  {
    /** @disregard */
    $user = auth()->user();

    return view('profile.edit', compact('user'));
  }

  /**
   * Update profile
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function update(Request $request): RedirectResponse
  {
    /** @disregard */
    $user = auth()->user();

    // Validate
    $request->validate(
      [
        'firstname' => 'required|max:255',
        'lastname' => 'required|max:255',
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
        'avatar' => 'nullable|mimes:jpeg,png,jpg,svg|max:1024',
      ],
      User::validationMessages()
    );

    // Update name & email
    if ($user->firstname != request('firstname')) $user->firstname = request('firstname');
    if ($user->lastname != request('lastname')) $user->lastname = request('lastname');
    if ($user->email != request('email')) $user->email = request('email');
    $user->save();

    // Handle upload of avatar
    if ($request->file('avatar') && $request->file('avatar')->isValid()) {

      // Delete old avatar (if exists)
      if (isset($user->avatar) && $user->avatar !== "") {
        Storage::disk('public')->delete('images/avatars/' . $user->avatar);
      }

      // Save new avatar in storage and get filename (only uploaded_path)
      $uploaded_path = $request->file('avatar')->store('images/avatars', 'public');
      $filename = basename($uploaded_path);

      // If filename exists
      if (isset($filename)) {
        // Save filename in database
        $user->avatar = $filename;
        $user->save();
        // Resize image to 96x96
        $avatar_path = storage_path('app/public/images/avatars/' . $filename);
        Image::load($avatar_path)
          ->width(120)
          ->height(120)
          ->save();
      }
    }

    // Redirect
    return redirect()->route('profile.index');
  }


  /**
   * Update password
   *
   * @param User $user
   * @param Request $request
   * @return RedirectResponse
   */
  public function updatePassword(Request $request): RedirectResponse
  {
    /** @disregard */
    $user = auth()->user();

    // Validate
    $request->validate([
      'password' => 'required|confirmed|min:8',
    ], User::validationMessages());

    // Update password
    $user->password = bcrypt($request->password);
    $user->save();

    // Redirect
    return redirect()
      ->route('profile.index')
      ->with('success', __('Your password has been updated.'));
  }
}
