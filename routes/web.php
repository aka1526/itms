<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FixassetController;


Route::get('/', function () {
    return view('welcome');
});

Route::controller(FixassetController::class)->group(function(){
    Route::get('fixasset','index')->name('fa.index');
    Route::get('fixasset/add','add')->name('fa.add');
    Route::post('fixasset/save','save')->name('fa.save');
    Route::get('fixasset/edit/{UNID}','edit')->name('fa.edit');
    Route::post('fixasset/update','update')->name('fa.update');
    Route::post('fixasset/delete','delete')->name('fa.delete');
    // Route::post('base/mctype/upstatus','upstatus')->name('base.mctype.upstatus');;

});

