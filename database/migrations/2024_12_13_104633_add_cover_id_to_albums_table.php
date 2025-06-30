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
    Schema::table('albums', function (Blueprint $table) {
      $table->foreignId('cover_id')
        ->nullable()
        ->constrained('photos')
        ->onDelete('set null');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('albums', function (Blueprint $table) {
      $table->dropForeign(['cover_id']);
      $table->dropColumn('cover_id');
    });
  }
};
