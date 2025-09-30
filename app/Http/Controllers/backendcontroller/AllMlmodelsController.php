<?php

namespace App\Http\Controllers\backendcontroller;

use App\Http\Controllers\Controller;
use App\Models\AiModel;
use App\Models\LungPrediction;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AllMlmodelsController extends Controller
{

    
    public function predictLungCancer(Request $request)
    {
        $data = $request->all();


        // Validate required fields
        $requiredFields = [
            'gender',
            'age',
            'smoking',
            'yellow_fingers',
            'anxiety',
            'peer_pressur',
            'chronic_disease',
            'fatigue',
            'allergy',
            'wheezing',
            'alcohol_consumption',
            'coughing',
            'shortness_of_breath',
            'swallowing_difficulty',
            'chest_pain'
        ];

        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $data)) {
                return response()->json(['status' => 'error', 'message' => 'Missing required fields'], 400);
            }
        }
        
        // Get authenticated user ID
        $userId = Auth::id();
    
        // Find lung model
        $model = AiModel::where('name', 'Lung')->first();
        if (!$model) {
            return response()->json(['status' => 'error', 'message' => 'Model not found'], 404);
        }
    
        // Create general prediction record
        $prediction = \App\Models\Prediction::create([
            'user_id' => $userId,
            'model_id' => $model->id,
            'prediction' => null,
            'confidanse' => null,
            'advise' => null,
        ]);
    //    Create specific lung prediction record
        $gender = $data['gender'] == 1 ? 'Male' : 'Female';

        LungPrediction::create([
            'id' => $prediction->id,
            'gender' => $gender,
            'age' => $data['age'],
            'smoking' => $data['smoking'],
            'yellow_fingers' => $data['yellow_fingers'],
            'anxiety' => $data['anxiety'],
            'peer_pressure' => $data['peer_pressur'] || $data['peer_pressur'],
            'chronic_disease' => $data['chronic_disease'],
            'fatigue' => $data['fatigue'],
            'allergy' => $data['allergy'],
            'wheezing' => $data['wheezing'],
            'alcohol_consumption' => $data['alcohol_consumption'],
            'coughing' => $data['coughing'],
            'shortness_of_breath' => $data['shortness_of_breath'],
            'swallowing_difficulty' => $data['swallowing_difficulty'],
            'chest_pain' => $data['chest_pain'],
        ]);

        // Send request to Flask API
        $response = Http::post(config('services.flask.url') . '/predict_lung_cancer', $data);
    
        if ($response->successful()) {
            $apiResponse = $response->json();
    
            $prediction->update([
                'prediction' => $apiResponse['prediction'],
           
            ]);
    
            // Fetch full result for return
            $result = DB::table('predictions as p')
                ->join('users as u', 'p.user_id', '=', 'u.id')
                ->join('models as m', 'p.model_id', '=', 'm.id')
                ->join('lung_predictions as lp', 'p.id', '=', 'lp.id')
                ->select(
                    DB::raw("CONCAT(u.name, ' (ID: ', u.id, ')') as patient_name"),
                    DB::raw("DATE_FORMAT(p.created_at, '%d-%m-%Y') as date"),
                    'u.gender',
                    'u.age as patient_age',
                    DB::raw("'Lung Cancer' as diagnosis_check"),
                    'lp.*',
                    'p.advise',
                    'p.prediction as expected_level'
                )
                ->where('p.id', $prediction->id)
                ->first();
    
            return response()->json([
                'status' => 'success',
                'prediction' => $result
            ], 200);
    
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Flask API request failed',
                'details' => $response->body()
            ], 500);
        }
    }
    
    // Endpoint for thyroid cancer prediction
    public function predictThyroidCancer(Request $request)
    {
        $data = $request->all();
    
        // Check required fields
        $requiredFields = [
            'age', 'gender', 'smoking', 'history_of_smoking', 'history_of_radiotherapy',
            'thyroid_function', 'physical_examination', 'adenopathy', 'pathology',
            'focality', 'risk', 'tumor_size_classification', 'lymph_node_involvement', 'metastasis', 'stage', 'response'
        ];
    
        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $data)) {
                return response()->json(['status' => 'error', 'message' => 'Missing required field: ' . $field], 400);
            }
        }
    
        // Get authenticated user ID
        $userId = Auth::id();
    
        // Find thyroid model
        $model = AiModel::where('name', 'Thyroid')->first();
        if (!$model) {
            return response()->json(['status' => 'error', 'message' => 'Model not found'], 404);
        }
    
        // Create a general prediction record
        $prediction = \App\Models\Prediction::create([
            'user_id' => $userId,
            'model_id' => $model->id,
            'prediction' => null,
            'confidanse' => null,
            'advise' => null,
        ]);
    
        // Create specific thyroid prediction record
        $thyroidPrediction = \App\Models\ThyroidPrediction::create([
            'id' => $prediction->id,
            'age' => $data['age'],
            'gender' =>  $data['gender'] ,
            'smoking' => $data['smoking'],
            'history_of_smoking' => $data['history_of_smoking'],
            'history_of_radiotherapy' => $data['history_of_radiotherapy'],
            'thyroid_function' => $data['thyroid_function'],
            'physical_examination' => $data['physical_examination'],
            'adenopathy' => $data['adenopathy'],
            'pathology' => $data['pathology'],
            'focality' => $data['focality'],
            'risk' => $data['risk'],
            'tumor_size_classification' => $data['tumor_size_classification'],
            'lymph_node_involvement' => $data['lymph_node_involvement'],
            'metastasis' => $data['metastasis'],
            'stage' => $data['stage'],
            'response' => $data['response'],
        ]);
    
        // Send request to Flask API
        $response = Http::post(config('services.flask.url') . '/predict_thyroid_cancer', $data);
    
        if ($response->successful()) {
            $apiResponse = $response->json();
    
            $prediction->update([
                'prediction' => $apiResponse['prediction'],
                // ممكن تضيف confidanse و advise لو راجعين من الـ API
            ]);
    
            // Fetch complete data to return
            $result = DB::table('predictions as p')
                ->join('users as u', 'p.user_id', '=', 'u.id')
                ->join('models as m', 'p.model_id', '=', 'm.id')
                ->join('thyroid_predictions as tp', 'p.id', '=', 'tp.id')
                ->select(
                    DB::raw("CONCAT(u.name, ' (ID: ', u.id, ')') as patient_name"),
                    DB::raw("DATE_FORMAT(p.created_at, '%d-%m-%Y') as date"),
                    'u.gender',
                    'u.age as patient_age',
                    DB::raw("'Thyroid Cancer' as diagnosis_check"),
                    'tp.age',
                    'tp.gender',
                    'tp.smoking',
                    'tp.history_of_smoking',
                    'tp.history_of_radiotherapy',
                    'tp.thyroid_function',
                    'tp.physical_examination',
                    'tp.adenopathy',
                    'tp.pathology',
                    'tp.focality',
                    'tp.risk',
                    'tp.tumor_size_classification',
                    'tp.lymph_node_involvement',
                    'tp.metastasis',
                    'tp.stage',
                    'tp.response',
                    'p.advise',
                    'p.prediction as expected_level'
                )
                ->where('p.id', $prediction->id)
                ->first();
    
            return response()->json([
                'status' => 'success',
                'prediction' => $result
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Flask API request failed',
                'details' => $response->body()
            ], 500);
        }
    }
    

    // Endpoint for prostate cancer prediction
    public function predictProstateCancer(Request $request)
    {
        $data = $request->all();

        $requiredFeatures = ['Radius', 'Area', 'Smoothness', 'Compactness', 'Symmetry'];
        foreach ($requiredFeatures as $feature) {
            if (!array_key_exists($feature, $data)) {
                return response()->json(['status' => 'error', 'message' => 'Missing required feature: ' . $feature], 400);
            }
        }

        $userId = Auth::id();

        $model = AiModel::where('name', 'Prostate')->first();
        if (!$model) {
            return response()->json(['status' => 'error', 'message' => 'Model not found'], 404);
        }

        $prediction = \App\Models\Prediction::create([
            'user_id' => $userId,
            'model_id' => $model->id,
            'prediction' => null,
            'confidanse' => null,
            'advise' => null,
        ]);

        $prostatePrediction = \App\Models\ProstatePrediction::create([
            'id' => $prediction->id,
            'radius' => $data['Radius'],
            'area' => $data['Area'],
            'smoothness' => $data['Smoothness'],
            'compactness' => $data['Compactness'],
            'symmetry' => $data['Symmetry'],
        ]);

        $response = Http::post(config('services.flask.url') . '/predict_prostate_cancer', $data);

        if ($response->successful()) {
            $apiResponse = $response->json();

            $prediction->update([
                'prediction' => $apiResponse['prediction'],
                // 'confidanse' => $apiResponse['confidanse'],
                // 'advise' => $apiResponse['advise'],
            ]);

            $result = DB::table('predictions as p')
                ->join('users as u', 'p.user_id', '=', 'u.id')
                ->join('models as m', 'p.model_id', '=', 'm.id')
                ->join('prostate_predictions as pp', 'p.id', '=', 'pp.id')
                ->select(
                    DB::raw("CONCAT(u.name, ' (ID: ', u.id, ')') as patient_name"),
                    DB::raw("DATE_FORMAT(p.created_at, '%d-%m-%Y') as date"),
                    'u.gender',
                    'u.age as patient_age',
                    DB::raw("'Prostate Cancer' as diagnosis_check"),
                    'pp.radius' ,
                    'pp.area',
                    'pp.smoothness',
                    'pp.compactness',
                    'pp.symmetry',
                    'p.advise',
                    'p.prediction as expected_level'
                )
                ->where('p.id', $prediction->id) // ناخد نفس prediction اللي لسه مدخوله
                ->first();

            return response()->json([
                'status' => 'success',
                'prediction' => $result
            ], 200);

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Flask API request failed',
                'details' => $response->body()
            ], 500);
        }
    }



    public function predictBreastCancer(Request $request)
    {
        $data = $request->all();
    
        $requiredFeatures = [
            'Mean radius', 'Mean texture', 'Mean perimeter', 'Mean area', 'Mean smoothness',
            'Mean compactness', 'Mean concavity', 'Mean concave points', 'Mean symmetry', 'Mean fractal dimension',
            'Radius error', 'Texture error', 'Perimeter error', 'Area error', 'Smoothness error',
            'Compactness error', 'Concavity error', 'Concave points error', 'Symmetry error', 'Fractal dimension error',
            'Worst radius', 'Worst texture', 'Worst perimeter', 'Worst area', 'Worst smoothness',
            'Worst compactness', 'Worst concavity', 'Worst concave points', 'Worst symmetry', 'Worst fractal dimension'
        ];
    
        foreach ($requiredFeatures as $feature) {
            if (!array_key_exists($feature, $data)) {
                return response()->json(['status' => 'error', 'message' => 'Missing required feature: ' . $feature], 400);
            }
        }
    
        $userId = Auth::id();
    
        $model = AiModel::where('name', 'Breast')->first();
        if (!$model) {
            return response()->json(['status' => 'error', 'message' => 'Model not found'], 404);
        }
    
        // نسجل في جدول Predictions
        $prediction = \App\Models\Prediction::create([
            'user_id' => $userId,
            'model_id' => $model->id,
            'prediction' => null,
            'confidanse' => null,
            'advise' => null,
        ]);
    
        // نسجل في جدول BreastPredictions (لازم تكون عملت الموديل و المايجريشن بتاعه)
        $breastPrediction = \App\Models\BreastPrediction::create([
            'id' => $prediction->id,
            'mean_radius' => $data['Mean radius'],
            'mean_texture' => $data['Mean texture'],
            'mean_perimeter' => $data['Mean perimeter'],
            'mean_area' => $data['Mean area'],
            'mean_smoothness' => $data['Mean smoothness'],
            'mean_compactness' => $data['Mean compactness'],
            'mean_concavity' => $data['Mean concavity'],
            'mean_concave_points' => $data['Mean concave points'],
            'mean_symmetry' => $data['Mean symmetry'],
            'mean_fractal_dimension' => $data['Mean fractal dimension'],
            'radius_error' => $data['Radius error'],
            'texture_error' => $data['Texture error'],
            'perimeter_error' => $data['Perimeter error'],
            'area_error' => $data['Area error'],
            'smoothness_error' => $data['Smoothness error'],
            'compactness_error' => $data['Compactness error'],
            'concavity_error' => $data['Concavity error'],
            'concave_points_error' => $data['Concave points error'],
            'symmetry_error' => $data['Symmetry error'],
            'fractal_dimension_error' => $data['Fractal dimension error'],
            'worst_radius' => $data['Worst radius'],
            'worst_texture' => $data['Worst texture'],
            'worst_perimeter' => $data['Worst perimeter'],
            'worst_area' => $data['Worst area'],
            'worst_smoothness' => $data['Worst smoothness'],
            'worst_compactness' => $data['Worst compactness'],
            'worst_concavity' => $data['Worst concavity'],
            'worst_concave_points' => $data['Worst concave points'],
            'worst_symmetry' => $data['Worst symmetry'],
            'worst_fractal_dimension' => $data['Worst fractal dimension'],
        ]);
    
        // نبعت للـ Flask API
        $response = Http::post(config('services.flask.url') . '/predict_breast_cancer', $data);
    
        if ($response->successful()) {
            $apiResponse = $response->json();
    
            $prediction->update([
                'prediction' => $apiResponse['prediction'],
                // 'confidanse' => $apiResponse['confidanse'] ?? null,
                // 'advise' => $apiResponse['advise'] ?? null,
            ]);
    
            $result = DB::table('predictions as p')
                ->join('users as u', 'p.user_id', '=', 'u.id')
                ->join('models as m', 'p.model_id', '=', 'm.id')
                ->join('breast_predictions as bp', 'p.id', '=', 'bp.id')
                ->select(
                    DB::raw("CONCAT(u.name, ' (ID: ', u.id, ')') as patient_name"),
                    DB::raw("DATE_FORMAT(p.created_at, '%d-%m-%Y') as date"),
                    'u.gender',
                    'u.age as patient_age',
                    DB::raw("'Breast Cancer' as diagnosis_check"),
                    'bp.mean_radius',
                    'bp.mean_texture',
                    'bp.mean_perimeter',
                    'bp.mean_area',
                    'bp.mean_smoothness',
                    'bp.mean_compactness',
                    'bp.mean_concavity',
                    'bp.mean_concave_points',
                    'bp.mean_symmetry',
                    'bp.mean_fractal_dimension',
                    'bp.radius_error',
                    'bp.texture_error',
                    'bp.perimeter_error',
                    'bp.area_error',
                    'bp.smoothness_error',
                    'bp.compactness_error',
                    'bp.concavity_error',
                    'bp.concave_points_error',
                    'bp.symmetry_error',
                    'bp.fractal_dimension_error',
                    'bp.worst_radius',
                    'bp.worst_texture',
                    'bp.worst_perimeter',
                    'bp.worst_area',
                    'bp.worst_smoothness',
                    'bp.worst_compactness',
                    'bp.worst_concavity',
                    'bp.worst_concave_points',
                    'bp.worst_symmetry',
                    'bp.worst_fractal_dimension',
                    'p.advise',
                    'p.prediction as expected_level'
                )
                ->where('p.id', $prediction->id)
                ->first();
    
            return response()->json([
                'status' => 'success',
                'prediction' => $result
            ], 200);
    
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Flask API request failed',
                'details' => $response->body()
            ], 500);
        }
    }
}