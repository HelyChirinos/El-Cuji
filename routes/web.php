<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PublicaController;
use App\Http\Controllers\GlobalController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('front_end.index');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth' ])->group(function () {
    // Route::get('/admin', function () {
    //     return view('admin.admin');
    // })->name('admin');

    Route::get('/admin', [GlobalController::class,'comienzo'])->name('admin');    
    
    Route::get('/propietarios', function () {
        return view('admin.user.owner.index');
    })->name('owner');
    Route::get('/condominio/gastos', function () {
        return view('admin.condominio.gastos.index');
    })->name('gastos');

    Route::get('/condominio/fondos', function () {
        return view('admin.condominio.fondos.index');
    })->name('fondos');


    Route::get('/condominio/facturas', [GlobalController::class,'facturas'])->name('facturas');
    
    Route::post('/condominio/factura/primera', [GlobalController::class,'save_first_fact'])->name('save_fact');

    Route::get('/condominio/pagos', function () {
        return view('admin.condominio.pagos.index');
    })->name('pagos');
    
    Route::get('/condominio/casa/{casa}', [GlobalController::class,'showCasa'])->name('casa');
    Route::get('/condominio/residentes', [GlobalController::class,'showResidentes'])->name('residentes');
    Route::get('/condominio/vehiculos', [GlobalController::class,'showVehiculos'])->name('vehiculos');

    
});

Route::get('/pruebas', [PruebasController::class,'casa_data']);

Route::controller(PdfController::class)->middleware(['auth' ])->group(function () {
    Route::get('/condominio/pdf/{casa}', 'showPDF')->name('showPDF') ;
    Route::get('/condominio/old_pdf/{factura_id}', 'showOldPDF')->name('showOldPDF') ;

});


Route::controller(PublicaController::class)->middleware(['auth' ])->group(function () {
    Route::get('/condominio/publicar', 'publicar')->name('publicar') ;
});

Route::controller(GlobalController::class)->middleware(['auth' ])->group(function () {
 
    Route::get('/user/perfil','showPerfil')->name('perfil');
    Route::get('/user/update-password','showPassword')->name('show_password');
    Route::post('/user/perfil/{user}', 'savePerfil')->name('save_perfil');
    
    Route::post('/user/update-password/{user}', 'updatePassword')->name('update_pass');

});


