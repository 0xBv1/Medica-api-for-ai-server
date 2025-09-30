<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreastPrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'mean_radius',
        'mean_texture',
        'mean_perimeter',
        'mean_area',
        'mean_smoothness',
        'mean_compactness',
        'mean_concavity',
        'mean_concave_points',
        'mean_symmetry',
        'mean_fractal_dimension',
        'radius_error',
        'texture_error',
        'perimeter_error',
        'area_error',
        'smoothness_error',
        'compactness_error',
        'concavity_error',
        'concave_points_error',
        'symmetry_error',
        'fractal_dimension_error',
        'worst_radius',
        'worst_texture',
        'worst_perimeter',
        'worst_area',
        'worst_smoothness',
        'worst_compactness',
        'worst_concavity',
        'worst_concave_points',
        'worst_symmetry',
        'worst_fractal_dimension',
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
