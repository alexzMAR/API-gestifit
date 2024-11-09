<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->string('firebase_uid'); // Agregar la columna para el UID de Firebase
            $table->dateTime('fecharegistro');
            $table->string('resultado');
            $table->string('consejo');
            $table->integer('horasSueno'); // Suponiendo que se almacena como un entero
            $table->integer('comidasDiarias'); // Suponiendo que se almacena como un entero
            $table->integer('ejercicio'); // Suponiendo que se almacena como un entero
            $table->integer('frecuenciaTabaco'); // Suponiendo que se almacena como un entero
            $table->integer('frecuenciaAlcohol'); // Suponiendo que se almacena como un entero
            $table->integer('nivelEstres'); // Suponiendo que se almacena como un entero
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};
