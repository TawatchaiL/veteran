<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\IssableService;

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
})->name('agent.break');
