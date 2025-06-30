<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Announcement;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'firstname',
    'lastname',
    'email',
    'password',
    'avatar',
    'role'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  /**
   * Get the user's full name (firstname first)
   *
   * @return String
   */
  public function getFullName(): String
  {
    return $this->firstname . ' ' . $this->lastname;
  }

  /**
   * Get the user's full name (lastname first)
   *
   * @return String
   */
  public function getFullNameLastFirst(): String
  {
    return $this->lastname . ' ' . $this->firstname;
  }

  /**
   * Determine if the user is an admin
   *
   * @return boolean
   */
  public function isAdmin(): bool
  {
    return $this->role === 'admin';
  }

  /**
   * Determine if the user is an editor
   *
   * @return boolean
   */
  public function isEditor(): bool
  {
    return $this->role === 'editor';
  }

  /**
   * Search users
   *
   * @param Builder $query
   * @param string $search
   * @return void
   */
  public function scopeSearch(Builder $query, string $search): void
  {
    if ($search) {
      $query->where('firstname', 'like', '%' . $search . '%')
        ->orWhere('lastname', 'like', '%' . $search . '%')
        ->orWhere('email', 'like', '%' . $search . '%');
    }
  }

  /**
   * The announcements that the user has marked as read or not read
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function announcements(): BelongsToMany
  {
    return $this->belongsToMany(Announcement::class, 'announcement_reads')
      ->withPivot('read')
      ->withTimestamps();
  }

  /**
   * Get validation messages
   *
   * @return array
   */
  public static function validationMessages(): array
  {
    return [
      'firstname.required'  => __('The first name is required.'),
      'firstname.max'       => __('The first name may not be greater than 255 characters.'),
      'lastname.max'        => __('The last name may not be greater than 255 characters.'),
      'email.required'      => __('Email address is required.'),
      'email.unique'        => __('This email address is already registered.'),
      'password.min'        => __('The password must be at least 8 characters long.'),
      'password.confirmed'  => __('The password confirmation does not match the password.'),
      'avatar.mimes'        => __('You can only upload image files of type: jpeg, png, jpg, svg.'),
      'avatar.max'          => __('The file may not be greater than 1MB.'),
      'role.in'             => __('Pick one of the following roles: admin, editor, user'),
      'password.required'   => __('The password field is required.'),
      'password.min'        => __('The password must be at least 8 characters long.'),
      'password.confirmed'  => __('The password confirmation does not match the password.')
    ];
  }
}
