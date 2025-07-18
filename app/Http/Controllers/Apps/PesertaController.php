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
use App\Exports\PendaftarUndanganExport;
use App\Exports\LulusUndanganExport;
use App\Models\Nilai;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

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
                        'rapor'
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

            //Update Data Prestasi
            $prestasi = Prestasi::where([['id_peserta', $id],['is_checked', 'true']])->first();
            $prestasi->update([
                'is_checked' => 'false'
            ]);

            DB::commit();

            return redirect()->route('peserta.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function updateCheckPrestasi(Request $request)
    {
        //return $request->all();
        DB::beginTransaction();
        if($request->checked == 'true'){
            $status = 'true';
        }else{
            $status = 'false';
        }

        try {
            $prestasi = Prestasi::findOrFail($request->id);
            $prestasi->update([
                'is_checked' => $status
            ]);

            DB::commit();
            return redirect()->route('peserta.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function exportDataPeserta(Request $request) {

        $dataPeserta = DB::table('peserta')
                       ->select('nisn_siswa','nm_siswa','nomor','npsn','sekolah.nama as nm_sekolah','kabkot.nm_kabkot','provinsi.nm_provinsi','pil_1.nm_prodi as pil_1','pil_2.nm_prodi as pil_2','pil_3.nm_prodi as pil_3','pil_4.nm_prodi as pil_4')
                       ->leftjoin('sekolah', 'peserta.npsn', '=', 'sekolah.id')
                       ->leftjoin('kecamatan', 'sekolah.kecamatan_id', '=', 'kecamatan.id')
                       ->leftjoin('kabkot', 'kecamatan.kabkot_id', '=', 'kabkot.id')
                       ->leftjoin('provinsi', 'kabkot.prov_id', '=', 'provinsi.id')
                       ->leftjoin('prodi as pil_1', 'peserta.pil1_siswa', '=', 'pil_1.id')
                       ->leftjoin('prodi as pil_2', 'peserta.pil2_siswa', '=', 'pil_2.id')
                       ->leftjoin('prodi as pil_3', 'peserta.pil3_siswa', '=', 'pil_3.id')
                       ->leftjoin('prodi as pil_4', 'peserta.pil4_siswa', '=', 'pil_4.id')
                       ->whereNotNull('peserta.nomor')
                       ->orderBy('nomor', 'desc')
                       ->get();

        //return $dataPeserta;
        return Excel::download(new PendaftarUndanganExport($dataPeserta), 'PendaftarUndangan — '.Carbon::now().'.xlsx');
    }

    public function exportDataPesertaLulus(Request $request) {

        $dataPeserta = DB::table('peserta')
                       ->select('nisn_siswa','nm_siswa','nomor','npsn','sekolah.nama as nm_sekolah','kabkot.nm_kabkot','provinsi.nm_provinsi','pil_1.nm_prodi as pil_1','pil_2.nm_prodi as pil_2','pil_3.nm_prodi as pil_3','pil_4.nm_prodi as pil_4','lulus.nm_prodi as prodills')
                       ->leftjoin('sekolah', 'peserta.npsn', '=', 'sekolah.id')
                       ->leftjoin('kecamatan', 'sekolah.kecamatan_id', '=', 'kecamatan.id')
                       ->leftjoin('kabkot', 'kecamatan.kabkot_id', '=', 'kabkot.id')
                       ->leftjoin('provinsi', 'kabkot.prov_id', '=', 'provinsi.id')
                       ->leftjoin('prodi as pil_1', 'peserta.pil1_siswa', '=', 'pil_1.id')
                       ->leftjoin('prodi as pil_2', 'peserta.pil2_siswa', '=', 'pil_2.id')
                       ->leftjoin('prodi as pil_3', 'peserta.pil3_siswa', '=', 'pil_3.id')
                       ->leftjoin('prodi as pil_4', 'peserta.pil4_siswa', '=', 'pil_4.id')
                       ->leftJoin('prodi as lulus', 'peserta.prodills_siswa', '=', 'lulus.id')
                       ->where('is_lulus','Y')
                       ->whereNotNull('peserta.nomor')
                       ->orderBy('nomor', 'desc')
                       ->get();

        //return $dataPeserta;
        return Excel::download(new LulusUndanganExport($dataPeserta), 'LulusUndangan — '.Carbon::now().'.xlsx');
    }

    public function getDataVerifikasi()
    {
        $peserta = Peserta::query()->with('rapor','prestasi','prestasi.bidang','prestasi.tingkat','prestasi.inkel')
                    ->where([
                        ['is_vrf_op', '=', 'Y'],
                        ['is_vrf_siswa', '=', 'Y'],
                        ['is_bayar', '=', '1'],
                    ])->get();

        return $peserta;
    }

    public function saveDataNilai(Request $request)
    {
        DB::beginTransaction();
        try {
            $nilai = Nilai::where('peserta_id', $request->id)->first();

            /**
             * TODO: Cek apakah data nilai sudah ada, jika sudah update, jika belum insert
             */

            if($nilai) {
                $nilai->update([
                    'rapor' => $request->rapor,
                    'prestasi' => $request->nilaiMax,
                    'total' => $request->nilaiTotal
                ]);
            } else {
                Nilai::create([
                    'peserta_id' => $request->id,
                    'rapor' => $request->rapor,
                    'prestasi' => $request->nilaiMax,
                    'total' => $request->nilaiTotal
                ]);
            }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

}
