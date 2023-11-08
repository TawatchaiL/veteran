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
        Schema::connection('remote_connection')->create('rate', function (Blueprint $table) {
            $table->id();
            $table->string('trunk')->nullable();
            $table->string('prefix')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->integer('per')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('remote_connection')->dropIfExists('rate');
    }
};
