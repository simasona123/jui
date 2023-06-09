<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        DB::table('booking_status')->insert(
            ["name" => "Belum Dibayar"]
        );
        
        DB::table('booking_status')->insert(
            ["name" => "Sudah Dibayar"]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_status');
    }
};
