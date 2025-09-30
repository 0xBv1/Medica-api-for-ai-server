<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThyroidPrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'age',
        'gender',
        'smoking',
        'history_of_smoking',
        'history_of_radiotherapy',
        'thyroid_function',
        'physical_examination',
        'adenopathy',
        'pathology',
        'focality',
        'risk',
        'tumor_size_classification',
        'lymph_node_involvement',
        'metastasis',
        'stage',
        'response',
        'prediction',
        'confidanse',
        'advise'
    ];

    public $timestamps = false;

    public function prediction()
    {
        return $this->belongsTo(Prediction::class, 'id');
    }
}
