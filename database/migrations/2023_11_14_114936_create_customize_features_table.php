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
        Schema::connection('remote_connection')->create('customize_features', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('config')->nullable();
            $table->string('value')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('remote_connection')->dropIfExists('customize_features');
    }
};
