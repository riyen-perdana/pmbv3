<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Peserta;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user_count     = User::all()->count();
        $peserta_count  = Peserta::all()->count();
        return Inertia::render('Apps/Dashboard/Index',[
            'user_count'    => $user_count,
            'peserta_count' => $peserta_count
        ]);
    }
}
