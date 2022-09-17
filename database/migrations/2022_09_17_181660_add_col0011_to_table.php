<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addcol0011ToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reqerp', function (Blueprint $table) {
              $table->date('start_date')->nullable();
              $table->date('end_date')->nullable();
              $table->float('jobpercen')->nullable()->default('0');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reqerp', function (Blueprint $table) {
            //
        });
    }
}
