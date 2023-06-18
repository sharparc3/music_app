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
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title')->default('Untitled');
            $table->string('file_path')->default('');
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->unsignedBigInteger('album_id')->nullable();
            $table->unsignedBigInteger('genre_id')->nullable();
            // $table->integer('duration');
            $table->date('release_date')->nullable();
            $table->integer('play_count')->default(0);
            $table->string('cover_image_path')->nullable();
            $table->timestamps();

            // Define foreign key constraints
            // $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade');
            // $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            // $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music');
    }
};
