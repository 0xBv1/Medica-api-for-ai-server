<?php

namespace App\Http\Controllers\backendcontroller;

use App\Http\Controllers\Controller;
use App\Models\Ctprediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // For HTTP client (Laravel 7+)
use Illuminate\Support\Facades\Auth; // For authentication

class CTcontroller extends Controller
{
    public function predict(Request $request)
    {
        $validated = $request->validate([
            'Age'            => 'required|integer|min:0|max:120',
            'Gender'         => 'required|in:Male,Female',
            'Cancer_Type'    => 'required|string|max:255',
            'Stage'          => 'required|in:I,II,III,IV',
            'Gene_Mutation'  => 'required|string|max:255',
        ]);
    
        try {
            $flaskResponse = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post(config('services.flask.url') . '/predict_treatment', $validated);
    
            if ($flaskResponse->successful()) {
                $data = $flaskResponse->json();
            
                if (!isset($data['data']['Best_Treatment_Details'])) {
                    return response()->json([
                        'error' => 'Missing Best_Treatment_Details in Flask response.',
                        'response' => $data
                    ], 500);
                }
            
                $prediction = Ctprediction::create([
                    'user_id'           => Auth::user()->id ?? null,
                    'age'               => $validated['Age'],
                    'gender'            => $validated['Gender'],
                    'cancer_type'       => $validated['Cancer_Type'],
                    'stage'             => $validated['Stage'],
                    'gene_mutation'     => $validated['Gene_Mutation'],
                    'expected_response' => $data['data']['Best_Treatment_Details']['Expected_Response'],
                    'response_prob'     => $data['data']['Best_Treatment_Details']['Response_Prob'],
                    'risk'              => $data['data']['Best_Treatment_Details']['Risk'],
                    'side_effects'      => $data['data']['Best_Treatment_Details']['Side_Effects'],
                    'survival_months'   => $data['data']['Best_Treatment_Details']['Survival_Months'],
                    'treatment'         => $data['data']['Best_Treatment_Details']['Treatment'],
                ]);
    
                $record = \DB::table('ctpredictions as p')
                    ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
                    ->select(
                        \DB::raw("CONCAT(u.name, ' (ID: ', u.id, ')') as patient_name"),
                        \DB::raw("DATE_FORMAT(p.created_at, '%d-%m-%Y') as date"),
                        'p.age',
                        'p.gender',
                        'p.cancer_type',
                        'p.stage',
                        'p.gene_mutation',
                        'p.expected_response',
                        'p.response_prob',
                        'p.risk',
                        'p.side_effects',
                        'p.survival_months',
                        'p.treatment'
                    )
                    ->where('p.id', $prediction->id)
                    ->first();
    
                return response()->json([
                    'status' => 'success',
                    'prediction_details' => $record
                ]);
            } else {
                return response()->json([
                    'error' => 'Flask API responded with error.',
                    'details' => $flaskResponse->body() ,
                    'validated' => $validated
                ], $flaskResponse->status());
            }
    
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to connect to Flask API.',
                'exception' => $e->getMessage(),
                  'details' => $flaskResponse ,
                'validated' => $validated
            ], 500);
        }
    }
    
    
}
