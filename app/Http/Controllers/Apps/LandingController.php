<?php

namespace App\Http\Controllers\Apps;

use Inertia\Inertia;
use App\Models\Prodi;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        $prodi = Prodi::with('fakultas','jenjang','akreditasi')
                ->where('is_aktif','=','Y')
                ->get();
        return Inertia::render('Landing/Index',[
            'prodi' => $prodi
        ]);
    }

    public function kelulusan($id)
    {
        DB::beginTransaction();
        $peserta = Peserta::with('prodi')->where('nomor','=', $id)->orWhere('nisn_siswa','=', $id)->first();
        return response($peserta);
    }


}
