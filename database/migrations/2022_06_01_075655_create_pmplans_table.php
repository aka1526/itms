<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmplans', function (Blueprint $table) {
            $table->string('pm_uuid',50)->primary();
            $table->date('pm_date')->nullable();
            $table->integer('pm_year')->length(5)->unsigned();
            $table->integer('pm_month')->length(2)->unsigned();
            $table->string('fa_uuid',50)->nullable()->default('');
            $table->date('pm_act_date')->nullable();
            $table->string('pm_status',50)->nullable()->default('');
            $table->string('create_by',200)->nullable()->default('');
            $table->string('create_time',50)->nullable()->default('');
            $table->string('modify_by',200)->nullable()->default('');
            $table->string('modify_time',50)->nullable()->default('');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pmplans');
    }
}
