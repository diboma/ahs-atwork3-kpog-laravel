<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
  protected $table = 'documents';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'title',
    'description',
    'path',
  ];

  /**
   * Validation messages
   *
   * @return array
   */
  public static function validationMessages(): array
  {
    return [
      'title.required' => __('The title field is required.'),
      'title.max' => __('The title may not be greater than 255 characters.'),
      'title.unique' => __('The title has already been taken.'),
      'description.max' => __('The description may not be greater than 255 characters.'),
      'file.required' => __('The file field is required.'),
      'file.mimes' => __('You can only upload files of type: pdf, xls, xlsx, doc, docx, ppt, pptx.'),
      'file.max' => __('The file may not be greater than 10MB.'),
    ];
  }
}
