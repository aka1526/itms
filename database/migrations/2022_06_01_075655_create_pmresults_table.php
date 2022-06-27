<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmresults', function (Blueprint $table) {
            $table->string('ac_uuid',50)->primary();
            $table->integer('ac_year')->length(5)->unsigned();
            $table->integer('ac_month')->length(2)->unsigned();
            $table->date('ac_date')->nullable();
            $table->string('plan_uuid',50)->nullable()->default('');
            $table->string('fa_uuid',50)->nullable()->default('');
            $table->string('fa_name',200)->nullable()->default('');

            $table->integer('ac_item')->length(2)->unsigned();
            $table->string('ac_desc',200)->nullable()->default('');
            $table->string('ac_method',200)->nullable()->default('');
            $table->string('ac_std',200)->nullable()->default('');
            $table->string('ac_result',50)->nullable()->default('');

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
        Schema::dropIfExists('pmresults');
    }
}
