<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void
    {
        Schema::create('ejercicio', function (Blueprint $table) {
            $table->id();
            $table->string('NombreEjercicio', 255);
            $table->enum('Categoria', ['Cardio', 'Fuerza', 'Flexibilidad']);
            $table->text('Descripción')->nullable();
            $table->integer('TiempoRealizado')->nullable();
            $table->decimal('CaloriasQuemadas', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ejercicio');
    }
};
