<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(!empty(auth()->user()->id)){
        return redirect()->route('dashboard');
    }else{
        return view('auth.login');
    }
});

#### Update Data Vehicle AMS
Route::get('/testvehicle', [App\Http\Controllers\Admin\VehicleController::class, 'TestDataAPiUnit']);

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/calendar-event-source',  [App\Http\Controllers\Admin\DashboardController::class, 'calendarEvents']);
        Route::get('/calendar-detail/{id}',  [App\Http\Controllers\Admin\DashboardController::class, 'ViewDetailUnitID']);
        Route::get('/get-banner/{id}',  [App\Http\Controllers\Admin\DashboardController::class, 'getDataBannerID']);

        Route::get('/vehicle', [App\Http\Controllers\Admin\VehicleController::class, 'index'])->name('vehicle');
        Route::post('/vehicle/list', [App\Http\Controllers\Admin\VehicleController::class, 'listdata'])->name('listvehicle');
        Route::post('/vehicle/store', [App\Http\Controllers\Admin\VehicleController::class, 'storedata'])->name('storevehicle');
        Route::get('/vehicle/editdata/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'editdata'])->name('editvehicle');
		Route::get('/vehicle/detail/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'detaildata'])->name('detailvehicle');
        Route::post('/vehicle/update/', [App\Http\Controllers\Admin\VehicleController::class, 'updatedata'])->name('updatevehicle');
        Route::get('/vehicle/historysvc', [App\Http\Controllers\Admin\VehicleController::class, 'listHistService'])->name('histservice');
        Route::post('/vehicle/hapus/', [App\Http\Controllers\Admin\VehicleController::class, 'hapusdata'])->name('deletevehicle');


        Route::post('/secondprice/list', [App\Http\Controllers\Admin\VehicleController::class, 'listAppraise'])->name('listAppraise');
        Route::post('/serviceprice/list', [App\Http\Controllers\Admin\VehicleController::class, 'listBiayaServices'])->name('listpriceservice');


        Route::get('/bodypaint', [App\Http\Controllers\Admin\BodyPricesController::class, 'index'])->name('bodypaint');
        Route::post('/bodypaint/list', [App\Http\Controllers\Admin\BodyPricesController::class, 'listdata'])->name('listbp');
        Route::get('/bodypaint/joblist', [App\Http\Controllers\Admin\BodyPricesController::class, 'getAllJobPainting']);

        Route::get('/profill', [App\Http\Controllers\Admin\ProfillController::class, 'index'])->name('profill');
        Route::post('/profill/store', [App\Http\Controllers\Admin\ProfillController::class, 'storedata'])->name('storeprofill');

        Route::get('/bengkel', [App\Http\Controllers\Admin\GeneralServiceController::class, 'index'])->name('bengkel');
        Route::post('/bengkel/list', [App\Http\Controllers\Admin\GeneralServiceController::class, 'listData'])->name('listbengkel');
        Route::post('/bengkel/prosesSync', [App\Http\Controllers\Admin\GeneralServiceController::class, 'proses_sinkron'])->name('updateSync');

        Route::get('/dropmodel', [App\Http\Controllers\Admin\VehicleController::class, 'getDataModelHaving'])->name('dropmodel');
        Route::get('/dropdowntype/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'getDataTypeByModel'])->name('dropdowntype');

        Route::get('/asuransi', [App\Http\Controllers\Admin\AsuransiController::class, 'index'])->name('asuransi');
        Route::post('/asuransi/list', [App\Http\Controllers\Admin\AsuransiController::class, 'listdata'])->name('listasuransi');
    
        Route::get('/stnk', [App\Http\Controllers\Admin\STNKController::class, 'index'])->name('stnk');
        Route::get('/stnk/listexpire', [App\Http\Controllers\Admin\STNKController::class, 'listexpire']);
        Route::post('/stnk/listData', [App\Http\Controllers\Admin\STNKController::class, 'listData'])->name('liststnk');
        ///listData
    });
});
