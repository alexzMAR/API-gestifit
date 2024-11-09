<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('Ingredientes');
            $table->string('Instrucciones');
            $table->integer('Tiempo_Preparación'); // en minutos
            $table->integer('Tiempo_Cocción'); // en minutos
            $table->string('Dificultad', 50);
            $table->integer('Porciones');
            $table->dateTime('Fecha_Creación');
            $table->string('Categoría', 50);
            $table->integer('Calorías');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};
