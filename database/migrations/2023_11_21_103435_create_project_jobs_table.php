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
        Schema::connection('remote_connection')->create('project_jobs', function (Blueprint $table) {
            $table->id('job_id');
            $table->string('job_code_id', 100)->nullable();
            $table->dateTime('job_create_date')->nullable();
            $table->string('job_file', 100)->nullable();
            $table->integer('job_admin')->nullable();
            $table->integer('job_agent')->nullable();
            $table->integer('job_status')->nullable();
            $table->integer('job_process')->nullable();
            $table->integer('job_auto')->nullable();
            $table->timestamps();

            //$table->primary('job_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('remote_connection')->dropIfExists('project_jobs');
    }
};
