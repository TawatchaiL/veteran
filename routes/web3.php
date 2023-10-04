<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/* use App\Services\IssableService;

Route::post('/agent_break', function (Request $request) {
    $issable = new IssableService;
    $phone = $request->input('phone');
    $break_id = $request->input('break_id');
    $result = $issable->agent_break($phone, $break_id);
    return $result;
})->name('agent.break');

Route::post('/agent_unbreak', function (Request $request) {
    $issable = new IssableService;
    $phone = $request->input('phone');
    $result = $issable->agent_unbreak($phone);
    return $result;
})->name('agent.unbreak'); */

Route::group(['middleware' => ['auth']], function () {
    Route::post('/agent_login', [App\Http\Controllers\PBXController::class, 'loginAgentToQueue'])->name('agent.login');
    Route::post('/agent_logoff', [App\Http\Controllers\PBXController::class, 'logoffAgentFromQueue'])->name('agent.logoff');
    Route::post('/agent_logoff_out', [App\Http\Controllers\PBXController::class, 'logoffAgentFromQueueAndLogout'])->name('agent.logoff_out');
    Route::post('/agent_break', [App\Http\Controllers\PBXController::class, 'AgentBreak'])->name('agent.break');
    Route::post('/agent_unbreak', [App\Http\Controllers\PBXController::class, 'AgentUnBreak'])->name('agent.unbreak');
});

