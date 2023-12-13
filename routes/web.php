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
    Route::post('/contacts/incoming', [App\Http\Controllers\ContactController::class, 'incoming'])->name('contacts.incoming');
    Route::post('/contacts/popupcontact', [App\Http\Controllers\ContactController::class, 'popupcontact'])->name('contacts.popupcontact');
    Route::get('/contacts/popup', [App\Http\Controllers\ContactController::class, 'popup'])->name('contacts.popup');
    Route::get('/contacts/running', [App\Http\Controllers\ContactController::class, 'create'])->name('contacts.running');
    Route::post('/contacts/store', [App\Http\Controllers\ContactController::class, 'store'])->name('contacts.store');
    Route::post('/contacts/casescontract', [App\Http\Controllers\ContactController::class, 'casescontract'])->name('contacts.casescontract');
    Route::get('/contacts/edit/{id}', [App\Http\Controllers\ContactController::class, 'edit'])->name('contacts.edit');
    Route::get('/contacts/popupedit/{telnop}', [App\Http\Controllers\ContactController::class, 'popupedit'])->name('contacts.popupedit');
    Route::get('/contacts/popupeditphone/{telnop}', [App\Http\Controllers\ContactController::class, 'popupeditphone'])->name('contacts.popupeditphone');
    Route::put('/contacts/update/{id}', [App\Http\Controllers\ContactController::class, 'update'])->name('contacts.update');
    Route::put('/contacts/casescontractupdate/{id}', [App\Http\Controllers\ContactController::class, 'casescontractupdate'])->name('contacts.casescontractupdate');
    Route::delete('/contacts/destroy', [App\Http\Controllers\ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('/contacts/destroy_all', [App\Http\Controllers\ContactController::class, 'destroy_all'])->name('contacts.destroy_all');
    Route::post('/contacts/caseslist', [App\Http\Controllers\ContactController::class, 'caseslist'])->name('contacts.caseslist');
    Route::post('/contacts/casesview', [App\Http\Controllers\ContactController::class, 'casesview'])->name('contacts.casesview');

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

    Route::get('/casetype6', [App\Http\Controllers\CaseType6Controller::class, 'index'])->name('casetype6');
    Route::post('/casetype6/store', [App\Http\Controllers\CaseType6Controller::class, 'store'])->name('casetype6.store');
    Route::get('/casetype6/edit/{id}', [App\Http\Controllers\CaseType6Controller::class, 'edit'])->name('casetype6.edit');
    Route::get('/casetype6/casetype/{id}', [App\Http\Controllers\CaseType6Controller::class, 'casetype'])->name('casetype6.casetype');
    Route::put('/casetype6/save/{id}', [App\Http\Controllers\CaseType6Controller::class, 'update'])->name('casetype6.save');
    Route::delete('/casetype6/destroy', [App\Http\Controllers\CaseType6Controller::class, 'destroy'])->name('casetype6.destroy');
    Route::post('/casetype6/destroy_all', [App\Http\Controllers\CaseType6Controller::class, 'destroy_all'])->name('casetype6.destroy_all');

    Route::get('/casetype', [App\Http\Controllers\CaseTypeController::class, 'index'])->name('casetype');
    Route::post('/casetype/store', [App\Http\Controllers\CaseTypeController::class, 'store'])->name('casetype.store');
    Route::get('/casetype/casetype/{id}', [App\Http\Controllers\CaseTypeController::class, 'casetype'])->name('casetype.casetype');
    Route::put('/casetype/save/{id}', [App\Http\Controllers\CaseTypeController::class, 'update'])->name('casetype.save');
    Route::put('/casetype/crmmoveup/{id}', [App\Http\Controllers\CaseTypeController::class, 'crmmoveup'])->name('casetype.crmmoveup');
    Route::delete('/casetype/destroy', [App\Http\Controllers\CaseTypeController::class, 'destroy'])->name('casetype.destroy');

    Route::get('/cases', [App\Http\Controllers\CasesController::class, 'index'])->name('cases');
    Route::get('/cases/seachcontact/{id}', [App\Http\Controllers\CasesController::class, 'seachcontact'])->name('cases.seachcontact');
    Route::post('/cases/store', [App\Http\Controllers\CasesController::class, 'store'])->name('cases.store');
    Route::get('/cases/edit/{id}', [App\Http\Controllers\CasesController::class, 'edit'])->name('cases.edit');
    Route::put('/cases/save/{id}', [App\Http\Controllers\CasesController::class, 'update'])->name('cases.save');
    Route::put('/cases/casecomment/{id}', [App\Http\Controllers\CasesController::class, 'casecomment'])->name('cases.casecomment');
    Route::post('/cases/commentlist', [App\Http\Controllers\CasesController::class, 'commentlist'])->name('cases.commentlist');
    Route::post('/cases/commentview', [App\Http\Controllers\CasesController::class, 'commentview'])->name('cases.commentview');
    Route::post('/cases/caseslistlog', [App\Http\Controllers\CasesController::class, 'caseslistlog'])->name('cases.caseslistlog');
    Route::post('/cases/casesviewlog', [App\Http\Controllers\CasesController::class, 'casesviewlog'])->name('cases.casesviewlog');
    Route::post('/cases/caseslist', [App\Http\Controllers\CasesController::class, 'caseslist'])->name('cases.caseslist');
    Route::post('/cases/casesview', [App\Http\Controllers\CasesController::class, 'casesview'])->name('cases.casesview');
    Route::delete('/cases/destroy', [App\Http\Controllers\CasesController::class, 'destroy'])->name('cases.destroy');
    Route::post('/cases/destroy_all', [App\Http\Controllers\CasesController::class, 'destroy_all'])->name('cases.destroy_all');

    Route::get('/casescomment', [App\Http\Controllers\CasesCommentController::class, 'index'])->name('casescomment');
    Route::get('/casescomment/records/{id}', [App\Http\Controllers\CasesCommentController::class, 'records'])->name('casescomment.records');
    Route::get('/casescomment/edit/{id}', [App\Http\Controllers\CasesCommentController::class, 'edit'])->name('casescomment.edit');
    Route::put('/casescomment/save/{id}', [App\Http\Controllers\CasesCommentController::class, 'update'])->name('casescomment.save');

    Route::get('/casescontract', [App\Http\Controllers\CasesContractController::class, 'index'])->name('casescontract.index');
    Route::post('/casescontract/store', [App\Http\Controllers\CasesContractController::class, 'store'])->name('casescontract.store');
    Route::get('/casescontract/edit/{id}', [App\Http\Controllers\CasesContractController::class, 'edit'])->name('casescontract.edit');
    Route::put('/casescontract/save/{id}', [App\Http\Controllers\CasesContractController::class, 'update'])->name('casescontract.save');
    Route::delete('/casescontract/destroy', [App\Http\Controllers\CasesContractController::class, 'destroy'])->name('casescontract.destroy');
    Route::post('/casescontract/destroy_all', [App\Http\Controllers\CasesContractController::class, 'destroy_all'])->name('casescontract.destroy_all');

    Route::get('/billingreport', [App\Http\Controllers\BillingReportController::class, 'index'])->name('billingreport');
    Route::get('/billingreport/edit/{id}', [App\Http\Controllers\BillingReportController::class, 'edit'])->name('billingreport.edit');
    Route::get('/billingreport/comment', [App\Http\Controllers\BillingReportController::class, 'comment'])->name('billingreport.comment');
    Route::POST('/billingreport/comment/update/{id}', [App\Http\Controllers\BillingReportController::class, 'update'])->name('billingreport.update');

    Route::get('/voicerecord', [App\Http\Controllers\VoicerecordController::class, 'index'])->name('voicerecord');
    Route::get('/ivrreport', [App\Http\Controllers\IvrreportController::class, 'index'])->name('ivrreport');
    Route::get('/ivrreporttop10', [App\Http\Controllers\Ivrreporttop10Controller::class, 'index'])->name('ivrreporttop10');
    Route::get('/billing', [App\Http\Controllers\BillingController::class, 'index'])->name('billing');
    
    Route::get('/reportcase', [App\Http\Controllers\ReportcaseController::class, 'index'])->name('reportcase');
    
    Route::get('/reportcasetop10', [App\Http\Controllers\ReportcasetopController::class, 'index'])->name('reportcasetop10');
    //Route::post('/reportcasetop10/report', [App\Http\Controllers\ReportcasetopController::class, 'report'])->name('reportcasetop10.report');
    Route::get('/reporttop10in', [App\Http\Controllers\ReporttopinController::class, 'index'])->name('reporttop10in');
    Route::get('/reporttop10out', [App\Http\Controllers\ReporttopoutController::class, 'index'])->name('reporttop10out');
//new
    Route::get('/loginstatus', [App\Http\Controllers\LoginstatusController::class, 'index'])->name('loginstatus');
    Route::get('/sumcasebyhn', [App\Http\Controllers\SumcasebyhnController::class, 'index'])->name('sumcasebyhn');
    Route::get('/detailcaselogbyhn', [App\Http\Controllers\DetailcaselogbyhnController::class, 'index'])->name('detailcaselogbyhn');
    Route::get('/sumtel', [App\Http\Controllers\SumtelController::class, 'index'])->name('sumtel');
    Route::get('/callstatus', [App\Http\Controllers\CallstatusController::class, 'index'])->name('callstatus');
    Route::get('/hitcall', [App\Http\Controllers\HitcallController::class, 'index'])->name('hitcall');
    Route::get('/misscall', [App\Http\Controllers\MisscallController::class, 'index'])->name('misscall');

    Route::get('/reportsumbytype', [App\Http\Controllers\ReportsumbytypeController::class, 'index'])->name('reportsumbytype');
    Route::get('/reportcaseinbyhour', [App\Http\Controllers\ReportcaseinbyhourController::class, 'index'])->name('reportcaseinbyhour');
    Route::get('/reportcaseoutbyhour', [App\Http\Controllers\ReportcaseoutbyhourController::class, 'index'])->name('reportcaseoutbyhour');
    Route::get('/reportsumcasebystatus', [App\Http\Controllers\ReportreportsumcasebystatusController::class, 'index'])->name('reportsumcasebystatus');
    Route::get('/reportsumcasebytranferstatus', [App\Http\Controllers\ReportreportsumcasebytranferstatusController::class, 'index'])->name('reportsumcasebytranferstatus');
    Route::get('/reportbreak', [App\Http\Controllers\ReportBreakController::class, 'index'])->name('reportbreak');
    Route::get('/detailcaseinternalnumber', [App\Http\Controllers\DetailcaseinternalnumberController::class, 'index'])->name('detailcaseinternalnumber');
    Route::get('/detailcaseexternalnumber', [App\Http\Controllers\DetailcaseexternalnumberController::class, 'index'])->name('detailcaseexternalnumber');
    Route::get('/detailcases', [App\Http\Controllers\DetailcasesController::class, 'index'])->name('detailcases');
    Route::get('/detailcasesstatus', [App\Http\Controllers\DetailcasesstatusController::class, 'index'])->name('detailcasesstatus');

    Route::get('/detailscore', [App\Http\Controllers\DetailscoreController::class, 'index'])->name('detailscore');
    Route::get('/detailscoreagent', [App\Http\Controllers\DetailscoreagentController::class, 'index'])->name('detailscoreagent');
    Route::get('/reportsumscoreagent', [App\Http\Controllers\ReportSumScoreAgentController::class, 'index'])->name('reportsumscoreagent');

    Route::get('/thcity/city', [App\Http\Controllers\ThCityController::class, 'city'])->name('thcity.city');
    Route::get('/thdistrict/district/{provinceId}', [App\Http\Controllers\ThDistrictController::class, 'district'])->name('thdistrict.district');
    Route::get('/thsubdistrict/subdistrict/{districtId}', [App\Http\Controllers\ThSubDistrictController::class, 'subdistrict'])->name('thsubdistrict.subdistrict');
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
