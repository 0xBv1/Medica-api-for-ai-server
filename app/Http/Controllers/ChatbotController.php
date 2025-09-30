<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http; // Laravel's HTTP Client (alternative to cURL)
use CURLFile;

class ChatbotController extends Controller
{
    private string $pythonApiBaseUrl = 'https://shadowtem-chatbot.hf.space'; // Default, can be moved to config

    /**
     * Helper function to forward JSON requests to the Python API using cURL.
     */
    private function forwardRequestJsonViaCurl(string $url, array $data): ?string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data))
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($curl_error) {
            // Log error: error_log('Curl error: ' . $curl_error);
            return null; // Indicate error
        }

        if ($http_code >= 400) {
            // Log error: error_log('Python API error: HTTP ' . $http_code . ' - ' . $response);
            // Return the error response from Python API to be handled by the caller
            // For simplicity, returning null, but ideally, throw an exception or return detailed error.
            return null; 
        }
        
        return $response;
    }

    /**
     * Helper function to forward file uploads to the Python API using cURL.
     */
    private function forwardRequestFileUploadViaCurl(string $url, string $fileFieldName, string $filePath, string $originalFileName, array $postData): ?array
    {
        $ch = curl_init($url);
        
        $cfile = new CURLFile($filePath, mime_content_type($filePath), $originalFileName);
        $data_to_send = array_merge($postData, [$fileFieldName => $cfile]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_to_send);

        $response_body = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($curl_error) {
            // Log error: error_log('Curl error in file upload: ' . $curl_error);
            return null;
        }

        if ($http_code >= 400) {
            // Log error: error_log('Python API file upload error: HTTP ' . $http_code . ' - ' . $response_body);
            // Return error details to be handled by the caller.
            return ['error' => $response_body, 'status_code' => $http_code];
        }
        
        return ['body' => $response_body, 'content_type' => $content_type, 'status_code' => $http_code];
    }

    public function textToText(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'Saved_response' => 'nullable|string',
        ]);

        $data = [
            'message' => $validated['message'],
            'Saved_response' => $validated['Saved_response'] ?? ''
        ];

        $api_response = $this->forwardRequestJsonViaCurl($this->pythonApiBaseUrl . '/text_to_text', $data);

        if ($api_response === null) {
            return response()->json(['error' => 'Failed to communicate with the AI service.'], 500);
        }
        
        // The Python API already returns JSON, so we decode and re-encode or pass through if sure it's valid.
        // Assuming $api_response is a JSON string.
        return response()->json(json_decode($api_response, true));
    }

    public function textToSpeech(Request $request): Response
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'output_filename' => 'nullable|string',
            'Saved_response' => 'nullable|string',
        ]);

        $data = [
            'message' => $validated['message'],
            'output_filename' => $validated['output_filename'] ?? 'output.wav',
            'Saved_response' => $validated['Saved_response'] ?? ''
        ];

        // Direct cURL call as in the original script for file responses
        $ch = curl_init($this->pythonApiBaseUrl . '/text_to_speech');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data))
        ]);

        $response_body = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $content_type_header = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($curl_error) {
            return response(json_encode(['error' => "Curl error: $curl_error"]), 500)
                ->header('Content-Type', 'application/json');
        }

        if ($http_code >= 400) {
            // Attempt to return Python's error as JSON if possible
            $error_data = json_decode($response_body, true);
            return response(json_encode($error_data ?: ['error' => 'Python API error', 'details' => $response_body]), $http_code)
                ->header('Content-Type', 'application/json');
        }
        
        return response($response_body)
                ->header('Content-Type', $content_type_header ?: 'audio/wav');
                // Python API might send Content-Disposition, if so, Laravel will pass it.
    }

    public function speechToText(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'audiofile' => 'required|file',
            'Saved_response' => 'nullable|string',
        ]);

        $audioFile = $request->file('audiofile');
        $tempAudioPath = $audioFile->getPathname();
        $originalFileName = $audioFile->getClientOriginalName();

        $postData = ['Saved_response' => $validated['Saved_response'] ?? ''];

        $api_response_data = $this->forwardRequestFileUploadViaCurl(
            $this->pythonApiBaseUrl . '/speech_to_text',
            'audiofile',
            $tempAudioPath,
            $originalFileName,
            $postData
        );

        if ($api_response_data === null) {
            return response()->json(['error' => 'Failed to communicate with the AI service for STT.'], 500);
        }

        if (isset($api_response_data['error'])) {
             $error_content = json_decode($api_response_data['error'], true);
             return response()->json($error_content ?: ['error' => 'Python API error during STT', 'details' => $api_response_data['error']], $api_response_data['status_code']);
        }

        return response()->json(json_decode($api_response_data['body'], true))
                         ->header('Content-Type', $api_response_data['content_type'] ?: 'application/json');
    }

    public function speechToSpeech(Request $request): Response
    {
        $validated = $request->validate([
            'audiofile' => 'required|file',
            'output_filename' => 'nullable|string',
            'Saved_response' => 'nullable|string',
        ]);

        $audioFile = $request->file('audiofile');
        $tempAudioPath = $audioFile->getPathname();
        $originalFileName = $audioFile->getClientOriginalName();

        $postData = [
            'output_filename' => $validated['output_filename'] ?? 'speech_output.wav',
            'Saved_response' => $validated['Saved_response'] ?? ''
        ];

        $api_response_data = $this->forwardRequestFileUploadViaCurl(
            $this->pythonApiBaseUrl . '/speech_to_speech',
            'audiofile',
            $tempAudioPath,
            $originalFileName,
            $postData
        );

        if ($api_response_data === null) {
            return response(json_encode(['error' => 'Failed to communicate with the AI service for STS.']), 500)
                ->header('Content-Type', 'application/json');
        }

        if (isset($api_response_data['error'])) {
            $error_content = json_decode($api_response_data['error'], true);
            return response(json_encode($error_content ?: ['error' => 'Python API error during STS', 'details' => $api_response_data['error']]), $api_response_data['status_code'])
                ->header('Content-Type', 'application/json');
        }
        
        return response($api_response_data['body'])
                ->header('Content-Type', $api_response_data['content_type'] ?: 'audio/wav');
    }
}

