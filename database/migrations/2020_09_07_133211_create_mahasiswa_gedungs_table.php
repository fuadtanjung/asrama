<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaGedungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_gedungs', function (Blueprint $table) {
            $table->unsignedBigInteger('ruangan_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->date('mulai');
            $table->date('akhir');
            $table->string('surat_perjanjian')->nullable();

            $table->primary(['ruangan_id','mahasiswa_id']);

            $table->foreign('ruangan_id')->references('id')->on('ruangans')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('mahasiswa_gedungs');
    }
}
