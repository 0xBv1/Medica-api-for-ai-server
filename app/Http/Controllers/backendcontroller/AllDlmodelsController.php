<?php

namespace App\Http\Controllers\backendcontroller;

use App\Http\Controllers\Controller;
use App\Models\AiModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\DlModelsPrediction;
use Illuminate\Support\Facades\DB;

class AllDlmodelsController extends Controller
{
    public function sendToAPI(Request $request)
    {
        try {
            $allowedLabels = ['breast', 'brain', 'skin', 'Histopathologic', 'Lung', 'oral', 'kidney'];
    
            $request->validate([
                'id' => ['required', 'string', Rule::in($allowedLabels)],
                'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            ]);
    
            $label = $request->input('id');
            $image = $request->file('image');
    
            // ارسال الصورة لـ Flask API
            $response = Http::timeout(10)
                ->attach('image', file_get_contents($image->getRealPath()), $image->getClientOriginalName())
                ->post(config('services.flask.url') . '/one_for_all', [
                    'id' => $label,
                ]);
    
            if ($response->successful()) {
                $data = json_decode($response->body(), true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return response()->json(['error' => 'Invalid JSON from Flask API'], 500);
                }
    
                // حفظ الصورة
                $imagePath = $image->store('images', 'public');
    
                // البحث عن الموديل في جدول models حسب الاسم
                $model = AiModel::whereRaw('LOWER(name) = ?', [strtolower($label)])
                    ->where('type', 'DL')
                    ->first();
    
                if (!$model) {
                    return response()->json(['error' => 'DL model not found in database'], 404);
                }
    
                // تخزين في جدول dl_models_predictions
                $record = DlModelsPrediction::create([
                    'user_id' => Auth::id(),
                    'model_id' => $model->id,
                    'image_path' => $imagePath,
                    'prediction' => $data['prediction'] ?? 'unknown',
                    'confidence' => $data['confidence'] ?? 0,
                    'advise' => $data['advise'] ?? null,
                ]);
    
                // إرجاع بيانات مفصلة من الجدول
                $respon = DB::table('dl_models_predictions as p')
                    ->join('users as u', 'p.user_id', '=', 'u.id')
                    ->join('models as m', 'p.model_id', '=', 'm.id')
                    ->select(
                        DB::raw("CONCAT(u.name, ' (ID: ', u.id, ')') as patient_name"),
                        DB::raw("DATE_FORMAT(p.created_at, '%d-%m-%Y') as date"),
                        'u.gender',
                        'u.age as patient_age',
                        DB::raw("CONCAT(m.name, ' (', m.type, ')') as diagnosis_check"),
                        'p.prediction as expected_level',
                        'p.confidence',
                        'p.advise',
                        'p.image_path'
                    )
                    ->where('p.id', $record->id)
                    ->first();
    
                return response()->json([
                    'saved_record' => $respon
                ]);
            } else {
                return response()->json([
                    'error' => 'Flask API request failed',
                    'message' => $response->body(),
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Image upload error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred during image upload' ,'massage'=> $e->getMessage()], 500);
        }
    }
    
}
