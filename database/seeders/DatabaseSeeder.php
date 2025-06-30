<?php

namespace Database\Seeders;

use App\Models\PageBlock;
use App\Models\User;
use Database\Factories\PageBlockFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // Create default users for each role
    User::factory()->create([
      'firstname' => 'Tim',
      'lastname' => 'Timmers',
      'email' => 'tim@example.com',
      'role' => 'admin',
      'email_verified_at' => fake()->dateTimeBetween('-1 year', 'now'),
      'password' => Hash::make('artevelde'),
      'remember_token' => Str::random(10),
    ]);

    User::factory()->create([
      'firstname' => 'Piet',
      'lastname' => 'Pieters',
      'email' => 'piet@example.com',
      'role' => 'user',
      'email_verified_at' => fake()->dateTimeBetween('-1 year', 'now'),
      'password' => Hash::make('artevelde'),
      'remember_token' => Str::random(10),
    ]);

    User::factory()->create([
      'firstname' => 'Jan',
      'lastname' => 'Jansens',
      'email' => 'editor@example.com',
      'role' => 'editor',
      'email_verified_at' => fake()->dateTimeBetween('-1 year', 'now'),
      'password' => Hash::make('artevelde'),
      'remember_token' => Str::random(10),
    ]);

    // Create random users
    User::factory(40)->create();

    // Create page blocks
    PageBlock::create([
      'page' => 'homepage',
      'title' => 'Wie zijn we?',
      'slug' => 'wie-zijn-we',
      'content' => PageBlockFactory::blockWieZijnWe(),
    ]);

    PageBlock::create([
      'page' => 'homepage',
      'title' => 'Ontstaan',
      'slug' => 'ontstaan',
      'content' => PageBlockFactory::blockOntstaan(),
    ]);

    PageBlock::create([
      'page' => 'homepage',
      'title' => 'Werking',
      'slug' => 'werking',
      'content' => PageBlockFactory::blockWerking(),
    ]);

    PageBlock::create([
      'page' => 'homepage',
      'title' => 'Doelstellingen',
      'slug' => 'doelstellingen',
      'content' => PageBlockFactory::blockDoelstellingen(),
    ]);
  }
}
