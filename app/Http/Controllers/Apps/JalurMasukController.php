<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\JalurMasuk;

class JalurMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jalurMasuk = JalurMasuk::query();
        if ($request->has('search')) {
            $agama->where('nm_agama','like','%'. $request->search .'%');
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        
        return Inertia::render('Apps/JalurMasuk/Index', [
            'perPage' => intval($perPage),
            'jalurMasuk' => $jalurMasuk->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString(),
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
