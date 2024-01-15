<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\ChecklistsController;
use App\Http\Controllers\FixassetController;
use App\Http\Controllers\PeriodsController;
use App\Http\Controllers\ProblemsController;
use App\Http\Controllers\RepairsController;
use App\Http\Controllers\Members\ProfileController;
use App\Http\Controllers\Members\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PmplansController;
use App\Http\Controllers\ReqerpController;

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboards',  'index')->name('dashboard.index');
});

Route::controller(RepairsController::class)->group(function () {

    Route::match(array('get', 'post'), '/repairs', 'index')->name('re.index');
    Route::get('repairs/online/{uuid}',  'online')->name('re.online');
    Route::get('repairs/add/{uuid}', 'add')->name('re.add');
    Route::get('repairs/add2/{uuid}', 'add2')->name('re.add2');
    Route::get('repairs/online/{uuid}', 'online')->name('re.online');
    Route::get('repairs/success', 'success')->name('re.success');
    Route::post('repairs/job/rec', 'recjob')->name('re.recjob');
    Route::post('repairs/job/delete', 'deletejob')->name('re.deletejob');
    Route::get('repairs/job/edit/{uuid}', 'editjob')->name('re.editjob');
    Route::post('repairs/job/update', 'updatejob')->name('re.updatejob');
    Route::post('repairs/save_req', 'save_req')->name('re.save_req');
});

Route::controller(ActionController::class)->group(function () {
    Route::get('actions/act/{uuid}', 'act')->name('ac.act');
    Route::post('actions/repaire', 'repaire')->name('ac.repaire');
    Route::post('actions/report', 'report')->name('ac.report');
    Route::match(array('get', 'post'),'actions/reqerp', 'reqerp')->name('ac.reqerp');

});

Route::controller(ReqerpController::class)->group(function () {
    Route::match(array('get', 'post'),'reqerp', 'index')->name('reqerp.index');
    Route::match(array('get', 'post'),'reqerp/add', 'add')->name('reqerp.add');
    Route::post('reqerp/save', 'save')->name('reqerp.save');
    Route::get('reqerp/edit/{uuid}', 'edit')->name('reqerp.edit');
    Route::post('reqerp/update', 'update')->name('reqerp.update');
});

Route::middleware(['auth'])->group(function () {
/*
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
*/

Route::controller(ActionController::class)->group(function () {

    Route::post('actions/pm', 'pm')->name('ac.pm');
    Route::post('actions/pm/savepm', 'savepm')->name('ac.savepm');
    Route::get('actions/pm/plan/{uuid}', 'pmplan')->name('ac.pmplan');
    Route::post('actions/pm/plan/save', 'pmplansave')->name('ac.pmplansave');
    Route::get('actions/pm/result/{uuid}', 'pmresult')->name('ac.pmresult');
});


    Route::controller(PmplansController::class)->group(function () {
        Route::match(array('get', 'post'),'/pmplans', 'index')->name('pmplans.index');
        Route::get('/pmplans/add', 'add')->name('pmplans.add');
        Route::post('/pmplans/new', 'new')->name('pmplans.new');
        Route::get('/pmplans/edit/{uuid}', 'edit')->name('pmplans.edit');
        Route::post('/pmplans/update', 'update')->name('pmplans.update');
        Route::post('/pmplans/delete', 'delete')->name('pmplans.delete');

    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::post('/profile/update', 'update')->name('profile.update');

    });

    Route::controller(ChangePasswordController::class)->group(function () {
        Route::get('/profile/pwd/edit', 'edit')
            ->name('pwd.edit');
        Route::post('/profile/pwd/update', 'update')
            ->name('pwd.update');

    });

    Route::controller(FixassetController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('fixasset', 'index')
            ->name('fa.index');
        Route::get('fixasset/add', 'add')
            ->name('fa.add');
        Route::post('fixasset/save', 'save')->name('fa.save');
        Route::get('fixasset/edit/{UNID}', 'edit')->name('fa.edit');
        Route::post('fixasset/update', 'update')->name('fa.update');
        Route::post('fixasset/delete', 'delete')->name('fa.delete');
        Route::match(['get', 'post'], 'fixasset/search', 'search')->name('fa.search');


    });



    Route::controller(ProblemsController::class)->group(function () {

        Route::match(array('get', 'post'), '/problems', 'index')->name('pb.index');
        Route::get('problems/add', 'add')->name('pb.add');
        Route::post('problems/save', 'save')->name('pb.save');
        Route::post('problems/delete', 'delete')->name('pb.delete');
        Route::get('problems/edit/{uuid}', 'edit')->name('pb.edit');
        Route::post('problems/update', 'update')->name('pb.update');

    });

    Route::controller(PeriodsController::class)->group(function () {

        Route::match(array('get', 'post'), '/periods', 'index')->name('pe.index');
        Route::get('periods/add', 'add')->name('pe.add');
        Route::post('periods/save', 'save')->name('pe.save');
        Route::post('periods/delete', 'delete')->name('pe.delete');
        Route::get('periods/edit/{uuid}', 'edit')->name('pe.edit');
        Route::post('periods/update', 'update')->name('pe.update');

    });

    Route::controller(ChecklistsController::class)->group(function () {

        Route::match(array('get', 'post'), '/checklists', 'index')->name('ch.index');
        Route::get('checklists/add', 'add')->name('ch.add');
        Route::post('checklists/save', 'save')->name('ch.save');
        Route::post('checklists/delete', 'delete')->name('ch.delete');
        Route::get('checklists/edit/{uuid}', 'edit')->name('ch.edit');
        Route::post('checklists/update', 'update')->name('ch.update');

    });

});

require __DIR__ . '/auth.php';
