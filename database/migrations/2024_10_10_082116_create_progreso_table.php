<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void
    {
        Schema::create('progreso', function (Blueprint $table) {
            $table->id();
            $table->dateTime('Fecha');
            $table->string('Tipo_Resultado', 50);
            $table->decimal('Valor', 10, 2);
            $table->text('Observaciones')->nullable();
            $table->unsignedBigInteger('objetivos_id');
            $table->foreign('objetivos_id')->references('id')->on('objetivos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progreso');
    }
};
