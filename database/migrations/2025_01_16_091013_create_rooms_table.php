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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('no_room', 5)->unique();
            $table->json('facilities');
            $table->enum('type_room', ['suite', 'deluxe', 'standard']);
            $table->integer('price');
            $table->enum('status', ['tersedia', 'terisi', 'maintenance'])->default('tersedia');
            $table->string('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
