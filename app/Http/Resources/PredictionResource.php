<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PredictionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prediction' => $this->prediction,
            'confidence' => $this->confidence,
            'advise' => $this->advise,
            'ai_model' => new AiModelResource($this->aiModel),
            'lung' => new LungPredictionResource($this->whenLoaded('lungPrediction')),
            'breast' => new BreastPredictionResource($this->whenLoaded('breastPrediction')),
            'prostate' => new ProstatePredictionResource($this->whenLoaded('prostatePrediction')),
            'thyroid' => new ThyroidPredictionResource($this->whenLoaded('thyroidPrediction')),
        ];
    }
}