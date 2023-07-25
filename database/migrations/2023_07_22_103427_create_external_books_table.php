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
        Schema::create('external_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('priorities_id');
            $table->string('doc_receive_number')->nullable();
            $table->string('doc_number')->nullable();
            $table->string('signdate')->nullable();
            $table->string('doc_to')->nullable();
            $table->unsignedBigInteger('doc_from')->nullable();
            $table->string('subject')->nullable();
            $table->unsignedBigInteger('doc_receive')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_books');
    }
};
