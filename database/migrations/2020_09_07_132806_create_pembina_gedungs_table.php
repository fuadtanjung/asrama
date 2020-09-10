<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembinaGedungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembina_gedungs', function (Blueprint $table) {
            $table->unsignedBigInteger('pembina_id');
            $table->unsignedBigInteger('gedung_id');
            $table->string('tahun')->references('tahun')->on('pembina_tahuns');

            $table->foreign('pembina_id')->references('pembina_id')->on('pembina_tahuns')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gedung_id')->references('id')->on('gedungs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembina_gedungs');
    }
}
