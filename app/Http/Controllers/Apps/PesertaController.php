<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Peserta\PesertaPrestasiNonAkademikUpdateRequest;
use App\Http\Requests\Peserta\PesertaRaporUpdateRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Peserta;
use App\Models\Inkel;
use App\Models\Bidang;
use App\Models\Prestasi;
use App\Models\Tingkat;
use App\Models\Rapor;
use Illuminate\Support\Facades\DB;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $peserta_daftar_count = Peserta::all()->count();
        $peserta_daftar_bayar = Peserta::where('is_bayar','=',1)->count();
        $peserta_daftar_pradaftar = Peserta::where('is_bayar','=',0)->count();
        $peserta_daftar_verifikasi = Peserta::where('is_vrf_siswa', 'Y')->count();
        $peserta = Peserta::query()
                    ->with(
                        'sekolah',
                        'sekolah.kecamatan',
                        'sekolah.kecamatan.kabkot',
                        'sekolah.kecamatan.kabkot.provinsi',
                        'pil_1',
                        'pil_2',
                        'pil_3',
                        'pil_4',
                        'prestasi',
                        'prestasi.bidang',
                        'prestasi.tingkat',
                        'prestasi.inkel',
                        'rapor',
                    );

        if ($request->has('search')) {
            $peserta->where('nisn_siswa','like','%'. $request->search .'%');
            $peserta->orWhere('nm_siswa','like','%'. $request->search .'%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        $inkel = Inkel::all();
        $bidang = Bidang::all();
        $tingkat = Tingkat::all();

        return Inertia::render('Apps/Peserta/Index', [
            'peserta_daftar_count' => $peserta_daftar_count,
            'peserta_daftar_bayar' => $peserta_daftar_bayar,
            'peserta_daftar_pradaftar' => $peserta_daftar_pradaftar,
            'peserta_daftar_verifikasi' => $peserta_daftar_verifikasi,
            'peserta' => $peserta->paginate($perPage),
            'perPage' => intval($perPage),
            'inkel' => $inkel,
            'bidang' => $bidang,
            'tingkat' => $tingkat,
        ]);
    }

    public function destroy(String $id)
    {
        DB::beginTransaction();
        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->delete();

            DB::commit();
            return redirect()->route('peserta.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, String $id)
    {
        DB::beginTransaction();
        try {

            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'is_vrf_siswa' => 'N'
            ]);

            DB::commit();
            return redirect()->route('peserta.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function updateDataPrestasi(PesertaPrestasiNonAkademikUpdateRequest $request, String $id)
    {
        DB::beginTransaction();
        try {
            $prestasi = Prestasi::findOrFail($id);
            $prestasi->update([
                'nm_prestasi' => $request->txtNmPrestasi,
                'id_bidang' => $request->cboBidangPrestasi,
                'id_tingkat' => $request->cboTingkatPrestasi,
                'id_jenis' => $request->cboKelompokPrestasi
            ]);

            DB::commit();

            return redirect()->route('peserta.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function getData(String $id)
    {
        DB::beginTransaction();
        try {
            $peserta = Peserta::with(
                'sekolah',
                'sekolah.kecamatan',
                'sekolah.kecamatan.kabkot',
                'sekolah.kecamatan.kabkot.provinsi',
                'pil_1',
                'pil_2',
                'pil_3',
                'pil_4',
                'prestasi',
                'prestasi.bidang',
                'prestasi.tingkat',
                'prestasi.inkel',
                'rapor',
            )->findOrFail($id);

            return $peserta;

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function updateDataRapor(PesertaRaporUpdateRequest $request, String $id)
    {
        DB::beginTransaction();
        try {
            $rapor = Rapor::findOrFail($id);
            $rapor->update([
                'n_mtk'  => $request->txtNilaiMTK,
                'n_bing' => $request->txtNilaiPAI
            ]);

            DB::commit();

            return redirect()->route('peserta.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function updateVerifikasi(String $id)
    {
        DB::beginTransaction();
        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'is_vrf_op' => 'Y'
            ]);

            DB::commit();

            return redirect()->route('peserta.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function cancelVerifikasi(String $id)
    {
        DB::beginTransaction();
        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'is_vrf_op' => 'N'
            ]);

            DB::commit();

            return redirect()->route('peserta.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
