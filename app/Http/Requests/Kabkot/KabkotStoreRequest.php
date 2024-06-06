<?php

namespace App\Http\Requests\Kabkot;

use Illuminate\Foundation\Http\FormRequest;

class KabkotStoreRequest extends FormRequest
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
            'txtKdKabkot' => 'required|unique:kabkot,id',
            'txtNmKabkot' => 'required'
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
            'cboProvinsi.required' => 'Kolom Pilih Provinsi Wajib Diisi',
            'txtKdKabkot.unique'   => 'Kolom Kode Kabupaten/Kota Sudah Ada, Isikan Yang Lain',
            'txtKdKabkot.required' => 'Kolom Kode Kabupaten/Kota Wajib Diisi',
            'txtNmKabkot.required' => 'Kolom Nama Kabupaten/Kota Wajib Diisi',
        ];
    }
}
