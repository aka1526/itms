<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixassetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixasset', function (Blueprint $table) {
            $table->string('fa_uuid')->primary();
            $table->string('fa_name',50)->nullable()->index();
            $table->string('fa_sec',200)->nullable()->default('');
            $table->string('fa_type',50)->nullable()->default('PC');
            $table->string('fa_user',200)->nullable()->default('');
            $table->string('fa_tel',50)->nullable()->default('-');
            $table->string('fa_email',50)->nullable()->default('-');
            $table->string('fa_status',50)->nullable()->default('Y');

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
        Schema::dropIfExists('fixasset');
    }
}
