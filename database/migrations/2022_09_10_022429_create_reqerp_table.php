<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqerpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reqerp', function (Blueprint $table) {
            $table->string('req_unid',50)->index();
            $table->string('req_no',50)->primary();
            $table->date('req_date')->nullable();
            $table->string('req_fa')->nullable()->default('');
            $table->string('req_name')->nullable()->default('');
            $table->longText('req_desc')->nullable()->default('');

            $table->string('req_vote1_name',200)->nullable()->default('');
            $table->string('req_vote2_name',200)->nullable()->default('');
            $table->string('req_vote3_name',200)->nullable()->default('');
            $table->string('req_vote4_name',200)->nullable()->default('');

            $table->string('req_vote1_stat',50)->nullable()->default('');
            $table->string('req_vote2_stat',50)->nullable()->default('');
            $table->string('req_vote3_stat',50)->nullable()->default('');
            $table->string('req_vote4_stat',50)->nullable()->default('');

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
        Schema::dropIfExists('reqerp');
    }
}
