<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Peserta\PesertaDataPilihanUpdateRequest;
use App\Http\Requests\Peserta\PesertaDataPribadiStoreRequest;
use App\Http\Requests\Peserta\PesertaPrestasiNonAkademikStoreRequest;
use App\Http\Requests\Peserta\PesertaRaporStoreRequest;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Storage;
use App\Models\Rapor;
use Barryvdh\DomPDF\Facade\Pdf;

class PesertaController extends Controller
{
    public function updateDataPribadi(PesertaDataPribadiStoreRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->nm_siswa  = $request->txtNamaLengkap;
            $peserta->nik_siswa = $request->txtNIK;
            $peserta->tptlhr_siswa = $request->txtTptLhr;
            $peserta->tgllhr_siswa = $request->txtTglLhr;
            $peserta->jklmn_siswa = $request->cboJenKel;
            $peserta->agm_siswa = $request->cboAgama;
            $peserta->almt_siswa = $request->txtAlmt;
            $peserta->email_siswa = $request->txtEmail;
            $peserta->notlpn_siswa = $request->txtNoHp;
            $peserta->npsn = $request->cboSekolah;

            // Upload File Foto
            $file = $request->file('txtFoto');
            $file->storeAs('public/fotopeserta', $file->hashName());
            $peserta->foto_siswa = $file->hashName();

            $peserta->update();

            DB::commit();
            return redirect()->route('peserta.dashboard');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function updateDataPilihan(PesertaDataPilihanUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->pil1_siswa = $request->cboPilihan1;
            $peserta->pil2_siswa = $request->cboPilihan2;
            $peserta->pil3_siswa = $request->cboPilihan3;
            $peserta->pil4_siswa = $request->cboPilihan4;
            $peserta->update();

            DB::commit();

            return redirect()->route('peserta.dashboard');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function insertDataPrestasi(PesertaPrestasiNonAkademikStoreRequest $request)
    {

        DB::beginTransaction();
        try {
            $prestasi = new Prestasi();
            $prestasi->id_peserta = Auth('peserta')->user()->id;
            $prestasi->nm_prestasi = $request->txtNmPrestasi;
            $prestasi->id_bidang = $request->cboBidangPrestasi;
            $prestasi->id_tingkat = $request->cboTingkatPrestasi;
            $prestasi->id_jenis = $request->cboKelompokPrestasi;

            // Upload File Foto
            $file = $request->file('txtFile');
            $file->storeAs('public/prestasi', $file->hashName());
            $prestasi->file = $file->hashName();

            $prestasi->save();

            DB::commit();
            return redirect()->route('peserta.dashboard');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deleteDataPrestasi($id)
    {
        DB::beginTransaction();
        try {
            $prestasi = Prestasi::findOrFail($id);

            Storage::delete('public/prestasi/'.$prestasi->file);

            $prestasi->delete();
            DB::commit();
            return redirect()->route('peserta.dashboard');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function insertDataRapor(PesertaRaporStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $rapor = Rapor::where('peserta_id', Auth('peserta')->user()->id)->first();
            if($rapor) {
                //Update Data Rapor

                //Hapus Data Dari Storage
                Storage::delete('public/rapor/'.$rapor->file);

                $file = $request->file('txtFile');
                $file->storeAs('public/rapor', $file->hashName());

                $rapor->update([
                    'n_mtk' => $request->txtNmtk,
                    'n_bing' => $request->txtNbing,
                    'file' => $file->hashName()
                ]);

            } else {
                //Insert Data Rapor
                $rapor = new Rapor();
                $rapor->peserta_id = Auth('peserta')->user()->id;
                $rapor->n_mtk = $request->txtNmtk;
                $rapor->n_bing = $request->txtNbing;

                $file = $request->file('txtFile');
                $file->storeAs('public/rapor', $file->hashName());

                $rapor->file = $file->hashName();
                $rapor->save();
            }
            DB::commit();

            return redirect()->route('peserta.dashboard');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deleteDataRapor($id)
    {
        DB::beginTransaction();
        try {

            $rapor = Rapor::findOrFail($id);

            Storage::delete('public/rapor/'.$rapor->file);

            $rapor->delete();

            DB::commit();
            return redirect()->route('peserta.dashboard');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function updateDataVerifikasi($id)
    {
        DB::beginTransaction();
        try {
            $peserta = Peserta::findOrFail($id);

            if($peserta->nomor != null) {

                $peserta->update([
                    'is_vrf_siswa' => 'Y',
                ]);

            } else {

                $count_peserta = Peserta::where('is_vrf_siswa', 'Y')
                                ->lockForUpdate()
                                ->count();

                $peserta->update([
                    'is_vrf_siswa' => 'Y',
                    'nomor' => '124'.str_pad($count_peserta+1, 5, '0', STR_PAD_LEFT)
                ]);

            }

            DB::commit();
            return redirect()->route('peserta.dashboard');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function cetak($id)
    {
        $data = Peserta::with('sekolah','pil_1','pil_2')->where('id','=',$id)->first();
        $pdf  = PDF::loadView('pdf.kartu',compact('data'));
        $pdf->setPaper('a4','potrait');
        return $pdf->stream('cetak-kartu-peserta.pdf');
        exit();
    }


}
