<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pinjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pinjaman', function ($table) {
        $table->string('id_pinjaman', 11);
        $table->string('id_anggota', 11);
        $table->string('id_admin', 11);
        $table->date('tgl_pinjaman');
        $table->float('pinjaman');
        $table->float('bunga_pinjaman');
        $table->float('jml_pinjaman');
        $table->float('sisa_jml_pinjaman');
        $table->float('jml_cicilan');
        $table->dateTime('created_at');
        $table->primary('id_pinjaman');
        $table->foreign('id_anggota')
              ->references('id_anggota')->on('anggota')
              ->onDelete('cascade');
        $table->foreign('id_admin')
              ->references('id_admin')->on('admin')
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
        Schema::drop('pinjaman');
    }
}
