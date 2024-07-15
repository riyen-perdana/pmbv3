<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sekolah\SekolahStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use App\Models\Provinsi;
use App\Models\Sekolah;
use GuzzleHttp\Client;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Provinsi
        $provinsi = Provinsi::orderBy('id')->get();

        //Query Sekolah
        $sekolah = Sekolah::query()->with('kecamatan','kecamatan.kabkot','kecamatan.kabkot.provinsi');
        if($request->has('search')) {
            $sekolah->where('id','like','%'. $request->search .'%');
            $sekolah->orWhere('nama','like','%'. $request->search .'%');
        }

        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Apps/Sekolah/Index', [
            'perPage' => intval($perPage),
            'sekolah' => $sekolah->paginate($perPage),
            'filters' => $request->all(['search']),
            'provinsi' => $provinsi
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
    public function store(SekolahStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            Sekolah::create([
                'id' => $request['txtIdSekolah'],
                'nama' => $request['txtNmSekolah'],
                'kecamatan_id' => $request['cboKecamatan'],
                'alamat' => $request['txtAlamatSekolah']
            ]);
            DB::commit();
            return redirect()->route('sekolah.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
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

    /**
     * Get Data Sekolah dari Dapodik
     */
    public function getApi(Request $request)
    {
        $id = $request['kecamatan'];
        $client = new Client();
        $response = $client->get('https://referensi.data.kemdikbud.go.id/pendidikan/dikmen/'.$id.'/3');

        $html = $response->getBody();

        $dom = new \DOMDocument();
        @$dom->loadHTML($html);

        $tableData = [];
        $table = $dom->getElementsByTagName('table')->item(0);

        try {
            if(!is_null($table)) {
                $rows = $table->getElementsByTagName('tr');
                foreach ($rows as $row) {
                    $rowData = [];
                    $cells = $row->getElementsByTagName('td');
                    foreach ($cells as $cell) {
                        $rowData[] = $cell->nodeValue;
                    }
                    $tableData[] = $rowData;
                }
            }
            unset($tableData[0]);
            return $tableData;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addApiSekolah(Request $request)
    {
        DB::beginTransaction();
        try {
            Sekolah::updateOrCreate(
                [
                    'id' => $request['id']
                ],
                [
                    'id' => $request['id'],
                    'kecamatan_id' => $request['kecamatan_id'],
                    'nama'  => $request['nama'],
                    'alamat' => $request['alamat']
                ]
            );
            DB::commit();

            return redirect()->route('sekolah.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }
}
