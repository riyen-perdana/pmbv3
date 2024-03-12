<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //get Permissions
        // $permission = Permission::when(request()->q, function($permission) {
        //     $permission = $permission->where('name','like','%'.request()->q.'%');
        // })->latest()->paginate(10);

        $permission = Permission::query();
        if($request->has('search')) {
            $permission->where('name','like','%'.$request->search.'%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Permission/Index', [
            'perPage' => intval($perPage),
            'permissions' => $permission->paginate($perPage),
            'filters' => $request->all(['search'])
        ]);
        //dd($request);
    }
}
