<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return \Inertia\Inertia::render('Auth/Login');
})->middleware('guest');

//Prefiks "apps"
Route::prefix('apps')->group(function () {
    //Middleware "Auth"
    Route::group(['middleware'=>['auth']], function () {

        //Dashboard
        Route::get('dashboard', \App\Http\Controllers\Apps\DashboardController::class)->name('apps.dashboard');

        //Pengguna
        Route::resource('pengguna', \App\Http\Controllers\Apps\PenggunaController::class)->except('create','edit');

        //Permissions
        Route::get('permissions', \App\Http\Controllers\Apps\PermissionsController::class)->name('apps.permissions');

        //Role
        Route::resource('roles', \App\Http\Controllers\Apps\RoleController::class)->except('create','edit','show');

        //Rektor
        Route::resource('rektor', \App\Http\Controllers\Apps\RektorController::class)->except('create','edit','show');

        //Akreditasi
        Route::resource('akreditasi', \App\Http\Controllers\Apps\AkreditasiController::class)->except('create','edit','show');

        //Fakultas
        Route::resource('fakultas', \App\Http\Controllers\Apps\FakultasController::class)->except('create','edit','show');

        //Jenjang
        Route::resource('jenjang', \App\Http\Controllers\Apps\JenjangController::class)->except('create','edit','show');

        //Prodi
        Route::resource('prodi', \App\Http\Controllers\Apps\ProdiController::class)->except('create','edit','show');

        //Provinsi
        Route::get('/provinsi/apiprov', [\App\Http\Controllers\Apps\ProvinsiController::class, 'getApi'])->name('apiProvinsi');
        Route::post('/provinsi/add-api-provinsi',[\App\Http\Controllers\Apps\ProvinsiController::class, 'addApiProvinsi'])->name('addApiProvinsi');
        Route::resource('provinsi', \App\Http\Controllers\Apps\ProvinsiController::class)->except('create','edit','show');

        //Kabupaten Kota
        Route::get('/kabkot/propinsi/{provinsi}',[\App\Http\Controllers\Apps\KabkotControllers::class, 'getKabkot'])->name('getKabkot');
        Route::get('/kabkot/apikabkot', [\App\Http\Controllers\Apps\KabkotControllers::class, 'getApi'])->name('apiKabkot');
        Route::post('/kabkot/add-api-kabkot',[\App\Http\Controllers\Apps\KabkotControllers::class, 'addApiKabkot'])->name('addApiKabkot');
        Route::resource('kabkot', \App\Http\Controllers\Apps\KabkotControllers::class)->except('create','edit','show');

        //Kecamatan
        Route::get('/kecamatan/apikecamatan', [\App\Http\Controllers\Apps\KecamatanController::class, 'getApi'])->name('apiKecamatan');
        Route::post('/kecamatan/add-api-kecamatan',[\App\Http\Controllers\Apps\KecamatanController::class, 'addApiKabkot'])->name('addApiKecamatan');
        Route::resource('kecamatan', \App\Http\Controllers\Apps\KecamatanController::class)->except('create','edit','show');

    });
});
