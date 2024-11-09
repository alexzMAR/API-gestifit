<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recetas_personalizadas', function (Blueprint $table) {
            $table->id();
            $table->string('NombreReceta', 255);
            $table->unsignedBigInteger('recetas_id'); // Clave foránea para la receta
            $table->foreign('recetas_id')->references('id')->on('recetas')->onDelete('cascade'); // Relación con la tabla recetas
            $table->string('firebase_uid'); // Agregar la columna para el UID de Firebase
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recetas_personalizadas');
    }
};
