<?php

namespace App\Http\Controllers\Private;

use App\Models\Document;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    // Get all documents
    $documents = Document::orderBy('title', 'asc')
      ->get()
      // Sort case insensitively (source: https://laracasts.com/discuss/channels/eloquent/case-insensitive-sorting-of-a-collection)
      ->sortBy(
        'title',
        SORT_NATURAL | SORT_FLAG_CASE
      );

    // Render
    return view('documents.index', compact('documents'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view('documents.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    // Validate
    $request->validate(
      [
        'title' => 'required|max:255|unique:documents',
        'description' => 'nullable|max:255',
        'file' => 'required|mimes:pdf,xls,xlsx,doc,docx,ppt,pptx|max:10240',
      ],
      Document::validationMessages()
    );

    // Handle upload
    if ($request->file('file') && $request->file('file')->isValid()) {

      // Save new file in storage and get filepath
      $filepath = $this->handleDocumentUpload($request->file('file'));

      // Create document in database
      if (isset($filepath)) {
        Document::create([
          'title' => $request->title,
          'description' => $request->description,
          'path' => $filepath
        ]);
      }
    }

    // Redirect
    return redirect()->route('documents.index');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Document $document): View
  {
    return view('documents.edit', compact('document'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Document $document): RedirectResponse
  {
    // Validate
    $request->validate(
      [
        'title' => ['required', 'max:255', Rule::unique('documents')->ignore($document)],
        'description' => 'nullable|max:255',
        'file' => 'nullable|mimes:pdf,xls,xlsx,doc,docx,ppt,pptx|max:10240',
      ],
      Document::validationMessages()
    );

    // If new file exists, save if in storage and get filepath
    if ($request->file('file') && $request->file('file')->isValid()) {
      $filepath = $this->handleDocumentUpload($request->file('file'), $document->path);
    }

    // Update document
    $document->title = $request->title;
    $document->description = $request->description;
    if (isset($filepath)) $document->path = $filepath;
    $document->save();

    // Redirect
    return redirect()->route('documents.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Document $document): RedirectResponse
  {
    // Delete document from storage
    Storage::disk('local')->delete('documents/' . $document->path);

    // Delete document from database
    $document->delete();

    // Redirect
    return redirect()->route('documents.index');
  }

  /**
   * Download document
   *
   * @param Document $document
   * @return void
   */
  public function download(Document $document)
  {
    // Download file
    return response()->download(storage_path('app/private/documents/' . $document->path));
  }

  /**
   * Handle document upload
   *
   * @param [type] $newFile
   * @param [type] $oldFilePath
   * @return String
   */
  public function handleDocumentUpload($newFile, $oldFilePath = null): String
  {
    // Delete old file (if exists)
    if (isset($oldFilePath) && $oldFilePath !== "") {
      Storage::disk('local')->delete('documents/' . $oldFilePath);
    }

    // Save new file in storage and get filepath
    $newFileName = time() . '-' . $newFile->getClientOriginalName();
    $uploadedPath = $newFile->storeAs('documents', $newFileName, 'local');
    $filePath = basename($uploadedPath);
    return $filePath;
  }
}
