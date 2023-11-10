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
            $table->string('group_name');
            $table->time('group_start');
            $table->time('group_end');
            $table->integer('group_sat');
            $table->integer('group_sun');
            $table->integer('group_extension');
            $table->integer('misscall');
            $table->string('line_token');
            $table->string('email');
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
