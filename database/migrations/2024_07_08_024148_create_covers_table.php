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
        Schema::create('covers', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('title');

            $table->datetime('start_at');
            //start_at es la fecha de  cuando se va a publicar en la portada
            $table->datetime('end_at')->nullable();
            //end_at es la fecha de  cuando se va a dejar de publicar en la portada
            $table->boolean('is_active')->default(true);
            //is_active es para saber si la imagen esta activa (visible) o no (no visible)
            $table->integer('order')->default(0);
            //para manejar el orden de las imagenes de una publicacion
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('covers');
    }
};
