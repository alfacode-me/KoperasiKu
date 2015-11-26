<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Anggota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('anggota', function ($table) {
        $table->string('id_anggota', 11);
        $table->string('nama');
        $table->date('tgl_gabung');
        $table->string('telp');
        $table->string('jenis_kelamin', 15);
        $table->string('kota');
        $table->date('tgl_lahir');
        $table->string('pekerjaan');
        $table->string('alamat');
        $table->dateTime('created_at');
        $table->primary('id_anggota');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('anggota');
    }
}
