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
    Route::post('/agent_warp', [App\Http\Controllers\PBXController::class, 'AgentWarp'])->name('agent.warp');
    Route::post('/agent_unwarp', [App\Http\Controllers\PBXController::class, 'AgentUnWarp'])->name('agent.unwarp');
    Route::post('/agent_ring', [App\Http\Controllers\PBXController::class, 'AgentRing'])->name('agent.ring');
    Route::post('/agent_talk', [App\Http\Controllers\PBXController::class, 'AgentTalk'])->name('agent.talk');
    Route::post('/agent_hang', [App\Http\Controllers\PBXController::class, 'AgentHang'])->name('agent.hang');
    Route::post('/agent_phone_unregis', [App\Http\Controllers\PBXController::class, 'AgentPhoneUnregis'])->name('agent.phone_unregis');
    Route::post('/agent_status', [App\Http\Controllers\PBXController::class, 'AgentStatus'])->name('agent.status');
    Route::post('/tranfer', [App\Http\Controllers\PBXController::class, 'call_tranfer'])->name('tranfer');
    Route::post('/agent_kick', [App\Http\Controllers\PBXController::class, 'AgentKick'])->name('agent.kick');
    Route::post('/pause_list', [App\Http\Controllers\PBXController::class, 'pause_list'])->name('pause_list');
});
