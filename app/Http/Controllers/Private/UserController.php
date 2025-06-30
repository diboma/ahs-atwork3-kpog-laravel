<?php

namespace App\Http\Controllers\Private;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\SimpleExcel\SimpleExcelWriter;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $search = request('search');
    if ($search) {
      $users = User::search($search)->orderBy('firstname')->paginate(12)->withQueryString();
    } else {
      $users = User::orderBy('firstname')->paginate(12)->withQueryString();
    }

    return view('users.index', compact('users', 'search'));
  }

  /**
   * Export users
   *
   * @return void
   */
  public function export(): void
  {
    // Get users
    $users = User::orderBy('lastname')->get();

    // Write to Excel file
    $writer = SimpleExcelWriter::streamDownload(date('Y-m-d') . ' ' . __('Users') . ' ' . env('APP_NAME') . '.xlsx');
    $writer->addHeader([__('Last name'), __('First name'), __('Email'), __('Role')]);
    foreach ($users as $user) {
      $writer->addRow([
        $user->lastname,
        $user->firstname,
        $user->email,
        __($user->role)
      ]);
    }
    $writer->toBrowser();
  }
  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view('users.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // Validate
    $request->validate([
      'firstname' => 'required|string|max:255',
      'lastname' => 'required|string|max:255',
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'role' => 'required|in:admin,editor,user',
    ], User::validationMessages());

    // Create user
    $user = User::create([
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'role' => $request->role,
    ]);

    if (!$user) {
      return redirect()->back()
        ->withInput()
        ->with('error', __('Failed to create user. Please try again.'));
    }

    // Redirect
    return redirect()->route('users.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user): View
  {
    return view('users.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    // Validate
    $request->validate([
      'firstname' => 'required|string|max:255',
      'lastname' => 'required|string|max:255',
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
      'password' => ['nullable', 'string', 'min:8', 'confirmed'],
      'role' => 'required|in:admin,editor,user',
    ], User::validationMessages());

    // Update user
    if ($user->firstname != request('name')) $user->firstname = request('firstname');
    if ($user->lastname != request('name')) $user->lastname = request('lastname');
    if ($user->email != request('email')) $user->email = request('email');
    if ($request->password) $user->password = bcrypt($request->password);
    if ($user->role != request('role')) $user->role = request('role');
    $user->save();

    if (!$user) {
      return redirect()->back()
        ->withInput()
        ->with('error', __('Failed to update user. Please try again.'));
    }

    // Redirect
    return redirect()->route('users.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user): RedirectResponse
  {
    $user->delete();
    return redirect()->route('users.index');
  }
}
