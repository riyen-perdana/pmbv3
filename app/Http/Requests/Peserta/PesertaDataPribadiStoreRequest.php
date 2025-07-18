<?php

namespace App\Http\Requests\Peserta;

use Illuminate\Foundation\Http\FormRequest;

class PesertaDataPribadiStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'txtNamaLengkap' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'txtNamaLengkap' => 'required|regex:/^[a-zA-Z\s]+(?:[\.][a-zA-Z\s]+)*$/|max:255',
            'txtNIK' => 'required|numeric|digits:16|regex:/^[0-9]+$/',
            'txtTptLhr' => 'required',
            'txtTglLhr' => 'required',
            'cboJenKel' => 'required',
            'txtFoto'   => 'required|mimes:jpeg,png,jpg|max:2048',
            'cboAgama' => 'required',
            'txtAlmt' => 'required|max:255',
            'txtEmail' => 'required|email',
            'txtNoHp' => 'required|regex:/^(0)8[1-9][0-9]{6,9}$/',
            'cboProvinsi' => 'required',
            'cboKabkot' => 'required',
            'cboKecamatan' => 'required',
            'cboSekolah' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'txtNamaLengkap.required' => 'Kolom Nama Lengkap Harus Diisi',
            'txtNamaLengkap.regex' => 'Kolom Nama Lengkap Tidak Valid',
            'txtNamaLengkap.max'=> 'Kolom Nama Lengkap Maksimal 255 Karakter',
            'txtNIK.required' => 'Kolom Nomor Induk Kependudukan Harus Diisi',
            'txtNIK.regex' => 'Kolom Nomor Induk Kependudukan Tidak Valid',
            'txtNIK.digits' => 'Kolom Nomor Induk Kependudukan Harus 16 Karakter',
            'txtTptLhr.required' => 'Kolom Tempat Lahir Harus Diisi',
            'txtTglLhr.required' => 'Kolom Tanggal Lahir Harus Diisi',
            'cboJenKel.required' => 'Kolom Jenis Kelamin Harus Diisi',
            'txtFoto.required' => 'Kolom Foto Harus Diisi',
            'txtFoto.mimes' => 'Format Kolom Foto Tidak Valid',
            'txtFoto.max' => 'Ukuran Kolom Foto Max 2Mb',
            'cboAgama.required' => 'Kolom Agama Harus Diisi',
            'txtAlmt.required' => 'Kolom Alamat Harus Diisi',
            'txtEmail.required' => 'Kolom Email Harus Diisi',
            'txtNoHp.required' => 'Kolom Nomor Telepon/HP Harus Diisi',
            'txtNoHp.regex' => 'Kolom Nomor Telepon/HP Tidak Valid',
            'txtEmail.email' => 'Kolom Email Tidak Valid',
            'cboProvinsi.required' => 'Kolom Provinsi Harus Diisi',
            'cboKabkot.required' => 'Kolom Kabupaten/Kota Harus Diisi',
            'cboKecamatan.required' => 'Kolom Kecamatan Harus Diisi',
            'cboSekolah.required' => 'Kolom Sekolah Harus Diisi',
        ];
    }
}
