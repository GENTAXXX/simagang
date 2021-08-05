<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimbingan', function (Blueprint $table) {
            $table->id('id');
            $table->string('catatan')->nullable();
            $table->date('tgl_bimbingan')->nullable();
            $table->string('file')->nullable();
            $table->string('feedback')->nullable();
            $table->unsignedBigInteger('magang_id')->nullable();
            $table->timestamps();
        });

        Schema::table('bimbingan', function ($table) {
            $table->foreign('magang_id')->references('id')->on('magang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bimbingan');
    }
}
