<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->string('repair_uuid',50)->index();
            $table->string('repair_docno',50)->primary();
            $table->date('repair_date')->nullable();
            $table->integer('repair_year')->length(5)->unsigned();
            $table->integer('repair_month')->length(2)->unsigned();
            $table->integer('repair_max')->length(5)->unsigned();
            $table->string('fa_uuid',50)->nullable()->index();
            $table->string('fa_name',50)->nullable()->index();
            $table->string('repair_user',200)->nullable()->default('-');
            $table->string('repair_type',50)->nullable()->index();
            $table->string('repair_problem',200)->nullable()->default('');
            $table->string('problem_img',50)->nullable()->default('');
            $table->string('repair_cause',300)->nullable()->default('');
            $table->string('repair_solution',200)->nullable()->default('');
            $table->string('repair_checkby',50)->nullable()->default('');
            $table->integer('repair_costs')->length(10)->unsigned();
            $table->string('repair_status',50)->nullable()->default('NEW');
            $table->integer('repair_priority')->length(5)->unsigned();
            $table->date('date_close')->nullable();

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
        Schema::dropIfExists('repairs');
    }
}
