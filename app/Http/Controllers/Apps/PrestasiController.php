<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prestasi\PrestasiStoreRequest;
use App\Http\Requests\Prestasi\PrestasiUpdateRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Bidang;
use Illuminate\Support\Facades\DB;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Bidang
        $bidang = Bidang::query();
        if ($request->has('search')) {
            $bidang->where('nama','like','%'. $request->search .'%');
            $bidang->orWhere('nilai','like','%'. $request->search .'%');
        }

        $bidang->orderBy('nama', 'asc');
        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Prestasi/Index', [
            'perPage' => intval($perPage),
            'bidang' => $bidang->paginate($perPage),
            'filters' => $request->all(['search'])
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
    public function store(PrestasiStoreRequest $request)
    {
        DB::beginTransaction();
        try {

            Bidang::create([
                'nama' => $request->txtBidangPrestasi,
                'nilai' => $request->txtNilaiBidangPrestasi
            ]);

            DB::commit();

            return redirect()->route('prestasi.index');

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
    public function update(PrestasiUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $prestasi = Bidang::findOrFail($id);
            $prestasi->update([
                'nama' => $request->txtBidangPrestasi,
                'nilai' => $request->txtNilaiBidangPrestasi
            ]);

            DB::commit();

            return redirect()->route('prestasi.index');

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
            $bidang = Bidang::findOrFail($id);
            $bidang->delete();

            DB::commit();

            return redirect()->route('prestasi.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }
}
