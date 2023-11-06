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
        Schema::create('callsurveys', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('max_score')->nullable();
            $table->integer('set_default')->nullable();
            $table->string('wellcome_sound')->nullable();
            $table->string('thankyou_sound')->nullable();
            $table->string('timeout_sound')->nullable();
            $table->string('invalid_sound')->nullable();
            $table->string('timeout_sound_retry')->nullable();
            $table->string('invalid_sound_retry')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('callsurveys');
    }
};
