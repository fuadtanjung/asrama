<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('status_rumah_id');
            $table->unsignedBigInteger('jalur_masuk_id');
            $table->unsignedBigInteger('goldar_id');
            $table->string('nim',12);
            $table->string('nama');
            $table->string('no_hp',13);
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir',30);
            $table->string('alamat',50);
            $table->string('bidik_misi');
            $table->string('asal_sekolah',50);
            $table->string('agama',25);
            $table->string('shalat_wajib',25);
            $table->string('hafalan',25);
            $table->string('nama_ayah',25);
            $table->string('nama_ibu',25);
            $table->string('pekerjaan_ayah',25);
            $table->string('pekerjaan_ibu',25);
            $table->string('pendapatan_ayah',25);
            $table->string('pendapatan_ibu',25);
            $table->string('no_hp_ortu',25);
            $table->string('anak_ke',25);
            $table->string('total_saudara',25);
            $table->string('status',25);
            $table->timestamps();


            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_rumah_id')->references('id')->on('status_rumahs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('goldar_id')->references('id')->on('goldars')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jalur_masuk_id')->references('id')->on('jalur_masuks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
}
