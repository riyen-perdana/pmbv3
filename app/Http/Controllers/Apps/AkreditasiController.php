<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Akreditasi\AkreditasiStoreRequest;
use App\Http\Requests\Akreditasi\AkreditasiUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Akreditasi;
use Inertia\Inertia;
use DB;

class AkreditasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Akreditasi
        $akreditasi = Akreditasi::query()->orderBy('created_at','ASC');
        if ($request->has('search')) {
            $akreditasi->where('jns_akreditasi','like','%'. $request->search .'%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Akreditasi/Index', [
            'perPage' => intval($perPage),
            'akreditasi' => $akreditasi->paginate($perPage),
            'filters' => $request->all(['search'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AkreditasiStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            Akreditasi::create([
                'jns_akreditasi'   => $request['jnsAkreditasi'],
                'is_aktif'         => $request['isAktif']
            ]);

            DB::commit();

            return redirect()->route('akreditasi.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AkreditasiUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $akreditasi = Akreditasi::findOrFail($id);

            $akreditasi->update([
                'jns_akreditasi'   => $request['jnsAkreditasi'],
                'is_aktif'         => $request['isAktif']
            ]);

            DB::commit();

            return redirect()->route('akreditasi.index');

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
            //find user by ID
            $akreditasi = Akreditasi::findOrFail($id);

            //delete role
            $akreditasi->delete();

            DB::commit();
            //redirect
            return redirect()->route('akreditasi.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('errors', $th->getMessage());
        }
    }


}
