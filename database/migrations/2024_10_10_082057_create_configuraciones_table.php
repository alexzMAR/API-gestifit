<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->id();
            $table->string('Clave', 50);
            $table->string('Descripción', 255);
            $table->string('DescripciónCorta', 255);
            $table->string('Field_Modificación', 255);
            $table->string('Campo', 50);
            $table->unsignedBigInteger('notificaciones_id')->nullable();
            $table->foreign('notificaciones_id')->references('id')->on('notificaciones')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuraciones');
    }
};
