<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FixassetController;
use App\Http\Controllers\RepairsController;
use App\Http\Controllers\ProblemsController;
use App\Http\Controllers\PeriodsController;
use App\Http\Controllers\ActionController;

Route::controller(FixassetController::class)->group(function(){
    Route::get('/','index');
    Route::get('fixasset','index')->name('fa.index');
    Route::get('fixasset/add','add')->name('fa.add');
    Route::post('fixasset/save','save')->name('fa.save');
    Route::get('fixasset/edit/{UNID}','edit')->name('fa.edit');
    Route::post('fixasset/update','update')->name('fa.update');
    Route::post('fixasset/delete','delete')->name('fa.delete');
    Route::match(['get', 'post'],'fixasset/search','search')->name('fa.search');
    //Route::get('fixasset/search','search')->name('fa.search'); ;
    // Route::post('base/mctype/upstatus','upstatus')->name('base.mctype.upstatus');;

});
Route::controller(ActionController::class)->group(function(){
    Route::get('actions/act/{uuid}','act')->name('ac.act');
    Route::post('actions/repaire','repaire')->name('ac.repaire');


});

Route::controller(RepairsController::class)->group(function(){

    Route::match(array('get', 'post'),'/repairs','index')->name('re.index');

    Route::get('repairs/add/{uuid}','add')->name('re.add');
    Route::get('repairs/online/{uuid}','online')->name('re.online');
    Route::get('repairs/success','success')->name('re.success');
    Route::post('repairs/job/rec','recjob')->name('re.recjob');
    Route::post('repairs/job/delete','deletejob')->name('re.deletejob');
    Route::get('repairs/job/edit/{uuid}','editjob')->name('re.editjob');
    Route::post('repairs/job/update','updatejob')->name('re.updatejob');
    Route::post('repairs/save_req','save_req')->name('re.save_req');
});


Route::controller(ProblemsController::class)->group(function(){

    Route::match(array('get', 'post'),'/problems','index')->name('pb.index');
    Route::get('problems/add','add')->name('pb.add');
    Route::post('problems/save','save')->name('pb.save');
    Route::post('problems/delete','delete')->name('pb.delete');
    Route::get('problems/edit/{uuid}','edit')->name('pb.edit');
    Route::post('problems/update','update')->name('pb.update');

});


Route::controller(PeriodsController::class)->group(function(){

    Route::match(array('get', 'post'),'/periods','index')->name('pe.index');
    Route::get('periods/add','add')->name('pe.add');
    Route::post('periods/save','save')->name('pe.save');
    Route::post('periods/delete','delete')->name('pe.delete');
    Route::get('periods/edit/{uuid}','edit')->name('pe.edit');
    Route::post('periods/update','update')->name('pe.update');

});

