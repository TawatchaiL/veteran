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
        Schema::connection('remote_connection')->create('project_job_numbers', function (Blueprint $table) {
            $table->id('job_number_id');
            $table->string('cdr_uniqueid', 50)->nullable();
            $table->unsignedBigInteger('project_job_id')->nullable();
            $table->string('project_name', 100)->nullable();
            $table->string('callcode', 50)->nullable();
            $table->dateTime('create_date')->nullable();
            $table->string('call_number', 50)->nullable();
            $table->integer('dial_agent')->nullable();
            $table->string('dial_number', 30)->nullable();
            $table->integer('call_status')->nullable();
            $table->integer('dial_status')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('realmin')->nullable();
            $table->dateTime('call_date')->nullable();
            $table->string('sound', 100)->nullable();

            $table->primary('job_number_id');
            $table->foreign('project_job_id')->references('job_id')->on('project_jobs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('remote_connection')->dropIfExists('project_job_numbers');
    }
};
