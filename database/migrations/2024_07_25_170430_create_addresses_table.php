<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            //creo una clave foranea que se llama user_id que se relaciona con la tabla users y se elimina en cascada
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // el registro type, determina si es un domicilio o una officina
            $table->string('type');
            // el registro description, contiene la direccion como tal, ejemplo: Avenida siempre viva 742
            $table->string('description');
            // el registro destrict, hace referencia a una proviencia.
            $table->string('district');
            // el registro reference, tiene mas detalles de la direccion, ejemplo: al lado de la casa de don ramon
            $table->string('reference');
            //el registro receiver, indica si el que recibe la compra es el mismo que realizo la compra o es otra persona
            // misma persona  => receiver = 0.
            // otra persona => receiver = 1.
            $table->integer('receiver');
            //receiver_info tipo json que contiene la informacion de la persona que recibe la compra
            $table->json('receiver_info');
            //default es tipo boolean, y determina cual es la dirrecion por defecto  para enviar el producto, solo una dirrecion
            $table->boolean('default')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
