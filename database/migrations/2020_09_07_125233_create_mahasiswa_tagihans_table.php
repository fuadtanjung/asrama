<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_tagihans', function (Blueprint $table) {
            $table->date('bulan');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('keterangan');

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
        Schema::dropIfExists('mahasiswa_tagihans');
    }
}
