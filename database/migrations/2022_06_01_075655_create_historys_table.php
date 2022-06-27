<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historys', function (Blueprint $table) {
            $table->string('uuid',50)->primary();
            $table->string('ref_docno',50)->nullable()->index();
            $table->string('ref_uuid',50)->nullable()->index();
            $table->date('ref_date')->nullable();
            $table->integer('repair_year')->length(5)->unsigned();
            $table->integer('repair_month')->length(2)->unsigned();
            $table->string('fa_uuid',50)->nullable()->index();
            $table->string('fa_name',200)->nullable()->index();
            $table->string('fa_user',200)->nullable()->default('-');
            $table->string('checkby',200)->nullable()->default('');
            $table->string('data_type',50)->nullable()->index();
            $table->string('data_problem',200)->nullable()->default('');
            $table->string('data_cause',300)->nullable()->default('');
            $table->string('data_solution',200)->nullable()->default('');
            $table->integer('data_costs')->length(10)->unsigned();

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
        Schema::dropIfExists('historys');
    }
}
