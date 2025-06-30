<?php

namespace App\Http\Controllers;

use App\Models\PageBlock;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    // Get blocks
    $pageBlocks = PageBlock::where('page', 'homepage')->get();

    // Render
    return view('home', compact('pageBlocks'));
  }
}
