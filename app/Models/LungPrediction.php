<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LungPrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'gender',
        'age',
        'smoking',
        'yellow_fingers',
        'anxiety',
        'peer_pressure',
        'chronic_disease',
        'fatigue',
        'allergy',
        'wheezing',
        'alcohol_consumption',
        'coughing',
        'shortness_of_breath',
        'swallowing_difficulty',
        'chest_pain',
        'prediiction',
        'confidanse',
        'advise'
    ];

    public $timestamps = false;

    public function prediction()
    {
        return $this->belongsTo(Prediction::class, 'id');
    }
}
