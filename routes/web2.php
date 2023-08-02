<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('manon', function (Request $request) {
    return $request;
});

Route::post('/save-signature', function (Request $request) {
    $signatureData = $request->input('image_data');

    // Remove the data URI prefix from the image data
    $encodedData = str_replace('data:image/png;base64,', '', $signatureData);

    // Decode the base64 data
    $decodedData = base64_decode($encodedData);

    // Define the path and filename for saving the image
    $filename = 'signatures/' . uniqid() . '.png'; // Replace 'signatures/' with your desired location

    // Save the image to the specified location
    if (Storage::disk('public')->put($filename, $decodedData)) {
        return response()->json(['message' => 'Signature saved successfully']);
    } else {
        return response()->json(['error' => 'Failed to save the signature'], 500);
    }
});
