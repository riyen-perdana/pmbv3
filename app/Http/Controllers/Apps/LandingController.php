<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        return Inertia::render('Landing/Index');
    }

    public function kelulusan($id)
    {
        DB::beginTransaction();
        $peserta = Peserta::with('prodi')->where('nomor','=', $id)->orWhere('nisn_siswa','=', $id)->first();
        return response($peserta);
    }


}
