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
        Schema::create('prostate_predictions', function (Blueprint $table) {
            $table->id();
            $table->decimal('radius', 10, 4);
            $table->decimal('area', 10, 4);
            $table->decimal('smoothness', 10, 4);
            $table->decimal('compactness', 10, 4);
            $table->decimal('symmetry', 10, 4);
            $table->foreign('id')->references('id')->on('predictions')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prostate_predictions');
    }
};
