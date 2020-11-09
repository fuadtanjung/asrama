<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postingans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembina_id');
            $table->string('judul');
            $table->text('keterangan');
            $table->date('waktu_post');

            $table->foreign('pembina_id')->references('user_id')->on('pembinas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postingans');
    }
}
