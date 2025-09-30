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
        // Drop the table if it already exists
        Schema::dropIfExists('thyroid_predictions');
        
        // Create the table again
        Schema::create('thyroid_predictions', function (Blueprint $table) {
            $table->id();
            $table->integer('age');
            $table->enum('gender', ['Male', 'Female']);
            $table->boolean('smoking');
            $table->boolean('history_of_smoking');
            $table->boolean('history_of_radiotherapy');
            $table->string('thyroid_function');
            $table->string('physical_examination');
            $table->string('adenopathy');
            $table->string('pathology');
            $table->string('focality');
            $table->string('risk');
            $table->string('tumor_size_classification');
            $table->string('lymph_node_involvement');
            $table->string('metastasis');
            $table->string('stage');
            $table->string('response');
    
            $table->foreign('id')->references('id')->on('predictions')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thyroid_predictions');
    }
};
