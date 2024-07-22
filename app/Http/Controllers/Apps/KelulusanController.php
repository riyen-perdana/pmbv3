<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Prodi;
use App\Models\Nilai;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class KelulusanController extends Controller
{
    public function index(Request $request,$id)
    {
        $prodi = Prodi::find($id);
        $pil_1 = Nilai::whereHas('peserta', function ($query) use ($prodi) {
            $query->where('pil1_siswa', $prodi->id);
        })->count();
        $pil_2 = Nilai::whereHas('peserta', function ($query) use ($prodi) {
            $query->where('pil2_siswa', $prodi->id);
        })->count();
        $pil_3 = Nilai::whereHas('peserta', function ($query) use ($prodi) {
            $query->where('pil3_siswa', $prodi->id);
        })->count();
        $pil_4 = Nilai::whereHas('peserta', function ($query) use ($prodi) {
            $query->where('pil4_siswa', $prodi->id);
        })->count();

        $pilihan = $request->has('pilihan') ? $request->pilihan : 'pil_1';

        $lulus = Peserta::where('prodills_siswa',$id)->count();

        if($pilihan == 'pil_1') {
            $nilai = Nilai::with(
                'peserta',
                'peserta.sekolah',
                'peserta.sekolah.kecamatan',
                'peserta.sekolah.kecamatan.kabkot',
                'peserta.sekolah.kecamatan.kabkot.provinsi',
                'peserta.prodi'
                )->whereHas('peserta', function ($query) use ($prodi) {
                    $query->where('pil1_siswa', $prodi->id);
                })->orderBy('total','DESC')
                ->orderBy('prestasi','DESC')
                ->get();
        } else if ($pilihan == 'pil_2') {
            $nilai = Nilai::with(
                'peserta',
                'peserta.sekolah',
                'peserta.sekolah.kecamatan',
                'peserta.sekolah.kecamatan.kabkot',
                'peserta.sekolah.kecamatan.kabkot.provinsi',
                'peserta.prodi'
                )->whereHas('peserta', function ($query) use ($prodi) {
                    $query->where([['pil2_siswa', $prodi->id],['is_lulus','=',NULL]]);
                })->orderBy('total','DESC')
                ->orderBy('prestasi','DESC')
                ->get();
        } else if ($pilihan == 'pil_3') {
            $nilai = Nilai::with(
                'peserta',
                'peserta.sekolah',
                'peserta.sekolah.kecamatan',
                'peserta.sekolah.kecamatan.kabkot',
                'peserta.sekolah.kecamatan.kabkot.provinsi',
                'peserta.prodi'
                )->whereHas('peserta', function ($query) use ($prodi) {
                    $query->where([['pil3_siswa', $prodi->id],['is_lulus','=',NULL]]);
                })->orderBy('total','DESC')
                ->orderBy('prestasi','DESC')
                ->get();
        } else {
            $nilai = Nilai::with(
                'peserta',
                'peserta.sekolah',
                'peserta.sekolah.kecamatan',
                'peserta.sekolah.kecamatan.kabkot',
                'peserta.sekolah.kecamatan.kabkot.provinsi',
                'peserta.prodi'
                )->whereHas('peserta', function ($query) use ($prodi) {
                    $query->where([['pil4_siswa', $prodi->id],['is_lulus','=',NULL]]);
                })->orderBy('total','DESC')
                ->orderBy('prestasi','DESC')
                ->get();
        }


        return Inertia::render('Apps/Kelulusan/Index', [
            'prodi' => $prodi,
            'pil_1' => $pil_1,
            'pil_2' => $pil_2,
            'pil_3' => $pil_3,
            'pil_4' => $pil_4,
            'nilai' => $nilai,
            'lulus' => $lulus,
            'pilihan' => $pilihan
        ]);
    }

    public function lulus(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $peserta = Peserta::find($id);
            $peserta->is_lulus = 'Y';
            $peserta->prodills_siswa = $request->prodi;
            $peserta->update();

            DB::commit();
            return redirect()->back();

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function cancel(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $peserta = Peserta::find($id);
            $peserta->is_lulus = NULL;
            $peserta->prodills_siswa = NULL;
            $peserta->update();

            DB::commit();
            return redirect()->back();

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function finalisasi($id)
    {
        DB::beginTransaction();

        $prodi = Prodi::find($id);

        try {
            if ($prodi->is_valid == 'N') {
                $prodi->is_valid = 'Y';
                $prodi->save();

            } else {
                $prodi->is_valid = 'N';
                $prodi->save();
            }

            DB::commit();
            return redirect()->back();

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
