<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void
    {
        Schema::create('registro_actividad', function (Blueprint $table) {
            $table->id();
            $table->dateTime('Fecha');
            $table->decimal('CaloriasQuemadas', 8, 2);
            $table->unsignedBigInteger('ejercicio_id');
            $table->foreign('ejercicio_id')->references('id')->on('ejercicio')->onDelete('cascade');
            $table->string('usuario_id'); // Cambiado a string para usar firebase_uid
            $table->foreign('usuario_id')->references('firebase_uid')->on('usuario')->onDelete('cascade'); // Relación con firebase_uid
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registro_actividad');
    }
};
