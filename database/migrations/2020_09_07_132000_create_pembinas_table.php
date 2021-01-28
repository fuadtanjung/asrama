<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembinas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('nim');
            $table->string('nama_pembina');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir',30);
            $table->date('tanggal_lahir');
            $table->string('alamat_asal',30);
            $table->string('pekerjaan',30);
            $table->string('no_hp',30);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembinas');
    }
}
