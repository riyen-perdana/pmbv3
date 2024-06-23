<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Peserta;
use App\Models\Provinsi;
use App\Models\Agama;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $sekolah = Peserta::with('sekolah','sekolah.kecamatan','sekolah.kecamatan.kabkot','sekolah.kecamatan.kabkot.provinsi')->where('npsn','=',Auth('peserta')->user()->npsn)->first();
        $provinsi = Provinsi::all();
        $agama = Agama::all();
        return Inertia::render('Peserta/Dashboard/Index', [
            'provinsi' => $provinsi,
            'agama' => $agama
        ]);
    }
}
