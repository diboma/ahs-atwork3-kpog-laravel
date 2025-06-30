<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageBlock extends Model
{
  use HasFactory;

  protected $table = 'pageblocks';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'page',
    'slug',
    'content',
  ];
}
