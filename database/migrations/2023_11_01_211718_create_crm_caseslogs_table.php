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
        Schema::create('crm_caseslogs', function (Blueprint $table) {
            $table->id("lid");
            $table->integer('id')->nullable();
            $table->integer('contact_id')->nullable();
            $table->date('adddate')->nullable();
            $table->string('uniqid')->nullable();
            $table->string('telno')->nullable();
            $table->string('casetype1')->nullable();
            $table->integer('caseid1')->default(0);
            $table->string('casetype2')->nullable();
            $table->integer('caseid2')->default(0);
            $table->string('casetype3')->nullable();
            $table->integer('caseid3')->default(0);
            $table->string('casetype4')->nullable();
            $table->integer('caseid4')->default(0);
            $table->string('casetype5')->nullable();
            $table->integer('caseid5')->default(0);
            $table->string('casetype6')->nullable();
            $table->integer('caseid6')->default(0);
            $table->string('tranferstatus')->nullable();
            $table->string('casedetail')->nullable();
            $table->string('casestatus')->nullable();
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
        Schema::dropIfExists('crm_caseslogs');
    }
};
