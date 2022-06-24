<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FixassetController;
use App\Http\Controllers\RepairsController;

// Route::get('/', function () {
//     return view('welcome');
// });

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


Route::controller(RepairsController::class)->group(function(){
    Route::get('repairs/online/{uuid}','online')->name('re.online');
    Route::get('repairs/success','success')->name('re.success');

    Route::post('repairs/save_req','save_req')->name('re.save_req');
});
