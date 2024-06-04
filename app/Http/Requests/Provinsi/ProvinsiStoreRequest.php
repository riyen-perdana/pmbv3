<?php

namespace App\Http\Requests\Provinsi;

use Illuminate\Foundation\Http\FormRequest;

class ProvinsiStoreRequest extends FormRequest
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
            'txtIDProvinsi' => 'required|unique:provinsi,id',
            'txtNmProvinsi' => 'required'
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
            'txtIDProvinsi.required' => 'Kolom ID Provinsi Wajib Diisi',
            'txtIDProvinsi.unique'   => 'ID Provinsi Sudah Ada, Isikan Yang Lain',
            'txtNmProvinsi.required' => 'Kolom Nama Provinsi Wajib Diisi',
        ];
    }
}
