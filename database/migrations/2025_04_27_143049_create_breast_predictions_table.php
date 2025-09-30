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
        Schema::create('breast_predictions', function (Blueprint $table) {
            $table->id();
            $table->decimal('mean_radius', 10, 4);
            $table->decimal('mean_texture', 10, 4);
            $table->decimal('mean_perimeter', 10, 4);
            $table->decimal('mean_area', 10, 4);
            $table->decimal('mean_smoothness', 10, 4);
            $table->decimal('mean_compactness', 10, 4);
            $table->decimal('mean_concavity', 10, 4);
            $table->decimal('mean_concave_points', 10, 4);
            $table->decimal('mean_symmetry', 10, 4);
            $table->decimal('mean_fractal_dimension', 10, 4);
            $table->decimal('radius_error', 10, 4);
            $table->decimal('texture_error', 10, 4);
            $table->decimal('perimeter_error', 10, 4);
            $table->decimal('area_error', 10, 4);
            $table->decimal('smoothness_error', 10, 4);
            $table->decimal('compactness_error', 10, 4);
            $table->decimal('concavity_error', 10, 4);
            $table->decimal('concave_points_error', 10, 4);
            $table->decimal('symmetry_error', 10, 4);
            $table->decimal('fractal_dimension_error', 10, 4);
            $table->decimal('worst_radius', 10, 4);
            $table->decimal('worst_texture', 10, 4);
            $table->decimal('worst_perimeter', 10, 4);
            $table->decimal('worst_area', 10, 4);
            $table->decimal('worst_smoothness', 10, 4);
            $table->decimal('worst_compactness', 10, 4);
            $table->decimal('worst_concavity', 10, 4);
            $table->decimal('worst_concave_points', 10, 4);
            $table->decimal('worst_symmetry', 10, 4);
            $table->decimal('worst_fractal_dimension', 10, 4);
            $table->foreign('id')->references('id')->on('predictions')->onDelete('cascade');
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breast_predictions');
    }
};
