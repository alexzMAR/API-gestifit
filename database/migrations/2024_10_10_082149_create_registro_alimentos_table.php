<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registro_alimentos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('Fecha');
            $table->integer('Cantidad');
            $table->string('usuario_id'); // Cambiado a string para usar firebase_uid
            $table->foreign('usuario_id')->references('firebase_uid')->on('usuario')->onDelete('cascade'); // Relación con firebase_uid
            $table->unsignedBigInteger('alimentos_id');
            $table->foreign('alimentos_id')->references('id')->on('alimentos')->onDelete('cascade');
            $table->unsignedBigInteger('escaneo_id');
            $table->foreign('escaneo_id')->references('id')->on('escaneo')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registro_alimentos');
    }
};
