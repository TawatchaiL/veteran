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
    Route::post('/hold', [App\Http\Controllers\PBXController::class, 'call_hold'])->name('hold');
    Route::post('/swap', [App\Http\Controllers\PBXController::class, 'call_swap'])->name('swap');
    Route::post('/tranfer', [App\Http\Controllers\PBXController::class, 'call_tranfer'])->name('tranfer');
    Route::post('/tranfer_status', [App\Http\Controllers\PBXController::class, 'TranferStatus'])->name('tranfer_status');
    Route::post('/agent_kick', [App\Http\Controllers\PBXController::class, 'AgentKick'])->name('agent.kick');
    Route::post('/pause_list', [App\Http\Controllers\PBXController::class, 'pause_list'])->name('pause_list');
    Route::post('/sup_logoff_agent', [App\Http\Controllers\PBXController::class, 'logoffAgentFromQueuebySup'])->name('sup.logoff_agent');
    Route::post('/sup_break_agent', [App\Http\Controllers\PBXController::class, 'AgentBreakbySup'])->name('sup.break_agent');
    Route::post('/sup_unbreak_agent', [App\Http\Controllers\PBXController::class, 'AgentUnBreakbySup'])->name('sup.unbreak_agent');

    Route::post('/agent_list', [App\Http\Controllers\DashboardController::class, 'getAgentList'])->name('dashboard.agent_list');
    Route::post('/avg_data', [App\Http\Controllers\DashboardController::class, 'dashboard_avg_data'])->name('dashboard.avg_data');
    Route::post('/agent_avg_data', [App\Http\Controllers\DashboardController::class, 'dashboard_agent_avg_data'])->name('dashboard.agent_avg_data');
    Route::post('/agent_by_hour', [App\Http\Controllers\DashboardController::class, 'dashboard_agent_call_by_hour'])->name('dashboard.agent_by_hour');
    Route::post('/agent_by_date', [App\Http\Controllers\DashboardController::class, 'dashboard_agent_call_by_date'])->name('dashboard.agent_by_date');
    Route::post('/agent_call_survey', [App\Http\Controllers\DashboardController::class, 'dashboard_agent_call_survey'])->name('dashboard.agent_call_survey');
    Route::post('/agent_case_by_date', [App\Http\Controllers\DashboardController::class, 'dashboard_agent_case_by_date'])->name('dashboard.agent_case_by_date');
    Route::post('/sla_data', [App\Http\Controllers\DashboardController::class, 'dashboard_sla_data'])->name('dashboard.sla_data');

    Route::get('/callsurvey', [App\Http\Controllers\CallsurveyController::class, 'index'])->name('callsurvey');
    Route::post('/callsurvey/store', [App\Http\Controllers\CallsurveyController::class, 'store'])->name('callsurvey.store');
    Route::get('/callsurvey/edit/{id}', [App\Http\Controllers\CallsurveyController::class, 'edit'])->name('callsurvey.edit');
    Route::put('/callsurvey/save/{id}', [App\Http\Controllers\CallsurveyController::class, 'update'])->name('callsurvey.save');
    Route::delete('/callsurvey/destroy', [App\Http\Controllers\CallsurveyController::class, 'destroy'])->name('callsurvey.destroy');
    Route::post('/callsurvey/destroy_all', [App\Http\Controllers\CallsurveyController::class, 'destroy_all'])->name('callsurvey.destroy_all');

    Route::get('/holiday', [App\Http\Controllers\HolidaysController::class, 'index'])->name('holiday');
    Route::post('/holiday/store', [App\Http\Controllers\HolidaysController::class, 'store'])->name('holiday.store');
    Route::get('/holiday/edit/{id}', [App\Http\Controllers\HolidaysController::class, 'edit'])->name('holiday.edit');
    Route::put('/holiday/save/{id}', [App\Http\Controllers\HolidaysController::class, 'update'])->name('holiday.save');
    Route::delete('/holiday/destroy', [App\Http\Controllers\HolidaysController::class, 'destroy'])->name('holiday.destroy');
    Route::post('/holiday/destroy_all', [App\Http\Controllers\HolidaysController::class, 'destroy_all'])->name('holiday.destroy_all');

    Route::get('/billing', [App\Http\Controllers\BillingController::class, 'index'])->name('billing');
    Route::post('/billing/store', [App\Http\Controllers\BillingController::class, 'store'])->name('billing.store');
    Route::get('/billing/edit/{id}', [App\Http\Controllers\BillingController::class, 'edit'])->name('billing.edit');
    Route::put('/billing/save/{id}', [App\Http\Controllers\BillingController::class, 'update'])->name('billing.save');
    Route::delete('/billing/destroy', [App\Http\Controllers\BillingController::class, 'destroy'])->name('billing.destroy');
    Route::post('/billing/destroy_all', [App\Http\Controllers\BillingController::class, 'destroy_all'])->name('billing.destroy_all');

    Route::get('/notify', [App\Http\Controllers\NotifyGroupController::class, 'index'])->name('notify');
    Route::post('/notify/store', [App\Http\Controllers\NotifyGroupController::class, 'store'])->name('notify.store');
    Route::get('/notify/edit/{id}', [App\Http\Controllers\NotifyGroupController::class, 'edit'])->name('notify.edit');
    Route::put('/notify/save/{id}', [App\Http\Controllers\NotifyGroupController::class, 'update'])->name('notify.save');
    Route::delete('/notify/destroy', [App\Http\Controllers\NotifyGroupController::class, 'destroy'])->name('notify.destroy');
    Route::post('/notify/destroy_all', [App\Http\Controllers\NotifyGroupController::class, 'destroy_all'])->name('notify.destroy_all');

    Route::get('/customize', [App\Http\Controllers\CustomizeFeatureController::class, 'index'])->name('customize');
    Route::get('/customize/edit/{id}', [App\Http\Controllers\CustomizeFeatureController::class, 'edit'])->name('customize.edit');
    Route::put('/customize/save/{id}', [App\Http\Controllers\CustomizeFeatureController::class, 'update'])->name('customize.save');

    Route::get('/voice/download/{id}', [App\Http\Controllers\VoicerecordController::class, 'downloadAndDelete'])->name('voice.download');

    Route::get('/voicebackup', [App\Http\Controllers\VoiceBackupController::class, 'index'])->name('voicebackup');
    Route::post('/voicebackup/store', [App\Http\Controllers\VoiceBackupController::class, 'store'])->name('voicebackup.store');
});

