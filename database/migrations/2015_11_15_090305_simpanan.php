<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Simpanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('simpanan', function ($table) {
        $table->string('id_simpanan', 11);
        $table->string('id_anggota', 11);
        $table->string('id_admin', 11);
        $table->string('id_jns_simpanan', 11);
        $table->date('tgl_simpanan');
        $table->float('simpanan');
        $table->float('bunga');
        $table->float('jml_simpanan');
        $table->dateTime('created_at');
        $table->primary('id_simpanan');
        $table->foreign('id_anggota')
              ->references('id_anggota')->on('anggota')
              ->onDelete('cascade');
        $table->foreign('id_admin')
              ->references('id_admin')->on('admin')
              ->onDelete('cascade');
        $table->foreign('id_jns_simpanan')
              ->references('id_jns_simpanan')->on('master_simpanan')
              ->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('simpanan');
    }
}
