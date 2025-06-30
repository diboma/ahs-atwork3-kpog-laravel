<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Announcement extends Model
{
  use SoftDeletes;

  protected $table = 'announcements';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'title',
    'content',
  ];

  /**
   * The users that have marked the announcement as read or not read
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function readers(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'announcement_reads')
      ->withPivot('read')
      ->withTimestamps();
  }

  /**
   * Mark an announcement as read
   *
   * @param Int $userId
   * @return void
   */
  public function markAsRead(Int $userId): void
  {
    $pivotRow = $this->readers()->where('user_id', $userId)->first();
    if (!$pivotRow) {
      $this->readers()->attach($userId, ['read' => true]);
    } else {
      $this->readers()->updateExistingPivot($userId, ['read' => true]);
    }
  }

  /**
   * Mark an announcement as not read
   *
   * @param Int $userId
   * @return void
   */
  public function markAsNotRead(Int $userId): void
  {
    $pivotRow = $this->readers()->where('user_id', $userId)->first();
    if (!$pivotRow) {
      $this->readers()->attach($userId, ['read' => false]);
    } else {
      $this->readers()->updateExistingPivot($userId, ['read' => false]);
    }
  }
}
