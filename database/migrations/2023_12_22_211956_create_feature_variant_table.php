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
        Schema::create('feature_variant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('features_id')->constrained()->onDelete('cascade');
            // feauture (1) --> feature_variant ( m)
            $table->foreignId('variants_id')->constrained()->onDelete('cascade');
            // variants (1) --> feature_variant (m)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_variant');
    }
};
