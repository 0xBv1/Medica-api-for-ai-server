<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function getUserProfile()
    {
        $user = User::find(Auth::id());
    
        $user->load([
            'predictions.aiModel',
            'predictions.lungPrediction',
            'predictions.breastPrediction',
            'predictions.prostatePrediction',
            'predictions.thyroidPrediction'
        ]);
    
        return view('auth.profile', ['user' => $user,
        'predictions' => $user->predictions,]);
    }
    
}
