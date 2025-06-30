<?php

namespace App\Models;

use App\Models\Album;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
  protected $table = 'photos';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'album_id',
    'path',
  ];

  /**
   * Get the album that owns the Photo
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function album(): BelongsTo
  {
    return $this->belongsTo(Album::class);
  }

  public static function validationMessages(): array
  {
    return [
      'photos.required' => __('Please select at least one photo.'),
      'photos.min' => __('Please select at least one photo.'),
      'photos.max' => __('You can upload a maximum of 10 photos.'),
      'photos.*.image' => __('Each file must be an image.'),
      'photos.*.mimes' => __('Each photo must be a file of type: jpeg, png, jpg, gif.'),
      'photos.*.max' => __('Each photo may not be greater than 2MB.'),
    ];
  }
}
