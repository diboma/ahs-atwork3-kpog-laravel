<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('announcement_reads', function (Blueprint $table) {
      $table->id();
      $table->foreignId('announcement_id')->constrained();
      $table->foreignId('user_id')->constrained();
      $table->boolean('read')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('announcement_reads');
  }
};
