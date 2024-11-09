<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('amigos', function (Blueprint $table) {
            $table->id();
            $table->string('usuario_id'); // Cambiado a string para usar firebase_uid
            $table->foreign('usuario_id')->references('firebase_uid')->on('usuario')->onDelete('cascade'); // Relación con firebase_uid
            $table->string('amigo_id'); // Cambiado a string para ser consistente con firebase_uid
            $table->foreign('amigo_id')->references('firebase_uid')->on('usuario')->onDelete('cascade'); // Relación con firebase_uid
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('amigos');
    }
};

