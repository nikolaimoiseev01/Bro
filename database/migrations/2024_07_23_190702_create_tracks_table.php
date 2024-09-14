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
        Schema::disableForeignKeyConstraints();

        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('artist_name')->nullable();
            $table->string('title');
            $table->foreignId('track_type_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('beat_id')->nullable();
            $table->foreignId('genre_id')->nullable();
            $table->string('track_copyright_variant_id')->nullable();
            $table->string('language')->nullable();
            $table->json('feats')->nullable();
            $table->string('isrc')->nullable();
            $table->string('composer')->nullable();
            $table->string('text')->nullable();
            $table->boolean('flg_adult')->nullable();
            $table->string('text_author')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
