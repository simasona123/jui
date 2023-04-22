<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_praktik', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('dokter_id');
            $table->datetime('tanggal_masuk');
            $table->datetime('tanggal_selesai');
            $table->integer('ketersediaan');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->foreign('dokter_id')->references('id')->on('dokter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jadwal_praktiks');
    }
};
