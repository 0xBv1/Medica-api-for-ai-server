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
        Schema::create('lung_predictions', function (Blueprint $table) {
            $table->id();

            $table->enum('gender', ['Male', 'Female']);
            $table->integer('age');
            $table->boolean('smoking');
            $table->boolean('yellow_fingers');
            $table->boolean('anxiety');
            $table->boolean('peer_pressure');
            $table->boolean('chronic_disease');
            $table->boolean('fatigue');
            $table->boolean('allergy');
            $table->boolean('wheezing');
            $table->boolean('alcohol_consumption');
            $table->boolean('coughing');
            $table->boolean('shortness_of_breath');
            $table->boolean('swallowing_difficulty');
            $table->boolean('chest_pain');
            $table->foreign('id')->references('id')->on('predictions')->onDelete('cascade');
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lung_predictions');
    }
};
