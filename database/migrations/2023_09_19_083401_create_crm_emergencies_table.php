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
        Schema::create('crm_emergencies', function (Blueprint $table) {
            $table->id();
            $table->integer('contact_id')->nullable();
            $table->string('emergencyname')->nullable();
            $table->string('emerrelation')->nullable();
            $table->string('emerphone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_emergencies');
    }
};
