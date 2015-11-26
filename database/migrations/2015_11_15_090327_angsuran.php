<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Angsuran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('angsuran', function ($table) {
        $table->string('id_angsuran', 11);
        $table->string('id_pinjaman', 11);
        $table->string('id_anggota', 11);
        $table->string('id_admin', 11);
        $table->date('tgl_angsuran');
        $table->float('jml_angsuran');
        $table->float('sisa_pinjaman');
        $table->string('status', 25);
        $table->float('cicilan', 4);
        $table->dateTime('created_at');
        $table->primary('id_angsuran');
        $table->foreign('id_anggota')
              ->references('id_anggota')->on('anggota')
              ->onDelete('cascade');
        $table->foreign('id_admin')
              ->references('id_admin')->on('admin')
              ->onDelete('cascade');
        $table->foreign('id_pinjaman')
              ->references('id_pinjaman')->on('pinjaman')
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
        Schema::drop('angsuran');
    }
}
