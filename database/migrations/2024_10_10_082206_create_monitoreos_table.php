<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monitoreos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('FechaMonitoreo');
            $table->string('usuario_id'); // Cambiado a string para usar firebase_uid
            $table->foreign('usuario_id')->references('firebase_uid')->on('usuario')->onDelete('cascade'); // Relación con firebase_uid
            $table->unsignedBigInteger('historial_imc_id')->nullable();
            $table->foreign('historial_imc_id')->references('id')->on('historial_imc')->onDelete('set null');
            $table->unsignedBigInteger('historial_ritmo_cardiaco_id')->nullable();
            $table->foreign('historial_ritmo_cardiaco_id')->references('id')->on('historial_ritmo_cardiaco')->onDelete('set null');
            $table->unsignedBigInteger('progreso_id')->nullable();
            $table->foreign('progreso_id')->references('id')->on('progreso')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monitoreos');
    }
};
