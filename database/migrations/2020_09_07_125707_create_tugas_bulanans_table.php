<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasBulanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas_bulanans', function (Blueprint $table) {
            $table->unsignedBigInteger('tugas_id');
            $table->string('bulan');
            $table->string('tahun');

            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas_bulanans');
    }
}
