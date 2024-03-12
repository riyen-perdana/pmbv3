<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = Permission::all();
        $role = Role::query()->with('permissions');
        if ($request->has('search')) {
            $role->where('name', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Otoritas/Index', [
            'perPage' => intval($perPage),
            'roles' => $role->paginate($perPage),
            'filters' => $request->all(['search']),
            'dataPermissions' => $permissions
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
    public function store(RoleStoreRequest $request)
    {

        DB::beginTransaction();

        try {
            $role = Role::create([
                'name' => $request->nm_role
            ]);

            $role->givePermissionTo($request->permission);

            DB::commit();

            return redirect()->route('roles.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('errors', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        return response()->json($role);
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
    public function update(RoleUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        try {

            $role = Role::findOrFail($id);

            $role->update([
                'name' => $request->nm_role
            ]);

            $role->syncPermissions($request->permission);

            DB::commit();

            return redirect()->route('roles.index');

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
            //find role by ID
            $role = Role::findOrFail($id);

            //delete role
            $role->delete();

            DB::commit();
            //redirect
            return redirect()->route('roles.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('errors', $th->getMessage());
        }
    }
}
