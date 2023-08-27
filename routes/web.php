<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

use App\Services\FileUploadService;
use Illuminate\Http\Request;


/* Route::get('/', function () {
    return view('home');
}); */

//Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    //Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    //Route::get('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit2');
    Route::put('/roles/save/{id}', [RoleController::class, 'update'])->name('roles.save');
    //Route::delete('/roles/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::post('/roles/destroy_all', [RoleController::class, 'destroy_all'])->name('roles.destroy_all');
    Route::resource('users', UserController::class);
    Route::get('/logout', [UserController::class, 'perform'])->name('logout.perform');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit2');
    Route::put('/users/save/{id}', [UserController::class, 'update'])->name('users.save');
    Route::post('/users/destroy_all', [UserController::class, 'destroy_all'])->name('users.destroy_all');
    Route::get('/users/find/{type}/{position}', [UserController::class, 'find'])->name('users.find');
    Route::resource('roles', RoleController::class);

    Route::get('/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('contacts');
    Route::get('/contacts/popup', [App\Http\Controllers\ContactController::class, 'popup'])->name('contacts.popup');
    Route::get('/contacts/running', [App\Http\Controllers\ContactController::class, 'create'])->name('contacts.running');
    Route::post('/contacts/store', [App\Http\Controllers\ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/edit/{id}', [App\Http\Controllers\ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/save/{id}', [App\Http\Controllers\ContactController::class, 'update'])->name('contacts.save');
    Route::delete('/contacts/destroy', [App\Http\Controllers\ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('/contacts/destroy_all', [App\Http\Controllers\ContactController::class, 'destroy_all'])->name('contacts.destroy_all');


    Route::get('/departments', [App\Http\Controllers\DepartmentController::class, 'index'])->name('departments');
    Route::post('/departments/store', [App\Http\Controllers\DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/edit/{id}', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/departments/save/{id}', [App\Http\Controllers\DepartmentController::class, 'update'])->name('departments.save');
    Route::delete('/departments/destroy', [App\Http\Controllers\DepartmentController::class, 'destroy'])->name('departments.destroy');
    Route::post('/departments/destroy_all', [App\Http\Controllers\DepartmentController::class, 'destroy_all'])->name('departments.destroy_all');
    Route::get('/departments/find/{type}/{department}', [App\Http\Controllers\DepartmentController::class, 'find'])->name('departments.find');

    Route::get('/positions', [App\Http\Controllers\PositionController::class, 'index'])->name('positions');
    Route::post('/positions/store', [App\Http\Controllers\PositionController::class, 'store'])->name('positions.store');
    Route::get('/positions/edit/{id}', [App\Http\Controllers\PositionController::class, 'edit'])->name('positions.edit');
    Route::put('/positions/save/{id}', [App\Http\Controllers\PositionController::class, 'update'])->name('positions.save');
    Route::delete('/positions/destroy', [App\Http\Controllers\PositionController::class, 'destroy'])->name('positions.destroy');
    Route::post('/positions/destroy_all', [App\Http\Controllers\PositionController::class, 'destroy_all'])->name('positions.destroy_all');

    Route::get('/casetype', [App\Http\Controllers\CaseTypeController::class, 'index'])->name('casetype');
    Route::post('/casetype/store', [App\Http\Controllers\CaseTypeController::class, 'store'])->name('casetype.store');
    Route::get('/casetype/edit/{id}', [App\Http\Controllers\CaseTypeController::class, 'edit'])->name('casetype.edit');
    Route::put('/casetype/save/{id}', [App\Http\Controllers\CaseTypeController::class, 'update'])->name('casetype.save');
    Route::delete('/casetype/destroy', [App\Http\Controllers\CaseTypeController::class, 'destroy'])->name('casetype.destroy');
    Route::post('/casetype/destroy_all', [App\Http\Controllers\CaseTypeController::class, 'destroy_all'])->name('casetype.destroy_all');

    Route::get('/cases', [App\Http\Controllers\CasesController::class, 'index'])->name('cases');
    Route::post('/cases/store', [App\Http\Controllers\CasesController::class, 'store'])->name('cases.store');
    Route::get('/cases/edit/{id}', [App\Http\Controllers\CasesController::class, 'edit'])->name('cases.edit');
    Route::put('/cases/save/{id}', [App\Http\Controllers\CasesController::class, 'update'])->name('cases.save');
    Route::delete('/cases/destroy', [App\Http\Controllers\CasesController::class, 'destroy'])->name('cases.destroy');
    Route::post('/cases/destroy_all', [App\Http\Controllers\CasesController::class, 'destroy_all'])->name('cases.destroy_all');

    Route::get('/voicerecord', [App\Http\Controllers\VoicerecordController::class, 'index'])->name('voicerecord');
    Route::get('/ivrreport', [App\Http\Controllers\IvrreportController::class, 'index'])->name('ivrreport');
    Route::get('/ivrreporttop10', [App\Http\Controllers\Ivrreporttop10Controller::class, 'index'])->name('ivrreporttop10');
    Route::get('/billing', [App\Http\Controllers\BillingController::class, 'index'])->name('billing');

    Route::get('/reportcase', [App\Http\Controllers\ReportcaseController::class, 'index'])->name('reportcase');
    Route::get('pdfreportcases', [App\Http\Controllers\PDFcasesController::class, 'pdf'])->name('reportcase.pdf');

    Route::get('/reportcasetop10', [App\Http\Controllers\ReportcasetopController::class, 'index'])->name('reportcasetop10');
    Route::get('/reporttop10in', [App\Http\Controllers\ReporttopinController::class, 'index'])->name('reporttop10in');
    Route::get('/reporttop10out', [App\Http\Controllers\ReporttopoutController::class, 'index'])->name('reporttop10out');
//new
    Route::get('/loginstatus', [App\Http\Controllers\LoginstatusController::class, 'index'])->name('loginstatus');
    Route::get('/sumcasebyhn', [App\Http\Controllers\SumcasebyhnController::class, 'index'])->name('sumcasebyhn');
    Route::get('/detailcaselogbyhn', [App\Http\Controllers\DetailcaselogbyhnController::class, 'index'])->name('detailcaselogbyhn');
    Route::get('/sumtel', [App\Http\Controllers\SumtelController::class, 'index'])->name('sumtel');
    Route::get('/callstatus', [App\Http\Controllers\CallstatusController::class, 'index'])->name('callstatus');
    Route::get('/misscall', [App\Http\Controllers\MisscallController::class, 'index'])->name('misscall');

    Route::get('/reportsumbytype', [App\Http\Controllers\ReportsumbytypeController::class, 'index'])->name('reportsumbytype');
    Route::get('/reportcaseinbyhour', [App\Http\Controllers\ReportcaseinbyhourController::class, 'index'])->name('reportcaseinbyhour');
    Route::get('/reportcaseoutbyhour', [App\Http\Controllers\ReportcaseinbyhourController::class, 'index'])->name('reportcaseoutbyhour');
    Route::get('/reportsumcasebystatus', [App\Http\Controllers\ReportreportsumcasebystatusController::class, 'index'])->name('reportsumcasebystatus');
    Route::get('/reportsumcasebytranferstatus', [App\Http\Controllers\ReportreportsumcasebytranferstatusController::class, 'index'])->name('reportsumcasebytranferstatus');

    Route::get('/detailcaseinternalnumber', [App\Http\Controllers\DetailcaseinternalnumberController::class, 'index'])->name('detailcaseinternalnumber');
    Route::get('/detailcaseexternalnumber', [App\Http\Controllers\DetailcaseexternalnumberController::class, 'index'])->name('detailcaseexternalnumber');
    Route::get('/detailcases', [App\Http\Controllers\DetailcasesController::class, 'index'])->name('detailcases');
    Route::get('/detailcasesstatus', [App\Http\Controllers\DetailcasesstatusController::class, 'index'])->name('detailcasesstatus');

    Route::get('/detailscore', [App\Http\Controllers\DetailscoreController::class, 'index'])->name('detailscore');
    Route::get('/detailscoreagent', [App\Http\Controllers\DetailscoreagentController::class, 'index'])->name('detailscoreagent');
    //file
    Route::post('/file/upload', function (Request $request) {
        $result = FileUploadService::fileStore($request);
        return response()->json(['success' => $result]);
    })->name('file.upload');

    Route::post('/file/upload/delete', function (Request $request) {
        $result = FileUploadService::fileDestroy($request);
        return $result;
    })->name('file.delete');

    Route::post('/file/upload/get', function (Request $request) {
        $result = FileUploadService::fileGetName($request);
        return $result;
    })->name('file.get');


    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Auth::routes();
