<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            // Cambiamos 'id' por 'firebase_uid' como clave primaria
            $table->string('firebase_uid')->primary(); // Clave primaria
            $table->string('nombre'); // snake_case
            $table->string('apellido'); // snake_case
            $table->integer('edad'); // snake_case
            $table->decimal('altura', 5, 2)->nullable(); // snake_case
            $table->decimal('peso', 5, 2)->nullable(); // snake_case
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro']); // snake_case
            $table->string('foto_perfil', 255)->nullable(); // snake_case
            $table->enum('preferencias_accesibilidad', ['Normal', 'Daltonismo', 'Modo Oscuro']); // snake_case
            $table->timestamp('fecha_registro')->nullable(); // snake_case
            $table->timestamps(); // Mantener timestamps al final
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario'); // Cambiado a plural
    }
};
