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
        Schema::create('crm_contact_logs', function (Blueprint $table) {
            $table->id("lid");
            $table->integer('id')->nullable();
            $table->string('hn')->nullable();
            $table->date('adddate')->nullable();
            $table->string('tname',50)->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('lname')->nullable();
            $table->string('bloodgroup',5)->nullable();
            $table->string('moo')->nullable();
            $table->string('road')->nullable();
            $table->string('soi')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phoneno')->nullable();
            $table->string('telhome')->nullable();
            $table->string('workno')->nullable();
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
        Schema::dropIfExists('crm_contact_logs');
    }
};
