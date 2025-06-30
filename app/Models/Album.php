<?php

namespace App\Models;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Album extends Model
{
  protected $table = 'albums';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'title',
    'description',
  ];

  /**
   * Get all of the photos for the Album
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function photos(): HasMany
  {
    return $this->hasMany(Photo::class)->orderBy('created_at', 'desc');
  }

  /**
   * Get the cover that belongs to the Album
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function cover(): BelongsTo
  {
    return $this->belongsTo(Photo::class, 'cover_id');
  }


  /**
   * Check if the album has a cover, if not, set a new one
   *
   * @return void
   */
  public function checkCover(): void
  {
    if (count($this->cover()->get()) === 0) {
      $this->cover_id = $this->photos()->first()?->id ?? null;
      $this->save();
    }
  }

  /**
   * Get the validation messages
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
    ];
  }
}
