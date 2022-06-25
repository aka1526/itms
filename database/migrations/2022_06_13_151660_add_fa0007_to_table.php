<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addfa0007ToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fixasset', function (Blueprint $table) {
              $table->date('pm_last_date')->nullable();
              $table->date('pm_next_date')->nullable();
              $table->integer('pm_interval')->length(5)->unsigned();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fixasset', function (Blueprint $table) {
            //
        });
    }
}
