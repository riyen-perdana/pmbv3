<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jenis\JenisStoreRequest;
use App\Http\Requests\Jenis\JenisUpdateRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Inkel;
use Illuminate\Support\Facades\DB;

class InkelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Kategori Prestasi
        $inkel = Inkel::query();
        if ($request->has('search')) {
            $inkel->where('nama', 'like', '%' . $request->search . '%');
            $inkel->orWhere('nilai', 'like', '%' . $request->search . '%');
        }

        $inkel->orderBy('nama', 'asc');
        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Inkel/Index', [
            'perPage' => intval($perPage),
            'inkel' => $inkel->paginate($perPage),
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
    public function store(JenisStoreRequest $request)
    {
        DB::beginTransaction();
        try {

            Inkel::create([
                'nama' => $request->txtJenisPrestasi,
                'nilai' => $request->txtNilaiJenisPrestasi
            ]);

            DB::commit();

            return redirect()->route('jenis.index');

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
    public function update(JenisUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $inkel = Inkel::findOrFail($id);
            $inkel->update([
                'nama' => $request->txtJenisPrestasi,
                'nilai' => $request->txtNilaiJenisPrestasi
            ]);

            DB::commit();

            return redirect()->route('jenis.index');

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
            $inkel = Inkel::findOrFail($id);
            $inkel->delete();

            DB::commit();

            return redirect()->route('jenis.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }
}
