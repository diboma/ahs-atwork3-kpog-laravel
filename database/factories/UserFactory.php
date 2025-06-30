<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
   * The current password being used by the factory.
   */
  protected static string $password = 'password';

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $firstName = fake()->firstName();
    $lastName = fake()->lastName();
    $email = strtolower(str_replace(' ', '', $firstName)) . '.' . strtolower(str_replace(' ', '', $lastName)) . '@example.com';

    $existingUser = User::where('email', $email)->first();
    if (! $existingUser) {
      return [
        'firstname' => $firstName,
        'lastname' => $lastName,
        'email' => $email,
        'email_verified_at' => fake()->dateTimeBetween('-1 year', 'now'),
        'password' => static::$password ??= Hash::make('password'),
        'remember_token' => Str::random(10),
      ];
    }
  }

  /**
   * Indicate that the model's email address should be unverified.
   */
  public function unverified(): static
  {
    return $this->state(fn(array $attributes) => [
      'email_verified_at' => null,
    ]);
  }
}
