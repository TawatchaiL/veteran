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
            $table->string('context', 255)->nullable();
            $table->string('telno', 15)->nullable();
            $table->integer('agent_id')->nullable();
            $table->string('agentno', 10)->nullable();
            $table->dateTime('calltime')->nullable();
            $table->integer('status')->nullable();
            $table->dateTime('start_hold')->nullable();
            $table->integer('holdtime')->nullable();
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
