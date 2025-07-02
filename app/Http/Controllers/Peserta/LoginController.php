<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'nisn'      => 'required',
            'password'  => 'required',
        ]);

        $peserta = Peserta::where([['nisn_siswa', '=', $request->nisn],['first_password','=', $request->password]])->first();

        if(!$peserta) {
            return redirect()->back()->with('error', 'Nomor Induk Siswa Nasional Tidak Terdaftar');
        } else {
            $pass = Hash::check($request->password, $peserta->password);
            if(!$pass) {
                return redirect()->back()->with('error', 'Nomor Induk Siswa Nasional atau Kata Kunci Anda Salah');
            } else {
                if($peserta->is_bayar == 0) {
                    return redirect()->back()->with('error', 'Anda Belum Melakukan Pembayaran');
                } else {
                    //login the user
                    //return redirect()->back()->with('error', 'Login Sukses');
                    auth()->guard('peserta')->login($peserta);
                    return redirect()->route('peserta.dashboard');
                }
            }
        }
    }
}
