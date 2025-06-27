<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Peserta;
use App\Models\Provinsi;
use App\Models\Agama;
use App\Models\Bidang;
use App\Models\Inkel;
use App\Models\Prestasi;
use App\Models\Prodi;
use App\Models\Rapor;
use App\Models\Tingkat;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $rapor = Rapor::where('peserta_id',Auth('peserta')->user()->id)->get();
        $sekolah = Peserta::with('sekolah','sekolah.kecamatan','sekolah.kecamatan.kabkot','sekolah.kecamatan.kabkot.provinsi')->where('npsn','=',Auth('peserta')->user()->npsn)->first();
        $provinsi = Provinsi::all();
        $agama = Agama::all();
        $prodi_12 = Prodi::where('is_aktif','=','Y')->get();
        $prodi_34 = Prodi::where([['is_aktif','=','Y'],['is_pil_34','=','Y']])->get();
        $bidang = Bidang::all();
        $inkel = Inkel::all();
        $tingkat = Tingkat::all();
        $prestasi = Prestasi::with('bidang','tingkat','inkel')->where('id_peserta',Auth('peserta')->user()->id)->get();
        $step = Peserta::select('step')->where('id',Auth('peserta')->user()->id)->first();

        return Inertia::render('Peserta/Dashboard/Index', [
            'provinsi' => $provinsi,
            'agama' => $agama,
            'sekolah' => $sekolah,
            'prodi_12' => $prodi_12,
            'prodi_34' => $prodi_34,
            'bidang' => $bidang,
            'tingkat' => $tingkat,
            'inkel' => $inkel,
            'prestasi' => $prestasi,
            'rapor' => $rapor,
            'step' => $step
        ]);
    }
}
