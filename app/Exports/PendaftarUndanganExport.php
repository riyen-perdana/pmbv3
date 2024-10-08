<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendaftarUndanganExport implements FromCollection, WithMapping, WithHeadings
{

    protected $peserta;

    public function __construct($peserta)
    {
        $this->peserta = $peserta;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->peserta;
    }

    public function map($peserta): array
    {
        return [
            $peserta->nisn_siswa,
            strtoupper($peserta->nm_siswa),
            $peserta->nomor,
            $peserta->npsn,
            $peserta->nm_sekolah,
            strtoupper($peserta->nm_kabkot),
            strtoupper($peserta->nm_provinsi),
            strtoupper($peserta->pil_1),
            strtoupper($peserta->pil_2),
            strtoupper($peserta->pil_3),
            strtoupper($peserta->pil_4),
        ];
    }

    public function headings() : array {
        return [
           'NISN',
           'Nama Siswa',
           'Nomor Peserta',
           'NPSN',
           'Nama Sekolah',
           'Kabupaten/Kota',
           'Provinsi',
           'Pilihan 1',
           'Pilihan 2',
           'Pilihan 3',
           'Pilihan 4'
        ];
    }
}
