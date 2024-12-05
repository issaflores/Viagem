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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('viagem_id');
            $table->date('data_ida');
            $table->date('data_volta');
            $table->integer('adultos')->default(1);
            $table->integer('kids')->default(0);
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->unsignedBigInteger('cidade_id')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
