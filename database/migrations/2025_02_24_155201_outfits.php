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
        
        Schema::create('outfits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->timestamps();

            // fk con users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // tabla pivote (relación muchos a muchos)
        Schema::create('outfit_prendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('outfit_id');
            $table->unsignedBigInteger('prenda_id');
            $table->timestamps();

            // f keys
            $table->foreign('outfit_id')->references('id')->on('outfits')->onDelete('cascade');
            $table->foreign('prenda_id')->references('id')->on('prendas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outfit_prendas');
        Schema::dropIfExists('outfits');
    }
};
