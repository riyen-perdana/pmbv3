<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jenjang\JenjangStoreRequest;
use App\Http\Requests\Jenjang\JenjangUpdateRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Jenjang;
use DB;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Akreditasi
        $jenjang = Jenjang::query();
        if ($request->has('search')) {
            $jenjang->where('kd_jenjang','like','%'. $request->search .'%');
            $jenjang->orWhere('nm_jenjang', 'like' , '%'. $request->search .'%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Jenjang/Index', [
            'perPage' => intval($perPage),
            'jenjang' => $jenjang->paginate($perPage),
            'filters' => $request->all(['search'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JenjangStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            Jenjang::create([
                'kd_jenjang'   => $request['kdJenjangPendidikan'],
                'is_aktif'     => $request['isAktif'],
                'nm_jenjang'   => $request['nMJenjangPendidikan']
            ]);

            DB::commit();

            return redirect()->route('jenjang.index');

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
            //find user by ID
            $jenjang = Jenjang::findOrFail($id);

            //delete role
            $jenjang->delete();

            DB::commit();
            //redirect
            return redirect()->route('jenjang.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('errors', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(JenjangUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        try {

            $jenjang = Jenjang::findOrFail($id);

            $jenjang->update([
                'kd_jenjang'   => $request['kdJenjangPendidikan'],
                'is_aktif'     => $request['isAktif'],
                'nm_jenjang'   => $request['nMJenjangPendidikan']
            ]);

            DB::commit();

            return redirect()->route('jenjang.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


}
