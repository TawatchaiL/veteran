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
        Schema::connection('remote_connection')->create('notify_groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name')->nullable();
            $table->time('group_start')->nullable();
            $table->time('group_end')->nullable();
            $table->string('group_start_th')->nullable();
            $table->string('group_end_th')->nullable();
            $table->integer('group_sat')->nullable();
            $table->integer('group_sun')->nullable();
            $table->integer('group_extension')->nullable();
            $table->integer('misscall')->nullable();
            $table->string('line_token')->nullable();
            $table->string('email')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('remote_connection')->dropIfExists('notify_groups');
    }
};
