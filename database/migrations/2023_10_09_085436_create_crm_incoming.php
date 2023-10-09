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
        Schema::create('crm_incoming', function (Blueprint $table) {
            $table->id();
            $table->string('uniqid', 255)->nullable();
            $table->string('telno', 15)->nullable();
            $table->string('agentno', 10)->nullable();
            $table->dateTime('calltime');
            $table->string('status', 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_incoming');
    }
};
