<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agama\AgamaStoreRequest;
use App\Http\Requests\Agama\AgamaUpdateRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tingkat;
use Illuminate\Support\Facades\DB;
use App\Models\Agama;

class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Tingkat
        $agama = Agama::query();
        if ($request->has('search')) {
            $agama->where('nm_agama','like','%'. $request->search .'%');
        }

        $agama->orderBy('nm_agama', 'asc');
        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Agama/Index', [
            'perPage' => intval($perPage),
            'agama' => $agama->paginate($perPage),
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
    public function store(AgamaStoreRequest $request)
    {
        DB::beginTransaction();

        try {

            Agama::create([
                'nm_agama' => $request['txtAgama']
            ]);

            DB::commit();

            return redirect()->route('agama.index');

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
    public function update(AgamaUpdateRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $agama = Agama::findOrFail($id);
            $agama->update([
                'nm_agama' => $request['txtAgama']
            ]);
            DB::commit();
            return redirect()->route('agama.index');
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
            $agama = Agama::findOrFail($id);
            $agama->delete();

            DB::commit();

            return redirect()->route('agama.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }
}
