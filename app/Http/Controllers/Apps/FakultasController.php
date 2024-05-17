<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fakultas\FakultasStoreRequest;
use App\Http\Requests\Fakultas\FakultasUpdateRequest;
use App\Models\Akreditasi;
use Illuminate\Http\Request;
use App\Models\Fakultas;
use Inertia\Inertia;
use DB;


class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Fakultas
        $fakultas = Fakultas::query()->with('akreditasi');
        $akreditasi = Akreditasi::orderBy('created_at','ASC')->get();

        if ($request->has('search')) {
            $fakultas->where('nm_fakultas','like','%'. $request->search .'%');
            $fakultas->orWhere('url_fakultas','like','%'. $request->search .'%');
            $fakultas->orWhere('url_akr_fakultas','like','%'. $request->search .'%');
            $fakultas->orWhereRelation('akreditasi','jns_akreditasi','like','%'. $request->search .'%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Fakultas/Index', [
            'perPage' => intval($perPage),
            'fakultas' => $fakultas->paginate($perPage),
            'akreditasi' => $akreditasi,
            'filters' => $request->all(['search'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FakultasStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            Fakultas::create([
                'id_akr_fakultas' => $request['akreditasi'],
                'nm_fakultas' => $request['nmFakultas'],
                'url_fakultas' => $request['linkWebFakultas'],
                'url_akr_fakultas' => $request['linkWebAkreditasiFakultas'],
                'is_aktif' => $request['isAktif']
            ]);

            DB::commit();
            return redirect()->route('fakultas.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FakultasUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $fakultas = Fakultas::findOrFail($id);
            $fakultas->update([
                'id_akr_fakultas' => $request['akreditasi'],
                'nm_fakultas' => $request['nmFakultas'],
                'url_fakultas' => $request['linkWebFakultas'],
                'url_akr_fakultas' => $request['linkWebAkreditasiFakultas'],
                'is_aktif' => $request['isAktif']
            ]);

            DB::commit();

            return redirect()->route('fakultas.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $fakultas = Fakultas::findOrFail($id);
            $fakultas->delete();

            DB::commit();

            return redirect()->route('fakultas.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }
}
