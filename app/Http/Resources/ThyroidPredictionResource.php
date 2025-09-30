<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThyroidPredictionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'age'                    => $this->age,
            'gender'                 => $this->gender,
            'smoking'                => $this->smoking,
            'history_of_radiation'   => $this->history_of_radiation,
            'thyroid_function'       => $this->thyroid_function,
            'physical_examination'   => $this->physical_examination,
            'adenopathy'             => $this->adenopathy,
            'pathology'              => $this->pathology,
            'focality'               => $this->focality,
            'nodule_size'            => $this->nodule_size,
            'tumor_size_classification' => $this->tumor_size_classification,
            'lymph_node_involvement' => $this->lymph_node_involvement,
            'metastasis'             => $this->metastasis,
            'stage'                  => $this->stage,
            'response'               => $this->response,
        ];
    }
}
