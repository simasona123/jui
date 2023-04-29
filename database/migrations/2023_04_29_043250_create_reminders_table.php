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
        Schema::drop('reminders');

        Schema::create('reminders', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('dokter_id')->nullable();
            $table->unsignedBigInteger('pasien_id')->nullable();
            $table->string('keterangan');
            $table->date('tanggal');
            $table->tinyInteger('status')->default(-1); //-1 Belum Terkirim
            $table->timestamps();
            $table->foreign('dokter_id')->references('id')->on('dokter');
            $table->foreign('pasien_id')->references('id')->on('pasien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reminders');
    }
};
