<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Campo para asociar al usuario
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('imagen');
            $table->string('notas')->nullable();
            $table->foreignId('categoria_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('marca_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('talla_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('color_id')->nullable()->constrained()->onDelete('set null');
            $table->json('estacion')->nullable(); 
            $table->string('ocasion')->nullable();
            $table->string('mood')->nullable();
            $table->decimal('precio', 10, 2)->nullable()->default(0); // Hasta 10 dígitos en total, con 2 decimales
            $table->string('moneda', 3)->default('MXN'); 
            $table->date('fecha_adquisicion')->nullable();
            $table->string('estado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prendas');
    }
};
