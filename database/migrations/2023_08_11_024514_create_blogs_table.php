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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->unique();
            $table->string('slug')->nullable()->unique();
            $table->string('images')->nullable()->default('avatar.jpg');
            $table->text('short_content')->nullable();
            $table->text('content')->nullable();
            $table->boolean('prominent')->nullable()->default(0);
            $table->integer('view')->nullable()->default('0');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('author')->nullable();
            $table->foreign('author')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
