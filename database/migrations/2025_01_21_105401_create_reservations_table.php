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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('code_booking');
            $table->string('phone');
            $table->enum('status', ['pending', 'confirm', 'cancel'])->default('pending');
            $table->enum('type_room', ['suite', 'deluxe', 'standard']);
            $table->integer('guest_count');
            $table->datetime('check_in');
            $table->datetime('check_out')->nullable();
            $table->foreignId('room_id')->nullable()->constrained('rooms');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
