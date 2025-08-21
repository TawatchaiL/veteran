<?php

use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */
Route::post('/contacts/popup/content', [App\Http\Controllers\ContactController::class, 'popup_content'])->name('contacts.popup_content');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/get-logo', function () {
    $result = FileUploadService::getLogoDataURL();
    return $result;
})->name('file.get-logo');

Route::get('manon', function (Request $request) {
    return $request;
});

// new 4/10/2023

Route::get('/voicerecord/edit/{id}', [App\Http\Controllers\VoicerecordController::class, 'edit'])->name('voicerecord.edit');
Route::get('/voicerecord/comment', [App\Http\Controllers\VoicerecordController::class, 'comment'])->name('voicerecord.comment');
Route::delete('/voicerecord/comment/{id}', [App\Http\Controllers\VoicerecordController::class, 'destroy'])->name('voicerecord.destroy');
Route::POST('/voicerecord/comment/update/{id}', [App\Http\Controllers\VoicerecordController::class, 'update'])->name('voicerecord.update');
