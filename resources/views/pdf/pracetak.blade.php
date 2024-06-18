<div class="title" style="padding-bottom: 13px">
    <div style="text-align: center;text-transform: uppercase;font-size: 15px">
        <b>UIN SUSKA RIAU</b>
    </div>
    <div style="text-align: center">
        Jl. H.R Soebrantas No.155 KM 18
    </div>
    <div style="text-align: center">
        Kel. Tuah Madani Kec. Tuah Madani Pekanbaru - Riau Telp: 0761-562223
    </div>
    <div style="text-align: center">
        Pradaftar Undangan Mandiri Universitas Islam Negeri Sultan Syarif Kasim Riau
    </div>
    <div style="text-align: center">
        TA. 2024/2025
    </div>
</div>

<table style="margin-left: auto; margin-right: auto">
    <tr>
        <td>Kode Bayar</td>
        <td>:</td>
        <td>{{ $data->pin }}</td>
    </tr>
    <tr>
        <td>Password/Kata Kunci</td>
        <td>:</td>
        <td>{{ $data->first_password }}</td>
    </tr>
    <tr>
        <td>Nomor Induk Siswa Nasional</td>
        <td>:</td>
        <td>{{ $data->nisn_siswa }}</td>
    </tr>
    <tr>
        <td>Total Bayar</td>
        <td>:</td>
        <td>{{ $data->jlmbayar_siswa }}</td>
    </tr>
    <tr>
        <td>ID</td>
        <td>:</td>
        <td>{{ $data->id }}</td>
    </tr>
</table>

<div style="margin-top: 10px;">
    <p style="font-size: 12px !important;text-align: center">Lakukan Pembayaran dengan memasukkan kode bayar di mobile banking, ATM atau menyebutkan kode tersebut pada teller Bank.</p>
</div>

