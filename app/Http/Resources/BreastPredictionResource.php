<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BreastPredictionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                          => $this->id,
            'mean_radius'                 => $this->mean_radius,
            'mean_texture'                => $this->mean_texture,
            'mean_perimeter'              => $this->mean_perimeter,
            'mean_area'                   => $this->mean_area,
            'mean_smoothness'             => $this->mean_smoothness,
            'mean_compactness'            => $this->mean_compactness,
            'mean_concavity'              => $this->mean_concavity,
            'mean_concave_points'         => $this->mean_concave_points,
            'mean_symmetry'               => $this->mean_symmetry,
            'mean_fractal_dimension'      => $this->mean_fractal_dimension,
            'radius_error'                => $this->radius_error,
            'texture_error'               => $this->texture_error,
            'perimeter_error'             => $this->perimeter_error,
            'area_error'                  => $this->area_error,
            'smoothness_error'            => $this->smoothness_error,
            'compactness_error'           => $this->compactness_error,
            'concavity_error'             => $this->concavity_error,
            'concave_points_error'        => $this->concave_points_error,
            'symmetry_error'              => $this->symmetry_error,
            'fractal_dimension_error'     => $this->fractal_dimension_error,
            'worst_radius'                => $this->worst_radius,
            'worst_texture'               => $this->worst_texture,
            'worst_perimeter'             => $this->worst_perimeter,
            'worst_area'                  => $this->worst_area,
            'worst_smoothness'            => $this->worst_smoothness,
            'worst_compactness'           => $this->worst_compactness,
            'worst_concavity'             => $this->worst_concavity,
            'worst_concave_points'        => $this->worst_concave_points,
            'worst_symmetry'              => $this->worst_symmetry,
            'worst_fractal_dimension'     => $this->worst_fractal_dimension,
        ];
    }
}
