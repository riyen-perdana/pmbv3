<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pengguna\PenggunaStoreRequest;
use App\Http\Requests\Pengguna\PenggunaUpdateRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Pengguna
        $pengguna = User::query()->with('roles');

        if ($request->has('search')) {
            $pengguna->where('name', 'like', '%' . $request->search . '%');
            $pengguna->orWhere('nip', 'like', '%' . $request->search . '%');
            $pengguna->orWhere('email', 'like', '%' . $request->search . '%');
            $pengguna->orWhere('glr_dpn', 'like', '%' . $request->search . '%');
            $pengguna->orWhere('glr_blk', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        //Query Role
        $role = Role::all();

        return Inertia::render('Apps/Pengguna/Index', [
            'perPage' => intval($perPage),
            'pengguna' => $pengguna->paginate($perPage),
            'filters' => $request->all(['search']),
            'role' => $role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PenggunaStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $pengguna = User::create([
                'nip'       => $request['nipNik'],
                'name'      => $request['namaPegawai'],
                'glr_dpn'   => $request['glrDepan'],
                'glr_blk'   => $request['glrBelakang'],
                'email'     => $request['email'],
                'password'  => bcrypt($request['password']),
                'is_aktif'  => $request['is_aktif']
            ]);

            $pengguna->assignRole($request['otorisasi']);

            DB::commit();

            return redirect()->route('pengguna.index');

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
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PenggunaUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $pengguna = User::findOrFail($id);

            if($request['password']) {
                $pengguna->update([
                    'nip'       => $request['nipNik'],
                    'name'      => $request['namaPegawai'],
                    'glr_dpn'   => $request['glrDepan'],
                    'glr_blk'   => $request['glrBelakang'],
                    'email'     => $request['email'],
                    'password'  => bcrypt($request['password']),
                    'is_aktif'  => $request['is_aktif']
                ]);
            } else {
                $pengguna->update([
                    'nip'       => $request['nipNik'],
                    'name'      => $request['namaPegawai'],
                    'glr_dpn'   => $request['glrDepan'],
                    'glr_blk'   => $request['glrBelakang'],
                    'email'     => $request['email'],
                    'is_aktif'  => $request['is_aktif']
                ]);
            }

            $pengguna->syncRoles($request->otorisasi);

            DB::commit();

            return redirect()->route('pengguna.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        var_dump($id);
        // DB::beginTransaction();
        // try {
        //     //find user by ID
        //     $user = User::findOrFail($id);

        //     //delete role
        //     $user->delete();

        //     DB::commit();
        //     //redirect
        //     return redirect()->route('pengguna.index');

        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return back()->with('errors', $th->getMessage());
        // }
    }
}
