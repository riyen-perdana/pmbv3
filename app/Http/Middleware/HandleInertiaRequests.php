<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            //session
            'session' => [
                'status' 	=> fn () => $request->session()->get('status'),
                'success'   => fn () => $request->session()->get('success'),
                'error'    	=> fn () => $request->session()->get('error'),
            ],
            //user authenticated
            'auth'=>[
                'user'          => $request->user() ? $request->user() : null,
                'peserta'       => auth()->guard('peserta')->user() ? auth()->guard('peserta')->user() : null,
                'permissions'   => $request->user() ? $request->user()->getPermissionArray() : [],
                'roles'         => $request->user() ? $request->user()->roles()->first()->name : [],
                'fakultas'      => isset($request->user()->fakultas) ? $request->user()->fakultas : null,
                'prodi'         => isset($request->user()->fakultas[0]->prodi) ? $request->user()->fakultas[0]->prodi : null,
                // 'roles'         => $request->user() ? $request->user()->roles()->pluck('name') : []
            ],
            //route
            'route' => function () use ($request) {
                return [
                    'params' => $request->route()->parameters(),
                    'query' => $request->all(),
                ];
            },
        ]);
    }
}
