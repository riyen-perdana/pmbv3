<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kecamatan\KecamatanStoreController;
use App\Models\Provinsi;
use App\Models\Kabkot;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Provinsi
        $provinsi = Provinsi::orderBy('id')->get();

        //Query Kecamatan
        $kecamatan = Kecamatan::query()->with('kabkot','kabkot.provinsi');
        if ($request->has('search')) {
            $kecamatan->where('nm_kecamatan','like','%'. $request->search .'%');
            $kecamatan->orWhere('id','like','%'. $request->search .'%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Kecamatan/Index', [
            'perPage' => intval($perPage),
            'kecamatan' => $kecamatan->paginate($perPage),
            'filters' => $request->all(['search']),
            'provinsi' => $provinsi
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
    public function store(KecamatanStoreController $request)
    {
        DB::beginTransaction();

        try {
            Kecamatan::create([
                'id' => $request['txtKdKecamatan'],
                'nm_kecamatan' => $request['txtNmKecamatan'],
                'kabkot_id' => $request['cboKabkot']
            ]);

            DB::commit();

            return redirect()->route('kecamatan.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $kecamatan = Kecamatan::findOrFail($id);
            $kecamatan->delete();

            DB::commit();

            return redirect()->route('kecamatan.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    public function getApi(Request $request)
    {
        $kabkot = $request->id;
        $response = Http::get('https://dapo.kemdikbud.go.id/rekap/dataSekolah?id_level_wilayah=2&kode_wilayah='.$kabkot.'&semester_id=20232');
        return $response;
    }

    /**
     * Tambah API Kabupaten Kota
     * @param id
     * @param id_prov
     * @param nama
     * @return Void
     */
    public function addApiKecamatan(Request $request)
    {
        DB::beginTransaction();
        try {

            Kecamatan::updateOrCreate(
                [
                    'id' => $request['id']
                ],
                [
                    'id' => $request['id'],
                    'kabkot_id' => $request['kabkot_id'],
                    'nm_kecamatan'  => $request['nm_kecamatan']
                ]
            );

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    public function getKecamatan(Kabkot $kabkot)
    {
        return $kabkot->kecamatan;
    }
}
