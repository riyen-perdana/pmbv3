@extends('layouts.kartu')

@section('content')
    <div id="container">
        <div id="header">
            <div class="L">
                <img class="left" src="{{ public_path('images/logo-uin.png') }}" />
            </div>
            <div class="R">
                <h3>SELEKSI MASUK PMB JALUR UNDANGAN MANDIRI</h3>
                <h4>UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM RIAU</h4>
                @php
                    $thn_a = date('Y');
                    $thn_n = $thn_a + 1;
                @endphp
                <h4>TA. @php
                    echo $thn_a . '/' . $thn_n;
                @endphp</h4>
            </div>
        </div>
        <div id="content" class="L">
            <img src="{{ public_path('storage/fotopeserta/' . $data->foto_siswa) }}" width="160px" height="220px">
        </div>
        <div id="content" class="R">
            <p>NOMOR PENDAFTARAN</p>
            <p class="label"><b>{{ $data->nomor }}</b></p>
            <p>NOMOR INDUK SISWA NASIONAL</p>
            <p class="label"><b>{{ $data->nisn_siswa }}</b></p>
            <p>NAMA SISWA</p>
            <p class="label"><b>{{ strtoupper($data->nm_siswa) }}</b></p>
            <p>SEKOLAH ASAL</p>
            <p class="label"><b>{{ $data->sekolah->nama }}</b></p>
        </div>
        <div id="prodi">
            <p><b>Pilihan Program Studi :</b></p>
        </div>
        <div id="prodilist">
            <p><b>1. {{ strtoupper($data->pil_1->nm_prodi) }}</b></p>
            <p><b>2. {{ strtoupper($data->pil_2->nm_prodi) }}</b></p>
            <p><b>3. {{ strtoupper($data->pil_3->nm_prodi) }}</b></p>
            <p><b>4. {{ strtoupper($data->pil_4->nm_prodi) }}</b></p>
        </div>
        <div id="pernyataan">
            <p><strong>Pernyataan : </strong></p>
            <p>Saya menyatakan bahwa data yang saya isikan dalam formulir pendaftaran Seleksi PMB Jalur Undangan Mandiri UIN
                SUSKA Riau ini adalah benar. Saya bersedia menerima sanksi pembatalan penerimaan di UIN SUSKA Riau apabila
                saya melanggar pernyataan ini.</p>
            <br><br>
            <div class="col-md-12">
                <div class="col-md-6">&nbsp;</div>
                <div class="col-md-6">
                    <p style="text-align: center;">ttd</p><br><br><br><br>
                    <p style="text-align: center;">({{ strtoupper($data->nm_siswa) }})</p>
                </div>
            </div>
        </div>
    </div>
@endsection
