<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Peserta\PesertaDataPribadiStoreRequest;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
