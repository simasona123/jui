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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('dokter_id');
            $table->string('nomor_rekam_medis')->unique();
            $table->string('keluhan');
            $table->string('diagnosis');
            $table->string('prognosa');
            $table->string('tindakan');
            $table->decimal('suhu');
            $table->decimal('berat');
            $table->datetime('tgl_pemeriksaan');
            $table->string('keterangan');
            $table->timestamps();
            $table->foreign('booking_id')->references('id')->on('booking');
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
        Schema::drop('rekam_medis');
    }
};
