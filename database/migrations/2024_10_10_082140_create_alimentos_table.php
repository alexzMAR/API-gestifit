<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void
    {
        Schema::create('alimentos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre', 255);
            $table->integer('Calorias');
            $table->decimal('Proteinas', 5, 2);
            $table->decimal('Grasas', 5, 2);
            $table->decimal('Carbohidratos', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alimentos');
    }
};
