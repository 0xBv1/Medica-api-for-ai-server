<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'model_id',
        'prediction',
        'confidence',
        'advise',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aiModel()
    {
        return $this->belongsTo(\App\Models\AiModel::class, 'model_id');
    }

    public function lungPrediction()
    {
        return $this->hasOne(LungPrediction::class, 'id');
    }

    public function breastPrediction()
    {
        return $this->hasOne(BreastPrediction::class, 'id');
    }
    public function thyroidPrediction()
    {
        return $this->hasOne(ThyroidPrediction::class, 'id');
    }
    
    public function prostatePrediction()
    {
        return $this->hasOne(ProstatePrediction::class, 'id');
    }
}
