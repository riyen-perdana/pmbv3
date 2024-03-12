<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rektor\RektorStoreRequest;
use App\Http\Requests\Rektor\RektorUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Rektor;
use Inertia\Inertia;
use App\Models\User;



class RektorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rektor = Rektor::query()->with('user');

        if($request->has('search')) {
            $rektor->whereRelation('user', 'nip', 'like', '%'. $request->search . '%');
            $rektor->orWhereRelation('user', 'name', 'like', '%' . $request->search . '%');
            $rektor->orWhereRelation('user', 'glr_dpn', 'like', '%' . $request->search . '%');
            $rektor->orWhereRelation('user', 'glr_blk', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        //Query Pengguna
        $user = User::with('roles')
                ->where('is_aktif','Y')
                ->get();

        return Inertia::render('Apps/Rektor/Index', [
            'perPage' => intval($perPage),
            'rektor' => $rektor->paginate($perPage),
            'filters' => $request->all(['search']),
            'user' => $user
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
    public function store(RektorStoreRequest $request)
    {
        DB::beginTransaction();

        try {

            Rektor::create([
                'id_user' => $request['idUser'],
                'rkt_awl_jbt' => $request['rktAwlJbt'],
                'rkt_akh_jbt' => $request['rktAkhJbt'],
                'is_rektor_aktif' => $request['isRektorAktif'],
                'is_rektor_plt' => $request['isRektorPlt']
            ]);

            DB::commit();

            return redirect()->route('rektor.index');

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
    public function update(RektorUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $rektor = Rektor::findOrFail($id);
            $rektor->update([
                'id_user' => $request['idUser'],
                'rkt_awl_jbt' => $request['rktAwlJbt'],
                'rkt_akh_jbt' => $request['rktAkhJbt'],
                'is_rektor_aktif' => $request['isRektorAktif'],
                'is_rektor_plt' => $request['isRektorPlt']
            ]);

            DB::commit();
            return redirect()->route('rektor.index');

        } catch (\Throwable $th) {
            DB::rollBack();
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
            $rektor = Rektor::findOrFail($id);

            //delete role
            $rektor->delete();

            DB::commit();
            //redirect
            return redirect()->route('rektor.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('errors', $th->getMessage());
        }
    }
}
