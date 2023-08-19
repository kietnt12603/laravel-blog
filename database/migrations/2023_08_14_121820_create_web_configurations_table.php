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
        Schema::create('web_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable()->default('Logo1.png');
            $table->string('name')->nullable()->default('Tin Tức 24H');
            $table->string('about')->nullable()->default('Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.');
            $table->string('instagram')->nullable()->default('https://www.instagram.com/');
            $table->string('tiwtter')->nullable()->default('https://twitter.com/');
            $table->string('facebook')->nullable()->default('https://facebook.com/');
            $table->string('linkedin')->nullable()->default('https://www.linkedin.com/');
            $table->string('pinterest')->nullable()->default('https://www.pinterest.com/');
            $table->string('dribbble')->nullable()->default('https://www.dribbble.com/');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_configurations');
    }
};
