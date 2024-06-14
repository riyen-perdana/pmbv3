<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tingkat\TingkatStoreRequest;
use App\Http\Requests\Tingkat\TingkatUpdateRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tingkat;
use Illuminate\Support\Facades\DB;

class TingkatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Tingkat
        $tingkat = Tingkat::query();
        if ($request->has('search')) {
            $tingkat->where('nama','like','%'. $request->search .'%');
            $tingkat->orWhere('nilai','like','%'. $request->search .'%');
        }

        $tingkat->orderBy('nama', 'asc');
        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Tingkat/Index', [
            'perPage' => intval($perPage),
            'tingkat' => $tingkat->paginate($perPage),
            'filters' => $request->all(['search'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TingkatStoreRequest $request)
    {
        DB::beginTransaction();
        try {

            Tingkat::create([
                'nama' => $request->txtTingkatPrestasi,
                'nilai' => $request->txtNilaiTingkatPrestasi
            ]);

            DB::commit();

            return redirect()->route('tingkat.index');

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
            $tingkat = Tingkat::findOrFail($id);
            $tingkat->delete();

            DB::commit();

            return redirect()->route('tingkat.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TingkatUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $tingkat = Tingkat::findOrFail($id);
            $tingkat->update([
                'nama' => $request->txtTingkatPrestasi,
                'nilai' => $request->txtNilaiTingkatPrestasi
            ]);

            DB::commit();

            return redirect()->route('tingkat.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

}
