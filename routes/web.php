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

        Route::get('/vehicle', [App\Http\Controllers\Admin\VehicleController::class, 'index'])->name('vehicle');
        Route::post('/vehicle/list', [App\Http\Controllers\Admin\VehicleController::class, 'listdata'])->name('listvehicle');
        Route::post('/vehicle/store', [App\Http\Controllers\Admin\VehicleController::class, 'storedata'])->name('storevehicle');
        Route::get('/vehicle/editdata/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'editdata'])->name('editvehicle');
		Route::get('/vehicle/detail/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'detaildata'])->name('detailvehicle');
        Route::post('/vehicle/update/', [App\Http\Controllers\Admin\VehicleController::class, 'updatedata'])->name('updatevehicle');
        Route::get('/vehicle/historysvc', [App\Http\Controllers\Admin\VehicleController::class, 'listHistService'])->name('histservice');
        Route::post('/vehicle/hapus/', [App\Http\Controllers\Admin\VehicleController::class, 'hapusdata'])->name('deletevehicle');

        Route::get('/profill', [App\Http\Controllers\Admin\ProfillController::class, 'index'])->name('profill');
        Route::post('/profill/store', [App\Http\Controllers\Admin\ProfillController::class, 'storedata'])->name('storeprofill');

        Route::get('/dropmodel', [App\Http\Controllers\Admin\VehicleController::class, 'getDataModelHaving'])->name('dropmodel');
        Route::get('/dropdowntype/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'getDataTypeByModel'])->name('dropdowntype');

    });
});
