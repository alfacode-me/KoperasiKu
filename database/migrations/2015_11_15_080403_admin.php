<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Admin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('admin', function ($table) {
        $table->string('id_admin', 11);
        $table->string('username', 64);
        $table->string('password');
        $table->string('nama_admin');
        $table->dateTime('created_at');
        $table->unique('username');
        $table->primary('id_admin');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin');
    }
}
