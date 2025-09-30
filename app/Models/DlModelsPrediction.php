<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DlModelsPrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'model_id',
        'image_path',
        'prediction',
        'confidence',
        'advise',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function model() {
        return $this->belongsTo(Model::class);
    }
}