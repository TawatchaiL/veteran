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
        Schema::create('voice_backups', function (Blueprint $table) {
            $table->id();
            $table->string('export_name')->nullable();
            $table->datetime('export_start')->nullable();
            $table->string('export_src')->nullable();
            $table->string('export_dst')->nullable();
            $table->integer('export_type')->nullable();
            $table->integer('export_status')->nullable();
            $table->integer('export_progress')->nullable();
            $table->string('export_filename')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voice_backups');
    }
};
