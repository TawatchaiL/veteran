<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crm_phone_emergency_logs', function (Blueprint $table) {
            $table->id("lid");
            $table->integer('id')->nullable();
            $table->integer('contact_id')->nullable();
            $table->string('emergencyname')->nullable();
            $table->string('emerrelation')->nullable();
            $table->string('emerphone')->nullable();
            $table->integer('agent')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->string('modifyaction',10)->nullable();
            $table->string('modifyagent',10)->nullable();
            $table->timestamp('modifydate')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_phone_emergency_logs');
    }
};
