<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provinsi\ProvinsiStoreRequest;
use App\Http\Requests\Provinsi\ProvinsiUpdateRequest;
use App\Models\Kabkot;
use Illuminate\Http\Request;
use DB;
use Inertia\Inertia;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Http;


class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Provinsi
        $provinsi = Provinsi::query();
        if ($request->has('search')) {
            $provinsi->where('nm_provinsi','like','%'. $request->search .'%');
            $provinsi->orWhere('id','like','%'. $request->search .'%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Provinsi/Index', [
            'perPage' => intval($perPage),
            'provinsi' => $provinsi->paginate($perPage),
            'filters' => $request->all(['search'])
        ]);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(ProvinsiStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            Provinsi::create([
                'id' => $request['txtIDProvinsi'],
                'nm_provinsi' => $request['txtNmProvinsi']
            ]);

            DB::commit();

            return redirect()->route('provinsi.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    public function getApi()
    {
        $response = Http::get('https://dapo.kemdikbud.go.id/rekap/dataSekolah?id_level_wilayah=0&kode_wilayah=000000&semester_id=20232');
        return $response;
    }

    /**
     * Hapus Seluruh Data Provinsi
     * @param void
     * @return void
     */
    public function deleteAllProvinsi()
    {
        DB::beginTransaction();
        try {
            Provinsi::query()->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $provinsi = Provinsi::findOrFail($id);
            $provinsi->delete();

            DB::commit();

            return redirect()->route('provinsi.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Tambah Data API
     */
    public function addApiProvinsi(Request $request)
    {
        DB::beginTransaction();

        try {

            Provinsi::updateOrCreate(
                [
                    'id' => $request['id']
                ],
                [
                    'id' => $request['id'],
                    'nm_provinsi' => $request['nm_provinsi']
                ]
            );
            // Provinsi::create([
            //     'id' => $request['id'],
            //     'nm_provinsi' => $request['nm_provinsi']
            // ]);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProvinsiUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $provinsi = Provinsi::findOrFail($id);
            $provinsi->update([
                'id' => $request['txtIDProvinsi'],
                'nm_provinsi' => $request['txtNmProvinsi']
            ]);

            DB::commit();

            return redirect()->route('provinsi.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

}
