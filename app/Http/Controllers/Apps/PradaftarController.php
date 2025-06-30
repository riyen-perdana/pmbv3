<?php

namespace App\Http\Controllers\Apps;

use Inertia\Inertia;
use App\Models\Lunas;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Pradaftar\PradaftarStoreRequest;

class PradaftarController extends Controller
{

    public function index()
    {
        //abort(500);
        return Inertia::render('Landing/Pradaftar');
    }


    public function cek(PradaftarStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $response = Http::asForm()->post('https://api-snbp.uin-suska.ac.id/api/check', [
                'nisn' => $request->nisn,
                'npsn' => $request->npsn
            ]);

            //dd($response['data']['status']);

            if ($response['data']['status'] == 'success') {
                if ($response['data']['data']['status'] == '2') {
                    return back()->with('error', 'Maaf Anda Tidak Dapat Mendaftar, Karena Sudah Dinyatakan Lulus SNBP/SNBT');
                } else {
                    $password = rand(100000, 600000);
                    $peserta = Peserta::create([
                        'jalur' => '1',
                        'nisn_siswa' => $request->nisn,
                        'password' => bcrypt($password),
                        'first_password' => $password,
                        'pin' => rand(9921250000, 9921259999),
                        'tgllhr_siswa' => $request->tglLhr,
                        'jlmbayar_siswa' => '250000',
                        'notlpn_siswa' => $request->telepon,
                        'npsn' => $request->npsn
                    ]);
                    DB::commit();

                    return redirect()->route('pradaftar.cetak', ['id' => $peserta->id]);
                }
            } else {
                $password = rand(100000, 600000);
                $peserta = Peserta::create([
                    'jalur' => '1',
                    'nisn_siswa' => $request->nisn,
                    'password' => bcrypt($password),
                    'first_password' => $password,
                    'pin' => rand(9921250000, 9921259999),
                    'tgllhr_siswa' => $request->tglLhr,
                    'jlmbayar_siswa' => '250000',
                    'notlpn_siswa' => $request->telepon,
                    'npsn' => $request->npsn
                ]);
                DB::commit();
                return redirect()->route('pradaftar.cetak', ['id' => $peserta->id]);
            }

            return redirect()->route('pradaftar.index');

            // $lunas = Lunas::where('id', $request->nisn)->first();
            // if($lunas) {
            //     return back()->with('error', 'Maaf Anda Tidak Dapat Mendaftar, Karena Sudah Dinyatakan Lulus SNBP/SNBT');
            // } else {
            //     $password = rand(100000,600000);
            //     $peserta = Peserta::create([
            //         'jalur' => '1',
            //         'nisn_siswa' => $request->nisn,
            //         'password' => bcrypt($password),
            //         'first_password' => $password,
            //         'pin' => rand(992100000, 992999999),
            //         'tgllhr_siswa' => $request->tglLhr,
            //         'jlmbayar_siswa' => '250000',
            //         'notlpn_siswa' => $request->telepon
            //     ]);
            //     DB::commit();

            //     return redirect()->route('pradaftar.cetak',['id' => $peserta->id]);
            // }

            // return redirect()->route('pradaftar.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function cetak(Request $request)
    {
        $peserta = Peserta::where('id', $request->id)->first();
        return Inertia::render('Landing/Cetak', [
            'peserta' => $peserta
        ]);
    }

    public function pdf($id)
    {
        $data = Peserta::where('id', '=', $id)->first();
        $pdf  = PDF::loadView('pdf.pracetak', compact('data'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('pracetak.pdf');
        exit();
    }
}
