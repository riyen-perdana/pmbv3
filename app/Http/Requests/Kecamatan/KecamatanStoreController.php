<?php

namespace App\Http\Requests\Kecamatan;

use Illuminate\Foundation\Http\FormRequest;

class KecamatanStoreController extends FormRequest
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
            'txtKdKecamatan' => 'required|unique:kecamatan,id',
            'txtNmKecamatan' => 'required'
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
            'cboKabkot.required'        => 'Kolom Pilih Kabupaten Kota Wajib Diisi',
            'txtKdKecamatan.unique'     => 'Kolom Kode Kecamatan Sudah Ada, Isikan Yang Lain',
            'txtKdKecamatan.required'   => 'Kolom Kode Kecamatan Wajib Diisi',
            'txtNmKecamatan.required'   => 'Kolom Nama Kecamatan Wajib Diisi',
        ];
    }
}
