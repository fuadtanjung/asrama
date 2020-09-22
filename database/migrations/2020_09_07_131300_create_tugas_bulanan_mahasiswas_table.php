<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasBulananMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas_bulanan_mahasiswas', function (Blueprint $table) {
            $table->unsignedBigInteger('tugas_bulanan_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('bulan')->references('bulan')->on('tugas_bulanans');
            $table->string('tahun')->references('tahun')->on('tugas_bulanans');
            $table->string('keterangan');

            $table->foreign('tugas_bulanan_id')->references('tugas_id')->on('tugas_bulanans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mahasiswa_id')->references('user_id')->on('mahasiswas')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas_bulanan_mahasiswas');
    }
}
