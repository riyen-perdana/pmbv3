<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Akreditasi;
use App\Models\Fakultas;
use App\Models\Jenjang;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;
use App\Models\Prodi;
use App\Http\Requests\Prodi\ProdiStoreRequest;
use App\Http\Requests\Prodi\ProdiUpdateRequest;
use App\Models\Peserta;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Prodi
        $prodi = Prodi::query()->with('fakultas', 'jenjang', 'akreditasi')->orderBy('created_at', 'ASC');
        $fakultas = Fakultas::where('is_aktif', 'Y')->orderBy('created_at', 'ASC')->get();
        $jenjang = Jenjang::where('is_aktif', 'Y')->orderBy('created_at', 'ASC')->get();
        $akreditasi = Akreditasi::where('is_aktif', 'Y')->orderBy('created_at')->get();
        if ($request->has('search')) {
            $prodi->where('kd_prodi', 'like', '%' . $request->search . '%')
                ->orWhere('nm_prodi', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Prodi/Index', [
            'perPage' => intval($perPage),
            'prodi' => $prodi->paginate($perPage),
            'filters' => $request->all(['search']),
            'fakultas' => $fakultas,
            'jenjang' => $jenjang,
            'akreditasi' => $akreditasi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdiStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            Prodi::create([
                'kd_prodi' => $request['txtKodeProdi'],
                'id_fakultas' => $request['optNmFakultas'],
                'id_jenjang' => $request['optJenjang'],
                'id_akr_prodi' => $request['optAkreditasi'],
                'nm_prodi' => $request['txtNmProdi'],
                'url_prodi' => $request['txtLinkProdi'],
                'url_akr_prodi' => $request['txtLinkAkreditasiProdi'],
                'is_aktif' => $request['optStatusAktif'],
                'is_pil_34' => $request['cboPil34'],
                'quota' => $request['txtQuota'],
                'is_valid' => $request['optStatusValidasi'],
            ]);

            DB::commit();

            return redirect()->route('prodi.index');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdiUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $prodi = Prodi::findOrFail($id);
            $prodi->update([
                'kd_prodi' => $request['txtKodeProdi'],
                'id_fakultas' => $request['optNmFakultas'],
                'id_jenjang' => $request['optJenjang'],
                'id_akr_prodi' => $request['optAkreditasi'],
                'nm_prodi' => $request['txtNmProdi'],
                'url_prodi' => $request['txtLinkProdi'],
                'url_akr_prodi' => $request['txtLinkAkreditasiProdi'],
                'is_aktif' => $request['optStatusAktif'],
                'is_pil_34' => $request['cboPil34'],
                'quota' => $request['txtQuota'],
                'is_valid' => $request['optStatusValidasi'],
            ]);

            DB::commit();

            return redirect()->route('prodi.index');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $prodi = Prodi::findOrFail($id);
            $prodi->delete();

            DB::commit();

            return redirect()->route('Prodi.index');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    public function cetak($id)
    {
        $peserta = Peserta::where([['is_lulus', 'Y'], ['prodills_siswa', $id]])->get();
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('format_kelulusan.docx'));

        $jumlahlls = $peserta->count();
        $template->cloneRow('no', $jumlahlls);

        $i = 1;
        foreach ($peserta as $pst) {
            $template->setValue('no#' . $i, $i);
            $template->setValue('no_daftar#' . $i, ucwords($pst->nomor));
            $template->setValue('nama#' . $i, ucwords($pst->nm_siswa));
            $template->setValue('ket#' . $i, 'LULUS');
            $i++;
        }

        $template->setValue('tgl', tanggal_indonesia(date("Y-m-d"), false));

        $prodi = Prodi::where('id', $id)->first();
        $template->setValue('dkn_nm', $prodi->fakultas->user->full_nm_user);
        $template->setValue('dkn_nip', $prodi->fakultas->user->nip);
        $template->setValue('fak', $prodi->fakultas->nm_fakultas);
        $template->setValue('prodi', $prodi->nm_prodi);

        $ta_a = date("Y");
        $ta_n = $ta_a + 1;

        $template->setValue('ta_a', $ta_a);
        $template->setValue('ta_n', $ta_n);

        $filename       = 'Laporan Kelulusan.docx';
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        //$template->saveAs('php://output');
        $template->saveAs(storage_path('/app/public/' . $filename));
    }

    public function forceDownloadFile()
    {
        $filePath = storage_path('/app/public/Laporan Kelulusan.docx');
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $fileName = 'Laporan Kelulusan' . date(now()) . '.docx';
        //return Storage::download($filePath, $fileName);
        return response()->download($filePath, $fileName, $headers);
    }
}
