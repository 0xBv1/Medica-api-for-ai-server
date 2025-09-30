<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProstatePrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'radius',
        'area',
        'smoothness',
        'compactness',
        'symmetry',
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
