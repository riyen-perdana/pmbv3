<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabkot;
use App\Models\Provinsi;
use App\Models\Kecamatan;

class AreaController extends Controller
{
    public function getKabkot(Provinsi $provinsi)
    {
        return $provinsi->kabkot;
    }

    public function getKecamatan(Kabkot $kabkot)
    {
        return $kabkot->kecamatan;
    }

    public function getSekolah(Kecamatan $kecamatan)
    {
        return $kecamatan->sekolah;
    }


}
