<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Kabkot;
use Illuminate\Http\Request;
use DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Redis;

class KabkotControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Kabkot
        $kabkot = Kabkot::query()->with('provinsi');
        if ($request->has('search')) {
            $kabkot->where('nm_kabkot','like','%'. $request->search .'%');
            $kabkot->orWhere('id','like','%'. $request->search .'%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        //Query Propinsi
        $prov = Provinsi::orderBy('id')->get();


        return Inertia::render('Apps/Kabkot/Index', [
            'perPage' => intval($perPage),
            'kabkot' => $kabkot->paginate($perPage),
            'filters' => $request->all(['search']),
            'provinsi' => $prov
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
    public function store(Request $request)
    {
        //
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
        //
    }

    public function getApi(Request $request)
    {
        $kabkot = $request->id;
        $response = Http::get('https://dapo.kemdikbud.go.id/rekap/dataSekolah?id_level_wilayah=1&kode_wilayah='.$kabkot.'&semester_id=20232');
        return $response;
    }

    /**
     * Tambah API Kabupaten Kota
     * @param id
     * @param id_prov
     * @param nama
     * @return Void
     */
    public function addApiKabkot(Request $request)
    {
        DB::beginTransaction();
        try {
            Kabkot::updateOrCreate(
                [
                    'id' => $request['id']
                ],
                [
                    'id' => $request['id'],
                    'prov_id' => $request['prov_id'],
                    'nm_kabkot'  => $request['nm_kabkot']
                ]
            );

            DB::commit();


        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

}