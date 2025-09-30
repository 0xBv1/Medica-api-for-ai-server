<?php
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\backendcontroller\AllDlmodelsController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\PredictionController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\backendcontroller\AllMlmodelsController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\backendcontroller\CTcontroller;
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('frontend.index');

})->name('home');

Route::get('/Check', function () {
    return view('frontend.cancer_models');
});

Route::get('/Cancer_Treatment_Recommender', function () {
    return view('frontend.ct');
})->name('Cancer_Treatment_Recommender');
//  DL
Route::post('/upload-image', [AllDlmodelsController::class, 'sendToAPI']);

//  ML
Route::post('/predict_lung_cancer', [AllMlmodelsController::class, 'predictLungCancer']);
Route::post('/predict_thyroid_cancer', [AllMlmodelsController::class, 'predictThyroidCancer']);
Route::post('/predict_prostate_cancer', [AllMlmodelsController::class, 'predictProstateCancer']);
Route::post('/predict_breast_cancer', [AllMlmodelsController::class, 'predictBreastCancer']);

// ct
Route::post('/ct', [CTcontroller::class, 'predict'])->name('ct.predict');


// Static Pages in the "static" folder
Route::view('/article-three', 'static.article_three')->name('static.article_three');
Route::view('/article-two', 'static.article_two')->name('static.article_two');
Route::view('/article-one', 'static.article_one')->name('static.article_one');
Route::view('/brain-tumor', 'static.brain_tumor')->name('static.brain_tumor');
Route::view('/breast-cancer', 'static.breast_cancer')->name('static.breast_cancer');
Route::view('/histopathologic-cancer', 'static.histopathologic_cancer')->name('static.histopathologic_cancer');
Route::view('/kidney-cancer', 'static.kidney_cancer')->name('static.kidney_cancer');
Route::view('/lung-cancer', 'static.lung_cancer')->name('static.lung_cancer');
Route::view('/oral-cancer', 'static.oral_cancer')->name('static.oral_cancer');
Route::view('/prostate-cancer', 'static.prostate_cancer')->name('static.prostate_cancer');
Route::view('/skin-cancer', 'static.skin_cancer')->name('static.skin_cancer');
Route::view('/thyroid-cancer', 'static.thyroid_cancer')->name('static.thyroid_cancer'); // check typo
Route::view('/colon-cancer', 'static.colon_cancer')->name('static.colon_cancer'); 



Route::post('/contactus', [ContactController::class, 'store']);
    // ->middleware('throttle:1,10') // Limit to 1 request per minute


Route::get('/contactus', function () {
    return view('frontend.contact_us');
})->name('contact_us');
// static\about_us
Route::get('/about_us', function () {
    return view('static.about_us');
})->name('about_us');
// auth routes
Route::get('/login', function () {return view('auth.login');})->name('login');
Route::get('/register', function () {return view('auth.register');})->name('register');

// auth logic
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.submit');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.submit');

// // google oauth
Route::get('/auth/google', [\App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);

//profile
Route::get('/profile', function () {
    return view('auth.profile');
})->middleware(['auth', 'verified'])->name('profile');


// Chatbot Routes
Route::prefix('chatbot')->name('chatbot.')->group(function () {
    Route::post('/text-to-text', [ChatbotController::class, 'textToText'])->name('textToText');
    Route::post('/text-to-speech', [ChatbotController::class, 'textToSpeech'])->name('textToSpeech');
    Route::post('/speech-to-text', [ChatbotController::class, 'speechToText'])->name('speechToText');
    Route::post('/speech-to-speech', [ChatbotController::class, 'speechToSpeech'])->name('speechToSpeech');
});




// password handling

// Forgot Password Routes
Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email')
    ->middleware('throttle:10,1');

// Reset Password Routes
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset')
    ->middleware('throttle:10,1');  // Apply rate limit to reset password form

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update')
    ->middleware('throttle:10,1');  // Apply rate limit to reset password submission

Route::get('/forgot-password/sent', function () {
    return view('auth.password-sent'); // هنجهزها تحت
})->name('password.email.sent');



Route::middleware(['auth'])->get('/profile', [\App\Http\Controllers\ProfileController::class, 'getUserProfile'])->name('profile');

