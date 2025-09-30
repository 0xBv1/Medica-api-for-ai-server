<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ctprediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age',
        'gender',
        'cancer_type',
        'stage',
        'gene_mutation',
        'expected_response',
        'response_prob',
        'risk',
        'side_effects',
        'survival_months',
        'treatment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
