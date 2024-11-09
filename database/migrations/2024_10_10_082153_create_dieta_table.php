<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dieta', function (Blueprint $table) {
            $table->id();
            $table->string('usuario_id'); // Si se usa firebase_uid, asegúrate de que sea el tipo correcto
            $table->foreign('usuario_id')->references('firebase_uid')->on('usuario')->onDelete('cascade'); // Relación con firebase_uid
            $table->dateTime('FechaConsumo'); // Cambiado a DATETIME
            $table->decimal('Proteinas', 5, 2); // Proteínas
            $table->decimal('Calorias', 5, 2); // Calorías
            $table->decimal('Grasas', 5, 2); // Grasas
            $table->unsignedBigInteger('recetas_personalizadas_id'); // Clave foránea para recetas personalizadas
            $table->foreign('recetas_personalizadas_id')->references('id')->on('recetas_personalizadas')->onDelete('cascade'); // Relación con recetas personalizadas
            $table->unsignedBigInteger('registro_alimentos_id'); // Corregido el nombre de la columna
            $table->foreign('registro_alimentos_id')->references('id')->on('registro_alimentos')->onDelete('cascade'); // Relación con registros de alimentos
            $table->boolean('Completado'); // Estado de completado
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dieta');
    }
};

