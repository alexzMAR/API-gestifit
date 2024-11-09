<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void
    {
        Schema::create('escaneo', function (Blueprint $table) {
            $table->id();
            $table->dateTime('FechaEscaneo');
            $table->unsignedBigInteger('alimentos_id');
            $table->foreign('alimentos_id')->references('id')->on('alimentos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('escaneo');
    }
};
