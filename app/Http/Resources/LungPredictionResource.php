<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LungPredictionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'gender'              => $this->gender,
            'age'                 => $this->age,
            'smoking'             => $this->smoking,
            'yellow_fingers'      => $this->yellow_fingers,
            'anxiety'             => $this->anxiety,
            'chronic_disease'     => $this->chronic_disease,
            'fatigue'             => $this->fatigue,
            'allergy'             => $this->allergy,
            'wheezing'            => $this->wheezing,
            'alcohol_consumption' => $this->alcohol_consumption,
            'coughing'            => $this->coughing,
            'shortness_of_breath' => $this->shortness_of_breath,
            'swallowing_difficulty' => $this->swallowing_difficulty,
            'chest_pain'          => $this->chest_pain,
        ];
    }
}
