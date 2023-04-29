<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject', 144);
            $table->unsignedBigInteger('creator_id');
            $table->string('image');
            $table->unsignedBigInteger('parent_message_id')->nullable();
            $table->timestamp('created_at');  
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('parent_message_id')->references('id')->on('messages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
