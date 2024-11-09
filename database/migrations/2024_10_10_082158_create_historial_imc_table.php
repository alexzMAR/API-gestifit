<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_imc', function (Blueprint $table) {
            $table->id();
            $table->decimal('IMC', 5, 2);
            $table->dateTime('FechaRegistro');
            $table->string('firebase_uid'); // Agregar la columna para el UID de Firebase
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_imc');
    }
};
