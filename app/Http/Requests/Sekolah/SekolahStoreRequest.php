<?php

namespace App\Http\Requests\Sekolah;

use Illuminate\Foundation\Http\FormRequest;

class SekolahStoreRequest extends FormRequest
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
            'cboProvinsi' => 'required',
            'cboKabkot' => 'required',
            'txtIdSekolah' => 'required|numeric|min:8|unique:sekolah,id',
            'cboKecamatan' => 'required',
            'txtNmSekolah' => 'required',
            'txtAlamatSekolah' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'cboProvinsi.required'      => 'Kolom Pilih Provinsi Wajib Diisi',
            'cboKabkot.required'        => 'Kolom Pilih Kabupaten/Kota Wajib Diisi',
            'txtIdSekolah.required'     => 'Kolom Nomor Pokok Sekolah Nasional Wajib Diisi',
            'txtIdSekolah.min'          => 'Kolom Nomor Pokok Sekolah Nasional Minimal 8 Karakter',
            'txtIdSekolah.unique'       => 'Kolom Nomor Pokok Sekolah Nasional Sudah Ada, Isikan Yang Lain',
            'txtIdSekolah.numeric'      => 'Kolom Nomor Pokok Sekolah Nasional Hanya Boleh Angka',
            'cboKecamatan.required'     => 'Kolom Pilih Kecamatan Wajib Diisi',
            'txtNmSekolah.required'     => 'Kolom Nama Sekolah Wajib Diisi',
            'txtAlamatSekolah.required' => 'Kolom Alamat Sekolah Wajib Diisi',
        ];
    }
}
