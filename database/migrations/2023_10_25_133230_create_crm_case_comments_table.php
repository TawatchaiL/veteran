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
        Schema::create('crm_case_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('case_id')->nullable();
            $table->string('comment')->nullable();
            $table->string('agent', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_case_comments');
    }
};
