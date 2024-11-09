<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recuperacion_contrasena', function (Blueprint $table) {
            $table->id();
            $table->string('Correo')->unique();
            $table->string('Token', 255);
            $table->dateTime('FechaExpiración');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recuperacion_contrasena');
    }
};