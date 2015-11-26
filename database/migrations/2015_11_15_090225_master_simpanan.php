<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MasterSimpanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('master_simpanan', function ($table) {
        $table->string('id_jns_simpanan', 11);
        $table->string('jns_simpanan');
        $table->float('bunga_simpanan');
        $table->dateTime('created_at');
        $table->unique('jns_simpanan');
        $table->primary('id_jns_simpanan');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('master_simpanan');
    }
}
