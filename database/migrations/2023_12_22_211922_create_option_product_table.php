<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('option_product', function (Blueprint $table) {
            $table->id();

            $table->foreignId('option_id')->constrained();
            //  options (1) ---> option_product (m)
            $table->foreignId('product_id')->constrained();
            // products (1) --> option_product (m)
            $table->json('features');
            //features contiene todos los valores selecionados de un producto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_product');
    }
};
