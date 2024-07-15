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
    return \Inertia\Inertia::render('Landing/Index');
})->middleware('guest');

//Syarat Ketentuan
Route::get('syarat-ketentuan', function () {
    return \Inertia\Inertia::render('Landing/Syarat');
})->middleware('guest');

//Pradaftar
Route::get('pradaftar',[\App\Http\Controllers\Apps\PradaftarController::class, 'index'])->name('pradaftar.index')->middleware('guest');
Route::post('/pradaftar/cek', [\App\Http\Controllers\Apps\PradaftarController::class, 'cek'])->name('cekPeserta')->middleware('guest');
Route::get('/pradaftar/cetak', [\App\Http\Controllers\Apps\PradaftarController::class, 'cetak'])->name('pradaftar.cetak')->middleware('guest');
Route::get('/pradaftar/pdf/{id}', [\App\Http\Controllers\Apps\PradaftarController::class, 'pdf'])->name('pradaftar.pdf')->middleware('guest');


Route::get('/login', function () {
    return \Inertia\Inertia::render('Auth/Login');
})->middleware('guest');

Route::get('/peserta/login', function () {
    return \Inertia\Inertia::render('Peserta/Login');
})->middleware('guest');

//login Peserta
Route::post('/peserta/login', \App\Http\Controllers\Peserta\LoginController::class)->name('peserta.login');

Route::prefix('peserta')->group(function () {
    //Middleware "Auth"
    Route::group(['middleware'=>['peserta']], function () {
        //Dashboard
        Route::get('dashboard', \App\Http\Controllers\Peserta\DashboardController::class)->name('peserta.dashboard');
        Route::get('/kabkot/propinsi/{provinsi}',[\App\Http\Controllers\Peserta\AreaController::class, 'getKabkot']);
        Route::get('/kecamatan/kabkot/{kabkot}',[\App\Http\Controllers\Peserta\AreaController::class, 'getKecamatan']);
        Route::get('/sekolah/kecamatan/{kecamatan}',[\App\Http\Controllers\Peserta\AreaController::class, 'getSekolah']);
        Route::post('/data-pribadi/{id}', [\App\Http\Controllers\Peserta\PesertaController::class, 'updateDataPribadi'])->name('updateDataPribadi');
        Route::post('/data-pilihan/{id}', [\App\Http\Controllers\Peserta\PesertaController::class, 'updateDataPilihan'])->name('updateDataPilihan');
        Route::post('/prestasi', [\App\Http\Controllers\Peserta\PesertaController::class, 'insertDataPrestasi'])->name('insertDataPrestasi');
        Route::post('/prestasi/{id}', [\App\Http\Controllers\Peserta\PesertaController::class, 'deleteDataPrestasi'])->name('deleteDataPrestasi');
        Route::post('/rapor', [\App\Http\Controllers\Peserta\PesertaController::class, 'insertDataRapor'])->name('insertDataRapor');
        Route::post('/rapor/{id}', [\App\Http\Controllers\Peserta\PesertaController::class, 'deleteDataRapor'])->name('deleteDataRapor');
        Route::post('/verifikasi/{id}', [\App\Http\Controllers\Peserta\PesertaController::class, 'updateDataVerifikasi'])->name('updateDataVerifikasi');
        Route::get('/cetak/pdf/{id}', [\App\Http\Controllers\Peserta\PesertaController::class, 'cetak'])->name('cetak-kartu-peserta');
    });
});


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

        //Agama
        Route::resource('agama', \App\Http\Controllers\Apps\AgamaController::class)->except('create','edit','show');

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
        Route::get('/kecamatan/kabkot/{kabkot}',[\App\Http\Controllers\Apps\KecamatanController::class, 'getKecamatan'])->name('getKecamatan');
        Route::get('/kecamatan/apikecamatan', [\App\Http\Controllers\Apps\KecamatanController::class, 'getApi'])->name('apiKecamatan');
        Route::post('/kecamatan/add-api-kecamatan',[\App\Http\Controllers\Apps\KecamatanController::class, 'addApiKecamatan'])->name('addApiKecamatan');
        Route::resource('kecamatan', \App\Http\Controllers\Apps\KecamatanController::class)->except('create','edit','show');

        //Sekolah
        Route::get('/sekolah/apisekolah', [\App\Http\Controllers\Apps\SekolahController::class, 'getApi'])->name('apiSekolah');
        Route::post('/sekolah/add-api-sekolah',[\App\Http\Controllers\Apps\SekolahController::class, 'addApiSekolah'])->name('addApiSekolah');
        Route::resource('sekolah', \App\Http\Controllers\Apps\SekolahController::class)->except('create','edit','show');

        //Bidang Prestasi
        Route::resource('prestasi', \App\Http\Controllers\Apps\PrestasiController::class)->except('create','edit','show');

        //Tingkat Prestasi
        Route::resource('tingkat', \App\Http\Controllers\Apps\TingkatController::class)->except('create','edit','show');

        //Jenis Prestasi
        Route::resource('jenis', \App\Http\Controllers\Apps\InkelController::class)->except('create','edit','show');

        //Peserta
        Route::get('/peserta/datapeserta/{id}', [\App\Http\Controllers\Apps\PesertaController::class, 'getData'])->name('getDataPeserta');
        Route::post('/peserta/updateprestasi/{id}', [\App\Http\Controllers\Apps\PesertaController::class, 'updateDataPrestasi'])->name('updateDataPrestasi');
        Route::post('/peserta/updaterapor/{id}', [\App\Http\Controllers\Apps\PesertaController::class, 'updateDataRapor'])->name('updateDataRapor');
        Route::resource('peserta', \App\Http\Controllers\Apps\PesertaController::class )->except('create','edit','show');
    });
});
