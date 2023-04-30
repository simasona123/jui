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
        Schema::create('booking', function (Blueprint $table) {
            $table->id('id');
            $table->string('kode_booking', 25)->unique();
            $table->unsignedBigInteger('jadwal_praktik_id');
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->boolean('completed')->default(false);
            $table->timestamps();
            $table->foreign('jadwal_praktik_id')->references('id')->on('jadwal_praktik');
            $table->foreign('pasien_id')->references('id')->on('pasien');
            $table->foreign('status_id')->references('id')->on('booking_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('booking');
    }
};
