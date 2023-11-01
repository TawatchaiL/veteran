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
    Route::post('/agent_spy', [App\Http\Controllers\PBXController::class, 'AgentSpy'])->name('agent.spy');
    Route::post('/agent_hold', [App\Http\Controllers\PBXController::class, 'AgentHold'])->name('agent.hold');
    Route::post('/agent_unhold', [App\Http\Controllers\PBXController::class, 'AgentUNHold'])->name('agent.unhold');
    Route::post('/agent_hang', [App\Http\Controllers\PBXController::class, 'AgentHang'])->name('agent.hang');
    Route::post('/agent_phone_unregis', [App\Http\Controllers\PBXController::class, 'AgentPhoneUnregis'])->name('agent.phone_unregis');
    Route::post('/agent_status', [App\Http\Controllers\PBXController::class, 'AgentStatus'])->name('agent.status');
    Route::post('/answer', [App\Http\Controllers\PBXController::class, 'call_answer'])->name('answer');
    Route::post('/tranfer', [App\Http\Controllers\PBXController::class, 'call_tranfer'])->name('tranfer');
    Route::post('/agent_kick', [App\Http\Controllers\PBXController::class, 'AgentKick'])->name('agent.kick');
    Route::post('/pause_list', [App\Http\Controllers\PBXController::class, 'pause_list'])->name('pause_list');
    Route::post('/sup_logoff_agent', [App\Http\Controllers\PBXController::class, 'logoffAgentFromQueuebySup'])->name('sup.logoff_agent');
    Route::post('/sup_break_agent', [App\Http\Controllers\PBXController::class, 'AgentBreakbySup'])->name('sup.break_agent');
    Route::post('/sup_unbreak_agent', [App\Http\Controllers\PBXController::class, 'AgentUnBreakbySup'])->name('sup.unbreak_agent');

    Route::post('/agent_list', [App\Http\Controllers\DashboardController::class, 'getAgentList'])->name('dashboard.agent_list');
    Route::post('/avg_data', [App\Http\Controllers\DashboardController::class, 'dashboard_avg_data'])->name('dashboard.avg_data');
    Route::post('/agent_avg_data', [App\Http\Controllers\DashboardController::class, 'dashboard_agent_avg_data'])->name('dashboard.agent_avg_data');
    Route::post('/agent_by_hour', [App\Http\Controllers\DashboardController::class, 'dashboard_agent_call_by_hour'])->name('dashboard.agent_by_hour');
    Route::post('/sla_data', [App\Http\Controllers\DashboardController::class, 'dashboard_sla_data'])->name('dashboard.sla_data');
});
